<?php
// teacher invitation admin

add_action('wp_ajax_ajax_invite_teacher', 'ajax_invite_teacher');
add_action('wp_ajax_ajax_add_activity_request','ajax_add_activity_request');
add_action('wp_ajax_ajax_reinvite_teacher', 'ajax_reinvite_teacher');
add_action('wp_ajax_ajax_bds_teacher_delete_home_work', 'ajax_bds_teacher_delete_home_work');
//--------Homework----//
add_action('wp_ajax_nopriv_ajax_bds_teacher_add_home_work', 'ajax_bds_teacher_add_home_work');
add_action('wp_ajax_nopriv_ajax_bds_teacher_edit_home_work', 'ajax_bds_teacher_edit_home_work');
add_action('wp_ajax_nopriv_ajax_bds_teacher_delete_home_work', 'ajax_bds_teacher_delete_home_work');
add_action('wp_ajax_nopriv_ajax_bds_teacher_home_work_detail', 'ajax_bds_teacher_home_work_detail');

//------------------------------------------------------------------------
add_action('wp_ajax_nopriv_ajax_teacher_signup_request', 'ajax_teacher_signup_request' );
add_action('wp_ajax_nopriv_ajax_teacher_list_event_request', 'ajax_teacher_list_event_request' );
add_action('wp_ajax_nopriv_ajax_teacher_download_request', 'ajax_teacher_download_request');
add_action('wp_ajax_nopriv_ajax_teacher_delete_request', 'ajax_teacher_delete_request');
add_action('wp_ajax_nopriv_ajax_teacher_gallery_request', 'ajax_teacher_gallery_request');
add_action('wp_ajax_nopriv_ajax_teacher_newsletter_request', 'ajax_teacher_newsletter_request');
add_action('wp_ajax_nopriv_ajax_teacher_home_work_request', 'ajax_teacher_home_work_request');
add_action('wp_ajax_nopriv_ajax_teacher_add_home_work_request', 'ajax_teacher_add_home_work_request');
add_action('wp_ajax_nopriv_ajax_teacher_edit_home_work_request', 'ajax_teacher_edit_home_work_request');
add_action('wp_ajax_nopriv_ajax_teacher_delete_home_work_request', 'ajax_teacher_delete_home_work_request');

add_action('wp_ajax_nopriv_ajax_teacher_spelling_words_request', 'ajax_teacher_spelling_words_request');
add_action('wp_ajax_nopriv_ajax_teacher_add_event_request', 'ajax_teacher_add_event_request');
add_action('wp_ajax_nopriv_ajax_teacher_edit_event_request', 'ajax_teacher_edit_event_request');
add_action('wp_ajax_nopriv_ajax_teacher_delete_event_request', 'ajax_teacher_delete_event_request');
add_action('wp_ajax_nopriv_ajax_parent_edit_child_request', 'ajax_parent_edit_child_request');
add_action('wp_ajax_nopriv_ajax_teacher_get_roster_by_id_request', 'ajax_teacher_get_roster_by_id_request');
add_action('wp_ajax_nopriv_ajax_login_action', 'ajax_login_action');

add_action('wp_ajax_nopriv_ajax_parent_register', 'ajax_parent_register');
add_action('wp_ajax_nopriv_ajax_add_parent_request', 'ajax_add_parent_request');
add_action('wp_ajax_nopriv_ajax_delete_teacher', 'ajax_delete_teacher');
add_action('wp_ajax_nopriv_ajax_teacher_profile_update_request', 'ajax_teacher_profile_update_request');
add_action('wp_ajax_nopriv_ajax_invite_parent_request', 'ajax_invite_parent_request');
add_action('wp_ajax_nopriv_ajax_reinvite_parent_request', 'ajax_reinvite_parent_request');
add_action('wp_ajax_nopriv_ajax_delete_parent_request', 'ajax_delete_parent_request');
add_action('wp_ajax_nopriv_ajax_parent_delete_child_request', 'ajax_parent_delete_child_request');
add_action('wp_ajax_nopriv_ajax_parent_edit_profile_request','ajax_parent_edit_profile_request');
add_action('wp_ajax_nopriv_ajax_teacher_dell_nonroster_request','ajax_teacher_dell_nonroster_request');

add_action('wp_ajax_nopriv_ajax_delete_activity_request','ajax_delete_activity_request');

add_action('wp_ajax_nopriv_ajax_search_activity_request','ajax_search_activity_request');
add_action('wp_ajax_nopriv_ajax_teacher_edit_roster_request','ajax_teacher_edit_roster_request');
add_action('wp_ajax_nopriv_ajax_teacher_reset_password_request','ajax_teacher_reset_password_request');
add_action('wp_ajax_nopriv_ajax_teacher_report_card_request','ajax_teacher_report_card_request');
add_action('wp_ajax_nopriv_ajax_parent_reset_password_request','ajax_parent_reset_password_request');
add_action('wp_ajax_nopriv_ajax_parent_add_family_request','ajax_parent_add_family_request');
add_action('wp_ajax_nopriv_ajax_delete_family_request','ajax_delete_family_request');

add_action('wp_ajax_nopriv_ajax_teacher_send_message_request','ajax_teacher_send_message_request');
add_action('wp_ajax_nopriv_ajax_teacher_gallert_is_home_request','ajax_teacher_gallert_is_home_request');

function ajax_teacher_signup_request() {
  if(isset($_POST['submit'])):
      extract($_POST);
        // error array initialization
        $error = array();
        if(empty($name)){
            $error[] = "Name required.";
        }
        if(empty($phone)){
            $error[] = "Phone required.";
        }
        if(empty($address)){
            $error[] = "Address required.";
        }
        if(empty($email)){
            $error[] = "Email required.";
        }
        if(empty($password)){
            $error[] = "Password required.";
        }
        if(strlen($password) < 6){
            $error[] = "Password must be at lest 6 char.";
        }
        if(count($error) > 0){
            foreach ($error as $value) {
                echo $value."\n\r";
            }
        }else {
			$teacher_data = array(
				'full_name' => $name,
				'email' => $email,
				'teacher_no' => $stu_no,
				'phone' => $phone,
				'address' => $address,
				'password' => $password,
				'md5_password' => md5($password),
				'gender' => $gender,
				'file' => $movefile['url'],
				'status' => '2',
			);
			global $wpdb;
			$table = $wpdb->prefix . 'teacher';
			$where = array('id' => $_POST['id']);
			$updated = $wpdb->update($table, $teacher_data, $where);
			if (false === $updated) {
				echo json_encode(array('status' => 2));
				global $wpdb;
				echo $wpdb->print_error();
			} else {
				echo json_encode(array('status' => 1));
			}
		}
   endif;
  die();
}
// Teacher Calendar 
function ajax_teacher_list_event_request(){
	
	echo "abc";
	die();
	/*events: [
				{
					title: 'My Event',
					url:'yahoo.com',
					start: '2016-09-01'
				},						
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2016-09-28'
				}
			]*/
	
}
// ####### teaccher download area data population
function ajax_teacher_download_request(){
	// crate table
    global $wpdb;
    $table = $wpdb->prefix.'download_area';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		title  text NOT NULL,
		file text NOT NULL,
		category text NOT NULL,
		date text NOT NULL,
	    status int(2) NOT NULL,
		teacher_id mediumint(9) NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	global $wpdb;
	if(isset($_POST['category'])){
		if ( ! function_exists( 'wp_handle_upload' ) ) {
	    	require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}
		 $uploadedfile = $_FILES['file'];
		$file_name = $_FILES['file']['name'];
		$upload_overrides = array( 'test_form' => false );
		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		if ( $movefile && ! isset( $movefile['error'] ) ) {
			$title=sanitize_file_name( $file_name );
			$category=sanitize_text_field( $_POST['category'] );
			$teacher_id = $_SESSION['teacher'];
			global $wpdb;
			$wpdb->insert(
				$table,
				array(
					'title' => $title,
					'date' => date('y-m-d H:i:s'),
					'file' => $movefile['url'],
					'category' => $category,
					'status' =>  '',
					'teacher_id' => $teacher_id,
				)
			);
		$download = $wpdb->get_results( "SELECT * FROM $table WHERE `id` = '".$wpdb->insert_id."'");
			foreach ($download as $value) {	?>
				<li><a download="myimage" href="<?php echo $value->file ?>"><i class="fa fa-download"></i> <?php echo $value->title;?></a>  <span class="time"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($value->date)); ?></span> 

				<a href="javascript:void(0)" id="<?php echo $value->id; ?>" onclick="delete_this(this,'download_area')" class="del"><i class="fa fa-times"></i></a>

				 </li>
		<?php
			}
		} else {
		     echo "file_err";
		}
	}
