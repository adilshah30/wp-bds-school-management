<?php

function student_roster() {
    // unset($_SESSION['parent']);
    if (!isset($_SESSION['teacher'])) {
        echo '<script>window.location="' . get_site_url() . '/login";</script>';
    }
    ?>
    <!-- html code -->
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
    <div class="mc-content-wrap">
        
        <div class="roster">

        <div class="roster_con">
            <div class="title"> <p><b class="roster_title"></b><span> <a href="<?= get_site_url() ?>/invite-parent"> <i class="fa fa-plus-circle"></i>&nbsp;New Student </a> </span> <!--<span> <a href="javascript:void(0)"> <i class="fa fa-download"></i> Import Student </a> </span>--></p>
            </div> 
            <div class="responsive-table">
                
                <table>
                <thead>
                    <tr>
                        <th width="20">#</th>
                        <th width="50"></th>
                        <th width="170">Name</th>
                        <th width="200" class="resp-display-none">Email</th>
                        <th width="140" class="resp-display-none">Phone</th>
                        <th width="60" class="resp-display-none">Grade</th>
                        <th width="115" >Report Card</th>
                        <th width="75" class="th_mng">Manager</th>
                    </tr>
                </thead>
                <tbody class="tb_ch">
                    <?php
                    global $wpdb;
                    $table_student = $wpdb->prefix . 'student';
                    $table_parent = $wpdb->prefix . 'parent';
                    $tbl_report = $wpdb->prefix . 'bds_report_card';
//
                    $query = " SELECT $table_student.id as stu_id, $table_student.full_name as stu_name, $table_student.file, $table_parent.id, $table_parent.status
                FROM $table_parent
                 INNER JOIN $table_student
                     ON $table_parent.id = $table_student.parent_id
                         AND $table_student.teacher_id = '" . $_SESSION['teacher'] . "'  
                             AND $table_parent.status != '-1' 
                                AND $table_student.status != '-1' 
                                    GROUP BY $table_parent.id  ";

                    $roster = $wpdb->get_results($query);
                    $total = 0;
                    $table_parent_child = $wpdb->prefix . 'parent_child';
                    foreach ($roster as $item) {
                        $total++;

                        //  secondar parent
                        $query_2 = " SELECT $table_parent.full_name as f_fname, $table_parent.phone as f_phone,$table_parent.phone_2 as f_phone2, $table_parent.email as f_email, $table_parent.email_2 as f_email2, $table_parent.relation as f_relation, $table_parent.phone_label_1 as f_phone_label_1
                                FROM $table_parent 
                                    INNER JOIN $table_parent_child
                                        ON $table_parent.id = $table_parent_child.parent_id WHERE $table_parent_child.child_id = '" . $item->stu_id . "'
                                            AND $table_parent.relation IN('Father','Mother','father','mother') 
                                         GROUP BY $table_parent_child.parent_id";
                        $family = $wpdb->get_results($query_2);
                        //echo "<pre/>";
                        //print($family);
                        ?>
                        <tr id="td_<?= $item->id ?>">
                            <td><?= $total ?></td>
                            <td>
                                <?php
                                if (empty($item->file)) {
                                    echo'&nbsp;&nbsp;<span><i class="fa fa-user fa-4x"></i></span>';
                                } else {
                                    ?>
                                    <div class="roster-img-holder">
                                        <img src="<?php echo $item->file ?>">
                                    </div>   
        <?php } ?>
                            </td>
                            <td class="inv_status_<?= $item->id ?>">
                                <a href="<?php bloginfo('url') ?>/student-profile/?student_id=<?= $item->stu_id ?> "> <span class="nameMember">
                                <?php echo ucfirst($item->stu_name); ?></span></a>&nbsp;&nbsp;
                                <?php
                                if ($item->status == 1) {
                                    echo'<p class="p_approval"><i class="fa fa-clock-o"></i> Invitation Pending</p>';
                                } elseif ($item->status == 2) {
                                    echo'<p class="fa fa-check-square-o fa-lg"></p>';
                                }
                                ?>
                    <li class=inv_btn_<?= $item->id ?>>
                        <?php if ($item->status == 0) { ?> <a href="javascript:void(0)"> <i class="fa fa-plus-square"></i> <span id="<?= $item->id ?>" onclick="invite_parent(this.id)" style="color:red;">Invite</span></a><?php } ?>
        <?php if ($item->status == 1) { ?> <a href="javascript:void(0)"> <i class="fa fa-repeat"></i> <span id="<?= $item->id ?>" onclick="reinvite_parent(this.id)">Reinvite</span></a><?php } ?>
        <?php if ($item->status == 2) echo "Accepted"; ?>
                    </li>
                    </td>                                            <!--   email    -->
                    <!-- family  email    -->
                    <td  class="resp-display-none">
                        <?php
                            foreach ($family as $value_1) {
                                if (!empty($value_1->f_email2)) {
                                    $value_1->f_email = $value_1->f_email . ', ' . $value_1->f_email2;
                                }
                                ?>
                                <div id="example-02">
                                    <a href="mailto:<?= $value_1->f_email ?>" class="tooltip" ><?= ucfirst($value_1->f_fname); ?>
                                        <span>
                                            <?php echo $value_1->f_email; ?>
                                        </span>
                                    </a>
                                </div>
                        <?php } ?>
                    </td>
                    <!-- family  phone    -->
                    <td  class="resp-display-none">
                        <?php
                        foreach ($family as $value) {
                            
                            ?>
                            <div id="example-02">
                                <a href="#" class="tooltip"><?= ucfirst($value->f_phone_label_1); ?>
                                    <span>
                                        <?= ($value->f_phone == "") ? 'Private' : $value->f_phone ?>
                                    </span>
                                </a>
                            </div>                    
                        <?php } ?>

                    </td>
                    <td  class="resp-display-none"><?= ucfirst($_SESSION['teacher_grade']); ?></td>
                    <td> 
                        <?php
                        $check_report = $wpdb->get_row("SELECT * FROM $tbl_report WHERE teacher_id = '" . $_SESSION['teacher'] . "' AND student_id='" . $item->stu_id . "'");
                        //print_r($check_report);
                        $check_report_count = $wpdb->num_rows;
                        ?>
                        <a href="<?php bloginfo('url') ?>/bds-add-report/?std_id=<?= $item->stu_id ?>" class="roster_rc">Add </a>
                        <?php
                        if ($check_report_count > 0) {
                            ?>
                            &nbsp; &nbsp;<i class="fa fa-check-square-o" aria-hidden="true" style="color:#879e73;"></i>
                            <?php
                        }
                        ?>
                        <br/>
                        <a href="<?php bloginfo('url') ?>/bds-add-report/?std_id=<?= $item->stu_id ?>&&edit_report=true" class="roster_rc">Edit</a><br/>
                        <a href="<?php echo 'https://brookridgedayschool.com/wp-content/plugins/teacher/pdf/src/student_report_card.php?std_id='.$item->stu_id.'&&teacher_id='.$_SESSION['teacher'] ; ?>" class="roster_rc" target="_blank">View</a>
                    </td>
                    <td class="td_mng">
                    <li> <a href="<?php bloginfo('url') ?>/teacher-edit-roster/?update=<?= $item->stu_id ?>"><i class="fa fa-pencil"></i><span style="color:#000000"> Edit</span></a></li>
                    <li id="child_<?= $item->stu_id ?>" onclick="del_child(this.id)"><i class="fa fa-trash-o"></i> Delete</li>
                    </td>
                    </tr>
    <?php } ?>  
                <tr>
                    <td id="total_child" colspan="8"> <b><span><?php echo $total; ?></span></b> Total Roster Members</td>
                </tr>    
                </tbody>
            </table>
                
            </div>
            
        </div>
        <!-- non roster -->
        <div class="roster_con">
            <div class="title"> <p class="no_roster_title"></p>
            </div> 
            <div class="responsive-table">
                <table>
                <thead>
                    <tr>
                        <th width="20">#</th>
                        <th width="50"></th>
                        <th width="170">Name</th>
                        <th width="200" class="resp-display-none">Email</th>
                        <th width="140" class="resp-display-none">Phone</th>
                        <th width="60" class="resp-display-none">Grade</th>
                        <th width="115">Report Card</th>
                        <th width="75" class="th_mng">Manager</th>
                    </tr>
                </thead>
                <tbody class="tb_ch">
                    <?php
                    // get  roster
                    global $wpdb;
                    $table_teacher = $wpdb->prefix . 'teacher';
                    $qery = "SELECT  `id`,`full_name`, `email`, `phone`, `class_name`, `teacher_no`, `file`, `status` FROM $table_teacher WHERE `id` = '" . $_SESSION['teacher'] . "' AND `status` = '2' limit 1";
                    $result = $wpdb->get_results($qery);
                    $total = 0;
                    foreach ($result as $value) {
                        $total++;
                        ?>
                        <tr>
                            <td>0<?= $total; ?></td>
                            <td>
                                <?php
                                if (empty($value->file)) {
                                    echo'&nbsp;&nbsp;<span><i class="fa fa-user fa-4x"></i></span>';
                                } else {
                                    ?>
                                    <div class="roster-img-holder">
                                        <img src="<?php echo $value->file ?>" >
                                    </div>
                                <?php } ?>
                            </td>
                            <td><span class="nameMember"><a href="<?php bloginfo('url') ?>/teacher-profile/"><?php echo ucfirst($value->full_name); ?></a></span></span>&nbsp;<p class="fa fa-check-square-o fa-lg"></p>
                                <?php
                                if ($value->status == 0) {
                                    echo'<p class="p_approval"> Invitation Pending </p>';
                                }
                                ?>
                                <?php
                                if ($value->status == 1) {
                                    echo'<p style="color:red;"> Invited </p>';
                                }
                                ?>
        <?php
        if ($value->status == 2) {
            echo'<p class="inv_btn_1"> Accepted </p>';
        }
        ?>
                                </p>
                            </td>
                            <td class="resp-display-none">
                                <div id="example-02">

                                    <a href="#" class="tooltip"><?= ucfirst($value->email); ?>
                                        <span>
        <?= $value->email ?>
                                        </span>
                                    </a>
                                </div>              

                            </td>
                            <td class="resp-display-none">               
                                <div id="example-02">

                                    <a href="#" class="tooltip"><?= ucfirst($value->phone); ?>
                                        <span>
        <?= $value->phone ?>
                                        </span>
                                    </a>
                                </div>    
                            </td>
                            <td class="resp-display-none"><?php echo ucfirst($value->class_name); ?></td>
                            <td><button>Report Card</button></td>
                            <td class="td_mng">
                    <li><a href="<?php bloginfo('url') ?>/teacher-update-profile/"><i class="fa fa-pencil"></i><span style="color:#000000"> Edit</span></a></li>
                    <li><i class="fa fa-trash-o"></i> Delete</li>
                    </td>
                    </tr>
    <?php } ?>
                <tr>
                    <td colspan="8"> <?php echo '<b>' . $total . '</b>'; ?> Total Non Roster Members</td>
                </tr>    
                </tbody>
            </table>
            </div>
            
        </div>
    </div>
    
    </div>

<?php } ?>