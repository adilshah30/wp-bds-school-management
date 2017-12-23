<?php
function add_family(){
    // user verification
    if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
        $user = true;
    }else{
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
            <div class="title">
                <p>Add Family</p>
            </div>
            <form method="post" action="#" id="add_stu_form">
                <table class="parent_edit_profile">
                    <input type="hidden" value="<?= $_GET['member']; ?>" name="id">
                    <tr>
                        <td>
                            <label>Profile Image</label>
                        </td>
                        <td>
                            <small class="file_err"></small>
                            <input type="file" name="file" id="imgInp"  >
                            <div class="img">
                                    <img style="display: none"  id="img_disp" src="" alt="your image" />
                                    <i class="fa fa-user fa-5x"></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <small class="name_err"></small>
                            <input type="text" name="stu_name">
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
                                    <option <?php if($key == strtolower( $parent_info->relation)){echo'selected';} ?>  value='<?= $key ?>' ><?= $value ?></option>
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
                            <input type="text" name="phone">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Phone No label</label>
                        </td>
                        <td>
                            <small class="phone_label_1_err"></small>
                            <input type="text" name="phone_label_1">
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

                            <input type="radio" name="gender" id="female" value="female"> <label for="female">Female</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label> Email</label>
                        </td>
                        <td>
                            <small class="email_err"></small>
                            <input type="text" name="email"  >
                        </td>
                    </tr>

                        <tr>
                            <td>
                                <label> Create Password</label>
                            </td>
                            <td>
                                <small class="password_err"></small>
                                <input type="password" name="password"  >
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