die();
}
// function art gallery population
function ajax_teacher_gallery_request(){
//	print_r($_POST);
	global $wpdb;
	$table = $wpdb->prefix.'art_gallery';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		title  text NOT NULL,
		file text NOT NULL,
		category text NOT NULL,
		date text NOT NULL,
	    status int(2) NOT NULL,
	    is_home int(2) NOT NULL ,
		teacher_id mediumint(9) NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
// file upload
if(isset($_POST['category'])){
	if ( ! function_exists( 'wp_handle_upload' ) ) {
    	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	}
	 $uploadedfile = $_FILES['file'];
	$file_name = $_FILES['file']['name'];
	$upload_overrides = array( 'test_form' => false );
	$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
	if ( $movefile && ! isset( $movefile['error'] ) ) {
		    $title=sanitize_file_name($file_name);
			$category=sanitize_text_field($_POST['category']);
			$teacher_id = $_SESSION['teacher'];
			global $wpdb;
			$wpdb->insert(
					$table,
					array(
						'title' => $title,
						'date' => date('y-m-d H:i:s'),
						'file' => $movefile['url'],
						'category' => $category,
						'status' =>  '1',
						
						'teacher_id' => $teacher_id,
					)
				);
			$art = $wpdb->get_results( "SELECT * FROM $table WHERE `id` = '".$wpdb->insert_id."' ");
			foreach ($art as $value) {
			    	?>
		    	<li class="art_li">
		    		<img data-original="<?php echo $value->file ?>" src="<?php echo $value->file ?>" >
		    		<a download href="<?php echo $value->file ?>"><?php echo $value->title;?></a>
		    		<br>
		    	  	<span class="time"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($value->date)); ?></span>
		    	  	<?php if(isset($_SESSION['teacher'])): ?>
		    	  	|
		    	  	<span>Home? <input name="art_gal" <?php if($value->is_home == 1){echo 'checked="checked"';} ?> id="is_home<?= $value->id ?>" onclick="is_home_gallery('<?= $value->id ?>')" type="radio"></span>
					<p id="<?php echo $value->id; ?>" onclick="delete_this(this,'art_gallery')" class="del" type="button"><i class="fa fa-times"></i></p>
				<?php endif; ?>
					 </li>
		    	<?php
				}
	} else {

	     echo "file_error";
	}
}
die();
}
function ajax_teacher_newsletter_request(){
	// crate table
    global $wpdb;
	$table = $wpdb->prefix.'news_letter';

	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		title  text NOT NULL,
		file text NOT NULL,
		category text NOT NULL,
		date text NOT NULL,
	    status int(2) NOT NULL,
	    is_home int(2) NOT NULL,
		teacher_id mediumint(9) NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
// file upload
	if(isset($_POST['category'])){
		if ( ! function_exists( 'wp_handle_upload' ) ) {
	    	require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}
		$uploadedfile = $_FILES['file'];
		$upload_overrides = array( 'test_form' => false );
		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		if ( $movefile && ! isset( $movefile['error'] ) ) {
			$title=sanitize_text_field($_POST['title']);
				$category=sanitize_text_field($_POST['category']);
				$teacher_id = $_SESSION['teacher'];
				global $wpdb;
				$wpdb->insert(
						 $table,
						array(
							'title' => $title,
							'date' => date('y-m-d H:i:s'),
							'file' => $movefile['url'],
							'category' => $category,
							'status' =>  '1',
							'is_home' =>  $_POST['is_home'],
							'teacher_id' => $teacher_id,
						)
					);
			// return success values
			$news_letter = $wpdb->get_results( "SELECT * FROM $table WHERE `id` = '".$wpdb->insert_id."' ");
			foreach ($news_letter as $value) {
			    	?>
		    	<li><a download href="<?php echo $value->file ?>"><i class="fa fa-download"></i> <?php echo $value->title;?></a>  <span class="time"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($value->date)); ?></span> <button id="<?php echo $value->id; ?>" onclick="delete_this(this,'news_letter')" class="del" type="button"><i class="fa fa-times"></i></button> </li>
		    	<?php
				}
		} else {
		     echo "file_error";
		}
	}
die();
}
// delete request
function ajax_teacher_delete_request(){
	if(isset($_POST['id'])){
		global $wpdb;
		$table = $wpdb->prefix.$_POST['table'];
		$update = array("status" => "-1");
		$where = array('id' => $_POST['id'] );
		$updated = $wpdb->update( $table, $update, $where );

		echo '1';
	}
die();
}
function ajax_teacher_home_work_request(){

//	print_r($_POST);
	// crate table
    global $wpdb;
	$table = $wpdb->prefix.'home_work';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		title  text NOT NULL,
		file text NOT NULL,
		category text NOT NULL,
		date text NOT NULL,
	    status int(2) NOT NULL,
	    is_home int(2) NOT NULL,
		teacher_id mediumint(9) NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
// file upload
if(isset($_POST['category'])){
	if ( ! function_exists( 'wp_handle_upload' ) ) {
    	require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }

	 $uploadedfile = $_FILES['file'];

	$file_name = $_FILES['file']['name'];
	$upload_overrides = array( 'test_form' => false );

	$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

	if ( $movefile && ! isset( $movefile['error'] ) ) {
		$title=$file_name;
			$category=$_POST['category'];
			$teacher_id = $_SESSION['teacher'];
			global $wpdb;
			$wpdb->insert(
					 $table ,
					array(
						'title' => $title,
						'date' => date('y-m-d H:i:s'),
						'file' => $movefile['url'],
						'category' => $category,
						'status' =>  '1',
						'is_home' => $_POST['is_home'],
						'teacher_id' => $teacher_id,
					)
				);
			// return values
			$home_wrk = $wpdb->get_results( "SELECT * FROM $table WHERE `id` = '".$wpdb->insert_id."' ");

			    foreach ($home_wrk as $value) {
			    	?>
			    	<li><a download href="<?php echo $value->file ?>"><i class="fa fa-download"></i> <?php echo $value->title;?></a>  <span class="time"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($value->date)); ?></span> <button id="<?php echo $value->id; ?>" onclick="delete_this(this,'home_work')" class="del" type="button"><i class="fa fa-times"></i></button> </li>
			    	<?php
				}


	} else {
	    echo "file_error";
	}
}

die();
}

// function spelling words

function ajax_teacher_spelling_words_request(){

	// crate table
    global $wpdb;
    $table = $wpdb->prefix."spelling_words";
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		title  text NOT NULL,
		file text NOT NULL,
		category text NOT NULL,
		date text NOT NULL,
	    status int(2) NOT NULL,
	    is_home int(2) NOT NULL,
		teacher_id mediumint(9) NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

// file upload
if(isset($_POST['category'])){
//	print_r($_POST);

	if ( ! function_exists( 'wp_handle_upload' ) ) {
    	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	}

	 $uploadedfile = $_FILES['file'];

	// $file_name = $_FILES['file']['name'];
	$upload_overrides = array( 'test_form' => false );

	$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

	if ( $movefile && ! isset( $movefile['error'] ) ) {
		$title=$_POST['title'];
			$category=$_POST['category'];
			$teacher_id = $_SESSION['teacher'];
			global $wpdb;
			$wpdb->insert(
					$table,
					array(
						'title' => $title,
						'date' => date('y-m-d H:i:s'),
						'file' => $movefile['url'],
						'category' => $category,
						'status' =>  '1',
						'is_home' => $_POST['is_home'],
						'teacher_id' => $teacher_id,
					)
				);
			// return values
			$download = $wpdb->get_results( "SELECT * FROM $table WHERE `id` = '".$wpdb->insert_id."'  ");

			    foreach ($download as $value) {
			    	?>

			    <li>
			    <a download href="<?php echo $value->file ?>"><i class="fa fa-download"></i> <?php echo $value->title;?></a>  <span class="time"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($value->date)); ?></span> <button id="<?php echo $value->id; ?>" onclick="delete_this(this,'spelling_words')" class="del" type="button"><i class="fa fa-times"></i></button>
			    </li>

				<?php
				}

	} else {

	     echo "file_error";
	}
}

die();
}

