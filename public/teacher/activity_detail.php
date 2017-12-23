<?php
function activity_detail(){
    global $wpdb,$calp_events_helper;
    /*adil edit session logout*/
    if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
            $user = true;
    }else{
            echo '<script>window.location="'.get_site_url().'/login";</script>';
            exit();
    } 
    
   if(isset($_SESSION['teacher'])){
       $user_id = $_SESSION['teacher'];
   }
   if(isset($_SESSION['parent'])){
       $user_id = $_SESSION['parent'];
   }
   if(isset($_SESSION['student'])){
       $user_id = $_SESSION['student'];
   }
   
   $site_url = site_url();
   wp_enqueue_style('rating_css', plugin_dir_url(FILE) . 'teacher/css/rating/jquery.rateyo.css', array(), get_bloginfo('version'), '');
//   wp_enqueue_script( 'rating_css', $site_url.'/wp-content/plugins/teacher/css/rating/jquery.rateyo.css', array( 'jquery' ), get_bloginfo('version'), false );
?>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>

    <?php
    
    $activity_id = $_GET['activity_id'];
    $activity_cat_id = $_GET['cat_id'];
    //echo get_category( $activity_cat_id );
    $getProductCat = get_the_terms( $activity_id, 'product-cat' ); 
    foreach ( $getProductCat as $productInfo ) {
        echo $productInfo->name;
    }
    $post_table = $wpdb->prefix.'posts';
    $calp_events = $wpdb->prefix.'calp_events';
    $activity_detail = $wpdb->get_row("SELECT * FROM $post_table INNER JOIN $calp_events ON $post_table.ID = $calp_events.post_id WHERE $post_table.ID = '".$activity_id."'" );
    //echo "SELECT $post_table.post_title ,$calp_events.start FROM $post_table INNER JOIN $calp_events ON $post_table.ID = $calp_events.post_id WHERE $post_table.ID = '".$activity_id."'";
    //exit;
    //echo $query = "SELECT * FROM $table WHERE ID = '".$activity_id."' ";
    //$activities = $wpdb->get_results( $query );
    //print_r($activities);
    //$value = $activities[0];
    
    //$post_table = $wpdb->prefix.'posts';
    //$calp_events = $wpdb->prefix.'calp_events';
    $activities_orders_table = $wpdb->prefix.'activities_orders';
    $cart_price = $wpdb->get_row("SELECT SUM(price) AS TotalItemsOrdered FROM $activities_orders_table "
             ."INNER JOIN $post_table ON $post_table.ID = $activities_orders_table.product_id "
             ."INNER JOIN $calp_events ON $calp_events.post_id = $activities_orders_table.product_id "
             ."WHERE $activities_orders_table.customer_id = '".$user_id."' AND $activities_orders_table.order_status='in_cart'" );
    $cart_price=$cart_price->TotalItemsOrdered;
    
    $cart_products = $wpdb->get_results("SELECT *, $activities_orders_table.id AS cart_item_id FROM $activities_orders_table "
             ."INNER JOIN $post_table ON $post_table.ID = $activities_orders_table.product_id "
             ."INNER JOIN $calp_events ON $calp_events.post_id = $activities_orders_table.product_id "
             ."WHERE $activities_orders_table.customer_id = '".$user_id."' AND $activities_orders_table.order_status='in_cart'" );
    $cart_products_count= $wpdb->num_rows;
    
    $event_details_date = $wpdb->get_row("SELECT UNIX_TIMESTAMP(start) as start , UNIX_TIMESTAMP(end) as end FROM $calp_events where post_id  = '".$activity_id."'" );
    ?>
    <div class="h_wrapper">
        
        <div class="chk_out top-action">
            <div class="col-md-6">
                <h2 class="title">Activities:</h2>
            </div>
            <div class="col-md-6">
                <span class="header-checkout-link"><a href="<?= site_url()."/bds-checkout/" ?>" style="color:#fff;">Checkout</a></span>
                <span class="header-cart-link"><a href="<?= site_url()."/bds-cart/" ?>" style="color:#fff;"><?php echo $cart_products_count == 0 ? '(0)' : '('.$cart_products_count.')' ; ?> <i class="fa fa-shopping-cart" aria-hidden="true"></i> $<?php echo $cart_price == 0 ? '0': $cart_price; ?> </a></span>
            </div>
            

        </div>
        <div class="event-detail-wrap">
            
            <div class="left-content">
                <div class="image-wrap">
                    <?php
                    if(has_post_thumbnail($activity_detail->ID)){
                        $thumb= wp_get_attachment_image_src(get_post_thumbnail_id($activity_detail->ID),'activity-detail');
                        $thumb[0];
                    }
                    ?>
                    <?php echo wp_get_attachment_url( $activity_detail->ID ); ?>
                    <img src="<?= $thumb[0]; ?>" alt="" width="100%" >
                    <div class="image-tile-wrap">
                        <h1><?= $activity_detail->post_title; ?></h1>
                    </div>
                    
                </div>
                <div class="detail-description" style="display: none;">
                    <?= $activity_detail->post_title; ?>
                </div>
            </div>
            <div class="right-content">
                <div class="side-bar-panel activity-detail-panel">
                    
                    <div class="heading">
                        <div class="pull-left">
                            <h2 class="category">
                                <strong>
                                    <?php 
                                        //echo get_the_category( $activity_detail->ID )[0]->name ;
                                        $term = get_term( $activity_cat_id, 'events_categories' );
                                        echo $term->name;
                                    ?>
                                </strong>
                            </h2>
                        </div> 
                        <div class="pull-right">
                            <div id="rateYo1" style="margin: 10px auto"></div>
                            <input type="hidden" name="post_id" class="post_id" value="<?= $activity_detail->ID; ?>">
                            <input type="hidden" name="post_id" class="user_id" value="<?= $user_id ?>">
                            <!--<div class="user_id"></div>-->
                            <!--<img src="http://localhost/BDS/wp-content/plugins/teacher/images/rating-img.png" alt="">-->
                        </div>  
                    </div>
                    <div class="panel-body">                       
                        <div class="detail-info">
                            <h3 class="product-title"><?= $activity_detail->post_title; ?></h3>
                            <h2 class="date"><?= "Date : ".$activity_detail->class_dates; ?></h2>
                            <?php 
                                if($activity_detail->allday == "1"){
                            ?>
                                    <h2 class="text"><strong>Time:</strong> All-day </h2>
                            <?php
                                }else{
                                    $s_time = esc_html( $calp_events_helper->get_short_time($event_details_date->start));
                                    $e_time = esc_html($calp_events_helper->get_short_time($event_details_date->end));
                            ?>
                                    <h2 class="text"><?= "<strong>Time:</strong> " .$s_time." - ".$e_time; ?></h2>
                            <?php 
                                }
                            ?>
                            <h2 class="text"><?= "<strong>Available To:</strong>".$activity_detail->activities_option; ?></h2>
                            <h2 class="text"><?= "<strong>Location:</strong> ".$activity_detail->venue; ?></h2>
                        </div>
                        <div class="detail-info">
                            <h2 class="text"><?= $activity_detail->post_content; ?></h2> 
                        </div>
                        <div class="detail-info" style="border:none;">
                            <h2 class="price"><strong>$<?= $activity_detail->price ?></strong></h2>
                            <div class="col-md-6" style="padding-left:0px;">
                                <button class="btn btn-activity-detail btn-block">Buy</button>
                            </div>
                            <div class="col-md-6" style="padding-right:0px;">
                                <form id="add_to_cart_form" method="post" action="#">
                                    <?php 
                                        if(isset($_SESSION['teacher'])){
                                    ?>
                                        <input type="hidden" name="customer_id" value="<?php echo $_SESSION['teacher']; ?>" id="customer_id"/>
                                    <?php        
                                        }
                                    ?>
                                    <?php 
                                        if(isset($_SESSION['parent'])){
                                    ?>
                                        <input type="hidden" name="customer_id" value="<?php echo $_SESSION['parent']; ?>" id="customer_id"/>
                                    <?php        
                                        }
                                    ?> 
                                    <?php 
                                        if(isset($_SESSION['student'])){
                                    ?>
                                        <input type="hidden" name="customer_id" value="<?php echo $_SESSION['student']; ?>" id="customer_id"/>
                                    <?php        
                                        }
                                    ?>      
                                    <input type="hidden" name="product_id" id="product_id" value="<?php echo $activity_detail->ID;?>" />
                                    <button class="btn btn-activity-detail btn-block" id="btn_add_to_cart" name="submit">Add to cart</button>
                                </form>
                                
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12" style="margin-top: 10px;padding:0px;">
                                <a href="<?= site_url()."/teacher-activities-new/" ?>" class="btn btn-activity-detail btn-block" name="submit">Continue Shopping</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                    </div>
                    
                </div>
                
                
                
            </div>
            <div class="loader">
                <div class="overlay"></div>
                <div class="wrap">
                    <div>
                        <img src="<?php echo plugins_url( '../../images/loader-4.gif', __FILE__ ); ?>" style="width:100px;" ><br/>  
                    </div>
                    <div> Loading..... </div>
                </div>

            </div>
        </div>
       
    </div>

