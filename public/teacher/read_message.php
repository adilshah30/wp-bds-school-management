<?php
function read_message(){
	if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
		$user = true;
	}else{
		echo '<script>window.location="'.get_site_url().'/login";</script>';
		exit();
	}
// validate
	if(!ctype_digit($_GET['message'])){
		echo '<script>window.location="'.get_site_url().'/404";</script>';
		exit;
	}
	global $wpdb;
	$table_msg = $wpdb->prefix.'message';

	$sql = "SELECT *  FROM $table_msg WHERE `id` = '".$_GET['message']."'";
	$row = $wpdb->get_results( $sql );
	$row = $row[0];
?>
<!-- html code -->

        <div class="wrapper">
	<?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
	</div>	<div class="error"></div>
	
        <div class="mc-content-wrap">
            <div id="body_wrapper">
                    <div class="title">
                        <p style="padding-left:30px;"> Received Email <span><a style="color:#fff;" href="<?php echo site_url().'/reply-message/?msg_id='.$_GET['message']; ?>">Reply</a></span> </p>        
                        <div class="clearfix"></div>
                    </div>
                    <div class="message_body">
                        <div class="message-date_details">
                            <p style="font-weight: bold;font-size: 12px;"><i class="fa fa-envelope-o" style="color:#879e73"></i> Email sent on <?=  date('l, F jS, Y', strtotime($row->date));  ?> at <?= date('H:m A',strtotime($row->date)) ?></p>
                            <p style="font-weight: bold;"><?= $row->subject; ?></p>
                        </div>
                            <?= $row->message ?>
                            <i>Download file</i>
                            <button onclick="javascript:window.history.back();"><i class="fa fa-arrow-left"></i> Back </button>
                    </div>
            </div>
        </div>
        
<?php
//	read message status
	global $wpdb;
	$update = array('status'=>1);
	$table_rec = $wpdb->prefix.'message_recipients';
	$where = array('id' => $_GET['message']);
	$updated = $wpdb->update( $table_rec, $update, $where );
}
?>