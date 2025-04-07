<?php require_once("Backend/config.php"); ?>


<?php
// Retrieve the email value from the AJAX request

if(isset($_POST['subscribe_btn']) && !empty($_POST['subscribe_btn'])){
    
    $email = $_POST['email'];
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {          
                
        $result_add=mysqli_query($conn,$sql_result);
        
        if($result_add){
    
        	echo("Subscription successful!"); 
        
        }else{
        	echo("Error inserting email!");
        }
        
    } else {
        echo("The email is not valid!");
    }
    
    


}
?>
