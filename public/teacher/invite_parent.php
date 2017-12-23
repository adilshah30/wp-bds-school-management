<?php
function teacher_invite_parent(){
if(!isset($_SESSION['teacher'])){
    echo '<script>window.location="'.get_site_url().'/login";</script>';
    exit();
}
$parent_relation=noceky_brs_common::parent_relation();
?>    
   <div class="wrapper">
    <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>

<div class="mc-content-wrap">
    <div id="body_wrapper">
        <div class="message"></div>
        <div class="title">
            <p>New Student</p>
        </div>
        <form id="trf">
            <table class="in_parent_table">
            <tr>
                <td><label>Name : </label></td>
                <td>
                    <small class="n_err"></small>
                    <input class="s_name" name="s_name" type="text"></td>
            </tr>
            <tr>
                <td><label>Number : </label></td>

                <td>
                    <small class="stno_err"></small>
                    <input class="s_no" name="s_no" type="text"></td>
            </tr>
            <tr>
                <td><label>Parent Name : </label></td>

                <td>
                    <small class="pn_err"></small>
                    <input class="p_name" name="p_name" type="text"></td>
            </tr>
            <tr>
                <td><label>Relation : </label></td>

                <td>
                    <small class="p_relation_err"></small>
                    <select class="p_name" name="p_relation">
                        <?php foreach ($parent_relation as $value) {
                            echo '<option value="'.$value.'">'. $value .'</option>';
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Email : </label></td>
                <td>
                    <div class="email_hd">
                        <small class="email_err"></small>
                        <p>Email</p>
                        <input class="pa_email" name="p_email" type="text">
                        <p>Label</p><small class="relation_err"></small>
                        <input class="p_email_l" type="text" name="relation"> <span>Example Mom, Dad, etc</span>
                    </div>
                    <div id="2nd_email" class="email_hd" style="display: none">
                        <small class="email2_err"></small>
                        <p>Email</p>
                        <input class="pa_email" name="p_email2" type="text">
                        <p>Label</p><small class="relation2_err"></small>
                        <input class="p_email_l" type="text" name="relation2"> <span>Example Mom, Dad, etc</span>
                    </div>
                    <button type="button" class="add_email"><i class="fa fa-plus"> Add Secondary Email</i></button>
                </td>
            </tr>
            <tr>
                <td><label>Phone : </label></td>

                <td>
                    <div class="email_hd">
                        <small class="phone_err"></small>
                        <p>Phone</p><small class="phone_err"></small>
                        <input class="p_phone" name="phone" type="text">
                        <p>Label</p><small class="p_l_err"></small>
                        <input class="p_p_l" type="text" name="phone_lable"> <span>Example Mobile, Home, Work, etc</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button id="tea_inv_pare" onclick="teacher_add_parent()" type="button"> Invite</button>
                    <button type="button" onclick="javascript:window.location.href='<?= bloginfo("url")?>/student-roster/'"> <i class="fa fa-arrow-left"></i> Roster </button>
                </td>
            </tr>
        </table>
      </form>
    </div>  
</div>
    
<?php  
}
?>