<?php
//wp_enqueue_script( 'rating_js', $site_url.'/wp-content/plugins/teacher/js/rating/jquery.rateyo.js', array( 'jquery' ), get_bloginfo('version'), false );
?>
<script type="text/javascript" src="<?php echo $site_url.'/wp-content/plugins/teacher/js/rating/jquery.rateyo.js' ?>"></script>
<script>
    jQuery(function () {
        var rating = 0;
        var user_id = jQuery('.user_id').val();
        var post_id = jQuery('.post_id').val();
        
//        jQuery(".counter").text(rating);
        jQuery("#rateYo1").on("rateyo.init", function () { console.log("rateyo.init"); });
        jQuery("#rateYo1").rateYo({
          rating: rating,
          numStars: 5,
          precision: 2,
          starWidth: "15px",
          spacing: "5px",
	  rtl: false,
          normalFill: "#cccccc",
          multiColor: {

            startColor: "#f39c12",
            endColor  : "#f39c12"
          },
          onInit: function () {

            //console.log("On Init Adil");
          },
          onSet: function () {
                    //alert("rating is "+data.rating);
            console.log("On Set Adil");
          }
        }).on("rateyo.set", function (e , data) { 
            //console.log("rateyo.set");
            //alert("sssss");
            //alert("rating is "+data.rating);
            rating = data.rating;
            
            jQuery.ajax({
                url: myAjax.ajaxurl,
                type: 'POST',
                data: {'rating': rating,'user_id':user_id,'post_id':post_id, action: 'ajax_bds_add_rating'},
                dataType : "json",
                success: function (data) {
                                    //alert(data);
                    console.log(data);
                    //var json = jQuery.parseJSON(data);

                    if (data.data_rate == "1"){
                        //alert("ok");
                        //alert("rating" + data.data_r)
                        //jQuery('.homework-row-' + id).hide();
                        swal('Success!', 'You have rated successfully', 'success');
                    }
                    if(data.data_rate == "0"){
                        swal('Error!', 'Process failed!', 'error');
                    }
                },
                error: function (errorThrown) {
                    alert(errorThrown);
                }
            });
            
            
            
        }).on("rateyo.change", function () { console.log("rateyo.change"); });
        //alert('ssss');
    });
</script>

<?php
}
?>