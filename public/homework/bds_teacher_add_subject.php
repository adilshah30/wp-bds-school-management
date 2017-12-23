<?php
function bds_teacher_add_subject(){
    //wp_enqueue_style( 'jsform-validation', plugin_dir_url( FILE ) . 'teacher/js/jquery.validate.js', array(), get_bloginfo('version'), '' );    
    /*adil edit session logout*/
    if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
            $user = true;
    }else{
            echo '<script>window.location="'.get_site_url().'/login";</script>';
            exit();
    } 
    
    $s_edit_id=$_GET['s_edit_id'];
    global $wpdb;   
    $subject_table = $wpdb->prefix.'bds_teacher_subjects';
    $subjects = $wpdb->get_results("SELECT * FROM $subject_table WHERE teacher_id = '".$_SESSION['teacher']."'" ); 
    $subject_detail = $wpdb->get_row("SELECT * FROM $subject_table WHERE id = '".$s_edit_id."'" );
    //echo "SELECT * FROM $subject_table WHERE id = '".$s_edit_id."'";
?>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
<div class="mc-content-wrap">
    <div class="h_wrapper">        
        <div class="bds-add-homework">
            <div class="normal top-action">
                <div class="pull-left">
                    <h2 class="title">My Subjects</h2>
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
                        <div> Loading.....</div>
                    </div>
                    
                </div>
                
                <div class="col-md-12">
                      <?php
                        if(isset($s_edit_id)){
                      ?>
                            <form method="post" action="#" id="form-bds-add-homework">
                                <div class="form-group">
                                    <p>
                                        <label>Subject</label>                  
                                    </p>
                                    <input type="text" name="subject_name" class="form-control" id="bds_subject" value="<?php echo $subject_detail->subject_name; ?>"/>
                                    <span class="bds_subject_error"></span>
                                </div>               
                                <!-- session -->
                                <div class="form-group">                      
                                    <p>
                                        <input type="hidden" value="<?php echo $subject_detail->id; ?>" id="bds_subject_id"/>
                                        <input type="hidden" value="<?php echo $_SESSION['teacher']; ?>" id="bds_teacher_id"/>
                                        <button type="button" id="bds-edit-subject-btn" name="submit">Submit</button>
                                    </p>
                                </div>
                            </form>
                      <?php 
                        } else {
                      ?>
                            <form method="post" action="#" id="form-bds-add-homework">
                                <div class="form-group">
                                    <p>
                                        <label>Subject</label>                  
                                    </p>
                                    <input type="text" name="subject_name" class="form-control" id="bds_subject" value=""/>
                                    <span class="bds_subject_error"></span>
                                </div>               
                                <!-- session -->
                                <div class="form-group">                      
                                    <p>
                                        <input type="hidden" value="<?php echo $_SESSION['teacher']; ?>" id="bds_teacher_id"/>
                                        <button type="button" id="bds-add-subject-btn" name="submit">Submit</button>
                                    </p>
                                </div>
                            </form>
                      <?php 
                        }
                      ?>
                    <div class="teacher-subject-listing">
                        <table style="width:100%" class="bds-table-manage">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                
                <?php
                    if (false === $subjects){
                ?>
                     <tr class="">
                        <td>No Subject Added Please Add</td>  
                    </tr>
                  <?php  
                  }else{
                  
                    foreach($subjects as $subject){                    
                    ?>
                    <tr class="homework-row-<?php echo $subject->id;?>">
                        <td><?php echo $subject->subject_name; ?></td>
                        <td>
                            <a href="<?php echo site_url();?>/bds-add-teacher-subject/?s_edit_id=<?php echo  $subject->id; ?>" id="<?php echo $subject->id; ?>" type="button"><i class="fa fa-pencil"></i></a>
                            <a href="javascript:void(0)" id="<?php echo $subject->id; ?>" class="btn_delete_subject del" type="button"><i class="fa fa-times"></i></a>
                        </td>

                    </tr>
                    <?php
                    }  
                    } ?>
             
              </table>
                    </div>
                    
                    <script type="text/javascript">
                            CKEDITOR.replace( 'bds_description' );
                    </script>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
    
 
<?php }