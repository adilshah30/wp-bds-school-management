<?php
function bds_teacher_add_homework(){
    $site_url = site_url();
   // wp_enqueue_style( 'jsform-validation', plugin_dir_url( FILE ) . 'teacher/js/jquery.validate.js', array(), get_bloginfo('version'), '' );
    /*adil edit session logout*/
    if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
            $user = true;
    }else{
            echo '<script>window.location="'.get_site_url().'/login";</script>';
            exit();
    } 
    global $wpdb;
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $homework_table = $wpdb->prefix.'bds_homework';
        //$class_table = $wpdb->prefix.'terms';
        $subject_table = $wpdb->prefix.'bds_teacher_subjects';
        //$homework_row = $wpdb->get_row("SELECT * FROM $homework_table INNER JOIN $class_table ON $homework_table.class_id = $class_table.term_id WHERE $homework_table.id = '".$id."'" );
        $homework_row = $wpdb->get_row("SELECT $homework_table.*, $subject_table.subject_name FROM $homework_table INNER JOIN $subject_table ON $homework_table.subject_id = $subject_table.id WHERE $homework_table.id = '".$id."'" );
    }else{
        //echo "nooooooooo";
    }
    wp_enqueue_script( 'text_editor', $site_url.'/wp-content/plugins/teacher/js/text_editor.js', array( 'jquery' ), get_bloginfo('version'), false );
?>
<script type="text/javascript">
//<![CDATA[
        
  //]]>
  </script>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
  <div class="mc-content-wrap">
      <div class="h_wrapper">        
        <div class="bds-add-homework">
            <div class="normal top-action">
                <div class="pull-left">
                    <h2 class="title">New Homework</h2>
                </div>
                <div class="pull-right">
                    <a href="<?php echo site_url()."/bds-homework/"; ?>" class="btn btn-bds-action"><i class="fa fa-plus-circle"></i> &nbsp; Homework</a>
                    <a href="<?php echo site_url()."/bds-add-teacher-subject/"; ?>" class="btn btn-bds-action"><i class="fa fa-plus-circle"></i>Add Subject</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-wrap bg-white pd-20" style="position:relative;">
                <div class="loader">
                    <div class="overlay"></div>
                    <div class="wrap">
                        <div>
                            <img src="<?php echo plugins_url( '../../images/loader-4.gif', __FILE__ ); ?>" style="width:100px;" ><br/> 
                        </div>

                        <div > Loading.....</div>
                    </div>
                    
                </div>
                
                <div class="col-md-12">
                    <?php 
                    if(isset($_GET['id'])){
                    ?>
                        <form method="post" action="#" id="form-bds-add-homework">

                        <div class="form-group">
                            <p>
                                <label>Homework Title</label>                  
                            </p>
                            <input type="text" name="homework_title" class="form-control" id="home_work_title" value="<?php echo $homework_row->homework_title; ?>" />
                            <span class="home_work_title_error"></span>
                        </div>

                        <div class="form-group">
                            <p>
                                <label>Subject</label>                  
                            </p>
                            <?php
                                $subject_table = $wpdb->prefix.'bds_teacher_subjects';
                                $subjects = $wpdb->get_results("SELECT * FROM $subject_table WHERE teacher_id = '".$_SESSION['teacher']."'" );
                            ?>
                            <select name="subject" class="form-control" id="bds_subject">                                
                                <option value="">Select Subject</option>                               			
                                    <?php                      
                                        foreach ($subjects as $subject) {
                                            if($subject->id == $homework_row->subject_id){
                                               echo "<option value='".$subject->id."' selected='selected'>".$subject->subject_name."</option>"; 
                                            }else{ 
                                               echo "<option value='".$subject->id."' >".$subject->subject_name."</option>";  
                                            }                                                
                                        }
                                    ?>			
                            </select> 
                            <!--<input type="text" name="subject" class="form-control" id="bds_subject" value="<?php //echo $homework_row->subject; ?>"/>-->
                            <span class="bds_subject_error"></span>
                        </div>               
                        <!-- session -->

                       

                        <div class="form-group">  
                            <p>
                                <label> Description</label>                   
                            </p>
                            <textarea cols="30" class="form-control" id="bds_description"><?php echo $homework_row->Description; ?></textarea>
                            <span class="bds_description_error"></span>
                        </div>
                        
                        <div class="form-group">                      
                            <p>
                                <input type="hidden" value="<?php echo $homework_row->teacher_id; ?>" id="bds_teacher_id"/>
                                <input type="hidden" value="<?php echo $id; ?>" id="bds_homework_id"/>
                                <button type="button" id="bds-edit-homework-btn" name="submit">Submit</button>
                            </p>
                        </div>
                    </form>
                    <?php 
                    }else{
                    ?>
                        <form method="post" action="#" id="form-bds-add-homework">
                        
                        <div class="form-group">
                            <p>
                                <label>Homework Title</label>                  
                            </p>
                            <input type="text" name="homework_title" class="form-control" id="home_work_title" />
                            <span class="home_work_title_error"></span>
                        </div>

                        <div class="form-group">
                            <p>
                                <label>Subject</label>                  
                            </p>
                            <?php
                                $subject_table = $wpdb->prefix.'bds_teacher_subjects';
                                $subjects = $wpdb->get_results("SELECT * FROM $subject_table WHERE teacher_id = '".$_SESSION['teacher']."'" );
                                ?>
                                <select name="subject" class="form-control" id="bds_subject">                                
                                    <option value="">Select Subject</option>                               			
                                        <?php                      
                                            foreach ($subjects as $subject) {
                                                echo "<option value='".$subject->id."' >".$subject->subject_name."</option>";       
                                            }
                                        ?>			
                                </select> 
                            <!--<input type="text" name="subject" class="form-control" id="bds_subject"/>-->
                            <span class="bds_subject_error"></span>
                        </div>               
                        <!-- session -->

                        <div class="form-group">
                            <p>
                                <label> Date</label>                  
                            </p>
                            <input name="date" type="text" class="form-control" id="bds_date">
                            <span class="bds_date_error"></span>
                        </div>

                        <div class="form-group">  
                            <p>
                                <label>Description</label>                   
                            </p>
                            <textarea cols="30" class="form-control" id="bds_description"></textarea>
                            <span class="bds_description_error"></span>
                        </div>
                        <div class="form-group">                      
                            <p>
                                <button type="button" id="bds-add-homework-btn" name="submit">Submit</button>
                            </p>
                        </div>
                        <input type="hidden" value="<?php echo $_SESSION['teacher']; ?>" id="bds_teacher_id"/>
                    </form>
                    <?php
                    }
                    ?>
                    <script type="text/javascript">
                            CKEDITOR.replace( 'bds_description' );
                    </script>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
  </div>
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery( "#bds_date" ).datepicker({
                dateFormat: 'yy-mm-dd'
              });
        });
        
        jQuery(document).ready(function(){ 
            nicEditors.allTextAreas() ;
            //alert('sdasd');
            
        });
    </script>   
    
 
<?php }