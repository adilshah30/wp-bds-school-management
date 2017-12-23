<?php

function teacher_download() {
    global $wpdb;
    $table = $wpdb->prefix . 'download_area';
    $download_category_table = $wpdb->prefix.'bds_downloads_category';
    
    if (isset($_SESSION['teacher']) || isset($_SESSION['parent'])) {
        $user = true;
    } else {
        echo '<script>window.location="' . get_site_url() . '/login";</script>';
        exit();
    }
    wp_enqueue_style('datapickercss', plugin_dir_url(FILE) . 'teacher/css/dp-style.css', array(), get_bloginfo('version'), '');
    wp_enqueue_style('bootstrap_css-css', plugin_dir_url(FILE) . 'teacher/css/bootstrap.css', array(), get_bloginfo('version'), '');
    wp_enqueue_script('sweetalertjs', plugin_dir_url(FILE) . 'teacher/js/jq-datapicker.js', array('jquery'), get_bloginfo('version'), false);
    wp_enqueue_script('sweetalertjs2', plugin_dir_url(FILE) . 'teacher/js/jq-datapicker2.js', array('jquery'), get_bloginfo('version'), false);
    wp_enqueue_script('bootstrap_js', plugin_dir_url(FILE) . 'teacher/js/bootstrap.min.js', array('jquery'), get_bloginfo('version'), false);
//    $download_category = noceky_brs_common::download_category();

    if (isset($_SESSION['teacher'])) {
        $TEACHER_ID = $_SESSION['teacher'];
    }
    if (isset($_SESSION['parent'])) {
        $TEACHER_ID = $_SESSION['teacher_id'];
    }
    $download_category = $wpdb->get_results("SELECT * FROM $download_category_table WHERE teacher_id = '".$TEACHER_ID."'" );  
    ?>
    <!-- html code -->

    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
    <div class="mc-content-wrap">
        <div id="body_wrapper">		
<!--        <div class="title">
            <p>Download Area</p>
        </div>-->
        <div class="top-action">
            <div class="pull-left">
                <h2 class="title">Download Area</h2>
            </div>
            <div class="pull-right">
                <?php if ($_SESSION['teacher']): ?>
                <a href="<?php echo site_url()."/bds-download-category/"; ?>" class="btn btn-bds-action"><i class="fa fa-plus-circle"></i>Add Category</a>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-group" id="accordion">
            <?php
            
            $count = 0;
            foreach ($download_category as $category) {
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
                                        <input type="hidden" id="cat<?= $count ?>" name="category" value="<?= $category->category_name; ?>">            
                                        
                                    </form>	
                                    <script>
                                        jQuery("#my-file<?= $count ?>").change(function (e) {

                                            if (jQuery("#my-file<?= $count ?>").val() != "") {
                                                submit_download_area("<?= $count ?>");
                                            }
                                        });
                                        jQuery("#submit_download<?= $count ?>").click(function () {

                                            jQuery("#my-file<?= $count ?>").click();
                                        });
                                    </script>

                                    <?php
                                    $sql = "SELECT * FROM $table WHERE `teacher_id` = '" . $TEACHER_ID . "' AND `category` = '" . strtolower($category->category_name) . "'  AND status != '-1' ";
                                    $download = $wpdb->get_results($sql);
                                    ?>			   	
                                    <div class="pnl">
                                        <ul  id="download_list<?php echo $count; ?>">	
                                            <li style="display: none;"></li>		   
                                            <?php
                                            foreach ($download as $value) {
                                                ?>										    	
                                                <li>
                                                    <a download="myimage" href="<?php echo $value->file ?>"><i class="fa fa-download"></i> <?php echo $value->title; ?></a>  <span class="time"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($value->date)); ?></span>
                                                    <?php if (isset($_SESSION['teacher'])): ?>
                                                        <a href="javascript:void(0) " id="<?php echo $value->id; ?>" onclick="delete_this(this, 'download_area')" class="del" type="button"><i class="fa fa-times"></i>
                                                        </a>
                                                <?php endif; ?>
                                                </li>

            <?php }
        ?> 
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
    <?php
}
?>