<!DOCTYPE html>
<html lang="en">
	
<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="icon" type="image/x-icon" href="/assets/img/namira.ico">
        
        
        <?php
                $page_name = explode('.',basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']))[0];
                if ($page_name == 'download'){
                    echo('
                        <title>Download</title>
                    ');                    
                } else if($page_name == 'contact'){
                    echo('
                        <title>Contact Us</title>
                    ');                    
                } else if($page_name == 'submit'){
                    echo('
                        <title>Upload New MicroRNA</title>
                    ');                   
                }else if($page_name == 'guest_login'){
                    echo('
                        <title>Guest Login</title>
                    ');                   
                }else if($page_name == 'guest_insert'){
                    echo('
                        <title>Upload New MicroRNA</title>
                    ');                   
                } else if($page_name =='advanced_search'){
                    echo('
                        <title>Advanced Search</title>
                    ');                    
                }else if($page_name =='api_help'){
                    echo('
                        <title>API Tutorial</title>
                    ');                    
                }else if($page_name =='search_result' || $page_name =='simple_search_result'){
                    echo('
                        <title>Search Result</title>
                    ');                    
                }else if($page_name =='admin_login'){
                    echo('
                        <title>Admin Login</title>
                    ');                    
                }else if($page_name =='dashboard'){
                    echo('
                        <title>Dashboard</title>
                    ');                    
                }else if($page_name =='admin_insert'){
                    echo('
                        <title>Insert new record</title>
                    ');                    
                }else if($page_name =='guestsubmissions'){
                    echo('
                        <title>Guest Submissions</title>
                    ');                    
                }else if($page_name =='admin_insert_cancer_related_words'){
                    echo('
                        <title>Insert Cancer-related words</title>
                    ');                    
                }else if($page_name =='admin_cancer_related_similar_words_edit'){
                    echo('
                        <title>Edit Cancer-related words</title>
                    ');                    
                }else if($page_name =='admin_cancer_related_words'){
                    echo('
                        <title>Cancer-related words</title>
                    ');                    
                }else{
                    echo('
                        <title>namiRa</title>
                    ');
                }
                
        ?>
		
		
		 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		 
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        
        <!-- Custom CSS -->
        <link href="/assets/css/styles.css" rel="stylesheet">
		
		<!-- Custom Color Option -->
		<link href="/assets/css/colors.css" rel="stylesheet">
		
        <!-- Include the Highlight.js CSS for the default theme. You can choose other themes if you want. -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/default.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
        
        <!-- Initialize Highlight.js -->
        <script>hljs.highlightAll();</script>
		
		  <style>
            .bordered-paragraph {
              border: 1px solid black; /* Sets a solid black border */
              border-radius: 4px;
              padding: 10px; /* Adds padding inside the border */
            }
          </style>
		
    </head>
	
    <body class="blue-skin">
	
		 <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div id="preloader"><div class="preloader"><span></span><span></span></div></div>
		
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
		
            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
            <!-- Start Navigation -->
            <?php
                $page_name = explode('.',basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']))[0];
                if ($page_name == 'download' or $page_name == 'guest_insert' or $page_name == 'guest_login' or $page_name == 'submit' or $page_name == 'contact' or $page_name =='advanced_search' or $page_name =='search_result' or $page_name =='simple_search_result' or $page_name =='api_help' or $page_name == 'admin_login' or $page_name == 'dashboard' or $page_name == 'admin_insert' or $page_name == 'guestsubmissions' or $page_name == 'admin_insert_cancer_related_words' or $page_name == 'admin_cancer_related_similar_words_edit' or $page_name == 'admin_cancer_related_words' or $page_name=='admin_cancer_related_similar_words_delete'){
                    echo('
                        <div class="header header-light head-shadow">
                    ');
                }else{
                    echo('
                        <div class="header header-transparent dark">
                    ');
                }
			
			
			if($page_name =='search_result' || $page_name =='simple_search_result'){
			    echo('<div class="header header-light head-shadow">');
			}
			
			
			 echo('
				<div class="container">
					<nav id="navigation" class="navigation navigation-landscape">
						<div class="nav-header">
							<a class="nav-brand" href="/index.php">
								<img src="/assets/img/logo.png" class="logo" alt="" />
							</a>
							<div class="nav-toggle"></div>
						</div>
						<div class="nav-menus-wrapper" style="transition-property: none;">
							<ul class="nav-menu" style="margin-left: 30%;">
				');			
							
                            if ($page_name == 'index'){
                                echo('
    								<li class="active"><a href="https://namira-db.com/">Home<span class="submenu-indicator"></span></a>
    								</li>
    								
    								<li><a href="/Frontend/download.php">Download<span class="submenu-indicator"></span></a>
    								</li>
									<li><a href="/Frontend/api_help.php">API<span class="submenu-indicator"></span></a>
    								</li>
    								<li><a href="/Frontend/submit.php"> Upload New MicroRNA<span class="submenu-indicator"></span></a>
    								</li>
    								<li><a href="/Frontend/contact.php">Contact Us<span class="submenu-indicator"></span></a>
    								</li>                                
                                ');
                            }else if ($page_name == 'download'){
                                echo('
    								<li ><a href="/index.php">Home<span class="submenu-indicator"></span></a>
    								</li>
    								
    								<li class="active"><a href="/Frontend/download.php">Download<span class="submenu-indicator"></span></a>
    								</li>
									<li><a href="/Frontend/api_help.php">API<span class="submenu-indicator"></span></a>
    								</li> 
    								<li><a href="/Frontend/submit.php"> Upload New MicroRNA<span class="submenu-indicator"></span></a>
    								</li>
    								<li><a href="/Frontend/contact.php">Contact Us<span class="submenu-indicator"></span></a>
    								</li>                                  
                                ');
                            }else if ($page_name == 'contact'){
                                echo('
    								<li ><a href="/index.php">Home<span class="submenu-indicator"></span></a>
    								</li>
    								
    								<li ><a href="/Frontend/download.php">Download<span class="submenu-indicator"></span></a>
    								</li>
									<li><a href="/Frontend/api_help.php">API<span class="submenu-indicator"></span></a>
    								</li>  
    								<li><a href="/Frontend/submit.php">Upload New MicroRNA<span class="submenu-indicator"></span></a>
    								</li>
    								<li class="active"><a href="/Frontend/contact.php">Contact Us<span class="submenu-indicator"></span></a>
    								</li>                                  
                                ');
                            }else if ($page_name == 'submit' or $page_name == 'guest_login' or $page_name == 'guest_insert'){
                                echo('
    								<li><a href="/index.php">Home<span class="submenu-indicator"></span></a>
    								</li>
    								<li><a href="/Frontend/download.php">Download<span class="submenu-indicator"></span></a>
    								</li>
									<li><a href="/Frontend/api_help.php">API<span class="submenu-indicator"></span></a>
    								</li>
    								<li class="active"><a href="/Frontend/submit.php">Upload New MicroRNA<span class="submenu-indicator"></span></a>
    								</li> 
    								<li><a href="/Frontend/contact.php">Contact Us<span class="submenu-indicator"></span></a>
    								</li>                                
                                ');
                            }else if ($page_name == 'index'){
                                echo('
    								<li class="active"><a href="/index.php">Home<span class="submenu-indicator"></span></a>
    								</li>
    								<li><a href="/Frontend/download.php">Download<span class="submenu-indicator"></span></a>
    								</li>
									<li><a href="/Frontend/api_help.php">API<span class="submenu-indicator"></span></a>
    								</li> 
    								<li><a href="/Frontend/submit.php">Upload New MicroRNA<span class="submenu-indicator"></span></a>
    								</li>
    								<li><a href="/Frontend/contact.php">Contact Us<span class="submenu-indicator"></span></a>
    								</li>                                
                                ');
                            }else if ($page_name == 'api_help'){
                                echo('
    								<li><a href="/index.php">Home<span class="submenu-indicator"></span></a>
    								</li>
    								<li><a href="/Frontend/download.php">Download<span class="submenu-indicator"></span></a>
    								</li>
									<li class="active"><a href="/Frontend/api_help.php">API<span class="submenu-indicator"></span></a>
    								</li>  
    								<li><a href="/Frontend/submit.php">Upload New MicroRNA<span class="submenu-indicator"></span></a>
    								</li>
    								<li><a href="/Frontend/contact.php">Contact Us<span class="submenu-indicator"></span></a>
    								</li>                                
                                ');
                            }else{
                                echo('
    								<li><a href="/index.php">Home<span class="submenu-indicator"></span></a>
    								</li>
    								<li><a href="/Frontend/download.php">Download<span class="submenu-indicator"></span></a>
    								</li>
									<li><a href="/Frontend/api_help.php">API<span class="submenu-indicator"></span></a>
    								</li>  
    								<li><a href="/Frontend/submit.php">Upload New MicroRNA<span class="submenu-indicator"></span></a>
    								</li>
    								<li><a href="/Frontend/contact.php">Contact Us<span class="submenu-indicator"></span></a>
    								</li>                                
                                ');
                            }
                            ?>
							</ul>
							
							<ul class="nav-menu nav-menu-social align-to-right">
								
								<li>
                                    <a class="nav-brand" href="https://royanstemcell.ir/" style="padding-top: 9%;">
        								<img src="/assets/img/royan.png" style="width: 50%;" alt="" />
        							</a>
								</li>
							</ul>							
							
							
						</div>						
					</nav>
				</div>
			</div>
			<?php
			if($page_name =='search_result' || $page_name =='simple_search_result'){
			    echo('</div>');
			}
			?>
			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
			