//-----------------------------------------------------------
function ajax_bds_teacher_add_home_work(){
    extract($_POST);
    global $wpdb; 	
    $bds_homework_table = $wpdb->prefix.'bds_homework';	
    //echo "Table Name : ".$postmeta_table;
    //$event_date = date('y-m-d h:i:s');
    //$Current_date = date('y-m-d h:i:s');
    $add = $wpdb->insert($bds_homework_table, array(
            'class_id' => $bds_class,
            'session_id' => $session_id,
            'homework_title' => $home_work_title,
            'subject'=>$bds_subject,
            'date' => $bds_date,           
            'description' => $bds_description,
            'teacher_id'=> $teacher_id		
    ));
    if (false === $add) {
            echo json_encode(array('status' => 0));

            echo $wpdb->print_error();
    } else {
            echo json_encode(array('status' => 1));
    }
    
    die();
}
function ajax_bds_teacher_edit_home_work(){
    extract($_POST);
    global $wpdb; 	
    $bds_homework_table = $wpdb->prefix.'bds_homework';	
    //echo "Table Name : ".$postmeta_table;
    //$event_date = date('y-m-d h:i:s');
    //$Current_date = date('y-m-d h:i:s');
    $where = array('id' => $id);
    $update = $wpdb->update($bds_homework_table, array(
            'class_id' => $bds_class,
            'session_id' => $session_id,
            'homework_title' => $home_work_title,
            'subject'=>$bds_subject,
            'date' => $bds_date,           
            'description' => $bds_description,
            'teacher_id'=> $teacher_id		
    ),$where);
    if (false === $update) {
            echo json_encode(array('status' => 0));

            echo $wpdb->print_error();
    } else {
            echo json_encode(array('status' => 1));
    }
    
    die();
}
function ajax_bds_teacher_delete_home_work(){
    global $wpdb; 
    if(isset($_POST['id'])){
        $homework_table = $wpdb->prefix.'bds_homework';
        $sql = "DELETE FROM $homework_table WHERE id ='".$_POST['id']."'";
        $result= $wpdb->query($sql);	

        if (false === $result) {
                echo json_encode(array('data' => 0));
                echo $wpdb->print_error();
        } else {
                echo json_encode(array('data' => 1));
        } 
    }
    		
    die();
}




function ajax_bds_teacher_home_work_detail(){
    global $wpdb; 
    if(isset($_POST['id'])){
        $homework_id = $_POST['id'];
        $homework_table = $wpdb->prefix.'bds_homework';
        $class_table = $wpdb->prefix.'terms';
        $homework_detailss = $wpdb->get_row("SELECT * FROM $homework_table INNER JOIN $class_table ON $homework_table.class_id = $class_table.term_id WHERE $homework_table.id = '".$homework_id."'" );
        
        //$result= $wpdb->query($sql);	

        if (false === $homework_detailss) {
                echo wp_send_json(array('data' => 0));
                echo $wpdb->print_error();
        } else {
                wp_send_json($homework_detailss);
        } 
    }
    		
    die();
}
function ajax_teacher_add_home_work_request(){
	
		/*$sql = "DELETE FROM $table_postmeta WHERE id ='".$_POST['id']."'";
		$wpdb->query($sql);		
		echo json_encode(array('data'=>'1'));*/	
		extract($_POST);
			
	global $wpdb; 	
	$postmeta_table = $wpdb->prefix.'home_work';	
	//echo "Table Name : ".$postmeta_table;
	//$event_date = date('y-m-d h:i:s');
	//$Current_date = date('y-m-d h:i:s');
	$wpdb->insert($postmeta_table, array(
		'title' => $title,
		'status' => '1',
		'file'=>'',
		'date' => $event_date,
		'category' => $category,
		'description' => $description,
		'teacher_id'=> $teacher_id,
		'is_home'=>'0'		
	));	
	
	
	$sql="SELECT * FROM $postmeta_table WHERE id = '".$wpdb->insert_id."'";
	//echo $sql;
	$event_postmeta = $wpdb->get_results($sql);
	foreach ($event_postmeta as  $item) {		
		?>
		<tr>
			<td><?=$item->title; ?></td>
			<td><?=$item->date; ?></td>
			<!--<td><php echo $item->price; ?></td>-->
			<!--<td><php echo ($item->is_calender_e == "1")? 'Calender': '...'; ?></td>-->
			<td><?=$item->description; ?></td>
			<td>
				<button class="del_homework" type="button"><i class="fa fa-times"></i></button>
			</td>
		</tr>
		<?php
	
	}
	//echo "Post Id : ".$post_id;
	die();
}
//   edit event
function ajax_teacher_edit_home_work_request(){
	// print_r($_POST);	
	extract($_POST);
	global $wpdb;
	$post_table = $wpdb->prefix.'home_work';	
	$Current_date = date('y-m-d h:i:s');


	  $update_post = array(
		'title' => $title,
		'date' => $event_date,
		'category' => $category,
		'description' => $description
	);
	$where = array('id' => $id);

	$updated = $wpdb->update( $post_table, $update_post, $where );

	//if(false=== $updated){
//		echo json_encode(array('data'=>'err'));
//	}else {
		echo json_encode(array('data'=>'1'));		
//	}
	die();
}
// function delete event
function ajax_teacher_delete_home_work_request(){
	
	if(isset($_POST['id'])){
		global $wpdb;
		$table_postmeta = $wpdb->prefix.'home_work';
		$sql = "DELETE FROM $table_postmeta WHERE id ='".$_POST['id']."'";
		$wpdb->query($sql);		
		echo json_encode(array('data'=>'1'));
	}
die();
}
//-------------------------------------------------------------

function ajax_teacher_add_event_request(){
	//print_r($_POST);
	extract($_POST);
	global $wpdb; 
	
	$post_table = $wpdb->prefix.'posts';
	$postmeta_table = $wpdb->prefix.'postmeta';
	//echo "Table Name : ".$post_table;
	//$event_date = date('y-m-d h:i:s');
	$Current_date = date('y-m-d h:i:s');
	$wpdb->insert('wp_dkf3k12nf1_posts', array(
		'post_author' => 1,
		'post_date' => $event_date,
		'post_date_gmt' => $Current_date,
		'post_content' => $description,
		'post_title' => $title,
		'post_excerpt' => $category,
		'post_status' => 'publish',
		'comment_status' => 'close',
		'ping_status' => 'open',
		'post_password' => '',
		'post_name' => $_SESSION['teacher'],
		'to_ping' => '',
		'pinged' => '',
		'post_modified' => $Current_date,
		'post_modified_gmt' => $Current_date,
		'post_content_filtered' => '',
		'post_parent' => 0,
		'guid' => 'http://brs.noceky.com/?page_id=',
		'menu_order' => 0,
		'post_type' => 'calp_event',
		'post_mime_type' => $is_home,
		'comment_count' => 0
	));
	$post_id =  $wpdb->insert_id;
	
	
	if($post_id>0){
	$event_info = array(
		'title' => $title,
		'price' => $price,
		'event_date' => $event_date,
		'category' => $category,
		'description' => $description,
		'is_calender_e' => $is_calender_e
	);
	//global $wpdb;
	$wpdb->insert($postmeta_table, array(
		'post_id' => $post_id,
		'meta_key' => $category,
		'meta_value' => json_encode($event_info)
	));

	$event_postmeta = $wpdb->get_results( "SELECT * FROM $postmeta_table WHERE `meta_key` = '".$category."' AND `meta_id` = '".$wpdb->insert_id."'");
	foreach ($event_postmeta as  $value) {

		$item = json_decode($value->meta_value);
		?>
		<tr>
			<td><php echo $item->title; ?></td>
			<td><php echo $item->event_date; ?></td>
			<td><php echo $item->price; ?></td>
			<td><php echo ($item->is_calender_e == "1")? 'Calender': '...'; ?></td>
			<td><php echo $item->description; ?></td>
			<td>
				<button class="del_event" type="button"><i class="fa fa-times"></i></button>
			</td>
		</tr>
		<?php
	}
	}
	//echo "Post Id : ".$post_id;
	die();
}

//   edit event
function ajax_teacher_edit_event_request(){
	// print_r($_POST);
	extract($_POST);
	global $wpdb;
	$post_table = $wpdb->prefix.'posts';
	$postmeta_table = $wpdb->prefix.'postmeta';
	$Current_date = date('y-m-d h:i:s');


	  $update_post = array(
		'post_author' => 1,
		'post_date' => $event_date,
		'post_date_gmt' => $Current_date,
		'post_content' => $description,
		'post_title' => $title,
		'post_excerpt' => $category,
		'post_status' => 'publish',
		'comment_status' => 'close',
		'ping_status' => 'open',
		'post_password' => '',
		'post_name' => $_SESSION['teacher'],
		'to_ping' => '',
		'pinged' => '',
		'post_modified' => $Current_date,
		'post_modified_gmt' => $Current_date,
		'post_content_filtered' => '',
		'post_parent' => 0,
		'guid' => '',
		'menu_order' => 0,
		'post_type' => ($is_calender_e == "1")? 'calp_event': 'event',
		'post_mime_type' => $is_home,
		'comment_count' => 0
	);

	$where = array('id' => $id);

	$updated = $wpdb->update( $post_table, $update_post, $where );

	if(false=== $updated){
		echo json_encode(array('data'=>'err'));
	}else {

		$event_info = array(
			'title' => $title,
			'price' => $price,
			'event_date' => $event_date,
			'category' => $category,
			'description' => $description,
			'is_calender_e' => $is_calender_e
		);
		global $wpdb;
		$update_postmeta = array(

			'meta_key' => $category,
			'meta_value' => json_encode($event_info)
		);
		$where = array('post_id' => $id);
		$updated = $wpdb->update( $postmeta_table, $update_postmeta, $where );

		if(false === $updated){
			echo json_encode(array('data'=>'err'));
		}else{
			echo json_encode(array('data'=>'1'));
		}
	}
	die();
}

// function delete event

