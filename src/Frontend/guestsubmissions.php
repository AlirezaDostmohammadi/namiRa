<?php require_once("../Backend/config.php"); require_once("../header.php"); ?>

			<!-- ============================ Page Title Start================================== -->
			<div class="page-title">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title" style="float: left; margin: revert;">Guest Submissions</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<section>
				<div class="container" style="margin-left: 1%; max-width: 97%;">
					<div class="pricing pricing-5" style="overflow: auto;">

  
	<?php
        	    #page number
				if(isset($_GET['page'])){
						$pageNumber = (int)$_GET['page'];
				}else{
						$pageNumber = 1;	
				}
										
					$min = ($pageNumber*20)-20; 
					
				#record number
				$cnt=$min+1;
				$result = mysqli_query($conn,$sql);
	?>
					
<table class="table table-bordered" style="text-align: center;width: 300%; border-collapse: separate; overflow: scroll;">
  
  <tr style="font-weight: bolder;background-color: lightgray;">
  <th >Index</th>
  <th >Given Name</th>
  <th >Surname</th>
  <th >Affilation</th>
  <th >Email</th>
  <th >MicroRNA</th>
  <th >Cancer Type</th>
  <th >References</th>
  <th >Title</th>
  <th >Comment</th>
  </tr>
  
  <?php
  
  if(isset($result) && !empty($result)){
		while($row=mysqli_fetch_assoc($result)){
					    
    		  if ($cnt %2 == 1){
				    $color = "#58A3BC";
			    }else{
					$color = "#CAFAFE";
			    }
    			
              echo("
            		<tr style='background: $color'>
            		<td>$cnt</td>
            		<td>$row[given_name]</td>
            		<td>$row[surname]</td>
            		<td>$row[affilation]</td>
            		<td>$row[email_address]</td>
            		<td>$row[mirna_name]</td>
            		<td>$row[cancer_type]</td>
            		<td>$row[doi]</td>
            		<td>$row[title]</td>
            		<td>$row[comment]</td>
            		</tr>
            	");
            	$cnt=$cnt+1; 
	}
  }
  ?>
</table>

						
                    </div>
				</div>
				
				<!-- Pagination -->
				
<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 2%;">
									<ul class="pagination p-center">
				
				<?php

	    #pagination
	    #query
		$resultCount = mysqli_query($conn,$countSql);
    	
    	if($resultCount){
    	
        	$rowCount = mysqli_fetch_assoc($resultCount);
        					
        	$limit = 20;
        					
        	$pagesCount = ceil($rowCount['count']/$limit);
        	$last = $pagesCount;
        	
        	
        	
        	#pagination
			//first page        	
        	$counter=0;
        	if($pageNumber != 1){
                    							
                $prev = $pageNumber-1;
                echo('
                    <li class="page-item">
                        <a class="page-link" href="guestsubmissions.php?page=1" 
						style="background: white; border: white; color: #5a6f7c;">
                                            First            
                        </a>
                    </li>
                
                ');
            }
			
			
//before            
            if($pageNumber<3){
                for($i=1;$i<$pageNumber;$i++){
                    echo('
                            <li class="page-item"><a class="page-link" href="guestsubmissions.php?page='.$i.'">'.$i.'</a></li>
                        ');
                } 
            }else{
                if($pageNumber-3>0){
                    
                echo('
                        <li class="page-item"><a style="border: 0px;">......</a></li>
                    '); 

				$prev = $pageNumber-1; 
                    
                echo('
                        <li class="page-item"><a class="page-link" href="guestsubmissions.php?page='.$prev.'" aria-label="Previous"
						 style="background: #35434e; border: 1px solid #35434e; color: white;">
							<span class="ti-arrow-left"></span>
							<span class="sr-only">Previous</span>
						
						</a></li>
                    ');                     
                    for($i=$pageNumber-3;$i<$pageNumber;$i++){
                        echo('
                                <li class="page-item"><a class="page-link" href="guestsubmissions.php?page='.$i.'">'.$i.'</a></li>
                            ');
                    } 
                    
                }else{
                    for($i=1;$i<$pageNumber;$i++){
                        echo('
                                <li class="page-item"><a class="page-link" href="guestsubmissions.php?page='.$i.'">'.$i.'</a></li>
                            ');
                    }                       
                }
              
            }
			

//current page
                    echo('
                            <li class="page-item active"><a class="page-link" href="guestsubmissions.php?page='.$i.'">'.$pageNumber.'</a></li>
                        ');

$current=$i;


//after 

if ($pagesCount-$pageNumber>3){
    
            for($i=$pageNumber+1;$i<$pageNumber+4;$i++){
                
                
                echo('
                        <li class="page-item"><a class="page-link" href="guestsubmissions.php?page='.$i.'">'.$i.'</a></li>
                    ');
            }    
                $next = $pageNumber+1; 
                echo('
                        <li class="page-item"><a class="page-link" href="guestsubmissions.php?page='.$next.'" aria-label="Next"
						style="background: #35434e; border: 1px solid #35434e; color: white;">
						
							<span class="ti-arrow-right"></span>
							<span class="sr-only">Next</span>
						
						
						</a></li>
                    '); 
                echo('
                        <li class="page-item"><a style="border: 0px;">......</a></li>
                    ');    

    
}else if ($pagesCount-$pageNumber>0){
            for($i=max($pagesCount-3,$pageNumber+1);$i<=$pagesCount;$i++){
                
                
                echo('
                        <li class="page-item"><a class="page-link" href="guestsubmissions.php?page='.$i.'">'.$i.'</a></li>
                    ');
            }  
    
}

//last            
            if($pageNumber != $pagesCount && $pagesCount>1){
                echo('
                    <li class="page-item">
                        <a class="page-link" href="guestsubmissions.php?page='.$last.'" 
						style="background: white; border: white; color: #5a6f7c;">
                                          Last           
                        </a>
                    </li>
                
                ');            
            }    	     	
    	    
    	}
			
			
			
?>
									</ul>
								</div>
							</div>
				
			</section>

<?php require_once("../footer.php");?>
