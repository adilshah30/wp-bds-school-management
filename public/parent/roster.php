<?php
function parent_child_info(){
        global $wpdb;
        $table = $wpdb->prefix.'parent';
        $table_teacher = $wpdb->prefix.'teacher';
        $url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";        
        $qery ="SELECT `id`, `teacher_id`, `full_name` FROM $table WHERE `link` = '".$url."' AND `status` = '1' limit 1";
        $result = $wpdb->get_results( $qery );  
        //print($result);
        if( $result ){
            $qery ="SELECT full_name, class_name,session FROM $table_teacher WHERE  id = '".$result[0]->teacher_id."'  limit 1";       
                $row = $wpdb->get_results( $qery );
                    
                $_SESSION['teacher_name'] = $row[0]->full_name;
                $_SESSION['teacher_grade'] = $row[0]->class_name;
                $_SESSION['teacher_session'] = $row[0]->session;
                $_SESSION['teacher_id'] = $result[0]->teacher_id;
                $_SESSION['parent'] = $result[0]->id;
                $_SESSION['parent_name'] = $result[0]->full_name;
                $update =  array('status' => '2' );
                $where = array('id' => $result[0]->id);
                $updated = $wpdb->update( $table, $update, $where );
        }
        if(!isset($_SESSION['parent'])){
            echo '<script>window.location="'.get_site_url().'/login";</script>';
            exit();
        }
    $session=noceky_brs_common::session();
?>
<!-- html code -->

<div class="wrapper">
	<?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
	</div>	
<div class="mc-content-wrap">
    <div class="roster">
        <div class="roster_con">
            <div class="title"><p>Roster</b></p>
            </div>
            <table>
                <thead>
                <tr>
                    <th width="20">#</th>
                    <th width="50"></th>
                    <th width="170">Name</th>
                    <th width="200" class="resp-display-none">Email</th>
                    <th width="140"class="resp-display-none">Phone</th>
                    <th width="60"class="resp-display-none">Grade</th>
                    <th width="115">Report Card</th>
                    <th width="75" class="th_mng">Manager</th>
                </tr>
                </thead>
                <tbody class="tb_ch">
                <?php
                global $wpdb;
                $table_student = $wpdb->prefix.'student';
                $table_parent = $wpdb->prefix.'parent';
                //
                $query = " SELECT $table_student.id as stu_id, $table_student.full_name as stu_name, $table_student.file as stu_file,$table_parent.teacher_id as teacher_id, $table_parent.id, $table_parent.status
                            FROM $table_parent
                                INNER JOIN $table_student
                                    ON $table_parent.id = $table_student.parent_id 
                                     AND $table_parent.status = '2' 
                                        AND $table_student.status != '-1' AND $table_student.status != '-1' WHERE $table_parent.teacher_id= ".$_SESSION['teacher_id'];

                $roster = $wpdb->get_results( $query);
             
                $total=0;
                $table_parent_child = $wpdb->prefix.'parent_child';
                foreach ($roster as  $item) {  $total++;
                    $query = " SELECT $table_parent.full_name as f_fname, $table_parent.phone as f_phone,$table_parent.phone_2 as f_phone2, $table_parent.email as f_email, $table_parent.email_2 as f_email2, $table_parent.relation as f_relation, $table_parent.phone_label_1 as f_phone_label_1
                                FROM $table_parent 
                                    INNER JOIN $table_parent_child
                                        ON $table_parent.id = $table_parent_child.parent_id WHERE $table_parent_child.child_id = '".$item->stu_id."'
                                            AND $table_parent.relation IN('father','mother') 
                                         GROUP BY $table_parent_child.parent_id";
                    $family = $wpdb->get_results( $query);
                                
                    ?>
                    <tr id="td_<?= $item->id ?>">
                        <td><?= $total ?></td>
                        <td>
                            <?php if(empty($item->stu_file)){echo'&nbsp;&nbsp;<span><i class="fa fa-user fa-4x"></i></span>';}else{ ?>
                            <div class="roster-img-holder">
                                <img src="<?php echo $item->stu_file ?>" ><?php } ?>
                            </div>    
                            
                        </td>
                        <td class="inv_status_<?= $item->id ?>">
                            <a href="<?php bloginfo('url')?>/student-profile/?student_id=<?= $item->stu_id ?> "> <span class="nameMember">
                            <?php echo ucfirst( $item->stu_name ); ?></span></a>&nbsp;&nbsp;
                            <?php
                            if($item->status == 2){ echo'<p class="fa fa-check-square-o fa-lg"></p>';}
                            ?>
                            <li class=inv_btn_<?= $item->id ?>>
                                <?php if($item->status == 2) echo 'Accepted';?>
                            </li>
                        </td>
                        <!-- family  email    -->
                        <td class="resp-display-none">
                            <?php foreach ($family as  $value) {
                                if(!empty($value->f_email2)){ $value->f_email = $value->f_email .', '. $value->f_email2;}
                            ?>
                                <div id="example-02">
                                    <a href="mailto:<?= $value->f_email ?>" class="tooltip" ><?= ucfirst($value->f_fname); ?>
                                        <span>
                                        <?php echo $value->f_email; ?>
                                        </span>
                                    </a>
                                </div>
                            <?php } ?>
                        </td>
                        <!-- family  phone    -->
                        <td class="resp-display-none">
                             <?php foreach ($family as  $value) {
                                
                             ?>
                             <div id="example-02">
                                <a href="#" class="tooltip"><?= ucfirst($value->f_phone_label_1); ?>
                                <span>
                                    <?= ($value->f_phone == "")? 'Private': $value->f_phone ?>
                                </span>
                                </a>
                            </div>                    
                             <?php } ?>
                       
                        </td>
                        <td class="resp-display-none"><?= ucfirst( $_SESSION['teacher_grade'] ); ?></td>
                        <td>
                            <?php if($_SESSION['parent'] == $item->id ): ?>
                           
                            
                            <form method="post" action="<?= bloginfo('url')?>/bds-student-report/">
                                <input type="hidden" name="teacher_id" value="<?php echo $item->teacher_id; ?>" >
                                <button class="roster_rc" type="submit" name="std_id" value="<?= $item->stu_id?>"> Report Card </button>
                            </form>
                            <?php endif; ?>
                        </td>
                        <td class="td_mng">
                            <?php if($_SESSION['parent'] == $item->id ): ?>
                            <li><a href="<?php bloginfo('url') ?>/update-roster/?update=<?php echo $item->stu_id ?>"><i class="fa fa-pencil"></i> Edit </a></li>
                             <li id="child_<?= $item->stu_id ?>" onclick="del_child(this.id)"><i class="fa fa-trash-o"></i> Delete</li>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php
                // print_r($family);
                 } ?>
                <tr>
                    <td id="total_child" colspan="8"> <span><b><?php echo $total; ?></span></b> Total Roster Members</td>
                </tr>
                </tbody>
            </table>
        </div>
        
         <!-- non roster -->
        <div class="roster_con">
        <div class="title"> <p class="no_roster_title"> Non Roster </p>
        </div>    
        <table>
            <thead>
              <tr>
               <th width="20">#</th>
               <th width="50"></th>
                <th width="170">Name</th>
                <th width="200"  class="resp-display-none">Email</th>
                <th width="140"  class="resp-display-none">Phone</th>
                <th width="60">Grade</th>
                <!--<th width="112">Report Card</th>-->
               <!-- <th width="75" class="th_mng">Manager</th>-->
              </tr>
            </thead>
            <tbody class="tb_ch">
            <?php
            // get  roster
            global $wpdb;
            $table_teacher = $wpdb->prefix.'teacher';
            $qery ="SELECT  `id`,`full_name`, `email`, `phone`, `class_name`, `teacher_no`, `file`, `status` FROM $table_teacher WHERE `id` = '".$_SESSION['teacher_id']."' AND `status` = '2' limit 1";
            $result = $wpdb->get_results( $qery );
            $total = 0;
            foreach($result as $value){ $total++;
            ?>
              <tr>
                <td>0<?= $total; ?></td>
                <td><?php if(empty($value->file)){echo'&nbsp;&nbsp;<span><i class="fa fa-user fa-4x"></i></span>';}else{ ?>
                    <div class="roster-img-holder">
                        <img src="<?php echo $value->file ?>">
                    </div><?php } ?></td>
                <td><span class="nameMember"><a href="<?php bloginfo('url')?>/teacher-profile/"><?php echo ucfirst( $value->full_name ); ?></a></span>&nbsp;<p class="fa fa-check-square-o fa-lg"></p>
                    <?php if($value->status == 0){ echo'<p class="p_approval"> Invitation Pending </p>';}?>
                    <?php if($value->status == 1){ echo'<p style="color:red;"> Invited </p>';} ?>
                    <?php if($value->status == 2){ echo'<p class="inv_btn_1"> Accepted </p>';} ?>
                    </p>
                </td>
               <td>
                    <div id="example-02">
                        <a href="#" class="tooltip"><?= ucfirst(  $value->email ); ?>
                            <span>
                                <?= $value->email ?>
                            </span>
                        </a>
                    </div>
                </td>
                <td class="resp-display-none">               
                    <div id="example-02">

                        <a href="#" class="tooltip"><?= ucfirst(  $value->phone ); ?>
                            <span>
                                <?= $value->phone ?>
                            </span>
                        </a>
                    </div>    
                </td>
                <td class="resp-display-none"><?php echo ucfirst( $value->class_name ); ?></td>
                <!--<td><button>Report Card</button></td>-->
              <!--  <td class="td_mng">
                    <li><a href="<php bloginfo('url') ?>/teacher-update-profile/"><i class="fa fa-pencil"></i><span style="color:#000000"> Edit</span></a></li>
                    <li><i class="fa fa-trash-o"></i> Delete</li>
                </td>-->
              </tr>
                <?php } ?>
                <tr>
                    <td colspan="6"> <?php echo '<b>'.$total.'</b>'; ?> Total Non Roster Members</td>
                </tr>    
            </tbody>
        </table>
   </div>
        
	</div>
</div>
	


    
<?php
}?>