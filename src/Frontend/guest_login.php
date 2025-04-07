<?php require_once("../Backend/config.php"); require_once("../header.php"); ?>
			
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
			
			<section>
			


				<div class="container">
					<div class="hero-search-wrap" style="margin: auto;">
						<div class="hero-search">
							<h1>Guest Login</h1>
						</div>
						<form action="../Backend/guest_login.php" class="local-form content-box" method="post">
						<div class="hero-search-content side-form">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
																			<label class="control-label" for="username">Username</label>
									<div class="controls">
										<input class="form-control" id="username" name="username" placeholder="Username" type="text" value="">
									</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label class="control-label" for="password">Password</label>
									<div class="controls">
										<input class="form-control" id="password" name="password" placeholder="Password" type="password" value="">
									</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group hero-search-action" style="text-align: center; margin-top: 5%; margin-bottom: auto;">
						    <button class="btn btn-primary" type="submit" name="login-submit" id="login-submit" style="background: #1266e3; border: #1266e3; border-radius: 5px;">Sign in</button>
						</div>
						
						</form>
					</div>
				</div>

			</section>
			

			
<?php require_once("../footer.php");?>
