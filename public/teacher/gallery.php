<?php

function teacher_art_gallery() {
//	$_SESSION['teacher'] = 3;
    global $wpdb;
    $table = $wpdb->prefix . 'art_gallery';
    $gallery_category_table = $wpdb->prefix.'bds_gallery_category';
    
    if (isset($_SESSION['teacher']) || isset($_SESSION['parent'])) {
        $user = true;
    } else {
        echo '<script>window.location="' . get_site_url() . '/login";</script>';
        exit();
    }
//	 teacher id
    if (isset($_SESSION['teacher'])) {
        $TEACHER_ID = $_SESSION['teacher'];
    }
    if (isset($_SESSION['parent'])) {
        $TEACHER_ID = $_SESSION['teacher_id'];
    }
    $site_url = site_url();
    wp_enqueue_style('datapickercss', plugin_dir_url(FILE) . 'teacher/css/dp-style.css', array(), get_bloginfo('version'), '');
    wp_enqueue_style('bootstrap_css-css', plugin_dir_url(FILE) . 'teacher/css/bootstrap.css', array(), get_bloginfo('version'), '');
    wp_enqueue_script('sweetalertjs', plugin_dir_url(FILE) . 'teacher/js/jq-datapicker.js', array('jquery'), get_bloginfo('version'), false);
    wp_enqueue_script('sweetalertjs2', plugin_dir_url(FILE) . 'teacher/js/jq-datapicker2.js', array('jquery'), get_bloginfo('version'), false);
    wp_enqueue_script('bootstrap_js', plugin_dir_url(FILE) . 'teacher/js/bootstrap.min.js', array('jquery'), get_bloginfo('version'), false);

    //$art_gallery_category = noceky_brs_common::art_gallery_category();
    $art_gallery_category = $wpdb->get_results("SELECT * FROM $gallery_category_table WHERE teacher_id = '".$TEACHER_ID."'" );

    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        $base = 'http://localhost/bds';
    } else {
        $base = 'http://brookridgedayschool.com';
    }
    // gallery style
    wp_enqueue_style('view', $site_url . '/wp-content/plugins/teacher/css/gallery-css/viewer.css', array(), get_bloginfo('version'), 'all');
    wp_enqueue_script('view-main', $site_url . '/wp-content/plugins/teacher/js/gallery-js/main.js', array('jquery'), get_bloginfo('version'), false);
    wp_enqueue_script('view-viewer', $site_url . '/wp-content/plugins/teacher/js/gallery-js/viewer.js', array('jquery'), get_bloginfo('version'), false);
    ?>

    <div class="wrapper">
    <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>

<div class="mc-content-wrap">
    <div id="body_wrapper">
        <div class="docs-pictures">
            <div class="top-action">
                <div class="pull-left">
                    <h2 class="title">Gallery</h2>
                </div>
                <div class="pull-right">
                    <?php if ($_SESSION['teacher']): ?>
                    <a href="<?php echo site_url()."/bds-gallery-category/"; ?>" class="btn btn-bds-action"><i class="fa fa-plus-circle"></i>Add Category</a>
                    <?php endif; ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-group" id="accordion">
                <?php
                $count = 0;
                foreach ($art_gallery_category as $category) {
                    $count++;
                    ?>
                    <div style="clear:both; padding-bottom:5px;">
                        <div style="border:solid 1px #eee; background-color:#F8F8F8;  margin-bottom: 5px;">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion active" href="#collapse<?= $count ?>">
                                <div style="border:solid 1px #D8E3D6; font-size: 12px; background-color:#EDEDED ;padding: 12px 4px 11px 25px;font-weight:bold; height: 52px ">

                                    <h4 class="panel-title-large" style="float: left;"><i class="fa fa-angle-down"></i>&nbsp;&nbsp; <?= ucwords($category->category_name) ?> </h4>
                                    <?php
                                    if ($_SESSION['teacher']):
                                        echo'	
				<button style="float:right; margin-top: 0px !important;" type="button" id="submit_download' . $count . '" class="submit_download"><i class="fa fa-upload"></i></button>	
					';
                                    endif;
                                    ?>
                                </div>
                            </a>

                            <div id="collapse<?= $count ?>" class="accordion-body collapse" style="height: 0px;">
                                <div class="accordion-inner panel-body">
                                    <div class="row">
                                        <form align="right" id="form<?= $count ?>" method="post" action="" enctype="multipart/form-data">		
                                            <input type="file" name="image" class="my-file" id="my-file<?= $count ?>">									
                                            <input type="hidden" id="cat<?= $count ?>" name="category" value="<?= $category->category_name ?>">
                                        </form>	
                                        <script>
                                            jQuery("#my-file<?= $count ?>").change(function (e) {

                                                if (jQuery("#my-file<?= $count ?>").val() != "") {
                                                    submit_art_gallery("<?= $count ?>");
                                                }
                                            });

                                            jQuery("#submit_download<?= $count ?>").click(function () {

                                                jQuery("#my-file<?= $count ?>").click();
                                            });
                                        </script>
                                        <?php
                                        // select data
                                        $query = "SELECT * FROM $table WHERE `teacher_id` = '" . $TEACHER_ID . "' AND `category` = '" . strtolower($category->category_name) . "'  AND status != '-1' ";
                                        $art = $wpdb->get_results($query);
                                        ?>

                                        <div class="pnl">
                                            <ul  id="download_list<?php echo $count; ?>">	
                                                <li style="display: none;"></li>	
                                                <?php
                                                foreach ($art as $value) {
                                                    ?>

                                                    <li class="art_li">
                                                        <img data-original="<?php echo $value->file ?>" src="<?php echo $value->file ?>" class="img-responsive" />
                                                        <div class="gallery_img_name">
                                                            <a download href="<?php echo $value->file ?>"><?php echo $value->title; ?></a>
                                                        </div>
                                                        <!--<br>-->
                                                        <div class="time"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($value->date)); ?></div>
            <?php if (isset($_SESSION['teacher'])): ?>
                                                            <div class="gallery_actions">

                                                                <span><input name="art_gal<?= $value->id ?>" <?php if ($value->is_slider == 1) {
                    echo 'checked="checked"';
                } ?> id="is_home<?= $value->id ?>" onclick="is_slider('<?= $value->id ?>')" type="checkbox"> Slider Image </span><br>

                                                                <span><input name="art_gal" <?php if ($value->is_home == 1) {
                    echo 'checked="checked"';
                } ?> id="is_home<?= $value->id ?>" onclick="is_home_gallery('<?= $value->id ?>')" type="radio"> Featured Image </span>

                                                                <p id="<?php echo $value->id; ?>" onclick="delete_this(this, 'art_gallery')" class="del" type="button"><i class="fa fa-times"></i></p>

                                                            </div>

            <?php endif; ?>
                                                    </li>

                        <?php } ?> 
                                            </ul>						
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    <?php } ?>
                </div>	    
            </div>      
        </div> 
    </div>
</div>

    <?php
}
?>