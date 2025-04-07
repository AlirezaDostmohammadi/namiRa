    <style>
.toolt {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.toolt .toolttext {
  visibility: hidden;
  width: 3000%;
  background-color: darkgray;
  color: black;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.toolt:hover .toolttext {
  visibility: visible;
}

/* Synchronize horizontal scrollbars */
.table-scrollbar {
    overflow-x: auto;
    overflow-y: hidden; /* Prevent vertical scroll inside the table container */
    position: relative;
    margin-bottom: 10px;
}

.table-scrollbar-top {
    overflow-x: auto;
    overflow-y: hidden;
    position: relative;
    height: 20px; /* Match scrollbar height */
    background: transparent; /* Optional: to match design */
    border-bottom: 1px solid #000000; /* Visual separation (optional) */
}

.table-scrollbar-top::-webkit-scrollbar,
.table-scrollbar::-webkit-scrollbar {
    height: 10px; /* Scrollbar height */
}

.table-scrollbar-top::-webkit-scrollbar-thumb,
.table-scrollbar::-webkit-scrollbar-thumb {
    background-color: #c1c1c1; /* Scrollbar color */
    border-radius: 5px;
}

.table-scrollbar table {
    margin: 0;
    padding: 0;
}

</style>

<?php require_once("../Backend/config.php"); require_once("../header.php"); ?>

			<!-- ============================ Page Title Start================================== -->
			<div class="page-title" style='height: auto;position: relative;'>
				<div class="container">
					<div class="row align-items-center">
							
							<div class="col-lg-3 col-md-4 col-sm-12">
							<h2 class="ipt-title">search Results</h2>
							</div>
									<div class="col-lg-9 col-md-8 col-sm-12">		
										<form class="row g-2" action="simple_search_result.php" method="post" style="margin-top: auto; margin-bottom: auto;">
												<div class="col-lg-5 col-md-6 col-sm-12">
												    <?php
												    if (isset($_POST['mirna_val'])&& trim($_POST['mirna_val'],' ')!='' || isset($_GET['mirna'])&& trim($_GET['mirna'],' ')!=''){
														
														if (isset($_POST['mirna_val'])&& trim($_POST['mirna_val'],' ')!=''){
															$mirna_value = '"'.trim($_POST['mirna_val'], ' ').'"';
														}else{
															$mirna_value = '"'.trim($_GET['mirna'], ' ').'"';
														}
														
														echo('
																<div class="form-group">
																	<div class="controls">
																		<input type="text" style="border: 1px solid #425666;" class="form-control" name="mirna_val" id="mirna_val" placeholder="Search by miRNA" value='.$mirna_value.'>
																	</div>
																</div>														
															');
														
													}else{
														echo('												
																<div class="form-group">
																	<div class="controls">
																		<input type="text" style="border: 1px solid #425666;" class="form-control" name="mirna_val" id="mirna_val" placeholder="Search by miRNA">
																	</div>
																</div>														
															');
														
													}
												    ?>
													
													<div id="display_mirna" class="autocomplete-list" style="position: absolute;"></div>
												</div>
												<div class="col-lg-5 col-md-6 col-sm-12">
												
												    <?php
												    if (isset($_POST['cancer_val'])&& trim($_POST['cancer_val'],' ')!='' || isset($_GET['cancer_type'])&& trim($_GET['cancer_type'],' ')!=''){
														
														if (isset($_POST['cancer_val'])&& trim($_POST['cancer_val'],' ')!=''){
															$cancer_value = '"'.trim($_POST['cancer_val'], ' ').'"';
														}else{
															
															$cancer_value = '"'.trim($_GET['cancer_type'], ' ').'"';
														}
														
														echo('
																<div class="form-group">
																	<div class="controls">
																		<input type="text" style="border: 1px solid #425666;" class="form-control" name="cancer_val" id="cancer_val" placeholder="Search by Cancer type" value='.$cancer_value.'>
																	</div>
																</div>														
															');
														
													}else{
														echo('												
																<div class="form-group">
																	<div class="controls">
																		<input type="text" style="border: 1px solid #425666;" class="form-control" name="cancer_val" id="cancer_val" placeholder="Search by Cancer type">
																	</div>
																</div>														
															');
														
													}
												    ?>												
													<div id="display_cancer" class="autocomplete-list" style="position: absolute;"></div>
												</div>
											
											<div class="col-lg-2 col-md-12 col-sm-12" style="margin-top: auto; margin-bottom: auto;">
												<div class="form-group">
													<input class="btn btn-primary w-100" type="submit" name="search_btn" id="search_btn" value="Search" style="background: #1a2340; border: #1a2340; height: inherit;width: 100%;">
												</div>
											</div>
										</form>	
										
									
										
									</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			<section>
				<div class="container" style="margin-left: 1%; max-width: 97%;">
					<div class="pricing pricing-5">
					
					<!-- Top Scrollbar -->
        <div class="table-scrollbar-top"></div>
		<div class="table-scrollbar">

  
	<?php
	    if(isset($_POST['search_btn']) && !empty($_POST['search_btn'])|| trim($_GET['btn'],' ')!=''){
	                
        	if(isset($_POST['mirna_val'])&& trim($_POST['mirna_val'],' ')!='' || isset($_POST['cancer_val'])&& trim($_POST['cancer_val'],' ')!='' || trim($_GET['mirna'],' ')!='' || trim($_GET['cancer_type'],' ')!='' || trim($_GET['val'],' ')!=''){
        	    
        	    
        	    #page number
					if(isset($_GET['page'])){
						$pageNumber = (int)$_GET['page'];
					}else{
						$pageNumber = 1;	
					}
										
					$min = ($pageNumber*20)-20; 
					
				# sort by	
					if(isset($_GET['sort'])){
						$sort_by = $_GET['sort'];
					}else{
						$sort_by = "cancer";	
					}
					
				if ($sort_by == "cancer"){
					$sort_obj = "cancer_type";
				}else{
					$sort_obj = "miRNA";
				}
					
					
				#record number
				$cnt=$min+1;
				if(trim($_GET['btn'],' ')=='cancer'){
					$search_val = trim($_GET['cancer_type'],' ');
					#query
					$result = mysqli_query($conn,$sql);
					
					$seach_query = "btn=cancer&cancer_type=$search_val&sort=$sort_by";
					
				}else if(trim($_GET['btn'],' ')=='mirna'){
					$search_val = trim($_GET['mirna'],' ');
					// Use str_replace to replace 'hsa' with ''
					$search_val = str_replace('hsa-', '', $search_val);
					$search_val = str_replace('hsa', '', $search_val);
					#query
					$result = mysqli_query($conn,$sql);
					$seach_query = "btn=mirna&mirna=$search_val&sort=$sort_by";
				
				}else{
					if(trim($_GET['btn'],' ')=='search'){
						if (isset($_GET['mirna'])&& trim($_GET['mirna'],' ')!=''){
							if (isset($_GET['cancer_type'])&& trim($_GET['cancer_type'],' ')!=''){
								# both
								$mirna = trim($_GET['mirna'],' ');
								// Use str_replace to replace 'hsa' with ''
								$mirna = str_replace('hsa-', '', $mirna);
								$mirna = str_replace('hsa', '', $mirna);
								
								$cancer_type = trim($_GET['cancer_type'],' ');
								#query
								$result = mysqli_query($conn,$sql);				
								$seach_query = "btn=search&mirna=$mirna&cancer_type=$cancer_type&sort=$sort_by";
							}else{
								// only mirna
								$mirna = trim($_GET['mirna'],' ');
								// Use str_replace to replace 'hsa' with ''
								$mirna = str_replace('hsa-', '', $mirna);
								$mirna = str_replace('hsa', '', $mirna);
								#query
								$result = mysqli_query($conn,$sql);
												
								$seach_query = "btn=search&mirna=$mirna&sort=$sort_by";
							}
						}else{
							// only cancer
							$cancer_type = trim($_GET['cancer_type'],' ');
							#query
							$result = mysqli_query($conn,$sql);
							$seach_query = "btn=search&cancer_type=$cancer_type&sort=$sort_by";
						}
					}else{
						if (isset($_POST['mirna_val'])&& trim($_POST['mirna_val'],' ')!=''){
							if (isset($_POST['cancer_val'])&& trim($_POST['cancer_val'],' ')!=''){
								# both
								$mirna = trim($_POST['mirna_val'],' ');
								// Use str_replace to replace 'hsa' with ''
								$mirna = str_replace('hsa-', '', $mirna);
								$mirna = str_replace('hsa', '', $mirna);
								
								$cancer_type = trim($_POST['cancer_val'],' ');
								#query
								$result = mysqli_query($conn,$sql);			
								$seach_query = "btn=search&mirna=$mirna&cancer_type=$cancer_type&sort=$sort_by";
								
							}else{
								// only mirna
								$mirna = trim($_POST['mirna_val'],' ');
								// Use str_replace to replace 'hsa' with ''
								$mirna = str_replace('hsa-', '', $mirna);
								$mirna = str_replace('hsa', '', $mirna);
								
								#query
								$result = mysqli_query($conn,$sql);
								$seach_query = "btn=search&mirna=$mirna&sort=$sort_by";
							}
						}else{
							// only cancer
							$cancer_type = trim($_POST['cancer_val'],' ');
							#query
							$result = mysqli_query($conn,$sql);
							$seach_query = "btn=search&cancer_type=$cancer_type&sort=$sort_by";
						}
					}		
				}						

$sort_cancer_seach_query = str_replace("sort=mirna","sort=cancer",$seach_query);
$sort_mirna_seach_query = str_replace("sort=cancer","sort=mirna",$seach_query);
echo('
<table class="table table-bordered" style="text-align: center;width: 300%; border-collapse: separate; overflow: scroll;">
  
  <tr style="font-weight: bolder;background-color: lightgray;">
  <th rowspan="3" colspan="1">Index</th>
    <th rowspan="3" colspan="1">Cancer Type
	
	<a class="page-link" href="simple_search_result.php?'.$sort_cancer_seach_query.'" style="float: right; background: lightgray; border: lightgray; display: contents;">
		<i class="fa fa-sort"></i>				
	</a>

    </th>
    <th rowspan="3" colspan="2">MicroRNA
    <a class="page-link" href="simple_search_result.php?'.$sort_mirna_seach_query.'" style="float: right; background: lightgray; border: lightgray; display: contents;">
		<i class="fa fa-sort"></i>				
	</a>
    </th>
    <th rowspan="3" colspan="1">Regulatory Network
    <div class="toolt"><i class="fa fa-question-circle"></i>
          <span class="toolttext">
Visual regulatory network involving the microRNA based on published data
          </span>
        </div>
    </th>
    <th colspan="15">Results</th>
    <th rowspan="3" colspan="1">General Info</th>
    <th rowspan="3" colspan="1">Predicted Targets</th>
    <th rowspan="3" colspan="1">Validated Targets</th>
    <th rowspan="3" colspan="1">GO Terms
                        <div class="toolt"><i class="fa fa-question-circle"></i>
          <span class="toolttext">
Gene ontology (GO) terms and biological pathways involving the microRNA
          </span>
        </div> 
    </th>
    <th rowspan="3" colspan="1">References</th>
  </tr>
  <tr style="font-weight: bolder;background-color: lightgray;">
    <th colspan="5">Regulation</th>
    <th colspan="4">In Vitro</th>
    <th colspan="4">In Vivo</th>
    <th rowspan="2" colspan="2">Main Targets
                    <div class="toolt"><i class="fa fa-question-circle"></i>
          <span class="toolttext">
Main gene transcripts regulated by the microRNA
          </span>
        </div> 
    </th>
  </tr>
  <tr style="font-weight: bolder;background-color: lightgray;">
    <th colspan="2">Up/Down
        <div class="toolt"><i class="fa fa-question-circle"></i>
          <span class="toolttext">
The expression level of the microRNA
Detection Method: The method that has been used to detect the microRNA
          </span>
        </div>
    </th>
    <th colspan="1">Detection Method</th>
    <th colspan="2">Affected By
        <div class="toolt"><i class="fa fa-question-circle"></i>
          <span class="toolttext">
Indicates whether any agent or molecule affects the microRNA expression
          </span>
        </div>    
    </th>
    <th colspan="2">Promotes
            <div class="toolt"><i class="fa fa-question-circle"></i>
          <span class="toolttext">
What does the microRNA promote?
          </span>
        </div>  
    </th>
    <th colspan="2">Inhibits
                <div class="toolt"><i class="fa fa-question-circle"></i>
          <span class="toolttext">
What does the microRNA inhibit?
          </span>
        </div>  
    </th>
    <th colspan="2">Promotes</th>
    <th colspan="2">Inhibits</th>    
  </tr>

');				
				
				
				
				
				if(isset($result) && !empty($result)){
					while($row=mysqli_fetch_assoc($result)){
						$pubmed_ids = explode(",", $row["ref"]); // split string into an array based on comma delimiter
						$ref_links = "";
						foreach ($pubmed_ids as $key => $link) {
							$link = trim($link); // trim whitespace from the beginning and end of each substring
							if ($key === array_key_last($pubmed_ids)) {
								$link = "<a href='https://pubmed.ncbi.nlm.nih.gov/$link/' target='_blank' style='color: blue;'>$link</a>";
								$ref_links .= $link;
							}else{
								$link = "<a href='https://pubmed.ncbi.nlm.nih.gov/$link/' target='_blank' style='color: blue;'>$link</a>";
								$link .= ", ";  
								$ref_links .= $link;
							}
						}	

                        $consider_cancer = trim($row["cancer_type"]);
                        $consider_mirna=trim($row["miRNA"], ' ');
                        
                        // Removing patterns enclosed in parentheses for both miRNA and cancer
                        $cancer_for_network = preg_replace('/\s?\(.*?\)\s?/', ' ', $consider_cancer);
                        
                        $mir_for_network = preg_replace('/\s?\(.*?\)\s?/', ' ', $consider_mirna);
                        
                        // Removing colons from the cancer string
                        $cancer_cleaned = str_replace(":", "", $cancer_for_network);
                        
                        $link_network_pdf = '/network/pdf/' . $cancer_cleaned . '.' . $mir_for_network . '.pdf';
                        
                        $link_network_jpg = '/network/jpg/' . $cancer_cleaned . '.' . $mir_for_network . '.jpg';
                        
                        $link_network_final = "<a href='$link_network_pdf' target='_blank' '><i class='fas fa-file-pdf' style='font-size: 36px; color:red;'></i></a>
                        
                        <a href='$link_network_jpg' target='_blank' '><i class='fas fa-file-image' style='font-size: 36px; color:blue;'></i></a>
                        ";
                        
						$mirbase_link = "<a href='https://www.mirbase.org/results/?query=hsa-$consider_mirna' target='_blank' style='color: blue;'>miRBase</a>";
						
						$miRTarBase = "<a href='https://mirtarbase.cuhk.edu.cn/~miRTarBase/miRTarBase_2022/php/search.php?org=hsa&opt=mirna_id&kw=$consider_mirna' target='_blank' style='color: blue;'>miRTarBase</a>,";
					
						$target_scan_human_link = "<a href='https://www.targetscan.org/cgi-bin/targetscan/vert_80/targetscan.cgi?species=Human&gid=&mir_sc=&mir_c=&mir_nc=&mir_vnc=&mirg=$consider_mirna' target='_blank' style='color: blue;'>TargetScanHuman</a>,";
						$miRDB_link = "<a href='https://mirdb.org/cgi-bin/search.cgi?searchType=miRNA&searchBox=hsa-$consider_mirna&full=1' target='_blank' style='color: blue;'>miRDB</a>";	
						$TargetMiner_link = "<a href='https://www.isical.ac.in/~bioinfo_miu/final_html_targetminer/hsa-$consider_mirna.html' target='_blank' style='color: blue;'>TargetMiner</a>,";	
						
						$Predicted_targets_links = $target_scan_human_link ."</br>".$TargetMiner_link."</br>".$miRDB_link;
						
						$TarBase = "<a href='https://dianalab.e-ce.uth.gr/tarbasev9/interactions?gene=&mirna=hsa-$consider_mirna' target='_blank' style='color: blue;'>TarBase</a>";
						
						
						$mir_path_link = "<a href='https://dianalab.e-ce.uth.gr/html/mirpathv3/index.php?r=mirpath#mirnas=hsa-$consider_mirna' target='_blank' style='color: blue;'>mirPath</a>";
						
						$validated_target = $miRTarBase."</br>".$TarBase;
						
						$cancer_link = "simple_search_result.php?page=1&btn=cancer&cancer_type=".$row['cancer_type']."&sort=".$sort_by;
						$mirna_link = "simple_search_result.php?page=1&btn=mirna&mirna=".$row['miRNA']."&sort=".$sort_by;
						
						if ($cnt %2 == 1){
						    $color = "#58A3BC";
						}else{
						    $color = "#CAFAFE";
						}
						
						echo("
							  <tr style='background: $color'>
								  <td rowspan='1' colspan='1'>$cnt</td>
								  <td rowspan='1' colspan='1'><a href='$cancer_link' style='color:blue'>$row[cancer_type]</a></td>
								  <td rowspan='1' colspan='2' style='width: 4%;'><a href='$mirna_link' style='color:blue'>$row[miRNA]</a></td>
								  <td rowspan='1' colspan='1'>$link_network_final</td>
								  <td colspan='2'>$row[reg_up_down]</td>
								  <td colspan='1'>$row[reg_detection_method]</td>
								  <td colspan='2'>$row[reg_affected_by]</td>
								  <td colspan='2'>$row[in_vitro_promotes]</td>
								  <td colspan='2'>$row[in_vitro_inhibits]</td>
								  <td colspan='2'>$row[in_vivo_promotes]</td>
								  <td colspan='2'>$row[in_vivo_inhibits]</td>
								  <td rowspan='1' colspan='2'>$row[main_targets]</td>
								  <td rowspan='1' colspan='1'>$mirbase_link</td>
								  <td rowspan='1' colspan='1'>$Predicted_targets_links</td>
								  <td rowspan='1' colspan='1'>$validated_target</td>
								  <td rowspan='1' colspan='1'>$mir_path_link</td>
								  <td rowspan='1' colspan='1'>$ref_links</td>
							  </tr>
						");
						$cnt=$cnt+1; 
					}
				}
					
        	}
	    }
	?>					

			
</table>
</div>
						
                    </div>
				</div>
				
				<!-- Pagination -->
				
<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 2%;">
									<ul class="pagination p-center">				
				
				<?php

	    #pagination
		
		if(trim($_GET['btn'],' ')=='cancer'){
			#query
			$resultCount = mysqli_query($conn,$countSql);
					
		}else if(trim($_GET['btn'],' ')=='mirna'){
			#query
			$resultCount = mysqli_query($conn,$countSql);
				
		}else{	
			$resultCount = mysqli_query($conn,$countSql);
					
		}	
    					
    	
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
                        <a class="page-link" href="simple_search_result.php?page=1&'.$seach_query.'" 
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
                            <li class="page-item"><a class="page-link" href="simple_search_result.php?page='.$i.'&'.$seach_query.'">'.$i.'</a></li>
                        ');
                } 
            }else{
                if($pageNumber-3>0){
                    
                echo('
                        <li class="page-item"><a style="border: 0px;">......</a></li>
                    '); 

				$prev = $pageNumber-1; 
                    
                echo('
                        <li class="page-item">
						<a class="page-link d-flex align-items-center justify-content-center" href="simple_search_result.php?page='.$prev.'&'.$seach_query.'" aria-label="Previous"
						 style="background: #35434e; border: 1px solid #35434e; color: white;">
							<span class="ti-arrow-left"></span>
							<span class="sr-only">Previous</span>
						
						</a></li>
                    ');                     
                    for($i=$pageNumber-3;$i<$pageNumber;$i++){
                        echo('
                                <li class="page-item"><a class="page-link" href="simple_search_result.php?page='.$i.'&'.$seach_query.'">'.$i.'</a></li>
                            ');
                    } 
                    
                }else{
                    for($i=1;$i<$pageNumber;$i++){
                        echo('
                                <li class="page-item"><a class="page-link" href="simple_search_result.php?page='.$i.'&'.$seach_query.'">'.$i.'</a></li>
                            ');
                    }                       
                }
              
            }
			

//current page
                    echo('
                            <li class="page-item active"><a class="page-link" href="simple_search_result.php?page='.$i.'&'.$seach_query.'">'.$pageNumber.'</a></li>
                        ');

$current=$i;


//after 

if ($pagesCount-$pageNumber>3){
    
            for($i=$pageNumber+1;$i<$pageNumber+4;$i++){
                
                
                echo('
                        <li class="page-item"><a class="page-link" href="simple_search_result.php?page='.$i.'&'.$seach_query.'">'.$i.'</a></li>
                    ');
            }    
                $next = $pageNumber+1; 
                echo('
                        <li class="page-item">
						<a class="page-link d-flex align-items-center justify-content-center" href="simple_search_result.php?page='.$next.'&'.$seach_query.'" aria-label="Next"
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
                        <li class="page-item"><a class="page-link" href="simple_search_result.php?page='.$i.'&'.$seach_query.'">'.$i.'</a></li>
                    ');
            }  
    
}

//last            
            if($pageNumber != $pagesCount && $pagesCount>1){
                echo('
                    <li class="page-item">
                        <a class="page-link" href="simple_search_result.php?page='.$last.'&'.$seach_query.'" 
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
			
<script>
<?php
					if(!isset($_GET['btn'])){
						if (isset($_POST['mirna_val'])&& trim($_POST['mirna_val'],' ')!=''){
							if (isset($_POST['cancer_val'])&& trim($_POST['cancer_val'],' ')!=''){
								// both
								echo('window.history.pushState("", "Title", "simple_search_result.php?btn=search&mirna='.$mirna.'&cancer_type='.$cancer_type.'");   ');
							}else{
								echo('window.history.pushState("", "Title", "simple_search_result.php?btn=search&mirna='.$mirna.'");   ');
							}
						}else{
							echo('window.history.pushState("", "Title", "simple_search_result.php?btn=search&cancer_type='.$cancer_type.'");   ');
						}
						
					}
?>
 
</script>


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



   document.addEventListener("DOMContentLoaded", function () {
    const tableContainer = document.querySelector(".table-scrollbar");
    const topScrollbar = document.querySelector(".table-scrollbar-top");

    // Ensure the top scrollbar matches the table width
    function syncScrollbars() {
        const tableWidth = tableContainer.scrollWidth;
        topScrollbar.innerHTML = ""; // Clear any existing content
        const phantomTable = document.createElement("div");
        phantomTable.style.width = tableWidth + "px";
        phantomTable.style.height = "1px"; // Phantom element is not visible
        topScrollbar.appendChild(phantomTable);
    }

    // Sync scroll positions
    tableContainer.addEventListener("scroll", function () {
        topScrollbar.scrollLeft = tableContainer.scrollLeft;
    });

    topScrollbar.addEventListener("scroll", function () {
        tableContainer.scrollLeft = topScrollbar.scrollLeft;
    });

    // Call syncScrollbars initially and on window resize
    syncScrollbars();
    window.addEventListener("resize", syncScrollbars);
});


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
               url: "../livesearch.php",
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
               url: "../livesearch.php",
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
});   
    
    
    
</script>

<?php require_once("../footer.php");?>
