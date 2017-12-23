<?php
function student_profile(){

	if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
		$user = true;
	}else{
		echo '<script>window.location="'.get_site_url().'/login";</script>';
		exit();
	}
//	 teacher id
	if(isset($_SESSION['teacher'])){
		$who = "`teacher_id` = '".$_SESSION['teacher']."'";
	}
	if(isset($_SESSION['parent'])){
		$who = "`parent_id` = '".$_SESSION['parent']."'";
	}

	global $wpdb;
	$table_student = $wpdb->prefix.'student';
	$qery ="SELECT count(id) as total FROM  $table_student WHERE id = '".$_GET['student_id']."' AND $who limit 1 ";
	$result = $wpdb->get_results( $qery );
	$result = $result[0];

	if( $result->total < 1 ){
//		echo '<script>window.location="'.get_site_url().'/404";</script>';
//		exit;
	}
?>
	    	<div class="wrapper">
    <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
	<?php
//	student profile
//
	global $wpdb;
	$table_teacher = $wpdb->prefix.'teacher';
	$qery ="SELECT $table_student.*, $table_teacher.class_name,$table_teacher.school_type, $table_teacher.session
    	FROM $table_teacher
			INNER JOIN $table_student
				ON $table_student.teacher_id = $table_teacher.id
				 WHERE $table_student.id = '".$_GET['student_id']."'";
	$student_info = $wpdb->get_results( $qery );
	$student_info = $student_info[0];
        $student_id_gg=$_GET['student_id'];
        //echo "bbbb".$_SESSION['parent'];
	?>
    </div>  
<div class="mc-content-wrap">
    <div class="h_wrapper">
		<div class="title">
			<p><?= ucwords( $student_info->full_name); ?>
				<span>
					<?php if(isset($_SESSION['parent']) === $student_id_gg): ?>
                                    <?php
                                        //echo "sss".$student_id_gg; 
                                        echo "bbbb".$_SESSION['parent'];
                                    ?>
						<a href="<?php bloginfo('url')?>/update-roster/?update=<?= $student_info->id ?> ">Edit Profile</a>
					<?php endif;
					if(isset($_SESSION['teacher'])):?>
						<a href="<?php bloginfo('url')?>/teacher-edit-roster/?update=<?= $student_info->id ?> ">Edit Profile</a>
					<?php endif; ?>
				</span>
			</p>
		</div>
	    <div class="stu_pro_body">
	    	<div class="stu_info">
	    		<table>
	    			<tr>
	    				<td width="140">Name</td>
	    				<td><b><?= ucwords( $student_info->full_name); ?></b></td>
	    			</tr>
					<tr>
						<td width="140">Gender</td>
						<td><?= ucfirst( $student_info->gender); ?></td>
					</tr>
	    			<tr>
	    				<td >Email</td>
						<td>
							<?php
							if(!empty($student_info->email_2)){
								$student_info->email = $student_info->email.", ". $student_info->email_2;
							}
							echo "<a href='mailto:".$student_info->email."'> ".$student_info->email." </a>"; ?>
						</td>
	    			</tr>
	    			<tr>
	    				<td>Phone</td>
						<td>
							<?php
							if(!empty($student_info->phone_2)){
								$student_info->phone = $student_info->phone.", ". $student_info->phone_2;
							}
							echo $student_info->phone; ?>
						</td>
	    			</tr>
					<tr>
						<td>Birthday</td>
						<td><?= date( 'd/m/Y' , strtotime($student_info->dob)) ?></td>
					</tr>
					<tr>
						<td>Favorite Movie</td>
						<td><?= ($student_info->movie != "")? ucfirst($student_info->movie) : "..." ?></td>
					</tr>
					<tr>
						<td>Favorite Sport</td>
						<td><?= ($student_info->sport != "")? ucfirst($student_info->sport) : "..." ?></td>
					</tr>
					<tr>
						<td>Favorite Super Hero</td>
						<td><?= ($student_info->hero != "")? ucfirst($student_info->hero) : "..." ?></td>
					</tr>
					<tr>
						<td width="140">Grade / Position</td>
						<td><?= ucfirst( $student_info->grade); ?></td>
					</tr>
					<tr>
						<td width="140">Address</td>
						<td><?= ucfirst( $student_info->address); ?></td>
					</tr>
					<tr>
						<td width="140">School</td>
						<td><?= ucfirst( $student_info->school_type); ?></td>
					</tr>
	    			<tr>
	    				<td>Grade</td>
	    				<td><?= ucfirst( $student_info->class_name );?></td>
	    			</tr>
					<tr>
						<td width="140">Session</td>
						<td><?= ucfirst( $student_info->session); ?></td>
					</tr>
	    		</table> 
	    	</div>
	    </div>
	    <div class="stu_pro_sidebar">
	    	<div class="pic">
	    	<?php if(empty($student_info->file)){
	    		echo '<i class="fa fa-user fa-5x"></i>';
	    		}else{ ?>
	    		<img src="<?= $student_info->file ?>">
	    		<?php } ?>
	    	</div>
	    </div>
		<div class="family">
			<div class="title add_family_title" style="clear: both">
				<p>Family Members 
                                        <?php if(isset($_SESSION['parent'])=== $student_id_gg){
                                        ?>
                                        <span>
                                                <a href="<?php echo bloginfo('url').'/add-family/';?>" ><i class="fa fa-plus-circle"></i> Add Family</a>
                                        </span> 
                                    <?php

                                    }elseif(isset($_SESSION['teacher'])){
                                        ?>

                                        <span>
                                                <a href="<?php echo bloginfo('url').'/add-family/?member='.$student_info->parent_id.''; ?>" ><i class="fa fa-plus-circle"></i> Add Family</a>
                                        </span> 

                                    <?php
                                        } 
                                        ?>
                                        
                                </p>
			</div>
