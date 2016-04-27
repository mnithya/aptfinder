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
	/*function getLatLong(address) {
		var geocoder = new google.maps.Geocoder();

		geocoder.geocode( { 'address': address}, function(results, status) {
		
		if (status == google.maps.GeocoderStatus.OK) {
			var latitude = results[0].geometry.location.latitude;
			var longitude = results[0].geometry.location.longitude;
			alert(latitude);
			} 
		}); 
	}
	
		
	$address = "New York, New York";
	var myCenter=new google.maps.LatLng($latlong);

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

	google.maps.event.addDomListener(window, 'load', initialize); */
 
	</script>
</head>

<body>
	<?php 
	
	session_start();

	if ($_SESSION['isAdmin'] == 0) {
		include_once("./libraryC.php");
		}
	else if ($_SESSION['isAdmin'] ==1) {
		include_once("./libraryA.php");
	} else {
		include_once("./libraryB.php");
	}
	
	
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
                   
                   <?php
                    session_start();
                    if (isset($_SESSION['username'])){
                    	echo "<li> <a href='user_profile.php'> Profile </a> </li>";
                    	echo "<li> <a href='logout.php'> Log out</a> </li>";
                    } else {
                    	echo "<li> <a href='Signup.php'>Sign Up/Sign In</a> </li>";
                    }
                    ?>
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
    <!-- /.intro-header -->

    </div>
    <!-- /.intro-header -->
	
    <div class="content-section-b">
	
        <div class="container">	
			<br><br>
			<?php 
				session_start();
				$query = "SELECT DISTINCT * FROM Building NATURAL JOIN Address NATURAL JOIN Apartment INNER JOIN Images 
				ON Images.purpose_building_id = Building.building_id 
				WHERE building_id = " . $_GET['id'] . " group by building_id";
				//echo $query;
				//$query = "SELECT * FROM Building;";
				$result = mysqli_query($con, $query);
				$pets_allowed = False;
				$website = "";				
				while($row = mysqli_fetch_assoc($result)) {
					$address = $row['street_num'] . " " . $row['street'] . ", " . $row['city'] . "," . $row['state'] . " " . $row['zipcode'];
					$data_arr = geocode($address);
 
					
					$pets_allowed = $row['pets_allowed'];
					$website = $row['website_url'];
					
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
					echo "<img src='" . $image . "' style='width:700px; height: auto; max-width:100%; max-height:100%;' id='buildingImage'>";
					echo "</div>";
					
					echo "<div class='col-xs-6 col-md-4'>";
					echo "<div class='well' id='aptinfowell'>";
					echo "<h3 align='right'>" . "See Apartments Below!" . "</h3>";
					echo "<p align='right' style='font-size: 26px;'>" . $row['rating'] . "/5<br/><small class='text-muted' style='font-weight: 500;'>Guest Rating</small></p>";
					echo "<p align='right' style='color: #1aa3ff; font-size: 23px; font-weight: 500;'>Walk Score: " . $row['walk_score'] . "</p>";
					echo "</div>";
					// if able to geocode the address
					if($data_arr){
						 
						$latitude = $data_arr[0];
						$longitude = $data_arr[1];
						$formatted_address = $data_arr[2];
					?>
 
					<!-- Many of geocode and googlemaps code taken from: https://www.codeofaninja.com/2014/06/google-maps-geocoding-example-php.html and other sources -->
					<!-- google map will be shown here -->
					<div id="gmap_canvas"></div>
				 
					<!-- JavaScript to show google map -->  
					<script type="text/javascript">
					var myCenter=new google.maps.LatLng(<?php echo $latitude . "," . $longitude; ?>);

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
						function init_map() {
							var myOptions = {
								zoom: 14,
								center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
								mapTypeId: google.maps.MapTypeId.ROADMAP
							};
							map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
							marker = new google.maps.Marker({
								map: map,
								position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>)
							});
							infowindow = new google.maps.InfoWindow({
								content: "<?php echo $formatted_address; ?>"
							});
							google.maps.event.addListener(marker, "click", function () {
								infowindow.open(map, marker);
							});
							infowindow.open(map, marker);
						}
						google.maps.event.addDomListener(window, 'load', init_map);
						
						
					</script>
				 
					<?php
				 
					// if unable to geocode the address
					}else{
						echo "No map found.";
					}
				
				?>
				<?php	
					
					echo "<div id='googleMap' style='width:500px;height:200px;max-width:100%; max-height:100%;'></div>";
					
					echo "</div>";
					echo "</div>";
					

				}
				echo "<hr>";
				echo "<div class='row'>";
				$query = "SELECT Amenity.name
						FROM Amenity
						INNER JOIN Building_Amenity ON Amenity.amenity_id = Building_Amenity.`ba-amenity_id`
						INNER JOIN Building ON Building_Amenity.`ba-building_id` = Building.building_id
						WHERE building_id = " . $_GET['id'];
				$result = mysqli_query($con, $query);
				echo "<div class='row'>";
				echo "</div>";
				
				echo "<div class='row'>";
				echo "<div class='col-lg-4'>";
				echo "<br><h3>Amenities </h3>";
				while($row = mysqli_fetch_assoc($result)) {
					echo "<li style='font-weight: 500;'>" . $row['name'] . "</li>";
				}	
				echo "</div>";
				
				echo "<div class='col-lg-4 pull-right'><br/><br/>";
				echo "<div class='panel panel-default'><div class='panel-body'>";
				echo "<a href='" . $website . "'>Go to website</a><br/>";
				if($pets_allowed) {
					echo "<p>Selected Pets Allowed. See website for details</p>";
				} else {
					echo "<p>No Pets Allowed</p>";
				}
				echo "</div></div>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
				
				echo "<hr>";
				
				echo "<div class='row'>";
				$query = "Select * from Apartment natural join Address natural join Building where building_id = " . $_GET['id'] . " AND availability = 1";

				$result = mysqli_query($con, $query);
				
				if($result->num_rows < 1) {
					echo "<br/><h4>There are no available apartments.</h4><br/>";
				}
				else {
					echo "<h3>Available Apartments: </h3><br/>";
				}
				while($row = mysqli_fetch_assoc($result)) {
					echo "<br><br><div class='panel panel-default'><div class='panel-body'>";
					echo "<div class='col-lg-4'>";
					echo "<p><div style='font-size: 20px;'>Apt #: " . $row['apt_num'] . "</div>";
					echo "<br/><p>Rent: $" . number_format($row['rent']);
					echo "<br/><p>Bedrooms: " . $row['num_bedrooms'];
					echo "<br/>Bathrooms: " . $row['num_bathrooms'];
					echo "</div>";
					echo "<div align='right' class='col-lg-4 pull-right'>";
					
					if (isset($_SESSION['username'])){
					
					echo "<br><a href='./rent.php?apt_num=" . $row['apt_num'] . "&id=" . $row['building_id'] . "' class='btn btn-primary btn-lg'>Rent!</a>";
					echo "<br>";
					echo "<br><a href='./favorite_apt.php?apt_num=" . $row['apt_num'] . "&id=" . $row['building_id'] . "' class='btn btn-warning btn-lg'>Favorite</a>";
					}
					echo "</div>";
					echo "</div>";
					echo "</div>";
				}
				echo "</div>";
			?>
			
			<?php
 
				// function to geocode address, it will return false if unable to geocode address
				function geocode($address){
				 
					// url encode the address
					$address = urlencode($address);
					 
					// google map geocode api url
					$url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
				 
					// get the json response
					$resp_json = file_get_contents($url);
					 
					// decode the json
					$resp = json_decode($resp_json, true);
				 
					// response status will be 'OK', if able to geocode given address 
					
					if($resp['status']=='OK'){
				 
						// get the important data
						$lati = $resp['results'][0]['geometry']['location']['lat'];
						$longi = $resp['results'][0]['geometry']['location']['lng'];
						$formatted_address = $resp['results'][0]['formatted_address'];
						
						 
						// verify if data is complete
						if($lati && $longi && $formatted_address){
						 
							// put the data in the array
							$data_arr = array();            
							 
							array_push(
								$data_arr, 
									$lati, 
									$longi, 
									$formatted_address
								);
							 
							return $data_arr;
							 
						}else{
							return false;
						}
						 
					}else{
						return false;
					}
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

		<script>
	 var img = document.getElementById('buildingImage');
						var imgheight = $('#buildingImage').height();
						var wellheight = $('#aptinfowell').height();
						var totalheight = imgheight - wellheight - 58;
						var imgheightstr = totalheight + "px";
						document.getElementById('googleMap').style.height=imgheightstr;
						</script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>