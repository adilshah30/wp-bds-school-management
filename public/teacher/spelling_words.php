<?php
function teacher_spelling_words(){

	if(!isset($_SESSION['teacher'])){
		echo '<script>window.location="'.get_site_url().'/login";</script>';
	}

$spelling_word_category=noceky_brs_common::spelling_word_category();	
?>
<!-- html code -->

<div class="wrapper">
	<?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
	</div>	<div class="error"></div>
	
	<div id="body_wrapper">
		<div>
			<div class="title">
				<p>Spelling Words</p>
			</div>
<?php


	       
	        global $wpdb;
	        $count=0;	        
	        foreach ($spelling_word_category as $category) { $count++; ?>
	        	<div class="<?php if($count == "1"){ echo "accordion active";}else{echo "accordion";} ?>"><?php echo ucfirst($category); ?>
	        	<?php
				if($_SESSION['teacher']):
				echo'
	        	<form style="float:right" id="form'.$count.'" enctype="multipart/form-data">	
	        	<form method="post" action="#">
	        	<input type="checkbox" id="is_home'.$count.'"> <label for="is_home'.$count.'">Is Home</label>
			    	<input type="text" placeholder="Add title" name="title" id="news_title'.$count.'" style="display: inline;width: 151px;height: 24px;  margin-top: -17px; ">		

					<button type="button" id="submit_download'.$count.'" class="submit_download"><i class="fa fa-upload"></i></button>
					<input type="file" name="file" class="my-file" id="my-file'.$count.'">
					<input type="hidden" id="cat'.$count.'"value="'.$category.'">
				</form>	
					<script>
					jQuery("#my-file'.$count.'").change(function(e) {
				    	if( jQuery("#my-file'.$count.'").val() !="" ){
				    	submit_spelling_words("'.$count.'");
					}
					});
				jQuery("#submit_download'.$count.'").click(function(){
				    jQuery(".error").text("");
				    var title = jQuery("#news_title'.$count.'").val();
				    if(title == ""){
				    	jQuery(".error").text("Please add title!").css("text-align", "center");
				    	jQuery("#news_title'.$count.'").css("border-top","2px solid red").focus();
				    }else{
				    	jQuery("#my-file'.$count.'").click();
				    }
				});
				</script>';
				endif; ?>
	        	</div>
	        	$table = $wpdb->prefix."spelling_words";
			    $download = $wpdb->get_results( "SELECT * FROM $table WHERE '".$_SESSION['teacher']."' AND `category` = '".strtolower($category)."'  AND status != '-1' ");
			   	
			    ?>			   	
			   <div class="<?php if($count == "1"){ echo "panel show";}else{echo "panel";} ?>">
			   <ul id="download_list<?php echo $count; ?>">	
			   <li style="display: none;"></li>			   
				<?php
			    foreach ($download as $value) {
			    	?>	

			    <li><a download href="<?php echo $value->file ?>"><i class="fa fa-download"></i> <?php echo $value->title;?></a>  <span class="time"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($value->date)); ?></span>
					<?php if($_SESSION['teacher']): ?>
					<a href="javascript:void(0)" id="<?php echo $value->id; ?>" onclick="delete_this(this,'spelling_words')" class="del" type="button"><i class="fa fa-times"></i></a>
						<?php endif; ?>
				</li>
				
				<?php	
				}
					echo ' </ul>						
						</div>';
			}
 ?>
	    </div>
    </div>
</div>
	
<?php  
}
?>