<!--			<div class="fam_wrap">-->
				<?php
				global $wpdb;
				$table_parent = $wpdb->prefix.'parent';
				$table_parent_child = $wpdb->prefix.'parent_child';
				$qery ="SELECT $table_parent_child.parent_id,$table_parent.*
						FROM $table_parent_child
						INNER JOIN $table_parent
						ON $table_parent_child.parent_id = $table_parent.id AND $table_parent_child.child_id = '".$_GET['student_id']."' AND $table_parent.status != '-1' GROUP BY $table_parent_child.parent_id";
				$parent_info = $wpdb->get_results( $qery );

				foreach($parent_info as $value){
					?>
			<div class="stu_pro_body">
					<div class="fam_<?= $value->id ?>">
					<div class="title">
						<p> <?= ucfirst( $value->relation ); ?>
                                                    
                                                    <?php if(isset($_SESSION['parent'])=== $student_id_gg){ ?>
                                                        <span onclick="delete_family_member('<?= $value->id ?>')"><i class="fa fa-trash-o"></i> Delete</span><span>
                                                        <a href="<?= bloginfo('url') ?>/edit-parent-profile/?member=<?= str_replace( "=","", base64_encode( $value->id ) ) ?>">
                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                        </span>
                                                    <?php 
                                                    
                                                    }elseif(isset($_SESSION['teacher'])){
                                                        ?>
                                                        <span onclick="delete_family_member('<?= $value->id ?>')"><i class="fa fa-trash-o"></i> Delete</span><span>
                                                            <a href="<?= bloginfo('url') ?>/edit-parent-profile/?member=<?= str_replace( "=","", base64_encode( $value->id ) ) ?>">
                                                                <i class="fa fa-pencil"></i> Edit
                                                            </a>
                                                        </span>
                                                    <?php 
                                                            } ?>
                                                
                                                </p>
					</div>
					<div class="family_info">
						<table>
							<tr>
								<td width="140">Name</td>
								<td><b><?= ucwords( $value->full_name); ?></b></td>
							</tr>
							<tr>
								<td >Email</td>
								<td>
								<?php
								echo "<a href='mailto:".$value->email."'> ".$value->email." </a>"; ?>
								</td>
							</tr>
							<tr>
								<td>Phone</td>
								<td><?= $value->phone ?></td>
							</tr>
							<tr>
								<td>Gender</td>
								<td><?= ucfirst( $value->gender); ?></td>
							</tr>
							<tr>
								<td>Address</td>
								<td><?= ucfirst( $value->address); ?></td>
							</tr>
							<tr>
								<td>Invitation Date</td>
								<td><?php echo date('l, F jS, Y', strtotime($value->date)); ?></td>
							</tr>
						</table>
					</div>
			</div>
			</div>
				<div class="fam_<?= $value->id ?>">
					<div class="family_pro_sidebar">
						<div class="pic">
							<?php if(empty($value->file)){
								echo '<i class="fa fa-user fa-5x"></i>';
							}else{ ?>
								<img src="<?= $value->file ?>">
							<?php } ?>
						</div>
					</div>
				</div>
				<?php } ?>
	</div>
    </div>
</div>
    
	
<?php
}
?>