function ajax_teacher_delete_event_request(){

	if(isset($_POST['id'])){
		global $wpdb;
		$table_postmeta = $wpdb->prefix.'postmeta';
		$table_posts = $wpdb->prefix.'posts';

		$sql = "DELETE FROM $table_posts WHERE ID ='".$_POST['id']."'";
		$wpdb->query($sql);

		$wpdb->query("DELETE FROM $table_postmeta WHERE `post_id` ='".$_POST['id']."'");

		echo json_encode(array('data'=>'1'));
	}
die();
}

function ajax_parent_edit_child_request(){
//	 print_r($_POST);
        global $wpdb;

        extract($_POST);
        // error array initialization
        $error = array();

        if(empty($name)){
            $error[] = "Name required.";
        }
        if(empty($stu_no)){
            $error[] = "Student no required.";
        }
//
        if(empty($phone)){
            $error[] = "Phone required.";
        }
        if(empty($address)){
            $error[] = "Address required.";
        }
        if(empty($email)){
            $error[] = "Email required.";
        }else{
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error[] = "Invalid email format.";
            }
        }

        if(count($error) > 0){
            foreach ($error as $value) {
                echo $value."\r\n";
            }
        }
        else{

			if(!empty($_POST['caption'])) {
				if (!function_exists('wp_handle_upload')) {
					require_once(ABSPATH . 'wp-admin/includes/file.php');
				}
				$uploadedfile = $_FILES['file'];
				$upload_overrides = array('test_form' => false);
				$movefile = wp_handle_upload($uploadedfile, $upload_overrides);
			}

			$update =  array(
				'full_name'   => $name,
				'student_no'  => $stu_no,
				'email'   	  => $email,
				'phone'   	  => $phone,
				'address' 	  => $address,
				'gender'  	  => $gender,
				'dob'         => $dob,
				'status'      => '1'
			);

			if(!empty( $_POST['caption'] )){
				$add_file = array('file' => $movefile['url']);

				$update = $update+$add_file;
			}

			global $wpdb;
			$table_student = $wpdb->prefix.'student';
	        $where = array('id' => $id);

	        $updated = $wpdb->update( $table_student, $update, $where );

            if($updated){
                echo json_encode( array('data' => "1") );
            }else{
				echo json_encode( array('data' => "err") );
            }
        }
die();
}

## add family
function ajax_parent_add_family_request()
{
//	print_r($_POST);
	global $wpdb;
	extract($_POST);

	// error array initialization
	$error = array();

	if (empty($name)) {
		$error[] = "Name required.";
	}
//
	if (empty($phone)) {
		$error[] = "Phone required.";
	}
	if (empty($address)) {
		$error[] = "Address required.";
	}
	if (empty($password)) {
		$error[] = "Password required.";
	} else {
		if (strlen($password) < 6) {
			$error[] = 'password must be greater than 6 characters';
		}
	}
	if (empty($relation)) {
		$error[] = "Relation required.";
	}
	if (empty($email)) {
		$error[] = "Email required.";
	} else {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error[] = "Invalid email format.";
		}
	}

	if (count($error) > 0) {
		foreach ($error as $value) {
			echo $value . "\r\n";
		}
	} else {
		if (!function_exists('wp_handle_upload')) {
			require_once(ABSPATH . 'wp-admin/includes/file.php');
		}
		$uploadedfile = $_FILES['file'];
		$upload_overrides = array('test_form' => false);
		$movefile = wp_handle_upload($uploadedfile, $upload_overrides);

		if(isset($_SESSION['parent'])){
			$teacher_id = $_SESSION['teacher_id'];
		}elseif(isset($_SESSION['teacher'])){
			$teacher_id = $_SESSION['teacher'];
		}
			$insert = array(
				'full_name' => $name,
				'relation' => $relation,
				'email' => $email,
				'phone' => $phone,
				'address' => $address,
				'gender' => $gender,
				'password' => $password,
				'md5_password' => md5($password),
				'status' => '2',
				'teacher_id' => $teacher_id,
			);

		if(!empty($_POST['caption'])){
			$img = array('file' => $movefile['url']);
			$insert = $insert + $img;
		}
			
			//send email
			//   send email
			    add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

			    $to = $result->email;
			    $subject = 'Invitation';
			    $body = 'invitation  from $name login criteria lonk: http://brs.noceky.com/login/  username: $email, password: $password';

			    wp_mail( $to, $subject, $body );

			// Reset content-type to avoid conflicts -- https://core.trac.wordpress.org/ticket/23578
			    remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

			    function wpdocs_set_html_mail_content_type() {
			        return 'text/html';
			    }
//			print_r($insert);

			global $wpdb;
			$table_parent = $wpdb->prefix.'parent';
			$insert = $wpdb->insert($table_parent, $insert);
			$parent_id = $wpdb->insert_id;
			$parent_child = $wpdb->prefix.'parent_child';
			// get childs of this parent
//			$student_table = $wpdb->prefix.'student';

		if(empty($id)){
			$pid = $_SESSION['parent'];
		}else{
			$pid = $id;
		}
			global $wpdb;
		    $sql =  "SELECT child_id  FROM $parent_child WHERE `parent_id` = '".$pid."' ";
		    $result = $wpdb->get_results($sql);
		    foreach ($result as  $value) { 
				$ins = array(
					'parent_id' => $parent_id,
					'child_id' => $value->child_id,
					'class' => $_SESSION['teacher_grade'],
					'session' => $_SESSION['teacher_session'],
					'status' => '1'
				);
				$wpdb->insert($parent_child,$ins);
		}
			if (false === $insert) {
				echo json_encode(array('data' => "err"));
			} else {
				echo json_encode(array('data' => "1"));
			}

	}
	die();
}

function ajax_teacher_get_roster_by_id_request(){

	global $wpdb;
    $table_posts = $wpdb->prefix.'posts';
    $roster_posts = $wpdb->get_results( "SELECT `ID` FROM $table_posts WHERE `post_excerpt` = '".$_POST['session']."'");


if(!$roster_posts){
        echo '<tr>
        	<td class="t-center error" colspan="7">Record Not Found!</td>
        </tr>';
    }


    $table_postmeta = $wpdb->prefix.'postmeta';
$total = 0;
    foreach ($roster_posts as $item) {$total++;

	    $roster = $wpdb->get_results( "SELECT * FROM $table_postmeta WHERE `post_id` = '".$item->ID."' ");

	                foreach ($roster as  $value) {

	                    $item = json_decode($value->meta_value);
	    ?>
	       <tr>
	        <td><?php echo $item->student_no ?></td>
	        <td><img src="<?php echo $item->image_url ?>" width="50px"><span> <?php echo ucfirst( $item->name ); ?></span></td>
	        <td><?php echo $item->email ?></td>
	        <td><?php echo $item->phone ?></td>
	        <td><?php echo ucfirst( $item->grade ); ?></td>

	        <td><button>Click Here</button></td>
	        <td class="td_mng">
	            <li><i class="fa fa-pencil"></i> Edit</li>
	            <li><i class="fa fa-trash-o"></i> Delete</li>
	        </td>

	      </tr>
	<?php
	   }

	}
echo '<tr>
        	<td colspan="7"> '.$total.' Total Roster Members</td>
        </tr>';
die();
}

function ajax_login_action(){
	if(isset($_POST['login'])){
        extract($_POST);
        if(!empty($username) && !empty($password) && $type != "0"){

            global $wpdb;
            $table_teacher = $wpdb->prefix.'teacher';
            $table_student = $wpdb->prefix.'student';
            $table_parent = $wpdb->prefix.'parent';
            if($type == "teacher"){
                $qery ="SELECT * FROM $table_teacher WHERE `email` = '". sanitize_email($username) ."' AND `md5_password` = '".md5($password)."' AND `status` = '2'  limit 1";
                $result = $wpdb->get_results( $qery );

                if($result) {
                    $_SESSION['teacher'] = $result[0]->id;
					$_SESSION['teacher_name'] = $result[0]->full_name;
					$_SESSION['teacher_grade'] = $result[0]->class_name;
					$_SESSION['teacher_session'] = $result[0]->session;					
                    $result = array('data'=>'teacher');
                    echo json_encode($result);
                }else{
                    echo json_encode(array('data'=>'err'));
                }
            }
            if($type == "parent"){
                $qery ="SELECT * FROM $table_parent WHERE `email` = '". sanitize_email($username) ."' AND `md5_password` = '".md5($password)."'  limit 1";
                $row = $wpdb->get_results( $qery );
                if($row) {
                    $qery ="SELECT full_name, class_name,session FROM $table_teacher WHERE  id = '".$row[0]->teacher_id."'  limit 1";			
                    $result = $wpdb->get_results( $qery );

                    $_SESSION['teacher_name'] = $result[0]->full_name;
                    $_SESSION['teacher_grade'] = $result[0]->class_name;
                    $_SESSION['teacher_session'] = $result[0]->session;
                    $_SESSION['teacher_id'] = $row[0]->teacher_id;
                    $_SESSION['parent'] = $row[0]->id;
                    $_SESSION['parent_name'] = $row[0]->full_name;
					
                    $result = array('data'=>'parent');
                    echo json_encode($result);
                }else{
                    echo json_encode(array('data'=>'err'));
                }
            }
            if($type == "student"){
                $qery ="SELECT * FROM $table_student WHERE `email` = '". sanitize_email($username) ."' AND `md5_password` = '".md5($password)."'  limit 1";
                $row = $wpdb->get_results( $qery );
                if($row) {
                    $_SESSION['student'] = $row[0]->id;
                    $result = array('data'=>'student');
                    echo json_encode($result);
                }else{
                    echo json_encode(array('data'=>'err'));
                }
            }
        }
    }
die(); 
}

