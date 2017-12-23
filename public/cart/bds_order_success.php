<?php
function bds_order_success(){
   $txn_id= $_SESSION['txn_id'];
   
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
    
    
    ////calculate cart price
    $cart_price = $wpdb->get_row("SELECT SUM(price) AS TotalItemsOrdered FROM $activities_orders_table "
             ."INNER JOIN $post_table ON $post_table.ID = $activities_orders_table.product_id "
             ."INNER JOIN $calp_events ON $calp_events.post_id = $activities_orders_table.product_id "
             ."WHERE $activities_orders_table.customer_id = '".$user_id."' AND $activities_orders_table.txn_id = '".$txn_id."' AND $activities_orders_table.order_status='completed'" );
    $cart_price=$cart_price->TotalItemsOrdered;
    
    $cart_products = $wpdb->get_results("SELECT *, $activities_orders_table.id AS cart_item_id FROM $activities_orders_table "
             ."INNER JOIN $post_table ON $post_table.ID = $activities_orders_table.product_id "
             ."INNER JOIN $calp_events ON $calp_events.post_id = $activities_orders_table.product_id "
             ."WHERE $activities_orders_table.customer_id = '".$user_id."' AND $activities_orders_table.txn_id = '".$txn_id."' AND $activities_orders_table.order_status='completed'" );

    $cart_products_count= $wpdb->num_rows;
    ?>
    
<div class="mc-content-wrap">
    

    <div class="h_wrapper">
        
        <div class="chk_out">
            <span><a href="<?= site_url()."/bds-checkout/" ?>" style="color:#fff;">Checkout</a></span>
            <span><a href="<?= site_url()."/bds-cart/" ?>" style="color:#fff;"><?php echo $cart_products_count == 0 ? '(0)' : '('.$cart_products_count.')' ; ?> <i class="fa fa-shopping-cart" aria-hidden="true"></i> $<?php echo $cart_price == 0 ? '0': $cart_price; ?> </a></span>

        </div>
        <div class="event-detail-wrap" style="background: #fff;padding:10px;">
                <h2 style="color:green;">Thank you !</h2>
                <h4 style="color:green;">Your order has been placed sucessfully! </h4>
                <table id="cart" class=" bds-table-manage">
                    <thead>
                            <tr>
                                    <th style="width:50%">Product</th>
                                    <th style="width:10%">Price</th>
                                    
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
                                   
                            </tr>
                        <?php 
                        }
                        ?>    
                    </tbody>
                            <tfoot>
                                    
                                    <tr>
                                        <td><a href="<?= site_url()."/teacher-activities-new/"; ?>" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                                            <td colspan="2" class="hidden-xs">$<?php echo $cart_price; ?> &nbsp;</td>
                                            
                                    </tr>
                            </tfoot>
                    </table>
        </div>
       
    </div>
    
</div>    
<?php 
    unset($_SESSION['txn_id']);
}
?>