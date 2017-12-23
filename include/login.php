<?php
session_start();
if(isset($_POST['login'])){
	// print_r($_POST);
	extract($_POST);


	if(!empty($username) && !empty($password) && $type != "0"){


		if($username == "rb" && $password == "12345" && $type == "teacher"){
			 $_SESSION['teacher'] = "1";
			 echo "1";
		}else{
			echo 'err';
		}

		
		// require_once('../../../../wp-config.php');
		// global $wpdb;
		// $qery ="SELECT * FROM `wp_dkf3k12nf1_posts` WHERE `post_title` = '".$username."' AND `post_content` = '".md5($password)."' AND `post_type` = '".$type."' limit 1";		

		//  $art = $wpdb->get_results( $qery );

		//  if($art){

		//  $_SESSION[$type] = $type."/".$art[0]->ID;
		//  echo '1';
		}
	// echo $art[0]->ID;
	
}


		

			
	