##########################
#####Parent Register######
##########################

function ajax_parent_register(){
    if(isset($_POST['submit'])){
        global $wpdb;
        extract($_POST);
        $error = array();
        
        if(empty($p_name)){
            $error[] = "name required.";
        }
        if(empty($phone)){
            $error[] = "Phone required.";
        }
        if(empty($address)){
            $error[] = "Phone required.";
        }
        if(empty($email)){
            $error[] = "Email required.";
        }else{
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error[] = "Invalid email format.";
            }
        }
        if(strlen($password) < 6){
            $error[] = "Password must be at least 6 char.";
        }
        if(count($error) > 0){
            foreach ($error as $value) {
                echo $value."\n\r";
            }
        }
        else{
           $parent_data = array(
                    'full_name' => $p_name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'password' => $password,
                    'md5_password' => md5($password),                   
                    'status' => '2'
            );
            global $wpdb;
            $table = $wpdb->prefix . 'parent';
            $where = array('id' => $_POST['id']);
            $updated = $wpdb->update($table, $parent_data, $where);
            if ($updated === false) {
                echo json_encode(array('status' => 2));
                global $wpdb;
                echo $wpdb->print_error();
            } else {
                echo json_encode(array('status' => 1));
            }        
        }      
    }
    
    wp_die();
}


#################################
####  parent registration #######
#################################

//function ajax_parent_register_request(){
//
//	if(isset($_POST['submit'])):
//        global $wpdb;
//
//        extract($_POST);
//        // error array initialization
//        $error = array();
//
//        if(empty($name)){
//            $error[] = "name required.";
//        }
//        if(empty($phone)){
//            $error[] = "Phone required.";
//        }
//        if(empty($address)){
//            $error[] = "Address required.";
//        }
//        if(empty($email)){
//            $error[] = "Email required.";
//        }else{
//            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//                $error[] = "Invalid email format.";
//            }
//        }
//        if(strlen($password) < 6){
//            $error[] = "Password must be at lest 6 char.";
//        }
//        if(count($error) > 0){
//
//            foreach ($error as $value) {
//                echo $value."\n\r";
//            }
//
//        }else{
//        	$post_table = $wpdb->prefix."posts";
//        	$postmeta_table = $wpdb->prefix."postmeta";
//        	// insert data to post\
//        	global $wpdb;
//        	$wpdb->insert($post_table, array(
//	        	'post_author' => 1,
//				'post_date' => date('y-m-d h:i:s'),
//				'post_date_gmt' => date('y-m-d h:i:s'),
//				'post_content' => md5($password),
//				'post_title' => $email,
//				'post_excerpt' => '',
//				'post_status' => 'publish',
//				'comment_status' => 'open',
//				'ping_status' => 'open',
//				'post_password' => '',
//				'post_name' => '',
//				'to_ping' => '',
//				'pinged' => '',
//				'post_modified' => date('y-m-d h:i:s'),
//				'post_modified_gmt' => date('y-m-d h:i:s'),
//				'post_content_filtered' => '',
//				'post_parent' => 0,
//				'guid' => '',
//				'menu_order' => 0,
//				'post_type' => 'parent',
//				'post_mime_type' => '',
//				'comment_count' => 0
//			));
//        	//get post id
//			$post_id = $wpdb->insert_id;
//			// insert data to post-meta
//
//			$teacher_info = array(
//				'name' => $name,
//				'email' => $email,
//				'phone' => $phone,
//				'address' => $address
//			);
//			global $wpdb;
//            $wpdb->insert($postmeta_table, array(
//                'post_id' => $post_id,
//                'meta_key' => 'parent_info',
//                'meta_value' => json_encode($teacher_info)
//            ));
//            echo "1";
//        }
//
//    endif;
//die();
//}

function ajax_invite_teacher(){
    // create table
    global $wpdb;
    $table = $wpdb->prefix.'teacher';
    $qery =" SELECT `id`, `full_name`, `email` FROM $table WHERE `id` = '". $_POST['id'] ."'  AND  status = '0'   limit 1";
    $result = $wpdb->get_results( $qery );
    $result = $result[0];
    //print_r($result);
    //$href = 'http://brs.noceky.com/teacher-registration/?full_name='.str_replace("=", "", base64_encode($result->full_name.'')).'&email='. str_replace( "=","", base64_encode($result->email) ).'&user='.str_replace("=", "", base64_encode( $result->id ) ).'';
    $href = site_url().'/teacher-registration/?full_name='.str_replace("=", "", base64_encode($result->full_name.'')).'&email='. str_replace( "=","", base64_encode($result->email) ).'&user='.str_replace("=", "", base64_encode( $result->id ) ).'';
    //send email
    add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

    $to = $result->email;
    $subject = 'Teacher Registration Invitation';
    $body = 'Please click the link to accept invitation' .  $href;

    wp_mail( $to, $subject, $body );

    // Reset content-type to avoid conflicts -- https://core.trac.wordpress.org/ticket/23578
    remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

    function wpdocs_set_html_mail_content_type() {
        return 'text/html';
    }
    // updating link
    global $wpdb;
    $link = array('link' => $href,'status'=>'1');
    $where = array('id' => $result->id);
    $updated = $wpdb->update( $table, $link, $where );
    if($updated){
        echo json_encode(array('status'=>'1', 'link'=>$href));
    }
die();
}
// reinvite teacher
function ajax_reinvite_teacher(){
    // crate table

    global $wpdb;
    $table = $wpdb->prefix.'teacher';
    $qery =" SELECT `id`, `full_name`, `email` FROM $table WHERE `id` = '". $_POST['id'] ."'  AND  status = '1'   limit 1";
    $result = $wpdb->get_results( $qery );
    $result = $result[0];
//print_r($result);
    $href = 'http://brs.noceky.com/teacher-registration/?full_name='.str_replace("=", "", base64_encode($result->full_name.'')).'&email='. str_replace( "=","", base64_encode($result->email) ).'&user='.str_replace("=", "", base64_encode( $result->id ) ).'';
//   send email
    add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

    $to = $result->email;
    $subject = 'Invitation';
	$body = 'Please click the link to accept invitation' .  $href;

    wp_mail( $to, $subject, $body );

// Reset content-type to avoid conflicts -- https://core.trac.wordpress.org/ticket/23578
    remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

    function wpdocs_set_html_mail_content_type() {
        return 'text/html';
    }
    // updating link
    global $wpdb;
    $link = array('link' => $href,'status'=>'3');
    $where = array('id' => $result->id);
    $updated = $wpdb->update( $table, $link, $where );
    if($updated){
        echo json_encode(array('status'=>'3'));
    }


    die();
}

