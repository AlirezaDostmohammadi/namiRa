<?php
session_start();
date_default_timezone_set('Asia/Tehran');
$conn=mysqli_connect();
 $error[]=" ";
   if(!$conn){
       echo('nnnnn');
	   $error['conf']="Connection error";
	}
 mysqli_set_charset($conn,"utf8");
 $_SESSION['error']=$error;
?>