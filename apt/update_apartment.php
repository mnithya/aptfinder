<?php
require "dbutil.php";
$db = DbUtil::loginConnection();
date_default_timezone_set('America/New_York');
$timestamp = time();
	echo "<html>
	<head>
         <!-- Bootstrap Core CSS -->
    <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Custom CSS -->
    <link href=\"css/landing-page.css\" rel=\"stylesheet\">

    <!-- Custom Fonts -->
    <link href=\"font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <link href=\"http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic\" rel=\"stylesheet\" type=\"text/css\">
	
    <title>Insert an Apartment</title>
	</head>

	<body>
		<div class = \"intro-header\">
			<h1>Add an <i>apartment</i>:</h1>
			<h3></h3>
			<hr class = \"intro-divider\">
		</div>
	<form action= \"insert_apartment.php\" method=\"post\"> <br/>
	<div class=\"container\">
			<div class=\"row\">
				<div class=\"col-md-6\" id=\"leftCol\">
					<div class='panel panel-default'>
						<div class='panel-heading'>General Info</div>
						<div class='panel-body' style='min-height: 300; max-height: 300; overflow-y: auto;'>
							<input type=\"text\" name=\"apt_num\" placeholder='Apartment Number'> <br/> <br/>
							<input type=\"text\" name=\"apt_beds\" placeholder='Number of Bedrooms'> <br/> <br/>
							<input type=\"text\" name=\"apt_baths\" placeholder='Number of Bathrooms'> <br/> <br/>
							<input type=\"text\" name=\"apt_rent\" placeholder='Rent'> <br/> <br/>
							Availability: <select name=\"apt_avail\">
								<option value=\"1\">Yes</option>
								<option value=\"0\">No</option>
								</select> 
						</div>
					</div>
				</div>

				<div class='col-md-6'>
					<div class='panel panel-default'>
						<div class='panel-heading'>
						Apartment Name
						</div>			
						<div class='panel-body' style='min-height: 300; max-height: 300; overflow-y: auto;'>	";

	$stmt = $db->stmt_init();
	if($stmt->prepare("select building_id, name from Building") or die("Error: could not retrieve Building data!")) {
		$stmt->execute();
		$stmt->bind_result($building_id, $name);
		while($stmt->fetch()) {
			echo "<input type=\"radio\" name=\"apt_bldg_id\" value=$building_id>";
			echo "	$name";
			echo "</br>";
		}
		$stmt->close();
	}
	else{
		echo "Failed to retrieve addresses";
	}
	echo "
				</div>
			</div>
		</div>
	</div>
	</div>
	<div class='container'>
	<div class='row' style='text-align:center;'>
	<input type=\"Submit\" value=\"Insert your Apartment\"
		style=\"text-align: center; color: #333; background-color: #fff; border-color: #ccc; 
		text-transform: uppercase; font-size: 14px; font-weight: 400; letter-spacing: 2px; 
		padding: 10px 16px; font-size: 14px; line-height: 1.3333333; border-radius: 6px;\">
	</div>
	</div>
		</form></body></html>";
$db->close();
?>
