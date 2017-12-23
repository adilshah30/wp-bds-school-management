<?php
function report_card(){

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

    if(isset($_POST['stu_id']) && is_numeric($_POST['stu_id']) ){
    $student_id = $_POST['stu_id'];
    }
    $report_card_category = noceky_brs_common::report_card_category();
    ?>
    <!-- html code -->
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
    <div class="mc-content-wrap">
        <div id="body_wrapper">
            <div>
                <div class="title">
                    <?php
                    global $wpdb;
                    $table_student = $wpdb->prefix.'student';
                    $sql = "SELECT full_name FROM $table_student WHERE `teacher_id` = '".$TEACHER_ID."'  AND `id` = '".$student_id."' AND status != '-1' limit 1  ";
                    $result = $wpdb->get_results( $sql);
                    $result = $result[0];
                    ?>
                    <p><?= ucwords($result->full_name)."'s " ?> Report Card </p>
                </div>
                <input type="hidden" value="<?= $student_id ?>" id="stu_id">
                <?php
                global $wpdb;
                $table = $wpdb->prefix.'report_card';
                $count=0;
                foreach ($report_card_category as $category) { $count++; ?>
                <div class="<?php if($count == "1"){ echo "accordion active";}else{echo "accordion";} ?>"><?php echo ucfirst($category); ?>
                    <?php
                    //				user check
                    if($_SESSION['teacher']):
                        echo'
                            <form align="right" id="form'.$count.'" method="post" action="" enctype="multipart/form-data">

                                            <button type="button" id="submit_download'.$count.'" class="submit_download"><i class="fa fa-upload"></i></button>
                                            <input type="file" name="image" class="my-file" id="my-file'.$count.'">
                                            <input type="hidden" id="cat'.$count.'" name="category" value="'.$category.'">
                                    </form>
                                            <script>
                                            jQuery("#my-file'.$count.'").change(function(e) {

                                       if( jQuery("#my-file'.$count.'").val() !="" ){
                                            submit_report_card("'.$count.'");
                                            }
                                    });
                                    jQuery("#submit_download'.$count.'").click(function(){
                                        jQuery("#my-file'.$count.'").click();
                                    });
                                    </script>';
                    endif;
                    ?>
                </div>
                <?php
                $sql = "SELECT * FROM $table WHERE `teacher_id` = '".$TEACHER_ID."' AND `category` = '".strtolower($category)."' AND `student_id` = '".$student_id."' AND status != '-1'  ";
                $download = $wpdb->get_results( $sql);
                ?>
                <div id="panel<?php echo $count; ?>" class="<?php if($count == "1"){ echo "panel show";}else{echo "panel";} ?>">
                    <ul id="download_list<?php echo $count; ?>">
                        <li style="display: none;"></li>
                        <?php
                            foreach ($download as $value) {
                         ?>
                            <li>
                                <a download="myimage" href="<?php echo $value->file ?>"><i class="fa fa-download"></i> <?php echo $value->title;?></a>  <span class="time"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($value->date)); ?></span>
                                <?php if(isset($_SESSION['teacher'])): ?>
                                    <a href="javascript:void(0)" id="<?php echo $value->id; ?>" onclick="delete_this(this,'report_card')" class="del" type="button"><i class="fa fa-times"></i>
                                    </a>
                                <?php endif; ?>
                            </li>
                            <?php
                        }
                        echo '</ul>
                                            </div>';
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
    
    
    <?php
}
?>