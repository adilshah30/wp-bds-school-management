<?php
function sent_message(){
        //	total new messages
	global $wpdb;
	$table_rec = $wpdb->prefix.'message_recipients';
	$table_msg = $wpdb->prefix.'message';
        
        $num_rec_per_page=10;
        if (isset($_GET["p_no"])) { $page  = $_GET["p_no"]; } else { $page=1; }; 
        $start_from = ($page-1) * $num_rec_per_page; 
        
	if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
		$user = true;
	}else{
		echo '<script>window.location="'.get_site_url().'/login";</script>';
		exit();
	}
        
        if(isset($_POST["delete_msg"])){
            $messages = $_POST["sent_message_id"];
            foreach ($messages as $msg){
               $sql_delete = "DELETE FROM $table_rec WHERE id ='".$msg."'";
               $result= $wpdb->query($sql_delete); 
            }
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
        

	$sql = "SELECT count(id) as new_msg FROM $table_rec WHERE `m_from` = '".$msg_to."' AND `status` = '0' ";
	$row = $wpdb->get_results( $sql );
	$row = $row[0];

        $site_url = site_url();
        
	?>

<!-- html code -->

<div class="wrapper">
	<?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
	</div>	<div class="error"></div>
	
        <div class="mc-content-wrap">
            <div id="body_wrapper" class="message_box">
            <form action="" method="post">

                <div class="title" style="background:#879e73;">
                    <div class="col-md-2 message-title">
                        <p>Sent</p>
                    </div>
                    <div class="col-md-5  message-pagingation-wrap">
                        <div class="messages-pagination">
                            <?php                            
                                $sql_paging = "SELECT $table_msg.*, $table_rec.m_from, $table_rec.m_to FROM $table_msg
                                    INNER JOIN $table_rec
                                    ON $table_msg.id=$table_rec.message_id
                                    AND $table_rec.m_from = '".$msg_to."'";
                                $total_records = $wpdb->get_results( $sql_paging );
                                $total_records= $wpdb->num_rows;
                                $total_pages = ceil($total_records / $num_rec_per_page); 

                                echo "<a href='".$site_url."/sent-message/?p_no=1'>".'<< Prev'."</a> "; // Goto 1st page  
                                for ($i=1; $i<=$total_pages; $i++) { 
                                            echo "<a href='".$site_url."/sent-message/?p_no=".$i."'>".$i."</a> "; 
                                } 
                                echo "<a href='".$site_url."/sent-message/?p_no=$total_pages'>".'Next >>'."</a> "; // Goto last page
                            ?>
                        </div>
                    </div>
                    <div class="col-md-5 message-action-btn">
                        <p>  <span class="em_active"><a href="<?php bloginfo('url')?>/sent-message"><i class="fa fa-arrow-right"></i> Sent </a></span> <span><a href="<?php bloginfo('url')?>/inbox-message"><i class="fa fa-envelope"></i> Emails <b><?= $row->new_msg ?></b> </a></span> <span><a href="<?php bloginfo('url')?>/teacher-messages"><i class="fa fa-plus-circle"></i> New Email</a></span><input type="submit" class="btn-bds" name="delete_msg" value="Delete"></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="inbox_message">
                        <table>
                            <thead>
                                <th><input type="checkbox" name="chk_all" id="chk_all"></th>
                                <th>Subject</th>
                                <th>Sent From</th>
                                <th class="resp-display-none">Send Date</th>
                                <th >Attachments</th>
                                
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT $table_msg.*, $table_rec.m_from, $table_rec.m_to, $table_rec.id AS rec_id
                                                            FROM $table_msg
                                                                    INNER JOIN $table_rec
                                                                    ON $table_msg.id=$table_rec.message_id
                                                                    AND $table_rec.m_from = '".$msg_to."' LIMIT $start_from , $num_rec_per_page";

                                    $row = $wpdb->get_results( $sql );
                                    foreach( $row as $value ){

                                    if( $value->m_to[0] == 't' ){
                                            $table_P_t = $wpdb->prefix.'teacher';
                                    }
                                    elseif( $value->m_to[0] == 'p' ){
                                            $table_P_t = $wpdb->prefix.'parent';
                                    }
                                    $sql = "SELECT full_name  FROM $table_P_t WHERE `id` = '".substr($value->m_to,2)."'";
                                    $row = $wpdb->get_results( $sql );

                                ?>
                                    <tr>
                                            <td><input type="checkbox" name="sent_message_id[]" id="chk_all" value="<?= $value->rec_id ?>"></td>
                                            <td><a href="<?= bloginfo('url') ?>/read-message/?message=<?= $value->id ?>"><i class="fa fa-envelope"></i>&nbsp; <?= $value->subject ?></a></td>
                                            <td><?= ucwords( $row[0]->full_name ) ?></td>
                                            <td class="resp-display-none"><?= date('d/y/m', strtotime($value->date)); ?></td>
                                            <td><i class="fa fa-paperclip"></i> file</td>
                                            
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                </div>	
            
            </form>
            </div>
        </div>
	      
<?php   
}
?>