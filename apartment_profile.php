<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Apartment Finder</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	
    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">
	<link href="css/thumbnail.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <!-- <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css"> 

    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>   
    <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

</head>

<body>
	<?php
	require "apt/dbutil.php";
    $db = DbUtil::loginConnection();
	date_default_timezone_set('America/New_York');
	$timestamp = time();
	?>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="index.php#">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php#about">About</a>
                    </li>
                    <li>
                        <a href="index.php#advancedSearch">Search</a>
                    </li>
                    <li>
                        <a href="user_profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="Signup.php">Sign Up/Sign In</a>
                    </li>
                    <li>
                        <a href="index.php#contact">Contact Us</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    <!-- Header -->
    <a name="banner"></a>
    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <br/>
                    <br/>
                     <h2 style="text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.6); font-weight: 625">Login/Sign Up</h2>
                     <h4 style="text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.6); font-weight: 625">Find your dream home today!</h4>
                    <hr class="intro-divider">
                 </div> 
            </div>   
        </div>          
    </div>
    <!-- /.intro-header -->

    </div>
    <!-- /.intro-header -->
	
    <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Sign Up</h2>
                    <p class="lead">
                    	<!-- KK fix form submit and check with POST -->
						<form class="col-md-12">
						    <div class="form-group">
						        <input type="text" class="form-control input-lg" placeholder="First Name">
						    </div>
						    <div class="form-group">
						        <input type="text" class="form-control input-lg" placeholder="Last Name">
						    </div>
						    <div class="form-group">
						        <input type="text" class="form-control input-lg" placeholder="Username">
						    </div>
						    <div class="form-group">
						        <input type="text" class="form-control input-lg" placeholder="Email">
						    </div>
						    <div class="form-group">
						        <input type="password" class="form-control input-lg" placeholder="Password">
						    </div>
						    <div class="form-group">
						        <input type="password" class="form-control input-lg" placeholder="Confirm Password">
						    </div>
						    <div class="form-group">
						        <button class="btn btn-primary btn-lg btn-block">Create Account</button>
						        <span><a href="#">Need help?</a></span>
						        <span class="pull-right"><a href="#">New Registration</a></span>
						    </div>
						</form>
                    </p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Login</h2>
                    <p class="lead">
                    	<!-- KK fix form submit and check with POST -->
						<form class="col-md-12">
						    <div class="form-group">
						        <input type="text" class="form-control input-lg" placeholder="Email">
						    </div>
						    <div class="form-group">
						        <input type="password" class="form-control input-lg" placeholder="Password">
						    </div>
						    <div class="form-group">
						        <button class="btn btn-primary btn-lg btn-block">Sign In</button>
						        <span><a href="#">Need help?</a></span>
						    </div>
						</form>
                    </p>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-b -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#about">About</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#services">Services</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#contact">Contact</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; University of Virginia 2016. All Rights Reserved o(>_<)o </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>