function ajax_add_parent_request(){

	// create student table table
	// print_r($_POST);
	global $wp_session;
	global $wpdb;
    $table_student = $wpdb->prefix.'student';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table_student (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		teacher_id mediumint(9) NOT NULL,
		parent_id mediumint(9) NOT NULL,
		student_no varchar(9) NOT NULL,
		full_name  varchar(150) NOT NULL,
		email varchar(150) NOT NULL,
		email_2 varchar(150) NOT NULL,
		password varchar(250) NOT NULL,
		md5_password varchar(250) NOT NULL,
		gender varchar(20) NOT NULL,
		phone varchar(30) NOT NULL,
		phone_2 varchar(30) NOT NULL,
		phone_label_1 varchar(150) NOT NULL ,
		phone_label_2 varchar(150) NOT NULL ,
		address text NOT NULL,
		grade varchar(150) NOT NULL,
		email_lables_1 varchar(100) NOT NULL,
		email_lables_2 varchar(100) NOT NULL,
		file text NOT NULL,
		date text NOT NULL,
		link text NOT NULL,
		movie varchar(250) NOT NULL ,
		hero varchar(250) NOT NULL ,
		sport varchar(250) NOT NULL ,
		dob varchar(50) NOT NULL,
	    status int(2) NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	//  create parent table
	global $wpdb;
	$table_parent = $wpdb->prefix.'parent';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table_parent (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		teacher_id mediumint(9) NOT NULL,
		full_name  varchar(150) NOT NULL,
		relation  varchar(150) NOT NULL,
		email varchar(150) NOT NULL,
		email_2 varchar(150) NOT NULL,
		password varchar(250) NOT NULL,
		md5_password varchar(250) NOT NULL,
		gender varchar(20) NOT NULL,
		phone varchar(30) NOT NULL,
		phone_2 varchar(30) NOT NULL,
		phone_label_1 varchar(150) NOT NULL ,
		phone_label_2 varchar(150) NOT NULL ,
		address text NOT NULL,
		email_lables_1 varchar(100) NOT NULL,
		email_lables_2 varchar(100) NOT NULL,
		file text NOT NULL,
		date text NOT NULL,
		link text NOT NULL,
	    status int(2) NOT NULL,
	    family_ref mediumint(9) NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

// create parent_child table
	global $wpdb;
	$table_parent_child = $wpdb->prefix.'parent_child';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table_parent_child (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		parent_id mediumint(9) NOT NULL,
		child_id  mediumint(9) NOT NULL,
		class  varchar(150) NOT NULL,
		session varchar(150) NOT NULL,	
		status int(2) NOT NULL,	
		UNIQUE KEY id (id)
		) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );


	//  insert data into parent table
	global $wpdb;

	$add_parent =  array(
		'teacher_id' => $_SESSION['teacher'],
                'full_name' => $_POST['parent_name'],
                'relation' => $_POST['p_relation'],
		'email' => $_POST['email'],
		'email_2' => $_POST['email2'],
		'phone' => $_POST['phone'],
		'phone_2' => $_POST['phone2'],
		'phone_label_1' => $_POST['phone_label'],
		'phone_label_2' => $_POST['phone_label2'],
                'email_lables_1' => $_POST['relation'],
                'email_lables_2' => $_POST['relation2'],
		'date' => date('y-m-d h:i:s'),
		'status' => '0'
	);

	// print_r($add_parent);

	$add_parent =  $wpdb->insert($table_parent, $add_parent);



	$parent_id = $wpdb->insert_id;
	if(false=== $add_parent ){
		echo json_encode(array('data' => '2' ));
	}else {

		global $wpdb;
		$wpdb->insert($table_student, array(
			'teacher_id' => $_SESSION['teacher'],
			'parent_id' => $parent_id,
			'full_name' => $_POST['name'],
			'student_no' => $_POST['stu_no'],
			'email' => $_POST['email'],
			'email_2' => $_POST['email2'],
			'phone' => $_POST['phone'],
			'phone_2' => $_POST['phone2'],
			'phone_label_1' => $_POST['phone_label'],
			'phone_label_2' => $_POST['phone_label2'],
			'email_lables_1' => $_POST['relation'],
			'email_lables_2' => $_POST['relation2'],
			'date' => date('y-m-d h:i:s'),
			'status' => '0'
		));
		$child_id = $wpdb->insert_id;
$arr = array(
			'parent_id' => $parent_id,
			'child_id' => $child_id,
			'class' => $_SESSION['teacher_grade'],
			'session' => $_SESSION['teacher_session'],			
			'status' => '1'
		);
		// print_r($arr);

		global $wpdb;
		$wpdb->insert($table_parent_child, array(
			'parent_id' => $parent_id,
			'child_id' => $child_id,
			'class' => $_SESSION['teacher_grade'],
			'session' => $_SESSION['teacher_session'],			
			'status' => '1'
		));
                
                //Sending Parent registration Link Via Email    
                $href = site_url().'/teacher-registration/?full_name='.str_replace("=", "", base64_encode($result->full_name.'')).'&email='. 
                str_replace( "=","", base64_encode($result->email) ).'&user='.str_replace("=", "", base64_encode( $result->id ) ).'';
                //send email
                add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

                $to = $_POST['email'];
                $subject = 'Parent Registration Invitation';
                $body = 'Please click the link to accept invitation' .  $href;

                wp_mail( $to, $subject, $body );    
                // Reset content-type to avoid conflicts -- https://core.trac.wordpress.org/ticket/23578
                remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );    

		echo json_encode(array('data' => '1' ));
	}
//			echo json_encode(array('href' => $href ));
	######
die();
}

function ajax_delete_teacher(){
    extract($_POST);

    global $wpdb;
    $table = $wpdb->prefix.'teacher';
    $status = array('status' => '-1');
    $where = array('id' => $id);
    $updated = $wpdb->update( $table, $status, $where );

        echo json_encode(array('status' => '1'));

die();
}
function ajax_teacher_profile_update_request(){
//print_r($_POST);
    if(isset($_POST['submit'])):
        extract($_POST);
        // error array initialization
        $error = array();
        if(empty($name)){
            $error[] = "Name required.";
        }
        if(empty($phone)){
            $error[] = "Phone required.";
        }
        if(empty($address)){
            $error[] = "Address required.";
        }
        if(empty($email)){
            $error[] = "Email required.";
        }
        if($class_name == '0'){
            $error[] = "Class name required.";
        }
        if(session == '0'){
            $error[] = "Session required.";
        }
        if($school_type == '0'){
            $error[] = "School type required.";
        }
        if(empty($password)){
            $error[] = "Password required.";
        }
        if(strlen($password) < 6){
            $error[] = "Password must be at lest 6 char.";
        }
        if(count($error) > 0){
            foreach ($error as $value) {
                echo $value."\n\r";
            }
        }else{

			if(!empty($_POST['caption'])) {
				if (!function_exists('wp_handle_upload')) {
					require_once(ABSPATH . 'wp-admin/includes/file.php');
				}
				$uploadedfile = $_FILES['file'];
				$upload_overrides = array('test_form' => false);
				$movefile = wp_handle_upload($uploadedfile, $upload_overrides);
			}



                $teacher_data = array(
                    'full_name' => $name,
                    'email' => $email,
                    'teacher_no' => $stu_no,
                    'phone' => $phone,
					'position' => $position,
					'class_name' => $class_name,
					'school_type' => $school_type,
					'session' => $session,
                    'address' => $address,
                    'password' => $password,
                    'md5_password' => md5($password),
                    'gender' => $gender,
					'dob' => $dob,
                    'status' => '2',
                );

			if(!empty( $_POST['caption'] )){
				$add_file = array('file' => $movefile['url']);

				$teacher_data = $teacher_data+$add_file;
			}


                global $wpdb;
                $table = $wpdb->prefix.'teacher';
                $where = array('id' => $_SESSION['teacher']);
                $updated = $wpdb->update( $table, $teacher_data, $where );
                if ( false === $updated ) {
                    echo json_encode(array('data' => '2'));
                    global $wpdb;
                    echo $wpdb->print_error();
                } else {
                    echo json_encode(array('data' => '1'));
                }

        }
    endif;
    die();
}

function ajax_invite_parent_request(){
    // crate table
//print_r($_POST);
    global $wpdb;
    $table = $wpdb->prefix.'parent';
    $qery =" SELECT `id`, `full_name`, `email` FROM $table WHERE `id` = '". $_POST['id'] ."'  AND  status = '0'   limit 1";
    $result = $wpdb->get_results($qery );
    $result = $result[0];


    $href = site_url().'/parent-registration/?full_name='.str_replace("=", "", base64_encode($result->full_name.'')).'&email='. str_replace( "=","", base64_encode($result->email) ).'&user='.str_replace("=", "", base64_encode( $result->id ) ).'';
//   send email
    add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

    $to = $result->email;
    $subject = 'Parent Sign Up Invitation';
	$body = 'Please click the link to accept invitation <br/>' .  $href;

    wp_mail( $to, $subject, $body );

// Reset content-type to avoid conflicts -- https://core.trac.wordpress.org/ticket/23578
    remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

    function wpdocs_set_html_mail_content_type() {
        return 'text/html';
    }
    // updating link
    global $wpdb;
    $link = array('link' => $href,'status'=>'1');
    $where = array('id' => $result->id);
    $updated = $wpdb->update( $table, $link, $where );
    if(false===$updated){
        echo json_encode(array('data'=>'0'));
    }else{
		echo json_encode(array('status'=>'1', 'link'=>$href));
	}
    die();
}
function ajax_reinvite_parent_request(){
    // crate table
//print_r($_POST);
    global $wpdb;
    $table = $wpdb->prefix.'parent';
    $qery =" SELECT `id`, `full_name`, `email` FROM $table WHERE `id` = '". $_POST['id'] ."'  AND  status = '1'   limit 1";
    $result = $wpdb->get_results( $qery );
    $result = $result[0];
//print_r($result);
    $href = 'http://brs.noceky.com/roster/?full_name='.str_replace("=", "", base64_encode($result->full_name.'')).'&email='. str_replace( "=","", base64_encode($result->email) ).'&user='.str_replace("=", "", base64_encode( $result->id ) ).'';
//   send email
    add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

    $to = $result->email;
    $subject = 'Invitation';
	$body = 'Please click the link to accept invitation' .  $href;

    wp_mail( $to, $subject, $body );

// Reset content-type to avoid conflicts -- https://core.trac.wordpress.org/ticket/23578
    remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

    function wpdocs_set_html_mail_content_type() {
        return 'text/html';
    }
    // updating link
    global $wpdb;
    $link = array('link' => $href,'status'=>'1');
    $where = array('id' => $result->id);
    $updated = $wpdb->update( $table, $link, $where );
    if(false===$updated){
        echo json_encode(array('status'=>'0'));
    }else{
		echo json_encode(array('status'=>'3'));
	}
    die();
}

