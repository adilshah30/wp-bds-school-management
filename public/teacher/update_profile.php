<?php
function  update_teacher_profile(){
    if(!isset($_SESSION['teacher'])){
        echo '<script>window.location="'.get_site_url().'/login";</script>';
        exit();
    }
    // variable initialization
    $session=noceky_brs_common::session();
    $class_name=noceky_brs_common::class_name();
    $school_type=noceky_brs_common::school_type();
    $years=noceky_brs_common::years();
    $month=noceky_brs_common::month();
    $day = noceky_brs_common::day();


    global $wpdb;
    $table = $wpdb->prefix.'teacher';
    $qery =" SELECT *  FROM $table WHERE `id` = '". $_SESSION['teacher'] ."'  AND  status = '2'   limit 1";
    $result = $wpdb->get_results( $qery );
    $result = $result[0];
    ?>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
    <div class="mc-content-wrap">
        <div id="body_wrapper">
            <div class="title">
                <p>Update Profile</p>
            </div>

                <form class="update_t" method="post" action="#" id="trf">
                    <table class="in_parent_table">
                        <tr>
                            <td>Profile Picture</td>
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
                            <input type="text" name="t_name"  value="<?= $result->full_name ?>" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Number</label>
                        </td>
                        <td>
                            <small class="tno_err"></small>
                             <input type="text" name="t_no" value="<?= $result->teacher_no ?>" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <label>Phone No</label>
                        </td>
                        <td>
                            <small class="phone_err"></small>
                            <input type="text" name="phone"  value="<?= $result->phone ?>" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Position</label>
                        </td>
                        <td>
                            <small class="pos_err"></small>
                            <input type="text" name="position" value="<?= $result->position ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Address</label>
                        </td>
                        <td>
                            <small class="addr_err"></small>
                            <input type="text" name="address"  value="<?= $result->address ?>" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label> Email</label>
                        </td>
                        <td>
                            <small class="email_err"></small>
                            <input name="email" type="email" value="<?= $result->email?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label> Gender</label>
                        </td>
                        <td>
                            <small class="gen_err"></small>
                            <input <?= ($result->gender ==('male')? 'checked' : '') ?> type="radio" id="male" name="gender" value="male"><label for="male"> Male</label>

                            <input <?= ($result->gender ==('female')? 'checked' : '') ?> type="radio" name="gender" id="female" value="female"> <lable for="female">  Female</lable>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Birthday</label>
                        </td>
    <!-- day -->
                        <td>
                            <?php
                            $dob =  explode("-", $result->dob);
                            ?>
                            <div class="edit_roster">
                                <select name="day" id="">
                                    <option value="0">Day</option>
                                    <?php
                                    foreach( $day as $value): ?>
                                        <option <?php if($value == $dob[0]){echo'selected';} ?>  value='<?= $value ?>' ><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
            <!-- Month-->
                                <select name="month" id="">
                                    <option value="0">Month</option>
                                    <?php
                                    foreach( $month as $value): ?>
                                        <option <?php if($value == $dob[1]){echo'selected';} ?>  value='<?= $value ?>' ><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select name="year" id="">
                                    <option value="0">Year</option>
                                    <?php
                                    foreach( array_reverse($years) as $value): ?>
                                        <option <?php if($value == $dob[2]){echo'selected';} ?>  value='<?= $value ?>' ><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </td>
                    </tr>

                    <!-- session -->
                    <tr>
                        <td>
                            <label>Session</label>
                        </td>
                        <td>
                            <small class="session_err"></small>
                            <select name="session" disabled>
                                <option value="0">Select Session</option>
                                <?php foreach ($session as $key => $value) { ?>
                                  <option <?php if($key == $result->session){echo'selected';} ?>  value='<?= $key ?>' ><?= $value ?></option>
                               <?php }?>

                            </select>
                        </td>
                    </tr>
                    <!-- clss name -->
                    <tr>
                        <td>
                            <label>Class</label>
                        </td>
                        <td>
                            <small class="class_err"></small>
                            <select name="class_name" disabled>
                                <option value="0">Select Class</option>
                                <?php foreach ($class_name as $key => $value) {?>
                                    <option <?php if($key == $result->class_name){echo'selected';} ?>  value='<?= $key ?>' ><?= $value ?></option>
                               <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <!-- school type -->
                    <tr>
                        <td>
                            <label>School Type</label>
                        </td>
                        <td>
                            <small class="school_err"></small>
                            <select name="school_type" disabled>
                                <option value="0">Select School Type</option>
                                <?php foreach ($school_type as $key => $value) {?>
                                    <option <?php if($key == $result->school_type){echo'selected';} ?>  value='<?= $key ?>' ><?= $value ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <button type="button" id="teacher_update_profile" name="submit">Submit</button>
                            <button type="button" onclick="javascript:window.location.href='<?= bloginfo("url")?>/student-roster/'"> <i class="fa fa-arrow-left"></i> Roster </button>
                        </td>
                    </tr>
                </table>
                </form>

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
                        </td

                    ></tr>
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
                        <td><button type="button" class="teacher_change_password">Change Password</button></td>
                    </tr>
                </table>
                </form>
        </div>
    </div>
    
   

    
<?php } ?>