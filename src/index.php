

<?php require_once("Backend/config.php"); require_once("header.php"); ?>
			
			
			<div class="image-cover hero-banner" style="background:#eff6ff;padding-top: 7%;min-height: auto;">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-9 col-md-11 col-sm-12">
							<div class="inner-banner-text text-center">
								<h2 style="text-transform: lowercase; font-family: Monotype Corsiva;">na<span style="margin-right: -1%;color: red; ">mi</span>
									<span style="color: red; text-transform: capitalize; ">R</span>a
								</h2>
								<h4>a manually curated database for microRNAs in cancer</h4>
								
<?php

$result_time=mysqli_query($conn,$sql_time);
$row_time=mysqli_fetch_assoc($result_time);


$monthNum  = $row_time['month'];
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F'); 

?>

								<span class="badge badge-success">Latest Update: <?php echo($monthName); ?>, <?php echo($row_time['year']); ?></span>
							</div>
							<div class="full-search-2 eclip-search italian-search hero-search-radius shadow-hard mt-5">
								<div class="hero-search-content">
<div class="row">
    		
    <form class="row col-lg-12 col-md-12 col-sm-12" action="Frontend/simple_search_result.php" method="post" style="margin-left: auto; padding-right: inherit;">
        <div class="col-lg-9 col-md-7 col-sm-12" style="padding: 0; padding-right: inherit;">
            
            <!-- Increased width for mirna_val input box -->
            <div class="col-lg-6 col-md-6 col-sm-12" style="float: left; margin-right: 1rem;">
                <div class="form-group" style="">
                    <div class="controls">
                        <input type="text" style="border: 1px solid #425666;" class="form-control" name="mirna_val" id="mirna_val" placeholder="Search by MicroRNA">
                    </div>
                </div>
                <div id="display_mirna" style="position: absolute; max-height: 150px; overflow: auto;"></div>
            </div>
            
            <!-- Decreased width for cancer_val input box -->
            <div class="col-lg-5 col-md-5 col-sm-12" style="float: left;">
                <div class="form-group" style="">
                    <div class="controls">
                        <input type="text" style="border: 1px solid #425666;" class="form-control" name="cancer_val" id="cancer_val" placeholder="Search by Cancer Type">
                    </div>
                </div>
                <div id="display_cancer" style="position: absolute; max-height: 160px; overflow: auto;"></div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-5 col-sm-12" style="text-align: center; margin: auto;">
            <div class="form-group" style="">
                <input class="btn btn-primary" type="submit" name="search_btn" id="search_btn" value="Search" style="background: #1a2340; border: #1a2340; width: 80%;">
            </div>
        </div>
    </form>	
	
    
</div>

								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			
			
	

<?php
					
					
					$result_cancer=mysqli_query($conn,$sql_cancer);
					$result_mirna=mysqli_query($conn,$sql_mirna);
					$result_ref=mysqli_query($conn,$sql_ref);
					
					
					$row_cancer=mysqli_fetch_assoc($result_cancer);
					$row_mirna=mysqli_fetch_assoc($result_mirna);
					$row_ref=mysqli_fetch_assoc($result_ref);
					
					
?>	
			
			
			<section class="py-3 py-md-2">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-7 col-md-10 text-center">
							<div class="sec-heading center">
								<h2 style="text-transform: none;">A brief summary of the 
								
								<span style="text-transform: lowercase; font-family: Monotype Corsiva;font-size: 2.5rem;">nami</span>
								<span style="margin-right: -1%;margin-left: -0.5%;font-family: Monotype Corsiva;font-size: 2.5rem;">R</span>
								<span style="text-transform: lowercase; font-family: Monotype Corsiva; font-size: 2.5rem;">a</span>
								
								
								
								database</h2>
							</div>
						</div>
					</div>	
					
					<div class="row mt-n2">
						<!-- MicroRNA Species -->
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="achievement-wrap">
								<div class="achievement-content">
									<h4 style="color: #0b8904;"><?php echo($row_mirna['count']); ?></h4>
									<p style="color: #0000FF;">MicroRNA Species</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="achievement-wrap">
								<div class="achievement-content">
									<h4 style="color: #0b8904;"><?php echo($row_cancer['count']); ?></h4>
									<p style="color: #0000FF;">Cancers Types</p>
								</div>
							</div>
						</div>						
						
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="achievement-wrap">
								<div class="achievement-content">
									<h4 style="color: #0b8904;"><?php echo($row_ref['count']); ?></h4>
									<p style="color: #0000FF;">Reviewed Articles</p>
								</div>
							</div>
						</div>
					</div>
					

					<div class="col-lg-12 col-md-12 col-sm-12 mt-5 text-center">
                        <img src="/assets/img/namiRa_Schematic.png" class="img-fluid" alt="namiRa Schematic">
                    </div>

					
					<!-- Description -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        </br></br>
                        <div class="bordered-paragraph">
                    	<p class="text-justify">
                    		<b style="font-family: Monotype Corsiva; font-size: 1.5rem;">namiRa</b> provides a comprehensive resource for microRNA expression, function, and deregulation in various human malignancies. 
                    	</br>
                    	   The current version of <span style="font-family: Monotype Corsiva; font-size: 1.25rem;">namiRa</span> documents curated relationships between <?php echo($row_mirna['count']); ?> human microRNA species and <?php echo($row_cancer['count']); ?> human cancer types based on more than <?php echo($row_ref['count']); ?> published papers. 
                    	</br>
                    	    Each entry in the <span style="font-family: Monotype Corsiva; font-size: 1.25rem;">namiRa</span> contains detailed information on microRNA-cancer relationships, including microRNA ID, cancer type, microRNA expression patterns, detection methods of microRNAs, description of microRNA functional analyses (in vitro and in vivo research), and experimentally verified microRNA target gene(s), along with the related references.
                    	</br></br>
                    	    <b>The most important and unique features of <span style="font-family: Monotype Corsiva; font-size: 1.25rem;">namiRa</span>: </b>
                    	</p>
                    	<ul>
                          <li style="list-style-type: disc;">
                              The most comprehensive resource for microRNA expression in various cancers
                          </li>
                          <li style="list-style-type: disc;">
                              The most thorough database for microRNA functions and deregulations in different human tumors and cancers
                          </li>
                          <li style="list-style-type: disc;">
                              Presentation of the detailed findings of more than <?php echo($row_ref['count']); ?> published papers on microRNA-cancer relationships
                          </li>
                        </ul>
                        </div>
                    </div>
				</div>
			</section>
			<div class="clearfix"></div>	
			
			<div class="pb-5"></div>
			
			<section class="theme-bg call-to-act-wrap py-4 px-2">
				<div class="container">
					<div class="row">
						<div class="col-lg-12" style="text-align: center;">
							
							<div class="call-to-act">
								<div class="row call-to-act-head">
