<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!isset($_SESSION['username'])){
		echo "<script> alert('You do not have permission to enter this page');";
		echo "</script>";
		echo "<script>location.href='../index.php'</script>";
		exit();
 	}



?>


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

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
                <a class="navbar-brand topnav" href="../index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="../index.php#about">About</a>
                    </li>
                    <li>
                        <a href="../index.php#advancedSearch">Search</a>
                    </li>
                    <li>
                        <a href="../user_profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="../logout.php">Log out</a>
                    </li>
                    <li>
                        <a href="../index.php#contact">Contact Us</a>
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
                     <h2 style="text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.6); font-weight: 625">Dashboard</h2>
                        <hr class="intro-divider">
                 </div> 
            </div>   
        </div>          
    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->

    <a name="dashboard"></a>
    <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-md-4">
                    <div class="well">
                        <h3 class="text-muted">
                           Update Apartment Data
                        </h3>
                        <hr style="border-color: #d3d3d3">
                            <a href="./update_building.php" class="btn btn-default btn-lg"><span class="network-name">Insert a Building</span></a>
                            <br/> <br/>
                            <a href="./update_apartment.php" class="btn btn-default btn-lg"><span class="network-name">Insert an Apartment Unit</span></a>
                            <br/> <br/>
                            <a href="./update_amenity.php" class="btn btn-default btn-lg"><span class="network-name">Add Amenity Listings</span></a>
                            <br/> <br/>
                            <h3 class="text-muted">
                           Manage Users
                        </h3>
                             <hr style="border-color: #d3d3d3">
                            <a href="./update_user.php" class="btn btn-default btn-lg"><span class="network-name">Add Admins</span></a>
                            <br/> <br/>
                            <h3 class="text-muted">
                           Manage Apartments
                        </h3>
                        <hr style="border-color: #d3d3d3">
                            <a href="./view_availability.php" class="btn btn-default btn-lg"><span class="network-name">View Availability</span></a>
                            <br/> <br/>
			                 <a href="./dbrst.php" class="btn btn-default btn-lg" onclick="return confirm('Are you certain? This cannot be undone.')"><span class="network-name">Reset Database</span></a>
                            <br/> <br/>
			                 <a href="./search_by_amenity.php" class="btn btn-default btn-lg"><span class="network-name">Filter by Amenity</span></a>
                            <br/> <br/>
                    </div>
                </div> 
                 <!-- /.col-md-3 -->     
                 <div class="col-md-8">
                    <h2>Administrative Tools</h2>
                   <div class="row">
                    
                <div class="col-md-8">
                    <img class="img-responsive" style="border-radius: 4px;" src="images/databases_group.jpg" alt="">
                    <br /> 
                    <h3 class='text-muted'>Manage your Apartment Finder Web application:</h3>
			<ul> 
			<li> Insert apartment and building information</li>
			<li> Manage users</li>
			<li> Monitor apartment availability </li>
			<li> Export select database tables into XML files </li>
			<li> Check on building-amenity information </li>
			<li> Manage your database! </li>
			</ul>
 		   <p class="text-muted"><i>A user's dream home is only a button click away!</i></p>
                </div>

                <div class="col-md-4">
                    <form action="output_file.php" method="post">
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">
                           <h3 class="text-muted"> Select Tables for Export</h3>
                        </div>
                        <div class="panel-body">
                            <input type="radio" name="export" value="Apartment" required> Apartment Units</input> </br>
                            <input type="radio" name="export" value="Building" required> Building Information</input> </br>
                            <input type="radio" name="export" value="Amenity" required> Amenities</input> </br>
                            <input type="radio" name="export" value="Company" required> Apartment Companies</input> </br>
			    <input type="radio" name="export" value="Apt_Availability" required> Availability </input> </br>
                                <br/>

                            <div style="text-align: center">
                            <input type="Submit" value="Export" style="text-align: center; color: #333; background-color: #fff; border-color: #ccc; text-transform: uppercase; font-size: 14px; font-weight: 400; letter-spacing: 2px; padding: 10px 16px; font-size: 14px; line-height: 1.3333333; border-radius: 6px;"/>
                        </div>
                        </div>
                        
                    </div>
                    <!-- /.panel --> 
                     </form>

                     <div class="well" style="background-color: #ffffff;">

                        <h3 class="text-muted">External Links</h3>
                        <hr style="border-color: #d3d3d3">

                        <a href="https://stardock.cs.virginia.edu/pma" class="btn btn-default btn-lg" style="background-color: #f5f5f5;"><span class="network-name">Database</span></a>
                            <br/> <br/>
                            <a href="../index.html" class="btn btn-default btn-lg" style="background-color: #f5f5f5;"><span class="network-name">Home Page</span></a>
                            <br/> <br/>
                              <a href="https://github.com/mnithya/aptfinder" class="btn btn-default btn-lg" style="background-color: #f5f5f5;"><span class="network-name">GitHub</span></a>
                            <br/> <br/>

                 </div>
                </div>
                <!-- /.col-md-4--> 

                   </div>
                   <!-- /.row --> 
                </div>
            </div>
            <!-- /.row -->    
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
                            <a href="../index.html">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#dashboard">Insert Data</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#dashboard">Export Data</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#dashboard">Go to Database</a>
                        </li>
                    </ul>
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