function ajax_delete_parent_request(){
    extract($_POST);

    global $wpdb;
    $table = $wpdb->prefix.'parent';
    $status = array('status' => '-1');
    $where = array('id' => $id);
    $updated = $wpdb->update( $table, $status, $where );

    echo json_encode(array('status' => '1'));

    die();
}

function ajax_parent_delete_child_request(){

    extract($_POST);

    global $wpdb;
    $table = $wpdb->prefix.'student';
    $status = array('status' => '-1');
    $where = array('id' => $id);
    $updated = $wpdb->update( $table, $status, $where );

	if(false === $updated){
		echo json_encode(array('status' => 'err'));
	}else{
		echo json_encode(array('status' => '1'));
	}



die();
}

function ajax_parent_edit_profile_request(){
//	 print_r($_POST);
   extract($_POST);
        // error array initialization
    $error = array();
    if(empty($name)){
        $error[] = "Name required.";
    }
    if(empty($phone)){
        $error[] = "Phone required.";
    }
    if(empty($relation)){
        $error[] = "Relation required.";
    }
	if(empty($address)){
		$error[] = "Address required.";
	}
	

        if(count($error) > 0){
            foreach ($error as $value) {
                echo $value."\n\r";
            }
        }else{

			if(!empty($_POST['caption'])) {

				if (!function_exists('wp_handle_upload')) {
					require_once(ABSPATH . 'wp-admin/includes/file.php');
				}
				$uploadedfile = $_FILES['file'];
				$upload_overrides = array('test_form' => false);
				$movefile = wp_handle_upload($uploadedfile, $upload_overrides);
			}

                $teacher_data = array(
                    'full_name' => $name,
                    'relation' => strtolower($relation),
                    'phone' => $phone,
                    'phone_label_1' => $phone_label,
                    'phone_2' => $phone,
                    'phone_label_2' => $phone_label,
                    'address' => $address,
                    'gender' => $gender,
                    'email' => $email,
                    'email_lables_1' => $relation1,
                    'email_2' =>$email2,
                    'email_lables_2' => $relation2,
                );
// print_r($teacher_data);
			if(!empty($_POST['caption'])){
				$add_file = array('file' => $movefile['url']);
				$teacher_data = $teacher_data + $add_file;
			}
			if(!empty($_POST['password'])){
				$teacher_data = $teacher_data + array('password' => $password, "md5_password" => md5($password));
			}

                global $wpdb;
                $table = $wpdb->prefix.'parent';
                $where = array('id' => $id);
                $updated = $wpdb->update( $table, $teacher_data, $where );
                if ( false === $updated ) {
                    echo json_encode(array('status'=>2));

                } else {
                    echo json_encode(array('status'=>1));
                }
            }



die();
}

function ajax_teacher_dell_nonroster_request(){
    extract($_POST);
    global $wpdb;
    $table = $wpdb->prefix.'teacher';
    $status = array('status' => '-1');
    $where = array('id' => $id);
    $updated = $wpdb->update( $table, $status, $where );
    echo json_encode(array('status' => '1'));
die();
}

function ajax_add_activity_request(){
	print_r($_POST);
	extract($_POST);
	global $wpdb;
	$table = $wpdb->prefix.'activities';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = " CREATE TABLE $table (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		title text NOT NULL,
		instructor text NOT NULL,
		price varchar(10) NOT NULL,
		start_date varchar(50) NOT NULL,
		end_date varchar(50) NOT NULL,
		e_time varchar(50) NOT NULL,
		e_group varchar(50) NOT NULL,
		description text NOT NULL,
		file text NOT NULL,
		category text NOT NULL,
		date text NOT NULL,
		is_home int(2) NOT NULL ,
	    status int(2) NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	global $wpdb;
	if(isset($_POST['submit'])) {
		if (!function_exists('wp_handle_upload')) {
			require_once(ABSPATH . 'wp-admin/includes/file.php');
		}
		$uploadedfile = $_FILES['file'];
		$file_name = $_FILES['file']['name'];
		$upload_overrides = array('test_form' => false);
		$movefile = wp_handle_upload($uploadedfile, $upload_overrides);
		if ($movefile && !isset($movefile['error'])) {
        //	data insert script
			global $wpdb;
			$data = array(
				'title' => $title,
				'instructor' => $ins,
				'start_date' => $s_date,
				'end_date' => $e_date,
				'e_time' => $time,
				'price' => $price,
				'e_group' => $group,
				'date' => date('y-m-d H:i:s'),
				'file' => $movefile['url'],
				'category' => $cat,
				'description' => $desc,
				'status' =>  '1',
				'is_home' => $is_home
			);
			$insert = $wpdb->insert($table, $data);
			if( false === $insert ){
				echo json_encode(array('data'=> 'error'));
			}else{
				echo json_encode(array('data'=> '1'));
			}

		}
	}
die();
}

function ajax_delete_activity_request(){



	$ids = explode(",", $_POST['id']);
	foreach( $ids as $value ){
		global $wpdb;
		$table = $wpdb->prefix.'activities';
		$where = array('id' => $value);
		$data  =array("status"=>'-1');
		$updated = $wpdb->update( $table, $data, $where );
	}


	if ( false === $updated ) {
		echo json_encode(array('status'=>2));
		global $wpdb;
		echo $wpdb->print_error();
	} else {
		echo json_encode(array('status'=>1));
	}

die();
}

function ajax_search_activity_request()
{
	global $wpdb;
//	print_r($_POST);
	extract($_POST);
	$table = $wpdb->prefix . 'activities';
	if (isset($from) && trim(isset($param))) { // parem empty and from not empty
		$sql = "SELECT * FROM $table WHERE start_date = '" . $from . "' AND `category` LIKE '%" . $type . "%' ";
	}
	if (isset($from) && $param != "") { // from empty and param not empty
		$sql = "SELECT * FROM $table WHERE title LIKE '" . $param . "%' AND `category` LIKE '%" . $type . "%' ";
	}
	if (trim(isset($from)) && trim($param)== "") { // from empty and param not empty
		$sql = "SELECT * FROM $table WHERE  `category` LIKE '%" . $type . "%' ";
	}
	$result = $wpdb->get_results($sql);

	if (empty($result)) {
		echo '<tr> <td class="error t-center" colspan="9">Activity Not Found!</td> </tr>';
	}
	foreach ($result as $value) {
		?>
		<tr>
			<?php if(isset($_SESSION['teacher'])): ?>
			<td><input class="select_box" type='checkbox' name="del" value="<?= $value->id ?>"></td>
			<?php endif; ?>
			<td> <?= $value->start_date ?> </td>
			<td> <?= $value->end_date ?> </td>
			<td> <?= $value->title ?> </td>
			<td> <?= $value->e_time ?> </td>
			<td> <?= $value->e_group ?> </td>
			<td> <?= date("D-m-Y", strtotime($value->start_date)); ?> </td>
			<td> <?= ucwords($value->instructor) ?> </td>
			<td class="td_mng">
				<form method="post" action="<?= bloginfo('url') ?>/view-activity">
					<button value="<?= $value->id ?>" name="activity_id" type="submit"> Buy Here</button>
				</form>
			</td>
		</tr>

	<?php }
	die();
}
	function ajax_teacher_edit_roster_request(){

//		 print_r($_POST);
		global $wpdb;

		extract($_POST);
		// error array initialization
		$error = array();

		if(empty($name)){
			$error[] = "Name required.";
		}
		if(empty($stu_no)){
			$error[] = "Student no required.";
		}
//
		if(empty($phone)){
			$error[] = "Phone required.";
		}
		if(empty($address)){
			$error[] = "Address required.";
		}
		if(empty($email)){
			$error[] = "Email required.";
		}else{
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error[] = "Invalid email format.";
			}
		}
		if(count($error) > 0){
			foreach ($error as $value) {
				echo $value."\r\n";
			}
		}
		else{
			if(!empty($_POST['caption'])) {
				if (!function_exists('wp_handle_upload')) {
					require_once(ABSPATH . 'wp-admin/includes/file.php');
				}
				 $uploadedfile = $_FILES['file'];
				$upload_overrides = array('test_form' => false);
				$movefile = wp_handle_upload($uploadedfile, $upload_overrides);
			}
				$update =  array(
					'full_name'    	  => $name,
					'student_no' 	  => $stu_no,
					'email'   	  => $email,
					'email_2' =>	$email2,
					'phone'   	  => $phone,
					'phone_2'   	  => $phone2,
					'phone_label_1'   	  => $phone_label,
					'phone_label_2'   	  => $phone_label2,
					'email_lables_1'   	  => $relation,
					'email_lables_2'   	  => $relation2,
					'address' 	  => $address,
					'grade' 	  => $grade,
					'gender'  	  => $gender,
					'dob' 	  => $dob,
					'movie'  => $movie,
					'hero' => $hero,
					'sport' => $support,
					'status' => '1'
				);
			if(!empty($_POST['caption'])) {
				$file_add = array( 'file' => $movefile['url']);
				$update = $update+$file_add;
			}

//			update parent phone, email
			$update_parent =  array(
				'email'   	  => $email,
				'email_2' =>	$email2,
				'phone'   	  => $phone,
				'phone_2'   	  => $phone2,
				'phone_label_1'   	  => $phone_label,
				'phone_label_2'   	  => $phone_label2,
				'email_lables_1'   	  => $relation,
				'email_lables_2'   	  => $relation2
			);
				global $wpdb;
				$table_student = $wpdb->prefix.'student';
				$where = array('id' => $id);
				$updated = $wpdb->update( $table_student, $update, $where );

//				update parent
			global $wpdb;
			$table_parent = $wpdb->prefix.'parent';
			$where = array('id' => $parent_id);
			$updated = $wpdb->update( $table_parent, $update_parent, $where );
				if(false===$updated){
					echo  json_encode(array('data'=>'error'));
				}else{
					echo  json_encode(array('data'=>'1'));
				}
		}
		die();
	}

