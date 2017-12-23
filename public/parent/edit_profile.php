<?php

function update_parent_profile(){
    // user verification

    if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
        $user = true;
    }else{
        echo '<script>window.location="'.get_site_url().'/login";</script>';
        exit();
    }
    $parent_relation=noceky_brs_common::parent_relation();

    if(isset($_SESSION['teacher'])){
        global $wpdb;
        $table_parent = $wpdb->prefix.'parent';
        $qery ="SELECT id FROM $table_parent WHERE `teacher_id` = '".$_SESSION['teacher']."' AND id = '". base64_decode($_GET['member'])."' AND  status != '-1' limit 1";
        $result = $wpdb->get_results( $qery );
        $ID = $result[0]->id;
    }
    if(isset($_SESSION['parent'])){
       echo $ID = base64_decode( $_GET['member']);
    }
    global $wpdb;
    $table_parent = $wpdb->prefix.'parent';
    $qery ="SELECT  * FROM $table_parent WHERE `id` = '".$ID."' limit 1";
    $parent_info = $wpdb->get_results( $qery );
    $parent_info = $parent_info[0];

    ?>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
<div class="mc-content-wrap">
    <div id="body_wrapper">

        <div class="title">
            <p>Edit Profile</p>
        </div>
            <form method="post" action="#" id="add_stu_form">
            <table class="parent_edit_profile">
                <input type="hidden" name="id" value="<?= $ID ?>">
                <tr>
                    <td>
                        <label>Profile Image</label>
                    </td>
                    <td>
                        <small class="file_err"></small>
                        <input type="file" name="file" id="imgInp" class="<?= $parent_info->file ?>" >
                        <div class="img">
                            <?php if(!empty($parent_info->file)): ?>
                                <img  id="img_disp" src="<?= $parent_info->file ?>" alt="your image" />
                            <?php else: ?>
                                <img style="display: none"  id="img_disp" src="" alt="your image" />
                                <i class="fa fa-user fa-5x"></i>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <small class="name_err"></small>
                        <input type="text" name="stu_name" value="<?php echo $parent_info->full_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Relation</label>
                    </td>
                    <td>
                        <small class="stuno_err"></small>

                        <select name="relation" id="">
                            <option value="0">Select Relation</option>
                            <?php foreach ($parent_relation as $key => $value) { ?>
                                <option <?php if($key == strtolower( $parent_info->relation)){echo'selected';} ?>  value='<?= $key ?>' ><?= $value ?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Email : </label></td>
                    <td>
                        <div class="email_hd">
                            <small class="email_err"></small>
                            <p>Email</p>
                            <input class="pa_email" name="p_email" type="text" value="<?= $parent_info->email ?>">
                            <p>Lable</p><small class="relation1_err"></small>
                            <input class="p_email_l" type="text" name="relation1" value="<?= $parent_info->email_lables_1 ?>"> <span>Example Mom, Dad, etc</span>
                        </div>

                        <div id="2nd_email" class="email_hd" <?php if($parent_info->email_2){echo 'style=""';}else{echo 'style="display:none"';} ?> >
                            <small class="email2_err"></small>
                            <p>Email</p>
                            <input class="pa_email" name="p_email2" type="text" value="<?= $parent_info->email_2 ?>">
                            <p>Lable</p><small class="relation2_err"></small>
                            <input class="p_email_l" type="text" name="relation2" value="<?= $parent_info->email_lables_2 ?>"> <span>Example Mom, Dad, etc</span>
                        </div>
                        <button type="button" class="add_email"><i class="fa fa-plus"> <?php if($parent_info->email_2){echo 'Hide Secondary Email';}else{echo 'Show Secondary Email';} ?> </i></button>

                    </td>
                </tr>
                <tr>
                    <td><label>Phone : </label></td>

                    <td>
                        <div class="email_hd">
                            <small class="phone_err"></small>
                            <p>Phone</p><small class="phone_err"></small>
                            <input class="p_phone" name="phone" type="text" value="<?= $parent_info->phone ?>">
                            <p>Lable</p><small class="p_l_err"></small>
                            <input class="p_p_l" type="text" name="phone_lable" value="<?= $parent_info->phone_label_1 ?>"> <span>Example Mobile, Home, Work, etc</span>
                        </div>

                        

                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <small class="addr_err"></small>
                        <input type="text" name="address" value="<?php echo $parent_info->address ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label> Gender</label>
                    </td>
                    <td>
                        <small class="gen_err"></small>
                        <input <?= ($parent_info->gender ==('male')? 'checked' : '') ?> type="radio" id="male" name="gender" value="male"><label for="male"> Male </label>

                        <input <?= ($parent_info->gender ==('female')? 'checked' : '') ?> type="radio" name="gender" id="female" value="female"> <lable for="female"> Female </lable>
                    </td>
                </tr>
                <?php if(empty($parent_info->password)): ?>
                <tr>
                    <td>
                        <label> Create Password</label>
                    </td>
                    <td>
                        <small class="password_err"></small>
                        <input type="password" name="password" id="<?php if(empty($parent_info->password)){echo 'true';}else echo 'false';?>"  >
                    </td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td></td>
                    <td>
                        <button type="button" id="edit_parent" name="submit">Submit</button>
                        <button type="button" onclick="javascript:window.location.href='<?php if(isset($_SESSION['parent'])){echo bloginfo("url").'/roster/';}else{echo bloginfo("url").'/student-roster/';}?>'"> <i class="fa fa-arrow-left"></i> Roster </button>
                    </td>                    
                </tr>
                </table>
            </form>
        <?php if(!empty($parent_info->password) && isset($_SESSION['parent']) ): ?>
        <div class="title">
            <p>Change Password</p>
        </div>
        <form class="update_t" id="trf">
            <table class="teacher_change_pass">
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <small class="o_pass_err"></small>
                        <input type="password" name="old_password" >
                    </td>

                </tr>
                <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <small class="n_pass_err"></small>
                        <input type="password" name="new_password" >
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Confirm New Password</label>
                    </td>
                    <td>
                        <small class="c_pass_err"></small>
                        <input type="password" name="c_new_password" >
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="button" class="parent_change_password">Change Password</button>
                    </td>
                </tr>
            </table>
        </form>
        <?php endif; ?>
        </div>
</div>
    
    
    
    <?php
}