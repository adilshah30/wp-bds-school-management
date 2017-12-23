<?php 
function reply_message(){
	
            
        if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
		$user = true;
	}else{
		echo '<script>window.location="'.get_site_url().'/login";</script>';
		exit();
	}
        global $wpdb;
	$table_recipients = $wpdb->prefix.'message_recipients';
        $table_parent = $wpdb->prefix.'parent';
        $table_teacher = $wpdb->prefix.'teacher';
        //Variable declaration
        $message_id='';
        $to_email = '';
        $from_email='';
        $to_name='';
        $from_name='';
        $to_id= '';
        $from_id='';
        
        
        
        // switch user id
	if(isset($_SESSION['teacher'])){
		$USERID = $_SESSION['teacher'];
		$from_id = 't_'.$_SESSION['teacher'];
                $get_user_info = $wpdb->get_row("SELECT * FROM $table_teacher WHERE id = ".$USERID);
                $from_email=$get_user_info->email;
                $from_name=$get_user_info->full_name;
	}
	if(isset($_SESSION['parent'])){
		$USERID = $_SESSION['teacher_id'];
		$from_id = 'p_'.$_SESSION['parent'];
                $get_user_info = $wpdb->get_row("SELECT * FROM $table_parent WHERE id = ".$USERID);
                $from_email=$get_user_info->email;
                $from_name=$get_user_info->full_name;
	}
        
        if(isset($_GET['msg_id'])){
            $message_id = $_GET['msg_id'];
        }
//	host name
	if($_SERVER['HTTP_HOST']== 'localhost'){
		$base = 'localhost/bds';
	}else{
		$base = 'http://brookridgedayschool.com';
	}
        $site_url = site_url();
	wp_enqueue_script( 'text_editor', $site_url.'/wp-content/plugins/teacher/js/text_editor.js', array( 'jquery' ), get_bloginfo('version'), false );

	
        
	$get_message = "SELECT * FROM $table_recipients WHERE message_id = '".$message_id."' AND m_from='".$_GET['from_id']."'";
	$message_row = $wpdb->get_row( $get_message );
//	echo "<br/>".$message_row->m_from;
        $get_from_info = explode('_',$message_row->m_from );
        $get_from_info_user_type = $get_from_info[0];
        $get_from_info_userid = $get_from_info[1];
        
        if($get_from_info_user_type == 'p'){
            
            $get_parent_info= $wpdb->get_row("SELECT * FROM $table_parent WHERE id = ".$get_from_info_userid);
            $to_email = $get_parent_info->email;
            $to_name = $get_parent_info->full_name;
            $to_id = 'p_'.$get_parent_info->id;
            
        }else if($get_from_info_user_type == 't'){
            
            $get_teacher_info= $wpdb->get_row("SELECT * FROM $table_teacher WHERE id = ".$get_from_info_userid);
            $to_email = $get_teacher_info->email;
            $to_name = $get_teacher_info->full_name;
            $to_id = 't_'.$get_teacher_info->id;
            
        }else{
            echo "doest match query";
        }
        
        
        
        
	?>
 <script type="text/javascript">
//<![CDATA[
        jQuery(document).ready(function(){ nicEditors.allTextAreas() });
  //]]>
  </script>
<div class="wrapper">
	<?php require_once TEACHER_PLUGIN_PATH. 'include/header.php'; ?>
</div>
  <div class="mc-content-wrap">
      <div id="body_wrapper">
		<div class="title">
			<p>Reply <span><a href="<?php bloginfo('url')?>/inbox-message"><i class="fa fa-envelope"></i> Emails</a></span></p>
		</div>
		<div class="message">
			<form id="form">
                                <p>To:  <?= $to_name." (".$to_email." )"; ?></p>                                
				
                                <p>Subject:  <small class="sub_err"></small></p>
                                <input type="text" name="subject" class="form-control" style="margin-bottom:10px;">
                                
				<p>Text of your email: <small class="email_err"></small></p>
                                <textarea name="message" class="form-control"></textarea>
                                
                                <h6>File Attachment</h6>
				<small>Maximum size: 20MB (combined)</small>
				<p>Add File</p>
				<input type="file" name="file" >
				<br/>
				
                                
                                <input type="hidden" id="to_email" name="to_email" value="<?= $to_email; ?>">
                                <input type="hidden" id="to_id" name="to_id" value="<?= $to_id; ?>">
                                <input type="hidden" id="to_name" name="to_name" value="<?= $to_name; ?>">
                                <input type="hidden" id="from_email" name="from_email" value="<?= $from_email; ?>">
                                <input type="hidden" id="from_id" name="from_id" value="<?= $from_id; ?>">
                                <input type="hidden" id="from_name" name="from_name" value="<?= $from_name; ?>">
                                
                                <div class="submit_email">
					<button type="button" id="send_reply_messages"><i class="fa fa-envelope"></i> Send Email </button>
				</div>
			</form>
		</div>
	</div>
  </div>
	
<style>
    .cke_chrome{
        display:none !important;
    }
</style>
<?php 	        
}

