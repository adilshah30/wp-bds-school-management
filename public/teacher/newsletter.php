<?php

function teacher_news_letter() {
    global $wpdb;
    $table = $wpdb->prefix . 'news_letter';
    $news_category_table = $wpdb->prefix.'bds_newsletter_category';
    
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
    wp_enqueue_style('datapickercss', plugin_dir_url(FILE) . 'teacher/css/dp-style.css', array(), get_bloginfo('version'), '');
    wp_enqueue_style('bootstrap_css-css', plugin_dir_url(FILE) . 'teacher/css/bootstrap.css', array(), get_bloginfo('version'), '');
    wp_enqueue_script('sweetalertjs', plugin_dir_url(FILE) . 'teacher/js/jq-datapicker.js', array('jquery'), get_bloginfo('version'), false);
    wp_enqueue_script('sweetalertjs2', plugin_dir_url(FILE) . 'teacher/js/jq-datapicker2.js', array('jquery'), get_bloginfo('version'), false);
    wp_enqueue_script('bootstrap_js', plugin_dir_url(FILE) . 'teacher/js/bootstrap.min.js', array('jquery'), get_bloginfo('version'), false);
    //$newsletter_category = noceky_brs_common::newsletter_category();
    $newsletter_category = $wpdb->get_results("SELECT * FROM $news_category_table WHERE teacher_id = '".$TEACHER_ID."'" );   
    //print_r($newsletter_category);
    //$newsletter_category = 
    ?>
    <!--Html code -->

    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>	<div class="error"></div>
    <div class="mc-content-wrap">
        <div id="body_wrapper">
        <div>
<!--            <div class="title">
                <p></p>
            </div>-->
            <div class="top-action">
                <div class="pull-left">
                    <h2 class="title">Newsletter</h2>
                </div>
                <div class="pull-right">
                    <?php if ($_SESSION['teacher']): ?>
                    <a href="<?php echo site_url()."/bds-newsletter-category/"; ?>" class="btn btn-bds-action"><i class="fa fa-plus-circle"></i>Add Category</a>
                    <?php endif; ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-group" id="accordion">
                <?php
               
                
                $count = 0;
                foreach ($newsletter_category as $category) {
                    $count++;
                    ?>
                    <div style="clear:both; padding-bottom:5px;">
                        <div style="border:solid 1px #eee; background-color:#F8F8F8;  margin-bottom: 5px;">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion active" href="#collapse<?= $count ?>">
                                <div style="border:solid 1px #D8E3D6; font-size: 12px; background-color:#EDEDED ;padding: 12px 4px 11px 25px;font-weight:bold; height: 52px ">

                                    <h4 class="panel-title-large" style="float: left;"><i class="fa fa-angle-down"></i>&nbsp;&nbsp; <?= $category->category_name ?> </h4>
                                    <input type="text" placeholder="Add title" name="title" id="news_title<?= $count ?>" style="position: absolute; width: 151px;height: 24px; right: 85px; ">
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
                                                    submit_newsletter("<?= $count ?>");
                                                }
                                            });
                                            jQuery("#submit_download<?= $count ?>").click(function () {
                                                jQuery(".error").text("");
                                                var title = jQuery("#news_title<?= $count ?>").val();
                                                if (title == "") {
                                                    jQuery(".error").text("Please add title!").css("text-align", "center");
                                                    jQuery("#news_title<?= $count ?>").css("border-color", "red").focus();
                                                } else {
                                                    jQuery("#my-file<?= $count ?>").click();
                                                }
                                            });
                                        </script>
                                        <?php
                                        $news_letter = $wpdb->get_results("SELECT * FROM $table WHERE `teacher_id` = '" . $TEACHER_ID . "'  AND `category` = '" . strtolower($category->category_name) . "'  AND status != '-1' ");
                                        ?>			   	
                                        <div class="pnl">
                                            <ul  id="download_list<?php echo $count; ?>">	
                                                <li style="display: none;"></li>		   
                                                <?php
                                                foreach ($news_letter as $value) {
                                                    ?>
                                                    <li>
                                                        <a download href="<?php echo $value->file ?>"><i class="fa fa-download"></i> <?php echo $value->title; ?></a> 
                                                        <span class="time"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($value->date)); ?></span> 
                       <!--                                 <span>
                                                           
                                                            
                                                        </span>-->
                                                        <?php if ($_SESSION['teacher']): ?>
                                                            <a href="javascript:void(0)" id="<?php echo $value->id; ?>" class="btn_delete_newsletter del" type="button"><i class="fa fa-times"></i></a>
                                                    <?php endif; ?>
                                                    </li>
                                                    <?php
                                                }
                                                ?> 
                                                <input type="hidden" class="news_teacher_id" name="teacher_id" value="<?php echo $TEACHER_ID ?>"
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