<?php
function teacher_dashboard(){

	if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
		$user = true;
	}else{
		echo '<script>window.location="'.get_site_url().'/login";</script>';
		exit();
	}
//	 teacher id
	if(isset($_SESSION['teacher'])){
		$TEACHER_ID = $_SESSION['teacher'];
	}
	if(isset($_SESSION['parent'])){
		$TEACHER_ID = $_SESSION['teacher_id'];
	}

	$event_category=noceky_brs_common::event_category();
	global $wpdb;
        
        $date = strtotime(date("Y-m-d")); 
        $day = date('d', $date);
        $month = date('m', $date);
        $year = date('Y', $date);
        $firstDay = mktime(0,0,0,$month, 1, $year);
        $day_word = strftime('%B', $firstDay);
?>
<div class="wrapper">
    <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div> 
<div class="mc-content-wrap">
     <div class="h_wrapper">
	    <div class="body home-left">
	    	<div class="title1">
	    		<p> <?php echo $day_word." ".$day.", ".$year ; ?> </p> 
	    	</div>
	    	<div class="img dashboard-main-img">

					<?php
					$table_art_gallery = $wpdb->prefix.'art_gallery';
					$query = "SELECT * FROM $table_art_gallery WHERE `teacher_id` = '".$TEACHER_ID."' AND is_home = '1' order by id desc limit 1  ";
//                                        $query = "SELECT * FROM $table_art_gallery WHERE `teacher_id` = '".$TEACHER_ID."'  order by id desc limit 1";
					$result = $wpdb->get_results( $query);

					?>
	    		<img src="<?= $result[0]->file ?>">
	    	</div>
            
                <div class="lower_menu1">
		    	<div class="title1">
		    		<p><i class="fa fa-list-alt" aria-hidden="true"></i> Birthdays</p>
		    	</div>
		    	<div class="section_li home-birthdays">	    		
                            <?php
                            $table_students = $wpdb->prefix.'student';
                            $query = "SELECT * FROM $table_students WHERE `teacher_id` = '".$TEACHER_ID."' And status=1 order by id desc limit 3 ";
                            $result = $wpdb->get_results( $query);
                            
                            foreach($result as $item){
                            ?>
		    		<li>
                                    <span class="child-name">
                                        <?php 
                                            $full_name= $item->full_name;
                                            $seprate_name=explode(" ",$full_name);
                                            echo $seprate_name[0] ;
                                        ?>
                                    </span>
                                    <span class="birthday">
                                        <?=  date('m/d/Y',strtotime($item->dob)) ?>
                                    </span>
                                    <div class="clearfix"></div>
                                </li>
                            <?php } ?>
                            
		    	</div>		    	
	    	</div>
	    	<div class="lower_menu2">
		    	<div class="title1">
                            <p><i class="fa fa-book" aria-hidden="true"></i> Homework </p>
		    	</div>
                    <div class="section_li" style="padding-top:7px;">
                            <p><?php //echo $month."/".$day."/".$year ; ?></p>
						<?php
						$table_home_work = $wpdb->prefix.'bds_homework';
                                                $table_bds_teacher_subjects = $wpdb->prefix.'bds_teacher_subjects';
						//$query = "SELECT * FROM $table_home_work WHERE `teacher_id` = '".$TEACHER_ID."'  order by id desc limit 3 ";
                                                //echo "<pre/>";
                                                $query = "SELECT * FROM $table_home_work INNER JOIN $table_bds_teacher_subjects ON $table_home_work.subject_id = $table_bds_teacher_subjects.id WHERE $table_home_work.teacher_id = '".$TEACHER_ID."'  order by $table_home_work.id desc limit 3 ";
						//exit;
                                                $result = $wpdb->get_results( $query);
                                                //print_r($query);
						$count=0;
						foreach($result as $item){$count++;
						$arr = explode(".", $item->homework_title, 2);
							?>
                            
                            <li style=""><i class="fa fa-angle-double-right" aria-hidden="true"></i><span style="font-size:12px;"><span style="color:#879e73;font-weight:500;text-transform: capitalize;">&nbsp;<?= $item->subject_name; ?> </span>- <?= " ".ucfirst($arr[0]); ?></span></li>
						<?php } ?>
					
		    		<p><a href="<?php echo site_url(); ?>/bds-homework/" class="home-more">more..</a></p>
		    	</div>		    	
	    	</div>
	    	<div class="lower_menu3">
		    	<div class="title1">
		    		<p><i class="fa fa-file" aria-hidden="true"></i> Newsletter </p>
		    	</div>
		    	<div class="menu_body">					
                                <?php
                                $table_news_letter = $wpdb->prefix.'news_letter';
                                $query = "SELECT * FROM $table_news_letter WHERE `teacher_id` = '".$TEACHER_ID."' AND is_home = '1' order by id desc limit 3 ";
                                $result = $wpdb->get_results( $query);
                                        ?>
                            <div class="home_newsletter_img_wrap">
                                <!--<img src="<? //$result[0]->file ?>" width="100%">-->
                                <img src="<?php echo site_url(); ?>/wp-content/uploads/2017/06/Brookridge-Day-School-Newsletter-6-17-1.png" width="100%">
                            </div>    
                                        
                                        <p><a href="<?php echo site_url(); ?>/teacher-news-letter/" class="home-more">click here</a></p>
		    	</div>		    	
	    	</div>
            
            
            
            <div class="lower_menu4">
                <div class="title1">
                          <p>Gallery </p>
	    	</div>
                <div class="home-gallery-feature-img">		    		
                        <?php
                            $table_art_gallery = $wpdb->prefix.'art_gallery';
                            $query = "SELECT * FROM $table_art_gallery WHERE `teacher_id` = '".$TEACHER_ID."' AND is_home = '1' order by id desc limit 1  ";
