<?php require_once("config.php"); require_once("../header.php"); 
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
	    if(isset($_POST['insert_btn']) && !empty($_POST['insert_btn'])){

			$query_statment=array();
			$query_value=array();

//id
            $result_id_sql=mysqli_query($conn,$id_sql);
            $report_id_sql = mysqli_fetch_assoc($result_id_sql);
            $mirna_id=$report_id_sql['max_id']+1;
			
			array_push($query_statment,'id');
			array_push($query_value,$mirna_id);


            $given_name=$_POST['given_name'];
			array_push($query_statment,'given_name');
			array_push($query_value,$given_name);
			
            $surname=$_POST['surname'];
			array_push($query_statment,'surname');
			array_push($query_value,$surname);
			
            $affilation=$_POST['affilation'];
			array_push($query_statment,'affilation');
			array_push($query_value,$affilation);
			
            $email_address=$_POST['email_address'];
			array_push($query_statment,'email_address');
			array_push($query_value,$email_address);


			
            $mirna_name=$_POST['mirna_name'];
			array_push($query_statment,'mirna_name');
			array_push($query_value,$mirna_name);

            $cancer_type=$_POST['cancer_type'];
			array_push($query_statment,'cancer_type');
			array_push($query_value,$cancer_type);				
			
			
            $doi=$_POST['doi'];
			if (preg_replace('/\s+/', '',$doi )!=''){
				array_push($query_statment,'doi');
				array_push($query_value,$doi);								
			}
			
            $title=$_POST['title'];
			if (preg_replace('/\s+/', '',$title )!=''){
				array_push($query_statment,'title');
				array_push($query_value,$title);								
			}
			
			$comment=$_POST['comment'];
			if (preg_replace('/\s+/', '',$comment )!=''){
				array_push($query_statment,'comment');
				array_push($query_value,$comment);								
			}


            //Query
			$query_statment = implode(',', $query_statment);	
			$query_value = implode("','", $query_value);				
            
            $result_add=mysqli_query($conn,$sql_result);
            
            
            
    		if($result_add){

    		    echo("<h2 style='text-align: center;color: green;'>Uploading miRNA information has been successful!</h2>");  
    		}else{
    		    echo("<h2 style='text-align: center;color: red;'>Information can not be submitted!</h2>");
    		}

				
	    }
	    
	    
	    ?>
	            </section>
			</div>		  
		</div>

<?php require_once("../footer.php");?>
