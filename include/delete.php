<?php

print_r($_POST);

if(isset($_POST['check'])){
	

	if($_POST['check'] == "download_area" ){

		global $wpdb;
		$wpdb->delete( `wp_download_area`, array( 'id' => $_POST['id'] ) );


		$sql = mysql_query(query)"DELETE FROM `wp_download_area` WHERE id '".$_POST['id']."'");

	}





}

 ?>