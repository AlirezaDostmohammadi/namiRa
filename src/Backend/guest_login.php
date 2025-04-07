<?php
require_once("config.php");	

	if($_SERVER['REQUEST_METHOD']=="POST"){	
		 $error[]=" ";
		 $sucess[]=" ";
		 $error_val=0;
		if(isset($_POST['login-submit'])){
			if(isset($_POST['username'],$_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){

			   $hash = $_POST['password'];	
				$result=mysqli_query($conn , $sql_select);	
				
				if(mysqli_num_rows($result)!=1){	
					$error['login']="Your Username or Password is Wrong!";	
					$error_val+=1;
			    }else{
						//set cookies
						$row=mysqli_fetch_assoc($result);
						$loginArray=["guest_username" => $row['Username'] , "guest_password" => $row['Password']];
						$login=base64_encode(serialize($loginArray));
						setcookie("lgdata",$login,time()+2592000);
						
						
							
							$_SESSION['guest_loginStatus'] = 1;
							$_SESSION['guest_username'] = $row['Username'];
							$_SESSION['guest_id'] = $row['authenticationId'];
							header("location:../Frontend/guest_insert.php");
											
				}
		
			}else{
				$error['login_field']="Fill Inputs!";
				$error_val+=1;
		}			
	}

				if ($error_val>=1){
				    	header("location:../Frontend/guest_login.php");					    
				}
		

	}
?>					


