<?php require_once("../header.php") ?>



<?php 
if(isset($_POST['submit_btn'])){
    $to = "sh.moradi@royan-rc.ac.ir"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $full_name = $_POST['full_name'];
    $subject = $_POST['subject'];
    $message = 'Full name: '. $full_name . "\n\n" .'From: '. $from . "\n\n" . "Message:" . "\n\n" . $_POST['message'];

    $headers = "From:" . $from;
    mail($to,$subject,$message,$headers);
    }
?>



			<!-- ============================ Page Title Start================================== -->
			<div class="page-title" style="height: 70px;">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<div class="container">
			    <div class="col-lg-12 col-md-12">
			        <section style="padding: 5%;">
			            
		<?php
    		    echo("<h3 style='text-align: center;color: green;'>Your Mail has been sent. Thank you " . $full_name . ", we will contact you shortly. </h3>");  
	    
	    ?>
	            </section>
			</div>		  
		</div>

<?php require_once("../footer.php");?>