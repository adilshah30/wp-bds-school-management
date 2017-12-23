<?php

function edit_family(){
    // user verification

    /*adil edit session logout*/
    if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
            $user = true;
    }else{
            echo '<script>window.location="'.get_site_url().'/login";</script>';
            exit();
    } 

    $id = base64_decode( $_GET['member'] );
    $parent_relation=noceky_brs_common::parent_relation();

//    get family member data
    global $wpdb;
    $table_parent = $wpdb->prefix.'parent';
    echo $query = " SELECT * FROM $table_parent WHERE id = '$id'" ;

    $result = $wpdb->get_results( $query);
    $result = $result[0];
    ?>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
<div class="mc-content-wrap">
    <div id="body_wrapper">

        <div class="title">
            <p>Edit Family</p>
        </div>
        <form method="post" action="#" id="add_stu_form">
            <table class="parent_edit_profile">
                <tr>
                    <td>
                        <label>Profile Image</label>
                    </td>
                    <td>
                        <small class="file_err"></small>
                        <input type="file" name="file" id="imgInp" class="<?= $result->file ?>" >
                        <div class="img">
                            <?php if(!empty($result->file)): ?>
                                <img  id="img_disp" src="<?= $result->file ?>" alt="your image" />
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
                        <input type="text" name="stu_name" value="<?= $result->full_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Relation</label>
                    </td>
                    <td>
                        <small class="relation_err"></small>

                        <select name="relation" id="">
                            <option value="0">Select Relation</option>
                            <?php foreach ($parent_relation as $key => $value) { ?>

                                <option <?php if($key == strtolower( $result->relation)){echo'selected';} ?>  value='<?= $key ?>' ><?= $value ?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone No</label>
                    </td>
                    <td>
                        <small class="phone_err"></small>
                        <input type="text" name="phone" value="<?= $result->phone ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <small class="addr_err"></small>
                        <input type="text" name="address" value="<?= $result->address ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label> Gender</label>
                    </td>
                    <td>
                        <small class="gen_err"></small>
                        <input <?= ($result->gender ==('male')? 'checked' : '') ?> type="radio" id="male" name="gender" value="male"><label for="male"> Male </label>

                        <input <?= ($result->gender ==('female')? 'checked' : '') ?> type="radio" name="gender" id="female" value="female"> <lable for="female"> Female </lable>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="button" id="add_family" name="submit">Submit</button>
                    </td>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
    

<?php }