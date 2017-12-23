<?php 
function teacher_message(){
	if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
		$user = true;
	}else{
		echo '<script>window.location="'.get_site_url().'/login";</script>';
		exit();
	}
// switch user id
	if(isset($_SESSION['teacher'])){
		$USERID = $_SESSION['teacher'];
		$msg_to = 't_'.$_SESSION['teacher'];
	}
	if(isset($_SESSION['parent'])){
		$USERID = $_SESSION['teacher_id'];
		$msg_to = 'p_'.$_SESSION['parent'];
	}
//	host name
	if($_SERVER['HTTP_HOST']== 'localhost'){
		$base = 'localhost/bds';
	}else{
		$base = 'http://brookridgedayschool.com';
	}
        $site_url = site_url();
	wp_enqueue_script( 'text_editor', $site_url.'/wp-content/plugins/teacher/js/text_editor.js', array( 'jquery' ), get_bloginfo('version'), false );

	global $wpdb;
	$table = $wpdb->prefix.'message_recipients';
	$sql = "SELECT count(id) as new_msg FROM $table WHERE `m_to` = '".$msg_to."'";
	$row = $wpdb->get_results( $sql );
	$row = $row[0];
	if( $row < 10 ){
		$new_msg =  '0'.$row->new_msg;
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
			<p>Send Message <span><a href="<?php bloginfo('url')?>/inbox-message"><i class="fa fa-envelope"></i> Emails <b><?= $new_msg ?></b> </a></span></p>
		</div>
		<div class="message">
			<form id="form">
				<p>Subject:  <small class="sub_err"></small></p>
                                <input type="text" name="subject" class="form-control">
				<p>Text of your email: <small class="email_err"></small></p>
                                <textarea name="email" class="form-control"></textarea>

				<div class="roster_check">
	<?php if(isset($_SESSION['teacher'])): ?>
				<h5>Roster Recipients</h5>
				<a href="javascript:void(0)" onClick="check('roster_check')"><small> Select All</a><span> | </span>
				<a href="javascript:void(0)" onClick="uncheck('roster_check')"> Select None</small></a>
				<ul>
					<?php
					global $wpdb;
					//$table_roster = $wpdb->prefix.'student';
                                        $table_roster = $wpdb->prefix.'parent';
					$query = "SELECT * FROM $table_roster WHERE `teacher_id` = '".$_SESSION['teacher']."' AND status != '-1' ";
					$result = $wpdb->get_results( $query);
					foreach ($result as $value):?>	
						<li><input class="r_c" type="checkbox" name="foo" value="<?= $value->id ?>"> <?= ucwords( $value->full_name ) ?> </li>
					<?php endforeach; ?>
			</ul>
			<hr>
				</div>
	<?php endif; ?>
				<h6>Non Roster Recipients</h6>
				<div class="nonroster_check">
				<a href="javascript:void(0)" onClick="check('nonroster_check')"><small> Select All</a> <span> | </span>
				<a href="javascript:void(0)" onClick="uncheck('nonroster_check')"> Select None </small> </a>
				<ul>
					<?php
					global $wpdb;
					$table_teacher = $wpdb->prefix.'teacher';
//query switch for teacher and parent
				if(isset($_SESSION['teacher'])) {
					$query = "SELECT * FROM $table_teacher WHERE status != '-1' ";
				}
				elseif(isset($_SESSION['parent'])){
					$query = "SELECT * FROM $table_teacher WHERE `id` = '".$_SESSION['teacher_id']."' AND status != '-1' ";
				}

					$result = $wpdb->get_results( $query);
					foreach ($result as $value):?>	
						<li><input class="nr_c" type="checkbox" name="foo" value="<?= $value->id ?>"> <?= ucwords( $value->full_name ) ?></li>
					
					<?php endforeach; ?>
				</ul>
				<hr>
				</div>
				
				<h6>File Attachment</h6>
				<small>Maximum size: 20MB (combined)</small>
				<p>Add File</p>
				<input type="file" name="file" >
				<br>
				<div class="submit_email">
					<button type="button" id="send_messages"><i class="fa fa-envelope"></i> Send Email </button>
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

