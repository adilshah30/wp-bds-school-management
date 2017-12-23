<?php
function set_password(){
    @session_destroy();
    global $wpdb;
    $error_msg="";
    $tbl_teacher = $wpdb->prefix.'teacher';
    $tbl_parent = $wpdb->prefix.'parent';
    $password ="";
    $c_password="";
    
    $user_type_post =$_GET['user_type'];
    $u_id= $_GET['u_id'];
   
    
    if(isset($_POST['submit'])){
        
        
        if(isset($_POST['password']) && isset($_POST['c_password'])){
           
            $password =  $_POST['password'];
            $c_password =  $_POST['c_password'];
            $user_type_post =$_POST['user_type'];
            $u_id= $_POST['user_id'];
            
            if($_POST['user_type'] == "teacher"){
                  
                   
                    $where = array('id' => $u_id);
                    $update = array('password' => $password,'md5_password' => md5($password));
                    $updated = $wpdb->update( $tbl_teacher,$update,$where );
                    if(false===$updated){
                        $error_msg= "Password Not set! please try again.";
                    }else{
                        $error_msg= "Password Sucessfully set";
                    }

            }else if($_POST['user_type'] == "parent"){
                
                    $where = array('id' => $u_id);
                    $update = array('password' => $password,'md5_password' => md5($password));
                    $updated = $wpdb->update( $tbl_parent,$update,$where );
                    if(false===$updated){
                        $error_msg= "Password Not set! please try again.";
                    }else{
                        $error_msg= "Password Sucessfully set";
                    }
            }
            
        }else{
           $error_msg= "Password doesnt match";
        }
        
    }
?>
<style type="text/css">
		
input,
textarea{box-sizing:border-box}input[type=text],input[type=search],input[type=radio],input[type=tel],input[type=time],input[type=url],input[type=week],input[type=password],input[type=checkbox],input[type=color],input[type=date],input[type=datetime],input[type=datetime-local],input[type=email],input[type=month],input[type=number],select,textarea{border:1px solid #ddd;
	-webkit-box-shadow:inset 0 1px 2px rgba(0,0,0,.07);
	box-shadow:inset 0 1px 2px rgba(0,0,0,.07);
	background-color:#fff;
	color:#32373c;
	outline:0;
	-webkit-transition:50ms border-color ease-in-out;
	transition:50ms border-color ease-in-out
	}
	input[type=text]:focus,input[type=search]:focus,input[type=radio]:focus,input[type=tel]:focus,input[type=time]:focus,input[type=url]:focus,input[type=week]:focus,input[type=password]:focus,input[type=checkbox]:focus,input[type=color]:focus,input[type=date]:focus,input[type=datetime]:focus,input[type=datetime-local]:focus,input[type=email]:focus,input[type=month]:focus,input[type=number]:focus,select:focus,textarea:focus{border-color:#5b9dd9;
		-webkit-box-shadow:0 0 2px rgba(30,140,190,.8);box-shadow:0 0 2px rgba(30,140,190,.8)}
		input[type=url],input[type=email]{direction:ltr}
		input[type=number]{height:28px;line-height:inherit}	
		
		
			input[type=radio]:checked:before,input[type=checkbox]:checked:before{
				float:left;
				display:inline-block;
				vertical-align:middle;
				width:16px;
				font:400 21px/1 dashicons;speak:none;
				-webkit-font-smoothing:antialiased;
				-moz-osx-font-smoothing:grayscale
			}
				input[type=checkbox]:checked:before{content:"\f147";margin:-3px 0 0 -4px;
				color:#1e8cbe
			}
					


	.login *{margin:0;padding:0}
	.login form{margin-top:20px;margin-left:0;padding:26px 24px 46px;background:#fff;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.13);box-shadow:0 1px 3px rgba(0,0,0,.13)}
	.login .button-primary{float:right}#login form p{margin-bottom:0}.login label{color:#72777c;font-size:14px}
	.login h1{text-align:center}
	.login #backtoblog,.login #nav{font-size:13px;padding:0 24px}
	.login #nav{margin:24px 0 0}
	#backtoblog{margin:16px 0}
	.login #backtoblog a,
	.login #nav a{
		text-decoration:none;color:#555d66
	}
	.login #backtoblog a:hover,
	.login #nav a:hover,
	.login h1 a:hover{color:#00a0d2}
	.login #backtoblog a:focus,
	.login #nav a:focus,
	.login h1 a:focus{color:#124964}
	.login form .input,
	.login input[type=text]{
		font-size:24px;
		width:100%;
		padding:3px;
		margin:2px 6px 16px 0
	}
	select{
		height: 35px;
		font-size:15px;		
		padding:3px;
		margin-bottom:10px !important;
	}
a{
	text-decoration: none;
}
.error{
	color: red;
    font-size: 13px;    
    margin-bottom: 5px;
}
.submit{
	    margin-right: 38px;
	    float: right;
}
.success{
	color: green;
}
</style>
	<div id="login">
		<h1><a href="#">Brookridge Day School</a></h1>
	
<form  method="post">
    <div class="error">
        <?php echo $error_msg; ?>
    </div><div class="success"></div>
           
	<p>
            <label for="user_login" style="display:block;">New password <small class="type_err"></small> <br>
              <input name="password"  class="input form-control" size="20" type="password"></label>      
	</p>
	<p>
		<label for="user_login" style="display:block;">Confirm password    <small class="user_err"></small><br>
		<input name="c_password" class="input form-control" size="20" type="password"></label>
	</p>
	
		
	<p class="text-right">
            <input type="hidden" name="user_id" value="<?php echo $u_id; ?>"/>
            <input type="hidden" name="user_type" value="<?php echo $user_type_post; ?>"/>
            <input name="submit" class="button button-primary button-large" value="Set Password" type="submit" style="float: right;
    margin-top: 10px;">
		
	</p>
</form>



	</div>


<?php	
}?>