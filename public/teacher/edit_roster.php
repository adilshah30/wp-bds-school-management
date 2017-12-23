<?php

function teacher_edit_roster(){
    // user verification

    if(!isset($_SESSION['teacher'])){
        echo '<script>window.location="'.get_site_url().'/login";</script>';
        exit();
    }
    if(!ctype_digit($_GET['update'])){
        echo '<script>window.location="'.get_site_url().'/404";</script>';
        exit;
    }
    $years=noceky_brs_common::years();
    $month=noceky_brs_common::month();
    $day = noceky_brs_common::day();

    global $wpdb;
    $table_student = $wpdb->prefix.'student';
    $qery ="SELECT  * FROM $table_student WHERE `teacher_id` = '".$_SESSION['teacher']."' AND `id` = '".$_GET['update']."' limit 1";
    $student_info = $wpdb->get_results( $qery );
    $student_info = $student_info[0];

    if(!$student_info){
        echo '<script>window.location="'.get_site_url().'/404";</script>';
        exit;
    }

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
                <input type="hidden" name="p_id" value="<?= $student_info->parent_id ?>">
            <table class="in_parent_table">
                <tr>
                    <td>
                        <label>Profile Image</label>
                    </td>
                    <td>
                        <small class="file_err"></small>
                        <input type="file" name="file" id="imgInp" class="<?= $student_info->file ?>" >
                        <div class="img">
                            <?php if(!empty($student_info->file)): ?>
                                <img  id="img_disp" src="<?= $student_info->file ?>" alt="your image" />
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
                        <input type="text" name="stu_name" value="<?php echo $student_info->full_name ?>">
                        <input type="hidden" name="id" value="<?php echo $_GET['update'] ?>">
                    </td>
                </tr>

                <tr>
                    <td><label>Email : </label></td>
                    <td>
                        <div class="email_hd">
                            <small class="email_err"></small>
                            <p>Email</p>
                            <input class="pa_email" name="p_email" type="text" value="<?= $student_info->email ?>">
                            <p>Label</p><small class="relation_err"></small>
                            <input class="p_email_l" type="text" name="relation" value="<?= $student_info->email_lables_1 ?>"> <span>Example Mom, Dad, etc</span>
                        </div>

                        <div id="2nd_email" class="email_hd" <?php if($student_info->email_2){echo 'style=""';}else{echo 'style="display:none"';} ?> >
                            <small class="email2_err"></small>
                            <p>Email</p>
                            <input class="pa_email" name="p_email2" type="text" value="<?= $student_info->email_2 ?>">
                            <p>Label</p><small class="relation2_err"></small>
                            <input class="p_email_l" type="text" name="relation2" value="<?= $student_info->email_lables_2 ?>"> <span>Example Mom, Dad, etc</span>
                        </div>
                        <button type="button" class="add_email"><i class="fa fa-plus"> <?php if($student_info->email_2){echo 'Delete Secondary Email';}else{echo 'Add Secondary Email';} ?> </i></button>

                    </td>
                </tr>
                <tr>
                    <td><label>Phone : </label></td>
                    <td>
                        <div class="email_hd">
                            <small class="phone_err"></small>
                            <p>Phone <?php if($student_info->phone):?> <span class="del_phone" onclick="del_email_1()">Delete</span> <?php endif; ?> </p><small class="phone_err"></small>
                            <input class="p_phone" name="phone" type="text" value="<?= $student_info->phone ?>">
                            <p>Label</p><small class="p_l_err"></small>
                            <input class="p_p_l" type="text" name="phone_lable" value="<?= $student_info->phone_label_1 ?>"> <span>Example Mobile, Home, Work, etc</span>
                        </div>

                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <label> Gender</label>
                    </td>
                    <td>
                        <small class="gen_err"></small>
                        <input <?= ($student_info->gender ==('male')? 'checked' : '') ?> class="r_gender" type="radio" id="male" name="gender" value="male"><label for="male"> Male </label>

                        <input <?= ($student_info->gender ==('female')? 'checked' : '') ?> class="r_gender" type="radio" name="gender" id="female" value="female"> <lable for="female"> Female </lable>
                    </td>
                </tr>
<!--        birthday        -->
                <tr>
                    <td>
                        <label for="">Birthday</label>
                    </td>
                    <!-- day -->
                    <td>
                        <?php
                        $dob =  explode("-", $student_info->dob);
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
<!--         student number       -->
                <tr>
                    <td>
                        <label>Number</label>
                    </td>
                    <td>
                        <small class="stuno_err"></small>
                        <input type="text" name="stu_no"  class="roster_w_50" value="<?php echo $student_info->student_no ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Grade/Position</label>
                    </td>
                    <td>
                        <small class="grade_err"></small>
                        <input type="text" name="grade" class="roster_w_50" value="<?php echo $student_info->grade ?>">
                    </td>
                </tr>
<!--        grade position        -->
                <tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <small class="addr_err"></small>
                        <input type="text" name="address" class="roster_w_50" value="<?php echo $student_info->address ?>">
                    </td>
                </tr>
<!--                support-->
                <tr>
                    <td>
                        <label>Favorite Sport</label>
                    </td>
                    <td>
                        <small class="support_err"></small>
                        <input type="text" name="support" class="roster_w_50" value="<?php echo $student_info->sport ?>">
                    </td>
                 </tr>
                <!--  hero  -->
                <tr>
                    <td>
                        <label>Favorite Super Hero</label>
                    </td>
                    <td>
                        <small class="hero_err"></small>
                        <input type="text" name="hero" class="roster_w_50" value="<?php echo $student_info->hero ?>">
                    </td>
                </tr>
<!--                movie-->
                <tr>
                    <td>
                        <label>Favorite Movie</label>
                    </td>
                    <td>
                        <small class="movie_err"></small>
                        <input type="text" name="movie" class="roster_w_50" value="<?php echo $student_info->movie ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Student of the Week</label>
                    </td>
                    <td>
                        <small class="movie_err"></small>
                        <input type="checkbox" name="student_of_week" class="student_of_week" <?php if($student_info->student_of_week == 1){echo 'checked="checked"';} ?> style="margin-left:10px;">
                        <input type="hidden" name="teacher_id" class="teacher_id" value="<?php echo $_SESSION['teacher']; ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="button" id="teacher_edit_roster" name="submit">Submit</button>
                        <button type="button" onclick="javascript:window.location.href='<?= bloginfo("url")?>/student-roster/'"> <i class="fa fa-arrow-left"></i> Roster </button>
                    </td>
                </tr>
            </table>
            </form>
    </div>
    </div>
    
<?php
}