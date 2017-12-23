<?php
function teacher_event(){
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
	$event_category=noceky_brs_common::event_category();	
	
	
/*	global $wpdb; 
	
	$post_table = $wpdb->prefix.'posts';
	$postmeta_table = $wpdb->prefix.'postmeta';
	echo "Table Name : ".$post_table;
	$event_date = date('y-m-d h:i:s');
	$wpdb->insert('wp_dkf3k12nf1_posts', array(
		'post_author' => 1,
		'post_date' => $event_date,
		'post_date_gmt' => $event_date,
		'post_content' => 'HBD',
		'post_title' => 'HBD',
		'post_excerpt' => 'birthday-party',
		'post_status' => 'publish',
		'comment_status' => 'close',
		'ping_status' => 'open',
		'post_password' => '',
		'post_name' => $_SESSION['teacher'],
		'to_ping' => '',
		'pinged' => '',
		'post_modified' => $event_date,
		'post_modified_gmt' => $event_date,
		'post_content_filtered' => '',
		'post_parent' => 0,
		'guid' => 'http://brs.noceky.com/?page_id=',
		'menu_order' => 0,
		'post_type' => 'calp_event',
		'post_mime_type' => "1",
		'comment_count' => 0
	));
	$post_id =  $wpdb->insert_id;
	
	echo "Post Id : ".$post_id;
	$event_info = array(
		'title' => 'HBD',
		'price' => '200',
		'event_date' => $event_date,
		'category' => 'birthday-party',
		'description' => 'HBD',
		'is_calender_e' => 1
	);
	
	$wpdb->insert($postmeta_table, array(
		'post_id' => $post_id,
		'meta_key' => 'birthday-party',
		'meta_value' => json_encode($event_info)
	));*/
	

//data picker links
	wp_enqueue_style( 'datapickercss', plugin_dir_url( FILE ) . 'teacher/css/dp-style.css', array(), get_bloginfo('version'), '' );
	wp_enqueue_script( 'jq-datapicker', plugin_dir_url( FILE ) . 'teacher/js/jq-datapicker.js', array( 'jquery' ), get_bloginfo('version'), false );
	wp_enqueue_script( 'jq-datapicker2', plugin_dir_url( FILE ) . 'teacher/js/jq-datapicker2.js', array( 'jquery' ), get_bloginfo('version'), false );
//echo "Path : ". plugin_dir_url( FILE );
    wp_enqueue_style( 'jquery-ui-timepicker-addon', plugin_dir_url( __FILE__ ) . 'css/jquery-ui-timepicker-addon.css', array(), get_bloginfo('version'), 'all' );
	wp_enqueue_script( 'jquery-ui-timepicker-addon', plugin_dir_url( FILE ) . 'teacher/js/jquery-ui-timepicker-addon.js', array(), get_bloginfo('version'), false );
	?>
<script>
//$(document).ready(function()
jQuery(document).ready(function(){
	/*jQuery("#datepicker").datepicker();*/
	jQuery('#datepicker').datetimepicker({
			controlType: 'select',
			timeFormat: 'HH:mm:ss',
			dateFormat:'yy-mm-dd'
		}); //background: url(public/img/content-top-edge.png) repeat-x
	jQuery( ".ch-content-top-edge" ).css( 'background','transparent');
	});
</script>

<div class="wrapper">
	<?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>

	<div id="body_wrapper">
		<div class="title">
			<p>Teacher Event</p>
		</div>
		<?php if(isset($_SESSION['teacher'])): ?>
	    <div class="event_form">
	        <form method="post" action="#">
	        	<div class="event_title">
		        	<p>
		        		<label>Event Title</label> <small class="t_err"></small>
		        	</p>
		        	<input type="text" name="title">
                    <input type="hidden" name="price" value="0">
	        	</div>
	        <!--	<div class="event_price">
		        	<p>
		        		<label>Price</label> <small class="p_err"></small>	        		
		        	</p>
		        	<input type="hidden" name="price">
	        	</div>-->
	        	<div class="event_price">
		        	<p>
		        		<label>When</label> <small class="w_err"></small>	        		
		        	</p> 
                                  
                    <input type="text" name="event_date" id="datepicker" > 
	        	</div>
               
	        	<div class="event_when">
		        	<p>
		        		<label>Category</label> <small class="c_err"></small>
		        	</p>	
		        		<select type="text" name="category">

	        			<option selected value="0">Select Category</option>
	        			<?php
	        			
	        			foreach($event_category as $key => $value):
	        			     echo '<option value="'.$key.'">'.$value.'</option>';

	        			 endforeach;
	        			 ?>
	        		</select>	
	        	</div>
	        	<div class="event_desc">
		        	<p>
		        		<label>Description</label> <small class="d_err"></small>	        		
		        	</p>
		        	<textarea name="description" rows="5"></textarea>
	        	</div>
	        	
	        	<div style="float: left;width: 91%;">
		        	<p>
		        	  <!--<input type="checkbox" value="1" name="is_calender_e" id="is_calender_e" ><label for="is_calender_e"> </label>-->
                      <input type="hidden" value="1" name="is_calender_e" id="is_calender_e">
						<input type="checkbox" value="1" name="is_home" id="is_home" ><label for="is_home"> Is Home</label>
		        	</p>
	        	</div>

	        	<div>
		        	<p>
		        		<button class="evnt_sub_btn" type="button" onclick="submit_event()"> Submit </button>
		        	</p>
	        	</div>
	        </form>
	    </div>
	    <?php endif; ?>
	<?php

	    global $wpdb;
	    $table_post = $wpdb->prefix. 'posts';
	    $table_postmeta = $wpdb->prefix. 'postmeta';
        $count=0;           

//print_r($event_category);

        foreach ($event_category as $key => $category) { $count++;
        	?>
        	<div class="<?php if($count == "1"){ echo "accordion active";}else{echo "accordion";} ?>"><?php echo ucfirst($category); ?>
        	<?php echo'
        	</div>';
 // select data 
        	?>
        	<div class="<?php if($count == "1"){ echo "panel show";}else{echo "panel";} ?> <?= $category ?>1">
        	<?php
			$query = "SELECT `ID` FROM $table_post WHERE `post_name` = '".$TEACHER_ID."' AND `post_type` IN ('event','calp_event') AND `post_excerpt` = '".$key."' ";
		   // echo $query;
			$event = $wpdb->get_results( $query); ?>
		   
		   <table border="1" class="event_table">
		        	<thead>
		        	    <th>Title</th>
		        	    <th width="140">When</th>
		        	 <!--   <th>Price</th>-->
		        	     <th width="90">Event Type</th>
		        	    <th>Description</th>
						<?php if(isset($_SESSION['teacher'])): ?>
		        	    <th width="90" class="td_mng">Manager</th>
					    <?php endif; ?>
		            </thead>
		            <tbody class="<?= $category ?>">
<?php
		    foreach ($event as  $event_value) {


		   	 	$event_postmeta = $wpdb->get_results( "SELECT * FROM $table_postmeta WHERE `post_id` = '".$event_value->ID."'");
		   	 	foreach ($event_postmeta as  $value) {		   
		   	 	 
			   		$item = json_decode($value->meta_value);		   		
			   		?>
			   			<tr id="tr_<?= $event_value->ID ?>">
		                    <td><?= ucfirst( $item->title); ?></td>
		                    <td><?= $item->event_date; ?></td>
		                   <!-- <td><= $item->price; ?></td>-->
		                    <td><?= ($item->is_calender_e == "1")? 'Calender': '...'; ?></td>
		                    <td><?= ucfirst( $item->description ); ?></td>
						<?php if(isset($_SESSION['teacher'])): ?>
							<td class="td_mng">
								<li>
									<a href="<?= bloginfo('url')?>/teacher-edit-event/?event=<?= $event_value->ID ?>"><i class="fa fa-pencil"></i> Edit</a>
								</li>

								<li>
					    	  	 	<a href="javascript:void(0)" onclick="delete_event(<?php echo $event_value->ID; ?>)"><i class="fa fa-trash-o"></i> Delete</a>
								</li>

							</td>
						<?php endif; ?>
	                	</tr>       
			   		<?php
		  		}
		    }
		   echo '</tbody></table> </div>';
	}
 ?> 

     </div><!-- end gray div -->
</div>

<?php
}
