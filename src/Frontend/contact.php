<?php require_once("../header.php");?>
			
			<!-- ============================ Page Title Start================================== -->
			<div class="page-title" style="height: 70px;">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title">Contact Us</h2>
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->

			<section>
			
				<div class="container">
				
					<!-- row Start -->
					<div class="row">
						<div class="col-lg-7 col-md-7">
							<form action="../Backend/contact.php" class="local-form content-box" method='post' enctype='multipart/form-data'>	
								<div class="row">
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>*Full name</label>
											<input type="text" class="form-control simple" id="full_name" name="full_name" value="" required>
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>*Email</label>
											<input type="email" class="form-control simple" id="email" name="email" value="" required>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label>*Subject</label>
									<input type="text" class="form-control simple" id="subject" name="subject" value="" required>
								</div>
								
								<div class="form-group">
									<label>*Message</label>
									<textarea class="form-control simple" id="message" name="message" value="" required></textarea>
								</div>
								
								<div class="form-group">
									<input class="btn btn-theme-light-2 rounded" type="submit" name="submit_btn" id="submit_btn"  value="Submit Message">
								</div>
							</form>
						</div>
						
						<div class="col-lg-5 col-md-5">
							<div class="contact-info">
								
								<h2 style="text-transform: none;">Feel free to contact us</h2>
								<p>If you have any comments, suggestions, or questions, please get in touch with us. </p>
								</br>
								
								<div style="">
										<i class='fas fa-envelope-open-text' aria-hidden="true" style="font-size: 36px; color: blue"></i>
										<span class="footer-text" ><a href="mailto:sh.moradi@royan-rc.ac.ir" style="text-decoration: none;"><span> &nbsp;sh.moradi@royan-rc.ac.ir (Dr. Sharif Moradi)</span></a></span>
									</div>
								</br>
								
								<div style="">
										<i class='fas fa-envelope-open-text' aria-hidden="true" style="font-size: 36px; color: blue"></i>
										<span class="footer-text" ><a href="mailto:info@namira-db.com" style="text-decoration: none;"><span> &nbsp;info@namira-db.com (namiRa support team)</span></a></span>
									</div>
								</br>
								
								<div style="">
										<i class="fa fa-phone-square" style="font-size: 36px; color: blue"></i>
										 <a href="tel:982123562760" style="text-decoration: none;">&nbsp;+98 21 2356 2760</a>    
                                </div>
								
							</div>
						</div>
						
					</div>
					<!-- /row -->		
					
				</div>
						
			</section>

<?php require_once("../footer.php");?>		
