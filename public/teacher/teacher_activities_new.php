<?php

function teacher_activities_new() {
    //require_once TEACHER_PLUGIN_PATH . 'include/class-calp-events-helper.php';
    
    global $wpdb , $calp_events_helper; 
    
    
    if (isset($_SESSION['teacher']) || isset($_SESSION['parent'])) {
        $user = true;
    } else {
        echo '<script>window.location="' . get_site_url() . '/login";</script>';
        exit();
    }
    /* wp_enqueue_style( 'datapickercss', plugin_dir_url( FILE ) . 'teacher/css/dp-style.css', array(), get_bloginfo('version'), '' );
      wp_enqueue_script( 'sweetalertjs', plugin_dir_url( FILE ) . 'teacher/js/jq-datapicker.js', array( 'jquery' ), get_bloginfo('version'), false );
      wp_enqueue_script( 'sweetalertjs2', plugin_dir_url( FILE ) . 'teacher/js/jq-datapicker2.js', array( 'jquery' ), get_bloginfo('version'), false ); */
    wp_enqueue_style('datapickercss', plugin_dir_url(FILE) . 'teacher/css/dp-style.css', array(), get_bloginfo('version'), '');
    wp_enqueue_style('bootstrap_css-css', plugin_dir_url(FILE) . 'teacher/css/bootstrap.css', array(), get_bloginfo('version'), '');
    wp_enqueue_script('jq-datapicker', plugin_dir_url(FILE) . 'teacher/js/jq-datapicker.js', array(''), get_bloginfo('version'), false);
    wp_enqueue_script('datapicker2', plugin_dir_url(FILE) . 'teacher/js/jq-datapicker2.js', array(''), get_bloginfo('version'), false);
    wp_enqueue_script('bootstrap_js', plugin_dir_url(FILE) . 'teacher/js/bootstrap.min.js', array('jquery'), get_bloginfo('version'), false);

    //$activity_category = noceky_brs_common::activity_category();

    if (isset($_SESSION['teacher'])) {
        $TEACHER_ID = $_SESSION['teacher'];
        $user_id = $_SESSION['teacher'];
    }
    if (isset($_SESSION['parent'])) {
        $TEACHER_ID = $_SESSION['teacher_id'];
        $user_id = $_SESSION['parent'];
    }
    if(isset($_SESSION['student'])){
       $user_id = $_SESSION['student'];
    }
    
    $post_table = $wpdb->prefix.'posts';
    $calp_events = $wpdb->prefix.'calp_events';
    $activities_orders_table = $wpdb->prefix.'activities_orders';
    //Cart price Count
    $cart_price = $wpdb->get_row("SELECT SUM(price) AS TotalItemsOrdered FROM $activities_orders_table "
             ."INNER JOIN $post_table ON $post_table.ID = $activities_orders_table.product_id "
             ."INNER JOIN $calp_events ON $calp_events.post_id = $activities_orders_table.product_id "
             ."WHERE $activities_orders_table.customer_id = '".$user_id."' AND $activities_orders_table.order_status='in_cart'" );
    $cart_price=$cart_price->TotalItemsOrdered;
    
    ///Cart products Count
    $cart_products = $wpdb->get_results("SELECT *, $activities_orders_table.id AS cart_item_id FROM $activities_orders_table "
             ."INNER JOIN $post_table ON $post_table.ID = $activities_orders_table.product_id "
             ."INNER JOIN $calp_events ON $calp_events.post_id = $activities_orders_table.product_id "
             ."WHERE $activities_orders_table.customer_id = '".$user_id."' AND $activities_orders_table.order_status='in_cart'" );
    $cart_products_count= $wpdb->num_rows;
    ?>
    
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
<div class="mc-content-wrap">
    <div class="h_wrapper">
        
        <div class="chk_out" style="margin-bottom">
            <span><a href="<?= site_url()."/bds-checkout/" ?>" style="color:#fff;">Checkout</a></span>
            <span><a href="<?= site_url()."/bds-cart/" ?>" style="color:#fff;"><?php echo $cart_products_count == 0 ? '(0)' : '('.$cart_products_count.')' ; ?> <i class="fa fa-shopping-cart" aria-hidden="true"></i> $<?php echo $cart_price == 0 ? '0': $cart_price; ?> </a></span>
        </div>
        
        <div class="top-action">
            <div class="col-md-4">
                <h2 class="title">Activities:</h2>
            </div>
            <div class="col-md-8 activities-actions-bar np" style="padding:0px;">
                <div class="col-md-3"><span class="title"> Search</span></div>
                <form method="post" action="">
                    <div class="col-md-5 search-drp-activity" style="padding:0px;">
                        <?php
                        $include_categories= get_option('calendar_activity_categories_set');
                        $args_cat = array(
                            'taxonomy' => 'events_categories',
                            'orderby' => 'id',
                            'order' => 'ASC',
                            'parent' => 0,
                            'include' => $include_categories
//                                'child_of' => 48
                        );
                        $filter_cats = get_terms('events_categories', $args_cat);
                       
                        ?>
                        
                        <select class="form-control" name="category_id">
                            <option value="">Select Category</option>
                            <option value="ALL">All</option>
                            <?php
                            foreach ($filter_cats as $cat) {
                                $cat_id = $cat->term_id;
                                if($_POST['category_id'] == $cat_id){
                                ?>
                                    <option value="<?php echo $cat_id; ?>" selected="selected"><?php echo $cat->name; ?></option>
                                <?php
                                }else{
                                ?>
                                    <option value="<?php echo $cat_id; ?>"><?php echo $cat->name; ?></option>
                                <?php
                                } //End IF
                            }
                            ?>
                        </select>
                    </div>
                    <!-- <div class="col-md-3">
                         <select class="form-control">
                             <option value="">Dance</option>
                             <option value="">Ballet 1</option>
                             <option value="">Ballet 2</option>
                         </select>
                     </div>-->
                    <div class="col-md-3 " style="width:28%;">
                        <input type="submit" class="btn btn-bds-action btn-block btn-activity-search" value="Search"/>
                    </div>


                </form>
            </div>

            <div class="clearfix"></div>
        </div>
        <div class="teacher-activities-wrap">
            
            <?php
            $default_dance_cat_id = '48';
            $dropdown_post_category_id = '';
            $default_dance_child_cat_id = array('88','89','90','91','94','93','87','92','109','110','111','112');
            $all_dance_categories = array('88','89','90','91','94','93','87','92','48','109','110','111','112','55');
            $get_activity_categories= explode(',',get_option('calendar_activity_categories_set'));
            //echo "<pre/>";
            $all_activity_categories = array_merge($get_activity_categories, $default_dance_child_cat_id);
            //print_r($all_activity_categories);
            global $wpdb;
            if (isset($_POST['category_id'])) {
                $dropdown_post_category_id = $_POST['category_id'];
                $term_slug = get_query_var('portfolio-net');
                $taxonomyName = get_query_var('portfolio_category');
                //$current_term = get_term_by('slug', $term_slug, $taxonomyName);
                if($dropdown_post_category_id == $default_dance_cat_id){
                    //echo "hello mm";
                    $args = array(
                        'taxonomy' => 'events_categories',
                        'orderby' => 'id',
                        'order' => 'DESC',
                        //'child_of' => $dropdown_post_category_id
                        'include' => $all_dance_categories
                    ); 
                }else if($dropdown_post_category_id == "ALL"){
                    //echo "hello";
                    $args = array(
                        'taxonomy' => 'events_categories',
                        'orderby' => 'id',
                        'order' => 'DESC',
                        'include' => $all_activity_categories
//                        'cat' => -48,
//                        'child_of' => '48'
                    );
                }else{
                    //echo "hello  ll";
                    $args = array(
                        'taxonomy' => 'events_categories',
                        'orderby' => 'id',
                        'order' => 'DESC',
                        'include' => $dropdown_post_category_id
                    );
                }
                //echo "<pre/>";
                $cats = get_terms('events_categories', $args);
                //print_r($cats);
                foreach ($cats as $cat) {
                    //echo "catg ". $cat->name ." ID ".$cat->term_id."<br/>" ;
                    //setup the cateogory ID
                    $cat_id = $cat->term_id;
                    //echo "<h2>".$cat->name."</h2>";
                    // create a custom wordpress query
                    $query_args = array(
                        'post_type' => 'calp_event',
                        'post_status' => array('publish'),
                        'showposts' => 100,
                        'category' => $cat_id,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'events_categories', //or tag or custom taxonomy
                                'field' => 'id',
                                'terms' => $cat_id
                            )
                        )
                    );
                    $the_query = new WP_Query($query_args);

                    // start the wordpress loop!
                    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                            ?>
                            <?php
                            //if(get_post_meta($the_query->post->ID, "price", true) != "" ){
                            ?>
                            <?php 
                            $calp_events = $wpdb->prefix.'calp_events';
                            $event_details = $wpdb->get_row("SELECT * FROM $calp_events WHERE end >= NOW() && post_id  = '".$the_query->post->ID."'" );
                            $event_details_date = $wpdb->get_row("SELECT UNIX_TIMESTAMP(start) as start , UNIX_TIMESTAMP(end) as end FROM $calp_events where post_id  = '".$the_query->post->ID."'" );
                            if($event_details->show_for_sale == 1){
                            ?>
            
                            <div class="teacher-activities-listing">
                                <a href = "<?php echo site_url(); ?>/activity-detail/?activity_id=<?php echo $the_query->post->ID; ?>&cat_id=<?php echo $cat_id; ?>">
                                    <div class="" style="padding:20px;">
                                        <h2 class="category"><?php echo $cat->name; ?> </h2>
                                        <h1 class="title"><?php the_title(); ?></h1>
<!--                                        <p class="price">price: <?php //echo get_post_meta($the_query->post->ID, "price", true); ?>&nbsp;$</p>-->
                                       
                                        <h3 class="date"><strong>Date:</strong><?= $event_details->class_dates; ?></h3>
                                        <?php 
                                            if($event_details->allday == "1"){
                                        ?>
                                                <h3 class="time"><strong>Time:</strong> All-day </h3>
                                        <?php
                                            }else{
                                                $s_time = esc_html( $calp_events_helper->get_short_time($event_details_date->start));
                                                $e_time = esc_html($calp_events_helper->get_short_time($event_details_date->end));
                                        ?>
                                                <h3 class="time"><?= "<strong>Time:</strong> ".$s_time." - ".$e_time ?></h3>
                                        <?php 
                                            }
                                        ?>
                                        <h3 class="room">
                                            <strong>Available to : <br/></strong>
                                            <?= $event_details->activities_option ; ?>
                                        </h3>
<!--                                        <p class="description"> 
                                           
                                        </p>-->

                                    </div>  
                                    <div class="activity-overlay">
                                        <div class="activity-hover">
                                            <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:30px;"></i>
                                            <br>
                                            Buy
                                        </div>
                                    </div>    
                                </a>
                            </div>

                            <?php
                        //}
                        }
                        endwhile;
                    endif; // done our wordpress loop. Will start again for each category 
                }
            }else {
                    
                $term_slug = get_query_var('portfolio-net');
                $taxonomyName = get_query_var('portfolio_category');
                //$current_term = get_term_by('slug', $term_slug, $taxonomyName);
                $args = array(
                    'taxonomy' => 'events_categories',
                    'orderby' => 'id',
                    'order' => 'DESC',
                    'child_of' => $default_dance_cat_id,
//                    'include' => $default_dance_cat_id
                );
                $cats = get_terms('events_categories', $args);
                //print($cats);
                foreach ($cats as $cat) {
                    //echo "catg ". $cat->name ." ID ".$cat->term_id."<br/>" ;
                    //setup the cateogory ID
                    $cat_id = $cat->term_id;
                    //echo "<h2>".$cat->name."</h2>";
                    // create a custom wordpress query
                    $query_args = array(
                        'post_type' => 'calp_event',
                        'showposts' => 100,
                        'category' => $cat_id,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'events_categories', //or tag or custom taxonomy
                                'field' => 'id',
                                'terms' => $cat_id
                            )
                        )
                    );
                    $the_query = new WP_Query($query_args);
                    // start the wordpress loop!
                    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                            ?>
                            <?php 
                            
                            ///Fetch the details  of calpress event post
                            $calp_events = $wpdb->prefix.'calp_events';
                            $calp_event_instances = $wpdb->prefix.'calp_event_instances';
                            $event_details = $wpdb->get_row("SELECT * FROM $calp_events WHERE end >= NOW() && post_id  = '".$the_query->post->ID."'" );
                            $event_details_date = $wpdb->get_row("SELECT UNIX_TIMESTAMP(start) as start , UNIX_TIMESTAMP(end) as end FROM $calp_events where post_id  = '".$the_query->post->ID."'" );
                            
                            if($event_details->show_for_sale == 1){
                                
                            ?>
                            <div class="teacher-activities-listing">
                                <a href = "<?php echo site_url(); ?>/activity-detail/?activity_id=<?php echo $the_query->post->ID; ?>&cat_id=<?php echo $cat_id; ?>">
                                    <div class="" style="padding:20px;">
                                        <h2 class="category">DANCE </h2>
                                        <h1 class="title"><?php the_title(); ?></h1>
                                        <?php 
                                        
                                        ?>
                                        <h3 class="date"><strong>Date:</strong><?= $event_details->class_dates; ?></h3>
                                        <?php 
                                            if($event_details->allday == "1"){
                                        ?>
                                                <h3 class="time"><strong>Time:</strong> All-day </h3>
                                        <?php
                                            }else{
                                                $s_time = esc_html( $calp_events_helper->get_short_time($event_details_date->start));
                                                $e_time = esc_html($calp_events_helper->get_short_time($event_details_date->end));
                                        ?>      
                                                <h3 class="time"><?= "<strong>Time:</strong> ".$s_time." - ".$e_time; ?></h3>
                                        <?php        
                                            }
                                        ?>
                                        <h3 class="room">
                                            <strong>Available to : <br/></strong>
                                            <?= $event_details->activities_option ; ?>
                                        </h3>
                                        <!-- <p class="description">                                           
                                        </p>-->
                                    </div>  
                                    <div class="activity-overlay">
                                        <div class="activity-hover">
                                            <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:30px;"></i>
                                            <br>
                                            Buy
                                        </div>
                                    </div>    
                                </a>
                            </div>

                            <?php
                            }
                        //}
                        endwhile;
                    endif; // done our wordpress loop. Will start again for each category 
                }
            }
            ?>

            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div> 
</div>
    
    <script>
    /* Thanks to CSS Tricks for pointing out this bit of jQuery
https://css-tricks.com/equal-height-blocks-in-rows/
It's been modified into a function called at page load and then each time the page is resized. One large modification was to remove the set height before each new calculation. */

equalheight = function(container){

var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 jQuery(container).each(function() {

   $el = jQuery(this);
   jQuery($el).height('auto')
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}

jQuery(window).load(function() {
  equalheight('.teacher-activities-wrap .teacher-activities-listing .room');
});


jQuery(window).resize(function(){
  equalheight('.teacher-activities-wrap .teacher-activities-listing .room');
});

    </script>
<?php } ?>