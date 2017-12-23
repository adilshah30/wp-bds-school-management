<?php
function parent_registration(){
    session_start();
    global $wpdb;
    
    $table = $wpdb->prefix.'parent';
    $url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $qery = "SELECT `id` FROM $table WHERE `link` = '".$url."' limit 1";
    $result = $wpdb->get_results( $qery );
    if( $result ){
        //$where = array('id' => $result[0]->id);
        //$update = array('status' => '2');
        //$updated = $wpdb->update( $table, $update, $where );
        //$_SESSION['parent'] = $result[0]->id;
    }   
//    }else{
//        echo '<script>window.location="'.get_site_url().'/login";</script>';
//        exit();
//    }
   
?>    
<!--   <div class="wrapper">
    <?php //require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>  -->


<div class="mc-content-wrap">
    
    <div class="gray_box"> 
        <div class="col-md-6">
            <div class="form-wrap form-register-parent">
            <form method="post" action="#" id="trf">

                <div class="input-wrap">
                    <p>
                        <label>Parent Name</label><small class="name_err"></small>                 
                    </p>
                    <input type="text" name="p_name" value="<?php if(isset($_GET['full_name'])){echo base64_decode($_GET['full_name']);} ?>" />
                </div>
                
                <div class="input-wrap">
                    <p>
                        <label>Phone No</label><small class="phone_err"></small>                    
                    </p>
                    <input type="text" name="phone" />
                </div>
                
                <div class="input-wrap">
                    <p>
                        <label>Address</label><small class="addr_err"></small>                  
                    </p>
                    <input type="text" name="address"/>
                </div>               
                <!-- session -->
                
                <div class="input-wrap">
                    <p>
                        <label> Email</label><small class="email_err"></small>                  
                    </p>
                    <input name="email" type="email" value="<?php if( isset( $_GET['email'] ) ){ echo base64_decode($_GET['email']);} ?>">
                </div>

                <div class="input-wrap">  
                    <p>
                        <label> Password</label><small class="pass_err"></small>                    
                    </p>
                    <input name="password" type="password">
                </div>
                <div class="input-wrap">  
                    <p>
                        <label>Confirm Password</label><small class="confirm_pass_err"></small>                    
                    </p>
                    <input name="confirm_password" type="password" id="confirm_password">
                    <small class="pass_match"></small> 
                </div>
                <div class="">                      
                    <p>
                        <input type="hidden" id="user_id" name="id" value="<?php echo base64_decode($_GET['user']); ?>">
                        <button type="button" id="parent_signup" name="submit">Submit</button>
                    </p>
                </div>
            </form>
        </div>
        </div>
        
    </div> 
    
</div>
     

    
    
<?php } ?>