<?php
function register_teacher(){
    // user verification
//    unset($_SESSION['teacher']);
    session_start();
        global $wpdb;
        $table = $wpdb->prefix.'teacher';
        $url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $qery ="SELECT `id` FROM $table WHERE `link` = '".$url."' limit 1";
        $result = $wpdb->get_results( $qery );
        if( $result ){
            $where = array('id' => $result[0]->id);
            $update = array('status' => '2');

            $updated = $wpdb->update( $table, $update, $where );
            $_SESSION['teacher'] = $result[0]->id;
        }
?>    
   <div class="wrapper">
    <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
   </div> 
<div class="mc-content-wrap">
    <div id="body_wrapper">
        <div class="title">
            <p>Teacher Registration</p>
        </div>
            <form method="post" action="#" id="trf">
                <table class="teacher_change_pass">
                <tr>
                    <td>
                        <label>Teacher Name </label>
                    </td>
                    <td>
                        <small class="name_err"></small>
                        <input type="text" name="t_name"  value="<?php if(isset($_GET['full_name'])){echo base64_decode($_GET['full_name']);} ?>">
                        <input type="hidden" name="user" value="<?php echo base64_decode($_GET['user']); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Teacher No</label>
                    </td>
                    <td>
                        <small class="tno_err"></small>
                        <input type="text" name="t_no">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone No</label>
                    </td>
                    <td>
                        <small class="phone_err"></small>
                        <input type="text" name="phone" >
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <small class="addr_err"></small>
                        <input type="text" name="address">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label> Gender</label>
                    </td>
                    <td>
                        <small class="gen_err"></small>
                        <input checked type="radio" id="male" name="gender" value="male"><label for="male">Male</label>
                
                        <input type="radio" name="gender" id="female" value="female"> <lable for="female">Female</lable>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label> Email</label>
                    </td>
                    <td>
                        <small class="email_err"></small>
                        <input name="email" type="email" value="<?php if( isset( $_GET['email'] ) ){ echo base64_decode($_GET['email']);} ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label> Password</label>
                    </td>
                    <td>
                        <small class="pass_err"></small>
                        <input name="password" type="password">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="button" id="teacher_signup" name="submit">Submit</button>
                    </td>
                </tr>
            </table>
            </form>
    </div>  
</div>
    
<?php } ?>