//                                    $query = "SELECT * FROM $table_art_gallery WHERE `teacher_id` = '".$TEACHER_ID."' order by id desc limit 1  ";
                            $result = $wpdb->get_results( $query);						
                        ?>
                        <a href="<?php echo site_url(); ?>/teacher-art-gallery/"><img src="<?= $result[0]->file ?>"></a>		    			
                </div>
                	
<!--                <div class="t_gallery">
		    		<p >Gallery</p>
		    	</div>	    	-->
	    	</div>
            

	    	
	    	<div class="stu_of_week">
	    		<div class="title1">
                          <p><i class="fa fa-graduation-cap" aria-hidden="true"></i> Student of the Week</p>
	    		</div>
                    <?php
                    $student_of_week = $wpdb->get_row("SELECT * FROM $table_students WHERE `teacher_id` = '".$TEACHER_ID."' AND student_of_week = '1' order by id desc limit 1" );
                    ?>
	    		<div class="info">
                	
                        <li><span class="stu_week_heading">Name :</span> <?= $student_of_week->full_name; ?></li>
                        <li><span class="stu_week_heading">Sport :</span> <?= $student_of_week->sport; ?></li>
                        <li><span class="stu_week_heading">Movie :</span> <?= $student_of_week->movie; ?></li>
                        <li><span class="stu_week_heading">Hero :</span> <?= $student_of_week->hero; ?></li>
                        <p><a href="<?php echo site_url(); ?>/student-roster/" class="home-more">more..</a></p>
	    		</div>
	    		
	    		<div class="img">
	    			<img src="<?= $student_of_week->file; ?>">
	    		</div>

	    	</div>

	    </div>
	    
        
            <div class="dashboard-sidebar home-rght">
                
                <div class="side-panel-section">
                    <div class="title">
                        <h2><i class="fa fa-calendar"></i>&nbsp;Events</h2> 
                    </div>
                    <div class="side-panel-body">
                    <?php 
                        $calp_events = $wpdb->prefix.'calp_events';
                        
                        $default_cat_id_events = array('16','15','14');
                        $term_slug = get_query_var('portfolio-net');
                        $taxonomyName = get_query_var('portfolio_category');
                        //$current_term = get_term_by('slug', $term_slug, $taxonomyName);
                        $args = array(
                            'taxonomy' => 'events_categories',
                            'orderby' => 'id',
                            'order' => 'DESC',
                            'include' => $default_cat_id_events
                        );
                        $cats = get_terms('events_categories', $args);
                        //print($cats);
                        foreach ($cats as $cat) {

                            $cat_id = $cat->term_id;

                            $query_args = array(
                                'post_type' => 'calp_event',
                                'showposts' => 3,
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
                                    //echo $the_query->post->ID; 
                                $event_detail = $wpdb->get_row("SELECT * FROM $calp_events  WHERE post_id = '".$the_query->post->ID."'" );
                                $event_start_date = $event_detail->start;
                                
                            ?>       
                            
                            <div class="list-item-sec">
                                <div class="date">
                                    <div class="month">
                                        <?php echo date('m', strtotime($event_start_date)); ?>
                                    </div>
                                    <div class="day">
                                        <?php echo date('d', strtotime($event_start_date)); ?>
                                    </div>
                                </div>
                                <div class="content">
                                    <p><strong><?php echo date('h:i A', strtotime($event_start_date));  ?></strong> - <a href="<?php echo get_permalink($the_query->post->ID); ?>">View Details</a></p>
                                    <p><?php echo $the_query->post->post_title; ?></p>
                                </div>
                                <div class="clearfix"></div>
                            </div> <!-- List item Sec-->
                        
                        <?php 
                                endwhile;
                            endif; // done our wordpress loop. Will start again for each category 
                        }
                        ?>                        
                    </div>
                </div>
                
                <div class="side-panel-section">
                    <div class="title">
                        <h2><i class="fa fa-calendar"></i>&nbsp;Activities</h2> 
                    </div>
                    <div class="side-panel-body">
                        <?php 
                        
                        //local-$default_cat_id_acty = array('109','110','111');
                        $default_cat_id_acty = array('48');
                        $term_slug_acty = get_query_var('portfolio-net');
                        $taxonomyName_acty = get_query_var('portfolio_category');
                        //$current_term = get_term_by('slug', $term_slug, $taxonomyName);
                        $args_acty = array(
                            'taxonomy' => 'events_categories',
                            'orderby' => 'id',
                            'order' => 'DESC',
                            'include' => $default_cat_id_acty
                        );
                        $cats_acty = get_terms('events_categories', $args_acty);
                        //print($cats);
                        foreach ($cats_acty as $cat_acty) {

                            $cat_id_acty = $cat_acty->term_id;

                            $query_args_acty = array(
                                'post_type' => 'calp_event',
                                'showposts' => 3,
                                'category' => $cat_id_acty,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'events_categories', //or tag or custom taxonomy
                                        'field' => 'id',
                                        'terms' => $cat_id_acty
                                    )
                                )
                            );
                            $the_query_acty = new WP_Query($query_args_acty);
                            // start the wordpress loop!
                            if ($the_query_acty->have_posts()) : while ($the_query_acty->have_posts()) : $the_query_acty->the_post();
                                    //echo $the_query->post->ID; 
                                $event_detail_acty = $wpdb->get_row("SELECT * FROM $calp_events  WHERE post_id = '".$the_query_acty->post->ID."' LIMIT 1" );
                                $event_start_date_acty = $event_detail_acty->start;
                                
                            ?>  
                            <div class="list-item-sec">
                                <div class="date">
                                    <div class="month">
                                        <?php echo date('m', strtotime($event_start_date)); ?>
                                    </div>
                                    <div class="day">
                                        <?php echo date('d', strtotime($event_start_date)); ?>
                                    </div>
                                </div>
                                <div class="content">
                                    <p><strong><?php echo date('h:i A', strtotime($event_start_date));  ?></strong> - <a href="<?php echo get_permalink($the_query_acty->post->ID); ?>">View Details</a></p>
                                    <p><?php echo $the_query_acty->post->post_title; ?></p>
                                </div>
                                <div class="clearfix"></div>
                            </div> <!-- List item Sec-->
                            <?php 
                                    endwhile;
                                endif; // done our wordpress loop. Will start again for each category 
                            }
                            ?>                      
                    </div>
                </div>
                
                <div class="side-panel-section">
                    <div class="title">
                        <h2><i class="fa fa-cutlery"></i>&nbsp;Lunch Menu</h2> 
                    </div>
                    <div class="side-panel-body">
                        <?php 
                        
                            $default_cat_id_lmenu = array('17');
                            $term_slug_lmenu = get_query_var('portfolio-net');
                            $taxonomyName_lmenu = get_query_var('portfolio_category');
                            //$current_term = get_term_by('slug', $term_slug, $taxonomyName);
                            $args_lmenu = array(
                                'taxonomy' => 'events_categories',
                                'orderby' => 'id',
                                'order' => 'DESC',
                                'include' => $default_cat_id_lmenu
                            );
                            $cats_lmenu = get_terms('events_categories', $args_lmenu);
                            //print($cats);
                            foreach ($cats_lmenu as $cat_lmenu) {

                                $cat_id_lmenu = $cat_lmenu->term_id;

                                $query_args_lmenu= array(
                                    'post_type' => 'calp_event',
                                    'showposts' => 2,
                                    'category' => $cat_id_lmenu,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'events_categories', //or tag or custom taxonomy
                                            'field' => 'id',
                                            'terms' => $cat_id_lmenu
                                        )
                                    )
                                );
                                $the_query_lmenu = new WP_Query($query_args_lmenu);
                                // start the wordpress loop!
                                if ($the_query_lmenu->have_posts()) : while ($the_query_lmenu->have_posts()) : $the_query_lmenu->the_post();
                                        //echo $the_query->post->ID; 
                                    $event_detail_lmenu = $wpdb->get_row("SELECT * FROM $calp_events  WHERE post_id = '".$the_query_lmenu->post->ID."' LIMIT 1" );
                                    $event_start_date_lmenu = $event_detail_acty->start;
                                    $the_query_lmenu->post->ID;
                        ?> 
                                <div class="list-item-sec">
                                    <div class="date">
                                        <div class="month">
                                            <?php echo date('m', strtotime($event_start_date_lmenu)); ?>
                                        </div>
                                        <div class="day">
                                            <?php echo date('d', strtotime($event_start_date_lmenu)); ?>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p><strong><?php echo date('h:i A', strtotime($event_start_date_lmenu));  ?></strong> - <a href="<?php echo get_permalink($the_query_lmenu->post->ID); ?>">View Details</a></p>
                                        <p><?php echo $the_query_lmenu->post->post_title; ?></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div> <!-- List item Sec-->
                        <?php 
                                    endwhile;
                                endif; // done our wordpress loop. Will start again for each category 
                            }
                        ?> 
 
                    </div>
                </div>
                
			
	    </div>
        <div class="clearfix"></div>
    </div>
</div>
   

	
<?php
}
?>