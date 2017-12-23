<?php
function bds_cart(){
   if(isset($_SESSION['teacher'])){
       $user_id = $_SESSION['teacher'];
   }
   if(isset($_SESSION['parent'])){
       $user_id = $_SESSION['parent'];
   }
   if(isset($_SESSION['student'])){
       $user_id = $_SESSION['student'];
   }
   
?>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>

    <?php
    global $wpdb;
    
    //$activity_id = $_GET['activity_id'];
    $post_table = $wpdb->prefix.'posts';
    $calp_events = $wpdb->prefix.'calp_events';
    $activities_orders_table = $wpdb->prefix.'activities_orders';
    
    if(isset($_GET['cart_item_id'])){
        $delete_cart_product =  "DELETE FROM $activities_orders_table WHERE id ='".$_GET['cart_item_id']."'";
        $result= $wpdb->query($delete_cart_product);	

        if (false === $result) { 
        ?>
            <script type="text/javascript">
                jQuery(document).ready(function(){
                   swal('Error!', 'Unknown Error', 'error');
                });

            </script>
        <?php   
        } else {
        ?>
            <script type="text/javascript">
                jQuery(document).ready(function(){
                    swal('Success!', 'Cart Item Removed Successfully', 'success');
                });
            </script>
        <?php       
        } 
    }
    ////calculate cart price
    $cart_price = $wpdb->get_row("SELECT SUM(price) AS TotalItemsOrdered FROM $activities_orders_table "
             ."INNER JOIN $post_table ON $post_table.ID = $activities_orders_table.product_id "
             ."INNER JOIN $calp_events ON $calp_events.post_id = $activities_orders_table.product_id "
             ."WHERE $activities_orders_table.customer_id = '".$user_id."' AND $activities_orders_table.order_status='in_cart'" );
    $cart_price=$cart_price->TotalItemsOrdered;
    
    $cart_products = $wpdb->get_results("SELECT *, $activities_orders_table.id AS cart_item_id FROM $activities_orders_table "
             ."INNER JOIN $post_table ON $post_table.ID = $activities_orders_table.product_id "
             ."INNER JOIN $calp_events ON $calp_events.post_id = $activities_orders_table.product_id "
             ."WHERE $activities_orders_table.customer_id = '".$user_id."' AND $activities_orders_table.order_status='in_cart'" );
    //echo "SELECT * FROM $activities_orders_table "
//             ."INNER JOIN $post_table ON $post_table.ID = $activities_orders_table.product_id "
//             ."INNER JOIN $calp_events ON $calp_events.post_id = $activities_orders_table.product_id "
//             ."WHERE $activities_orders_table.customer_id = '".$user_id."' AND $activities_orders_table.order_status='in_cart'";exit
    //echo "SELECT $post_table.post_title ,$calp_events.start FROM $post_table INNER JOIN $calp_events ON $post_table.ID = $calp_events.post_id WHERE $post_table.ID = '".$activity_id."'";
    //exit;
    //echo $query = "SELECT * FROM $table WHERE ID = '".$activity_id."' ";
    //$activities = $wpdb->get_results( $query );
    //print_r($activities);
    //$value = $activities[0];
    $cart_products_count= $wpdb->num_rows;
    ?>
        

   
    <div class="mc-content-wrap">

    
    <div class="h_wrapper">
        
        <div class="chk_out">
            <span><a href="<?= site_url()."/bds-checkout/" ?>" style="color:#fff;">Checkout</a></span>
            <span><a href="<?= site_url()."/bds-cart/" ?>" style="color:#fff;"><?php echo $cart_products_count == 0 ? '(0)' : '('.$cart_products_count.')' ; ?> <i class="fa fa-shopping-cart" aria-hidden="true"></i> $<?php echo $cart_price == 0 ? '0': $cart_price; ?> </a></span>

        </div>
        <div class="event-detail-wrap">
                <table id="cart" class=" bds-table-manage">
                    <thead>
                            <tr>
                                    <th style="width:50%">Product</th>
                                    <th style="width:10%">Price</th>
                                    <th>&nbsp;</th>
                                    <!--<th style="width:8%">Quantity</th>-->
                                    <th style="width:22%" class="text-center">Subtotal</th>
                                    <th style="width:10%"></th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($cart_products as $products){
                            
                        ?>
                            <tr>
                                    <td data-th="Product">
                                            <div class="row">
                                                    <div class="col-sm-2 hidden-xs">
                                                        <?php
                                                            if(has_post_thumbnail($products->product_id)){
                                                                $thumb= wp_get_attachment_image_src(get_post_thumbnail_id($products->ID),'activity-detail');
                                                                $thumb[0];
                                                            }
                                                            if($thumb[0] != ""){
                                                            ?>
                                                                <img src="<?= $thumb[0]; ?>" alt="" width="100%" >
                                                            <?php
                                                            }else{
                                                            ?>
                                                              <img src="http://placehold.it/100x100" alt="..." class="img-responsive"/>  
                                                            <?php    
                                                            }
                                                                
                                                        ?>
                                                        
                                                        
                                                        <!--<img src="http://placehold.it/100x100" alt="..." class="img-responsive"/>-->
                                                    </div>
                                                    <div class="col-sm-10">
                                                            <h4 class="nomargin"><?php echo $products->post_title; ?></h4>
                                                            <p>
                                                                <?php 
                                                                    $sbr=$products->post_content ;
                                                                    echo limit_text($sbr,10);
                                                                ?>
                                                            </p>
                                                    </div>
                                            </div>
                                    </td>
                                    
                                    <td data-th="Price">$<?php echo $products->price ; ?></td>
                                    <td>&nbsp;</td>
<!--                                            <td data-th="Quantity">
                                            <input type="number" class="form-control text-center" value="1">
                                    </td>-->
                                    <td data-th="Subtotal" class="text-center">$<?php echo $products->price ; ?></td>
                                    <td class="actions" data-th="">
                                            <!--<button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>-->
                                        <a href="<?php echo site_url()."/bds-cart/?cart_item_id=".$products->cart_item_id ;?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>								
                                    </td>
                            </tr>
                        <?php 
                        }
                        ?>    
                    </tbody>
                            <tfoot>
                                    <tr class="visible-xs">
                                            <td class="text-center"><strong>Total $<?= $cart_price ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= site_url()."/teacher-activities-new/"; ?>" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                                            <td colspan="2" class="hidden-xs"></td>
                                            <td class="hidden-xs text-center"><strong>Total $<?= $cart_price ?></strong></td>
                                            <td><a href="<?= site_url().'/bds-checkout/' ?>" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                                    </tr>
                            </tfoot>
                    </table>
        </div>
       
    </div>
        </div>
<?php }