<div class="col-lg-7 col-md-7 col-sm-12 text-center text-lg-start">
<p class="fw-bold fs-5 mb-0">
    Submit your email address here to get news and updates on 
    <span class="font-italic fs-4" style="font-family: Monotype Corsiva;">namiRa</span>
</p>
</div>
								

<div class="col-lg-5 col-md-5 col-sm-12 justify-content-center justify-content-lg-start">								
    <form class="row gx-4 gy-2 align-items-center">
        <!-- Email Input -->
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <input 
                    type="text" 
                    class="form-control" 
                    id="email-subscribe" 
                    name="email-subscribe" 
                    placeholder="Enter E-mail" 
                    required 
                >
            </div>
        </div>
        <!-- Submit Button -->
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <input 
                    type="submit" 
                    class="form-control text-white fw-bold rounded-pill" 
                    id="subscribe" 
                    name="subscribe" 
                    value="Subscribe"
                    style="background-color: orange; border: 4px solid #0F52BA; font-size: 1rem; min-width: 100px;"
                >
            </div>
        </div>
    </form>
</div>




								
								
								
								</div>
								
							</div>
							
						</div>
					</div>
				</div>
			</section>
			
			<div class="clearfix"></div>
			
			
<div class="modal fade" id="SubscribeModal" tabindex="-1" role="dialog" aria-labelledby="SubscribeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SubscribeModalLabel">Subscribing</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="message">
      </div>
    </div>
  </div>
</div>			
			

<script>
    
 function fill(Value) {
   //Assigning value to "search" div in "search.php" file.
   $('#mirna_val').val(Value);
   //Hiding "display" div in "search.php" file.
   $('#display_mirna').hide();
}


 function fill_cancer(Value) {
   //Assigning value to "search" div in "search.php" file.
   $('#cancer_val').val(Value);
   //Hiding "display" div in "search.php" file.
   $('#display_cancer').hide();
}


$(document).ready(function() {
   //On pressing a key on "Search box" in "search.php" file. This function will be called.
   $("#mirna_val").keyup(function() {
       //Assigning search box value to javascript variable named as "name".
       var name = $('#mirna_val').val();
       //Validating, if "name" is empty.
       if (name == "") {
           //Assigning empty value to "display" div in "search.php" file.
           $("#display_mirna").html("");
       }
       //If name is not empty.
       else if(name.length >= 3){
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: "livesearch.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "name" into "search" variable.
                   mirna_search: name
               },
               //If result found, this funtion will be called.
               success: function(html) {
                   //Assigning result to "display" div in "search.php" file.
                   $("#display_mirna").html(html).show();
               }
           });
       }
   });
   
   
   
   $("#cancer_val").keyup(function() {
       //Assigning search box value to javascript variable named as "name".
       var cancer_name = $('#cancer_val').val();
       //Validating, if "name" is empty.
       if (cancer_name == "") {
           //Assigning empty value to "display" div in "search.php" file.
           $("#display_cancer").html("");
       }
       //If name is not empty.
       else if(cancer_name.length >= 3) {
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: "livesearch.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "name" into "search" variable.
                   cancer_search: cancer_name
               },
               //If result found, this funtion will be called.
               success: function(html) {
                   //Assigning result to "display" div in "search.php" file.
                   $("#display_cancer").html(html).show();
               }
           });
       }
   });  
   
   
$('#subscribe').click(function(e) {
    e.preventDefault(); // Prevent the form from submitting

    // Retrieve the email value from the input field
    var email = $('#email-subscribe').val();
    var subscribe = "true";

    // Create an AJAX request to the PHP file
    $.ajax({
      url: 'insert_email.php',
      type: 'POST',
      data: {subscribe_btn: subscribe, email: email},
      success: function(response) {
        // Display success message in the modal
        console.log(response);
        $('#message').text(response);
        
        // Show the modal using Bootstrap's method
        $('#SubscribeModal').modal('show');

        // Add a delay to hide the modal after 5 seconds (2000 milliseconds)
        setTimeout(function(){
            $('#SubscribeModal').modal('hide');
        }, 1000);
      },
      error: function(xhr, status, error) {
        // Display error message in the console
        $('#message').text(error);
      }
    });
});

   
   
   
});   
    
    
    
</script>

			
<?php require_once("footer.php");?>