function ajax_teacher_reset_password_request(){
//	print_r($_POST);
	global $wpdb;
	$table = $wpdb->prefix.'teacher';

	if( $_POST['new_pass'] == '' ){

	}

	$sql = "SELECT `password` from  $table WHERE `password` = '".$_POST['old_pass']."' AND `id` = '". $_SESSION['teacher'] ."'  ";
	$result = $wpdb->get_results($sql);

	if($result){
		global $wpdb;
		$update = array("password" => $_POST['new_pass'], "md5_password" => md5($_POST['new_pass']) );
		$where = array('id' => $_SESSION['teacher']);
		$updated = $wpdb->update( $table, $update, $where );
		if(false===$updated) {
			echo json_encode(array("data"=> '2'));
		}else{
			echo json_encode(array("data"=> '1'));
		}
		}else{
			echo json_encode(array("data" => 'err'));
		}

die();
}

function ajax_parent_reset_password_request(){
//	print_r($_POST);
	global $wpdb;
	$table = $wpdb->prefix.'parent';

	$sql = "SELECT `password` from  $table WHERE `password` = '".$_POST['old_pass']."' AND `id` = '". $_SESSION['parent'] ."'  ";
	$result = $wpdb->get_results($sql);

	if($result){
		global $wpdb;
		$update = array("password" => $_POST['new_pass'], "md5_password" => md5($_POST['new_pass']) );
		$where = array('id' => $_SESSION['parent']);
		$updated = $wpdb->update( $table, $update, $where );
		if(false===$updated) {
			echo json_encode(array("data"=> '2'));
		}else{
			echo json_encode(array("data"=> '1'));
		}
		}else{
			echo json_encode(array("data" => 'err'));
		}
	die();
}

function ajax_teacher_report_card_request(){
//	create table

	global $wpdb;
	$table = $wpdb->prefix.'report_card';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		title  text NOT NULL,
		file text NOT NULL,
		category text NOT NULL,
		student_id mediumint(9) NOT NULL,
		class varchar(100) NOT NULL,
		date text NOT NULL,
	    status int(2) NOT NULL,
		teacher_id mediumint(9) NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	global $wpdb;
	if(isset($_POST['category'])){
		if ( ! function_exists( 'wp_handle_upload' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}

		$student_id = $_POST['stu_id'];
		$uploadedfile = $_FILES['file'];
		$file_name = $_FILES['file']['name'];
		$upload_overrides = array( 'test_form' => false );
		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		if ( $movefile && ! isset( $movefile['error'] ) ) {
			$title=sanitize_file_name( $file_name );
			$category=sanitize_text_field( $_POST['category'] );
			$teacher_id = $_SESSION['teacher'];
			global $wpdb;
			$wpdb->insert(
				$table,
				array(
					'title' => $title,
					'date' => date('y-m-d H:i:s'),
					'file' => $movefile['url'],
					'category' => $category,
					'status' =>  '1',
					'teacher_id' => $teacher_id,
					'student_id' => $student_id,
					'class' => $_SESSION['teacher_grade']
				)
			);
			$result_card = $wpdb->get_results( "SELECT * FROM $table WHERE `id` = '".$wpdb->insert_id."'");
			foreach ($result_card as $value) {	?>
				<li><a download="myimage" href="<?php echo $value->file ?>"><i class="fa fa-download"></i> <?php echo $value->title;?></a>  <span class="time"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($value->date)); ?></span> <button id="<?php echo $value->id; ?>" onclick="delete_this(this,'download_area')" class="del" type="button"><i class="fa fa-times"></i></button> </li>
				<?php
			}
		} else {
			echo "file_err";
		}
	}
	die();
}

function ajax_delete_family_request(){

//	print_r($_POST);
	extract($_POST);

	if(!ctype_digit($id)){
		echo json_encode(array('data'=>'id_err'));
	}else{

		global $wpdb;
		$table = $wpdb->prefix.'parent';
		echo $sql = "SELECT count( id ) as total FROM $table WHERE `id` = '".$id."' AND link = '' ";
		 $result = $wpdb->get_results( $sql);
		$result = $result[0];

		if($result->total > 0 ){
			$update = array("status" => "-1");
			$where = array('id' => $id );
			$updated = $wpdb->update( $table, $update, $where );

			if($updated === false){
				echo json_encode(array('data'=>'2'));
			}else{
				echo json_encode(array('data'=>'1'));
			}
		}else{
			echo json_encode(array('data'=>'3'));
		}
	}
die();
}

function ajax_teacher_send_message_request(){

	global $wpdb;
	$table_rec = $wpdb->prefix.'message_recipients';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table_rec (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		message_id mediumint(9) NOT NULL,
		m_from varchar(9) NOT NULL,
	    m_to varchar(9) NOT NULL,
	    date varchar(100) NOT NULL,
		status int(2) NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	global $wpdb;
	$table_msg = $wpdb->prefix.'message';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table_msg (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		subject  varchar(500) NOT NULL,
		message text NOT NULL,
		file text NOT NULL,
		date varchar(100) NOT NULL,
	    status int(2) NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	extract($_POST);

	if(isset($_SESSION['teacher'])){
		$from = 't_'.$_SESSION['teacher'];
	}
	elseif($_SESSION['parent']){
		$from = 'p_'.$_SESSION['parent'];
	}
//	insert data into message table
	if(!empty($_POST['caption'])) {
		if (!function_exists('wp_handle_upload')) {
			require_once(ABSPATH . 'wp-admin/includes/file.php');
		}
		$uploadedfile = $_FILES['file'];
		$upload_overrides = array('test_form' => false);
		$movefile = wp_handle_upload($uploadedfile, $upload_overrides);
	}else{
		$movefile['url'] = "";
	}

	$data = array(
		'subject' => $subject,
		'message' => str_replace('<br>', '', $email),
		'file' => $movefile['url'],
		'date' => date('y-m-d H:i:s'),
		'status' => '1',
	);
	$wpdb->insert($table_msg, $data);
	$msg_id = $wpdb->insert_id;
// to
//	roster_id
	if(!empty($roster_id)){
		foreach( explode(',', $roster_id) as $value){
			$wpdb->insert(
				$table_rec,
				array(
					'message_id' => $msg_id,
					'm_from' => $from,
					'm_to' => 'p_'.$value,
					'date' => date('y-m-d H:i:s'),
					'status' =>  '0',
				)
			);
		}
	}
//	nonroster_id
	if(!empty($nonroster_id)){
		foreach( explode(',', $nonroster_id) as $value){
			$wpdb->insert(
				$table_rec,
				array(
					'message_id' => $msg_id,
					'm_from' => $from,
					'm_to' => 't_'.$value,
					'date' => date('y-m-d H:i:s'),
					'status' =>  '0',
				)
			);
		}
	}
	echo json_encode(array('data'=> '1'));
die();
}

function ajax_teacher_gallert_is_home_request(){

	global $wpdb;
			$table = $wpdb->prefix . 'art_gallery';
			$data = array("is_home" => 0);
			$where = array('is_home' => 1, 'teacher_id' => $_SESSION['teacher']);
			$updated = $wpdb->update($table, $data, $where);

			$data = array("is_home" => 1);
			$where = array('id' => $_POST['id'], 'teacher_id' => $_SESSION['teacher']);
			$updated = $wpdb->update($table, $data, $where);
			if(false===$updated){
				echo 'err';
			}

die();	
}

