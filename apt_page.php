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
	
	<script
	src="http://maps.googleapis.com/maps/api/js">
	</script>

	<script>
	var myCenter=new google.maps.LatLng(47.6062,-122.3321);

	function initialize()
	{
	var mapProp = {
	  center:myCenter,
	  zoom:10,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };

	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

	var marker=new google.maps.Marker({
	  position:myCenter,
	  });

	marker.setMap(map);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
	</script>
</head>

<body>
	<?php 
	include_once("library.php"); // To connect to the database
 	$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 	// Check connection
 	if (mysqli_connect_errno())
 	{
 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
 	}
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
                <a class="navbar-brand topnav" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php#about">About</a>
                    </li>
                    <li>
                        <a href="user_profile.php">View Profile</a>
                    </li>
                    <li>
                        <a href="login.php">Sign Up/Sign In</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Header -->
    <a name="banner"></a>
    <!-- /.intro-header -->

    </div>
    <!-- /.intro-header -->
	
    <div class="content-section-b">
	
        <div class="container">	
			<br><br>
					
					<?php 
					
						$query = "Select distinct * from Building natural join Address natural join Apartment inner join Images on Images.purpose_building_id = Building.building_id where building_id = " . $_GET['id'];

						//$query = "SELECT * FROM Building;";
						$result = mysqli_query($con, $query);
						while($row = mysqli_fetch_assoc($result)) {
							//echo "<div id='address' style='display: none;' value=" . $row['city'] . "," . $row['state'] . ">";
							echo "<div style='text-align: justify; margin-left: 50px; margin-right: 50px;'>";
							echo "<div class='row'>";
				
							echo "<h2 class='section-heading'>" . $row['name'];
							//echo "<div class='rating inline'>"; 
							$full_stars_num = floor($row['rating']);
							$half_star = False;
							if($row['rating'] - $full_stars_num >= .5) {
								$half_star = True;
							}
							echo " ";
							for($i = 0; $i < $full_stars_num; $i++) {
								echo "<i class='fa fa-star'></i>";
							}
							if($half_star) {
								echo "<i class='fa fa-star-half'></i>";
							}
							
							
							echo "<br><small>" 
							. $row['street_num'] . " " . $row['street'] . " " . "<br/>" .  $row['city'] . ", " . $row['state'] . " " . $row['zipcode'] . "</small></h2>";
							
							echo "<br/>";
							
							if($row['img_url'] === null || $row['img_url'] === "" || sizeof($row['img_url']) == 0) {
								//default image if img URL not set
								$image = "http://i.imgur.com/OK5gGu4.png";				
							}
							else {
								$image = $row['img_url'];
							}
							
							echo "<div class='col-xs-12 col-md-8'>";
							echo "<img src='" . $image . "' style='width:700px; height: auto; max-width:100%; max-height:100%;'>";
							echo "</div>";
							
							echo "<div class='col-xs-6 col-md-4'>";
							echo "<div class='well'>";
							echo "<h3 align='right'>" . "Apartments Available!" . "</h3>";
							echo "<p align='right' style='font-size: 26px;'>" . $row['rating'] . "/5<br/><small class='text-muted' style='font-weight: 500;'>Guest Rating</small></p>";
							echo "<p align='right' style='color: #1aa3ff; font-size: 23px; font-weight: 500;'>Walk Score: " . $row['walk_score'] . "</p>";
							echo "</div>";
							echo "<div id='googleMap' style='width:500px;height:145px;max-width:100%; max-height:100%;'></div>";
							echo "</div>";
							echo "</div>";
							

						}
				
					
						$query = "SELECT Amenity.name
								FROM Amenity
								INNER JOIN Building_Amenity ON Amenity.amenity_id = Building_Amenity.`ba-amenity_id`
								INNER JOIN Building ON Building_Amenity.`ba-building_id` = Building.building_id
								WHERE building_id = " . $_GET['id'];
						$result = mysqli_query($con, $query);
						echo "<div class='row'>";
						echo "</div>";
						echo "<br><h3>Amenities </h3>";
						while($row = mysqli_fetch_assoc($result)) {
							echo "<li style='font-weight: 500;'>" . $row['name'] . "</li>";
						}	
						//echo "</div>";
						
						$query = "Select * from Apartment natural join Address natural join Building inner join Images on Images.purpose_building_id = Building.building_id where building_id = " . $_GET['id'] . " AND availability = 1";

						$result = mysqli_query($con, $query);
						echo "<h3>Available Apartments: </h3>";
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br><div class='panel panel-default'><div class='panel-body'>";
							echo "<div class='col-lg-4'>";
							echo "<p><div style='font-size: 20px;'>Apt #: " . $row['apt_num'] . "</div>";
							echo "<br/><p>Bedrooms: " . $row['num_bedrooms'];
							echo "<br/>Bathrooms: " . $row['num_bathrooms'];
							echo "</div>";
							echo "<div align='right' class='col-lg-4 pull-right'>";
							echo "<br><button type='button' class='btn btn-primary btn-lg'>Rent!</button>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
						}
					?>

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