<?php
function teacher_profile(){

	if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
		$user = true;
	}else{
		echo '<script>window.location="'.get_site_url().'/login";</script>';
		exit();
	}
//	 teacher id
	if(isset($_SESSION['teacher'])){
		$TEACHER_ID = $_SESSION['teacher'];
	}
	if(isset($_SESSION['parent'])){
		$TEACHER_ID = $_SESSION['teacher_id'];
	}
	global $wpdb;
	$table = $wpdb->prefix.'teacher';
    $qery ="SELECT  `id`,`full_name`, `email`, `phone`, `class_name`, `teacher_no`, `file`, `address`, `date`, `gender`, `position`, `dob`, `school_type`, `session` FROM $table WHERE `id` = '".$TEACHER_ID."' AND `status` = '2' limit 1";
    $result = $wpdb->get_results( $qery );
?>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div> 
    <div class="mc-content-wrap">
        <div class="h_wrapper">
	    <div class="stu_pro_body">
	    	<div class="title">
	    		<p> <?php echo ucwords( $result[0]->full_name."'s profile " ); ?> 
	    		<?php if(isset($_SESSION['teacher'])): ?>
	    		<span><a href="<?php bloginfo('url')?>/teacher-update-profile"> <i class="fa fa-pencil"></i> Edit Profile</a></span>
	    	<?php endif; ?>
	    		</p> 
	    	</div>
	    	<div class="stu_info">
	    		
	    		<table>
	    			<tr>
	    				<td width="140">Name</td>
	    				<td><?php echo ucwords( $result[0]->full_name ); ?></td>
	    			</tr>
	    			<tr>
	    				<td width="140">Teacher No</td>
	    				<td><?php echo $result[0]->teacher_no; ?></td>
	    			</tr>
	    			<tr>
	    				<td >Email</td>
	    				<td><?php echo $result[0]->email; ?></td>
	    			</tr>
	    			<tr>
	    				<td>Phone</td>
	    				<td><?php echo  $result[0]->phone; ?></td>
	    			</tr>
	    			<tr>
	    				<td>Address</td>
	    				<td><?php echo  ucfirst( $result[0]->address); ?></td>
	    			</tr>
	    			<tr>
	    				<td>Grade</td>
	    				<td><?php echo ucwords( $result[0]->class_name ); ?></td>
	    			</tr>
					<tr>
						<td>School</td>
						<td><?php echo ucwords( str_replace("-"," ",    $result[0]->school_type )); ?></td>
					</tr>
					<tr>
						<td>Session</td>
						<td><?php echo ucwords( $result[0]->session ); ?></td>
					</tr>
					<tr>
						<td>Position</td>
						<td><?php echo ucwords( $result[0]->position ); ?></td>
					</tr>
					<tr>
						<td>Gender</td>
						<td><?php echo ucwords( $result[0]->gender ); ?></td>
					</tr>
					<tr>
						<td>Birthday</td>
						<td><?php echo ucwords( $result[0]->dob ); ?></td>
					</tr>
	    			<tr>
	    				<td>Registration Date</td>
	    				<td><?php echo date("D-m-Y", strtotime($result[0]->date)); ?></td>
	    			</tr>
	    		</table> 
	    	</div>
	    </div>
	    <div class="stu_pro_sidebar">
	    	<div class="pic">
	    	<div class="title">
	    		<p><?php echo ucwords( $result[0]->full_name ); ?></p>
	    	</div>
	    		<img src="<?php echo $result[0]->file ?>">
	    	</div>				
	    </div>
    </div>
    </div>
<?php
}
?>