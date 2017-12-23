<?php
function bds_homework(){
?>

<?php
/*adil edit session logout*/
    if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
            $user = true;
    }else{
            echo '<script>window.location="'.get_site_url().'/login";</script>';
            exit();
    } 
    global $wpdb;   
    /* Set the default timezone */
    date_default_timezone_set("America/Montreal");
    if(isset($_GET['del_id'])){
        $homework_table = $wpdb->prefix.'bds_homework';
        $sql = "DELETE FROM $homework_table WHERE id ='".$_GET['del_id']."'";
        $result= $wpdb->query($sql);
        if (false === $result) {
        ?>
        <script>
            alert('Homework not deleted');
        </script>    
        <?php
        } else {
        ?>
        <script>
            alert('Homework deleted');
        </script>
        <?php
        }
        
    }
    if(isset($_POST['calendar_date']) && isset($_POST['subject_id'])){
        $arr = explode("/", $_POST['calendar_date']);
        $dd_day = $arr[1];
        $dd_month = $arr[0];
        $dd_year=$arr[2];
        $subject_id =  $_POST['subject_id']; 
        $date_month = $dd_year."-".$dd_month."-".$dd_day; 
       $date = strtotime(date($date_month));
    }else{
       $session_id =  "79"; 
       $date = strtotime(date("Y-m-d")); 
    }
    /* Set the date */
    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);
    $firstDay = mktime(0,0,0,$month, 1, $year);
    $title = strftime('%B', $firstDay);
    $dayOfWeek = date('D', $firstDay);
    $date_default_scroll= $year."-".$month."-".$day;
    $daysInMonth = cal_days_in_month(0, $month, $year);
    /* Get the name of the week days */
    $timestamp = strtotime('next Sunday');
    $weekDays = array();
    for ($i = 0; $i < 7; $i++) {
            $weekDays[] = strftime('%a', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
    }
    $blank = date('w', strtotime("{$year}-{$month}-01"));
    
    ///get homework
    $homework_table = $wpdb->prefix.'bds_homework';
    $class_table = $wpdb->prefix.'terms';
    $subject_table = $wpdb->prefix.'bds_teacher_subjects';
    
    //print_r($get_homework);
?>
        <style>
           .homework-detail li{
                list-style-type: inherit !important;
            }
        </style>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
        <div class="mc-content-wrap">
            <div class="h_wrapper"> 
        <div>
           <div class="top-action">
                <div class="pull-left homework-title-1">
                    <h2 class="title">Homework</h2>
                </div>
                <div class="pull-right homework-actions-1">
                    <a href="<?php echo site_url()."/bds-teacher-add-homework-2/"; ?>" class="btn btn-bds-action "><i class="fa fa-plus-circle"></i>Add Homework</a>
                    <a href="<?php echo site_url()."/bds-add-teacher-subject/"; ?>" class="btn btn-bds-action"><i class="fa fa-plus-circle"></i>Add Subject</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="homework-wrap">
            <div class="homework-container">
                <div class="homework-tools">
                    <div class="top-select-date">
                        <form action="<?php site_url().'/bds-homework/' ;?>" method="Post">
                            <div class="homework-controls">
                                <!--<select name="calendar_date" class="form-control">
                                    <option>Select Date</option>
                                    <option value="2017-03-23">2017-03-23</option>
                                    <option value="2017-04-23">2017-04-23</option>
                                </select>-->
                                <input name="calendar_date" type="text" class="form-control" id="bds_date" value="<?php echo isset($_POST['calendar_date']) ? $_POST['calendar_date'] : '' ?>" placeholder="mm/dd/yy">
                            </div>
                            <div class="homework-controls">
                                <?php
                                $subject_table = $wpdb->prefix.'bds_teacher_subjects';
                                if (isset($_SESSION['teacher'])) {
                                   $subjects = $wpdb->get_results("SELECT * FROM $subject_table WHERE teacher_id = '".$_SESSION['teacher']."'" ); 
                                } elseif (isset($_SESSION['parent'])) {
                                    $parent_table = $wpdb->prefix.'parent';
                                    $get_user_detail = $wpdb->get_row("SELECT * FROM $parent_table WHERE id = '".$_SESSION['parent']."'" );
                                    //echo "sdasda".$get_user_detail->teacher_id;        
                                    $subjects = $wpdb->get_results("SELECT * FROM $subject_table WHERE teacher_id = '".$get_user_detail->teacher_id."'" ); 
                                } elseif (isset($_SESSION['student'])) {
                                    $student_table = $wpdb->prefix.'student';
                                    $get_user_detail = $wpdb->get_row("SELECT * FROM $student_table WHERE id = '".$_SESSION['student']."'" );
                                    //echo "sdasda".$get_user_detail->teacher_id;        
                                    $subjects = $wpdb->get_results("SELECT * FROM $subject_table WHERE teacher_id = '".$get_user_detail->teacher_id."'" ); 
                                }
                                
                                ?>
                                <select name="subject_id" class="form-control" id="bds_class" class="form-control">                                
                                    <option value="">Subjects</option>                               			
                                        <?php                      
                                            foreach ($subjects as $subject) {
                                               if(isset($_POST['subject_id']) && $subject->id == $_POST['subject_id']){
                                                  echo "<option value='".$subject->id."' selected='selected' >".$subject->subject_name."</option>"; 
                                               }else{
                                                   echo "<option value='".$subject->id."'  >".$subject->subject_name."</option>";
                                               }
                                                       
                                            }
                                        ?>			
                                </select>                           
                            </div>
                            
                            <div class="homework-controls">
                                <input type="submit" class="top-date-sbt btn-block" value="Submit">
                            </div>                            
                        </form>                        
                    </div>                    
                    
                    <div class="clearfix"></div>
                </div>
                <?php 
                    if(isset($_POST['subject_id']) && isset($_POST['calendar_date'])){
                        include  TEACHER_PLUGIN_PATH . 'public/homework/_partial/_selected_date_homework_list.php';
                    } else{
                        include TEACHER_PLUGIN_PATH . 'public/homework/_partial/_all_date_homework.php';
                    }
                ?>
                <span id="requested_date" style="display:none;"><?php echo $date_default_scroll;?></span>
            </div>            
        </div>
    </div>
        </div>    
    
<?php
//wp_enqueue_script('sweetalertjs2', plugin_dir_url(FILE) . 'teacher/js/jq-datapicker2.js', array('jquery'), get_bloginfo('version'), false);
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    jQuery('#left_homework_scroll').slimscroll({
        size: '5px',
        height: '400px',
        alwaysVisible: true,
        color:'#000',
        railOpacity: 0.8
    });
      
    jQuery(document).ready(function (){
        //alert(jQuery('#ji_2017-09-22').offset().top);
        //var homework_height = jQuery("").scrollTop(d.prop("scrollHeight"));2017-09-2
        var requested_date=  jQuery('#requested_date').html();
        var split_date = requested_date.split("-");
        var year = split_date[0];
        var month = split_date[1];
        var day = split_date[2].replace(/^0+/, '');
        var full_date = year+"-"+month+"-"+day;
        var container = jQuery('.homework-month-days-listing-wrap'),
        scrollTo = jQuery('#date-'+full_date);
        container.animate({
            scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
        });
    });
    
    
   
        jQuery(document).ready(function(){
            jQuery( "#bds_date" ).datepicker({
                dateFormat: 'mm/dd/yy'
              });
        });
       
   
</script>  
<style type="text/css">
    
<?php if (isset($_SESSION['teacher'])) { ?>
         .btn.bds-content-edit,
         .btn.bds-content-delete{
                display:inline-block;
         }
<?php } elseif (isset($_SESSION['parent'])) { ?>
          .btn.bds-content-edit,
         .btn.bds-content-delete{
                display:none;
         } 
<?php } elseif (isset($_SESSION['student'])){ ?>
        .btn.bds-content-edit,
         .btn.bds-content-delete{
                display:none;
         }
<?php }else{ ?>
        .btn.bds-content-edit,
         .btn.bds-content-delete{
                display:none;
         }
<?php    
} ?>
   
</style>
<!--<a href="<?php //echo plugins_url().'/teacher/pdf/src/bds_homework_pdf.php'; ?>" target="_blank">generate</a>-->
<?php //plugins_url() ;?>
<?php }