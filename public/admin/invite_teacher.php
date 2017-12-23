<?php
function invite_teachers_options(){
	// variable initialization
	$session=noceky_brs_common::session();
	$class_name=noceky_brs_common::class_name();
	$school_type=noceky_brs_common::school_type();
?>

<script type="text/javascript">
	jQuery(document).ready(function(){
		var class_name = jQuery('select[name="class_name"]').val();
		jQuery('.'+class_name).addClass('show');
		
	});
	function disp_selectd(class_name){
		jQuery('.show').removeClass('show');
		jQuery('.'+class_name).addClass('show');
	}
</script>
<div class="invite">
	<h2>Add Teacher</h2>
	<small class="message"></small>
	<form method="post" id="admin_invite" onsubmit="return admin_add_teacher()">
	<div class="t_input">
		<p>
		 <label>Teacher Name</label><small class="fname_err"></small>
		</p>
		<input type="text" name="full_name">
	</div>
	
	<div class="t_input">
		<p>
		 <label>Email</label><small class="email_err"></small>
		</p>
		<input type="text" name="email">
	</div>
		<!-- session -->
		<div class="adm_session">
			<p>
				<label>Session</label><small class="session_err"></small>
			</p>
			<select name="session">
				<option value="0">Select Session</option>
				<?php foreach ($session as $key => $value) {
					echo "<option value='".$key."' >".$value."</option>";
				}
				?>
			</select>
		</div>


		<!-- clss name -->
		<div class="adm_class">
			<p>
				<label>Grade</label><small class="class_err"></small>
			</p>
			<select name="class_name" onchange="disp_selectd(this.value)">				
				<?php
				$class_name=noceky_brs_common::class_name();
				foreach ($class_name as $key => $value) {
					echo "<option value='".$key."' >".$value."</option>";
				}
				?>
			</select>
		</div>
		<!-- school type -->
		<div class="adm_school">
			<p>
				<label>School Type</label><small class="school_err"></small>
			</p>
			<select name="school_type">
				<option value="0">Select School Type</option>
				<?php foreach ($school_type as $key => $value) {
					echo "<option value='".$key."' >".$value."</option>";
				}
				?>
			</select>
		</div>
	<div class="t_submit">
		<input type="hidden" name="submit" value="123">
		<button type="submit">Submit</button>
	</div>	
	</form>

</div>
<?php
//	add teacher process

if(isset($_POST['submit'])) {
	extract($_POST);

	global $wpdb;
	$table = $wpdb->prefix . 'teacher';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		teacher_no varchar(9) NOT NULL,
		full_name  varchar(150) NOT NULL,
		email varchar(150) NOT NULL,
		password varchar(250) NOT NULL,
		md5_password varchar(250) NOT NULL,
		gender varchar(20) NOT NULL,
		phone varchar(30) NOT NULL,
		address text NOT NULL,
		file text NOT NULL,
		school_type varchar(100) NOT NULL,
		class_name varchar(100) NOT NULL,
		session varchar(100) NOT NULL,
		dob varchar(50) NOT NULL ,
		position varchar(250) NOT NULL ,
		date text NOT NULL,
		link text NOT NULL,
	    status int(2) NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	// insert data
	global $wpdb;
	$wpdb->insert($table, array(
		'full_name' => $full_name,
		'email' => $email,
		'date' => date('y-m-d h:i:s'),
		'session' => $session,
		'class_name' => $class_name,
		'school_type' => $school_type,
		'status' => '0'
	));}
	?>
	<div class="teacher_info">
		<div class="invite_teacher">
			<?php
                        //phpinfo();
			$class_name=noceky_brs_common::class_name();
			foreach ($class_name as $value) { ?>
			<div class="<?= strtolower($value); ?> hide">
				<div class="title"><p> Teacher <?= $value ?> (Grade)</p></div>
				<table>
					<thead>
					<th>Name</th>
					<th>Email</th>
					<th>Session</th>
					<th>Grade</th>
                                        <th>School type</th>
					<th>Invite</th>
					<th>Status</th>
					<th>Manage</th>
					</thead>
					<tbody>
				<?php
				global $wpdb;
				$result = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix . 'teacher'." WHERE `class_name` = '".$value."' AND `status` != '-1' " );
				if(empty($result)) echo '<tr class="error"><td colspan="7">Teacher not found!</td></tr>';
				foreach( $result as $teacher){
				?>
					<tr class="t_row_<?= $teacher->id ?>">
						<td><?= $teacher->full_name ?></td>
						<td><?= $teacher->email ?></td>
						<td><?= $teacher->session ?></td>
                                                <td><?= $teacher->class_name ?></td>
						<td><?= $teacher->school_type ?></td>
						<td class=inv_btn_<?= $teacher->id ?>>
							<?php if($teacher->status == 0){?> <button value="<?= $teacher->id ?>" onclick="invite_teacher(this.value)">Invite</button><?php } ?>
							<?php if($teacher->status == 1) {?> <button value="<?= $teacher->id ?>" onclick="reinvite_teacher(this.value)">Reinvite</button><?php } ?>
							<?php if($teacher->status == 2) echo 'Accepted';?>
							<?php if($teacher->status == 3) {?>  <button onclick="reinvite_message()">Reinvited</button><?php } ?>
						</td>
						<td class="inv_status_<?= $teacher->id ?>">
							<?php if($teacher->status == 0) echo '<i class="fa fa-envelope-o"></i> Send Inviattion ';?>
							<?php if($teacher->status == 1) echo '<i class="fa fa-clock-o"></i> Awaiting acceptance';?>
							<?php if($teacher->status == 2) echo '<i class="fa fa-check"></i> Invitation Accepted';?>
							<?php if($teacher->status == 3) echo 'Resubmitted';?>
						</td>
						<td><button id="<?= $teacher->id ?>" class="dell_teacher" onclick="dell_teacher(this.id)" type="button"><i class="fa fa-times"></i></button></td>
					</tr>
				<?php } ?>
					</tbody>
				</table>
			</div>
		<?php } ?>
		</div>
	</div>
<?php } ?>