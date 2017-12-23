<?php

function teacher_add_student(){
	if(!isset($_SESSION['teacher'])){
		echo '<script>window.location="'.get_site_url().'/login";</script>';
	}
	$session=noceky_brs_common::session();
	$class_name=noceky_brs_common::class_name();
	$school_type=noceky_brs_common::school_type();
?>
<div class="wrapper">
	<?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
	</div>
<div class="mc-content-wrap">
    
	<div class="gray_box">	
	    <div>
	        <form method="post" action="#" id="add_stu_form">

	        	<div class="stu_name">
		        	<p>
		        		<label>Student Name</label><small class="name_err"></small>	        		
		        	</p>
		        	<input type="text" name="stu_name" >
	        	</div>
	        	<div class="stu_no">
		        	<p>
		        		<label>Student No</label><small class="stuno_err"></small>	        		
		        	</p>
		        	<input type="text" name="stu_no">
	        	</div>
	        	<div class="stu_phone">
		        	<p>
		        		<label>Phone No</label><small class="phone_err"></small>	        		
		        	</p>
		        	<input type="text" name="phone" >
	        	</div>
	        	<div class="stu_address">
		        	<p>
		        		<label>Address</label><small class="addr_err"></small>	        		
		        	</p>
		        	<input type="text" name="address">
	        	</div>
	        	<div class="stu_gender">
		        	<p>
		        		<label> Gender</label><small class="gen_err"></small>	        		
		        	</p>
		        	<input checked type="radio" id="male" name="gender" value="male"><label for="male">Male</label> 
	        	
	        		<input type="radio" name="gender" id="female" value="female"> <lable for="female">Female</lable>
	        	</div>
	        	<!-- session -->
	        	<div class="stu_session">
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
	        	<div class="stu_class">
		        	<p>
		        		<label>Class</label><small class="class_err"></small>	        		
		        	</p>
		        	<select name="class_name">
		        	<option value="0">Select Class</option>
		        		<?php foreach ($class_name as $key => $value) {
		        			echo "<option value='".$key."' >".$value."</option>";
		        		} 
		        		?>
		        	</select>
	        	</div>
	        	<!-- school type -->
	        	<div class="stu_school">
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

		        <div class="stu_email">
		        	<p>
		        		<label> Email</label><small class="email_err"></small>	        		
		        	</p>
		        	<input name="email" type="email">
	        	</div>

		        <div class="stu_password">	
		        	<p>
		        		<label> Password</label><small class="pass_err"></small>	        		
		        	</p>
		        	<input name="password" type="password">
		        </div>
		        <div class="">	
		        	<p>
		        		<label>Student Image</label><small class="file_err"></small>
		        	</p>	
		        		<input type="file" name="file" id="imgInp" >
	       				<img style="display: none;" id="img_disp" src="#" alt="your image" />
	       		</div>
	       		<div class="">			        	
		        	<p>
		        		<button type="button" id="add_students" name="submit">Submit</button>
		        	</p>
	        	</div>
	        </form>
	    </div>
    </div>  
</div>
	
<?php
}