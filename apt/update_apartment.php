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

	<script>

	function validateForm() {
    		var rent = document.forms[\"aptform\"][\"apt_rent\"].value;
		var num = document.forms[\"aptform\"][\"apt_num\"].value;
		var bath = document.forms[\"aptform\"][\"apt_baths\"].value;
		var bed = document.forms[\"aptform\"][\"apt_beds\"].value;
    		if (rent < 1 || num < 1 || bath < 1 || bed < 1) {
       		//alert(\"Rent, Apartment Number, Number of Bedrooms, and Number of Bathrooms must be greater than 0\");
        	return false;
    		}
	}

	</script>
	<body>
		<div class = \"intro-header\">
			<h1>Add an <i>apartment</i></h1>
			<h3></h3>
			<hr class = \"intro-divider\">
		</div>
	<form name= \"aptform\" action= \"insert_apartment.php\" method=\"post\" onsubmit=\"return validateForm()\"> <br/>
	<div class=\"container\">
			<div class=\"row\">
				<div class=\"col-md-6\" id=\"leftCol\">
					<div class='panel panel-default'>
						<div class='panel-heading'>General Info</div>
						<div class='panel-body' style='min-height: 300; max-height: 300; overflow-y: auto;'>
							<input type=\"text\" name=\"apt_num\" placeholder='Apartment Number' required> <br/> <br/>
							<input type=\"text\" name=\"apt_beds\" placeholder='Number of Bedrooms' required> <br/> <br/>
							<input type=\"text\" name=\"apt_baths\" placeholder='Number of Bathrooms' required> <br/> <br/>
							<input type=\"text\" name=\"apt_rent\" placeholder='Rent' required> <br/> <br/>
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
			echo "<input type=\"radio\" name=\"apt_bldg_id\" value=$building_id required>";
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
	<span style=\"display:inline-block; width:15;\"></span>
	<a href=\"./index.html\" class=\"btn btn-default btn-lg\"><span class=\"network-name\">Homepage</span></a>
	</div>
	</div>
		</form></body></html>";
$db->close();
?>
