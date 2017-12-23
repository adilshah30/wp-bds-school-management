<?php
function bds_teacher_newsletter_category(){
    //wp_enqueue_style( 'jsform-validation', plugin_dir_url( FILE ) . 'teacher/js/jquery.validate.js', array(), get_bloginfo('version'), '' );    
    //echo $_GET['id'];
    /*adil edit session logout*/
    if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
            $user = true;
    }else{
            echo '<script>window.location="'.get_site_url().'/login";</script>';
            exit();
    } 
    
    global $wpdb;   
    $news_category_table = $wpdb->prefix.'bds_newsletter_category';
    $news_categories = $wpdb->get_results("SELECT * FROM $news_category_table WHERE teacher_id = '".$_SESSION['teacher']."'" );   
?>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
<div class="mc-content-wrap">
    <div class="h_wrapper">        
        <div class="bds-add-homework">
            <div class="normal top-action">
                <div class="pull-left">
                    <h2 class="title">My Newsletter Categories</h2>
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
                    
                        <form method="post" action="#" id="form-bds-add-newsletter-category">

                            <div class="form-group">
                                <p>
                                    <label>Category Name</label>                  
                                </p>
                                <input type="text" name="subject_name" class="form-control" id="bds_news_cat" value=""/>
                                <span class="bds_subject_error"></span>
                            </div>               
                            <!-- session -->
                            <div class="form-group">                      
                                <p>
                                    <input type="hidden" value="<?php echo $_SESSION['teacher']; ?>" id="bds_teacher_id"/>
                                    <button type="button" id="bds-add-news-cat-btn" name="submit">Submit</button>
                                </p>
                            </div>
                        </form>
                    <div class="teacher-subject-listing">
                        <table style="width:100%" class="bds-table-manage">
                <thead>
                    <tr>
                        <th>Categories</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <?php
                    if (false === $news_categories){
                ?>
                     <tr class="">
                        <td>No Subject Added Please Add</td>  
                    </tr>
                  <?php  
                  }else{
                  
                    foreach($news_categories as $news_category){                    
                    ?>
                    <tr class="homework-row-<?php echo $news_category->id;?>">
                        <td><?php echo $news_category->category_name; ?></td>
                        <td><a href="javascript:void(0)" id="<?php echo $news_category->id; ?>" class="btn_delete_newsletter_cat del" type="button"><i class="fa fa-times"></i></a></td>    
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