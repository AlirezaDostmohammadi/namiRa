<?php require_once("../Backend/config.php"); require_once("../header.php");
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
			
			<section class="bg-light">
			
				<div class="container">
					<div class="row">
						
						<div class="col-lg-12 col-md-12">
						
							<div class="submit-page">
							
								<div class="form-submit middle-logo">	
									<h3>Upload new 
									<span>M</span>
							<span style="text-transform: lowercase;margin: -2%; ">i</span>
							<span style="margin-right: -2%;text-transform: lowercase;">c</span>
							<span style="margin-right: -2%;text-transform: lowercase;">r</span>
							<span style="margin-right: -2%;text-transform: lowercase;">o</span>
							<span style="margin-right: -2%">R</span>
							<span style="margin-right: -2%">N</span>
							<span >A</span>
									
									
									</h3>
								</div>
								
								<form action="../Backend/guest_insert.php" class="local-form content-box" method='post' enctype='multipart/form-data'>
									<div class="form-submit">
										<div class="submit-section">
											<div class="row">
												
												<div class="form-group col-md-3">
													<label>First name</label>
													<input type="text" class="form-control" id="given_name" name="given_name" value="" required>
												</div>
												
												<div class="form-group col-md-3">
													<label>Last name</label>
													<input type="text" class="form-control" id="surname" name="surname" value="" required>
												</div>
												
												<div class="form-group col-md-3">
													<label>Affiliation</label>
													<input type="text" class="form-control" id="affilation" name="affilation" value="" required>
												</div>
												
												<div class="form-group col-md-3">
													<label>Email address</label>
													<input type="email" class="form-control" id="email_address" name="email_address" value="" required>
												</div>
											</div>
										</div>
									</div>
								
									<div class="form-submit">
										<div class="submit-section">
											<div class="row">
											
												<div class="form-group col-md-3">
													<label>MicroRNA</label>
													<input type="text" class="form-control" id="mirna_name" name="mirna_name" value="" required>
												</div>
												
												<div class="form-group col-md-3">
													<label>Cancer type</label>
													<input type="text" class="form-control" id="cancer_type" name="cancer_type" value="" required>
												</div>
												
												<div class="form-group col-md-3">
													<label>The title of the paper</label>
													<input type="text" class="form-control" id="title" name="title" value="">
												</div>
												
												<div class="form-group col-md-3">
													<label>Doi</label>
													<input type="text" class="form-control" id="doi" name="doi" value="" required>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-md-12" style="margin-bottom: 2%;">	
								<div class="form-group col-md-6">
									<label class="control-label" for="inputAddress">Comment</label>
									<div class="controls">
										<textarea name="comment" id="comment" class="form-control h-120"></textarea>
									</div>
								</div>
	                        </div>
								
									<div class="form-group col-lg-12 col-md-12" style="text-align: center; margin-top: 3%;">
										<input class="btn btn-theme-light-2 rounded" type="submit" name="insert_btn" id="insert_btn"  value="Submit">
									</div>
								</form>			
							</div>
						</div>
						
					</div>
				</div>
						
			</section>

	<?php require_once("../footer.php");?>