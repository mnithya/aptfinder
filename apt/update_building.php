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
	
    <title>Insert a Building</title>
	</head>

	<body>
		<div class = \"intro-header\">
			<h1>Add a <i>building</i>:</h1>
			<h3></h3>
			<hr class = \"intro-divider\">
		</div>
		<form action= \"insert_building.php\" method=\"post\"> <br/>
		<div class=\"container\">
			<div class=\"row\">
				<div class=\"col-md-4\" id=\"leftCol\">
					<div class='panel panel-default'>
					<div class='panel-heading'>General Info</div>
						<div class='panel-body' style='min-height: 300; max-height: 300; overflow-y: auto;'>
							<input type=\"text\" name=\"bldg_name\" placeholder='Building Name' > <br/><br/>
							<input type=\"text\" name=\"bldg_url\" placeholder='Website'> <br/><br/>
							<input type=\"text\" name=\"bldg_max_occ\" placeholder='Max Occupancy'> <br/><br/>
							<input type=\"text\" name=\"bldg_walk_score\" placeholder='Walk Score'> <br/><br/>
							<input type=\"text\" name=\"bldg_rating\" placeholder='Rating'> <br/><br/>
							Pets Allowed: <select name=\"bldg_pets\">
								<option value=\"1\">Yes</option>
								<option value=\"0\">No</option>
							</select> 

							</div></div></div>";


	echo "
	<div class='col-md-4'>
	<div class='panel panel-default'>
		<div class='panel-heading'>
			Building Address
			</div>
			<div class='panel-body' style='min-height: 300; max-height: 300; overflow-y: auto;'>";
	$stmt = $db->stmt_init();
	if($stmt->prepare("select * from Address") or die(mysqli_error($db))) {
		$stmt->execute();
		$stmt->bind_result($address_id, $street, $city, $state, $zipcode, $street_num);
		while($stmt->fetch()) {
			echo "<input type=\"radio\" name=\"bldg_addr\" value=$address_id>";
			echo "    $street_num $street $city, $state $zipcode";
			echo "</br>";
		}
		$stmt->close();
	}
	else{
		echo "Failed to retrieve addresses";
	}
	echo "</div>
	</div>
	</div>";

	echo "
	<div class='col-md-4'>
	<div class='panel panel-default'>
		<div class='panel-heading'>
		Building Owner </div>
		<div class='panel-body' style='min-height: 300; max-height: 300; overflow-y: auto;'>";
	$stmt = $db->stmt_init();
	if($stmt->prepare("select company_id, name from Company") or die(mysqli_error($db))) {
		$stmt->execute();
		$stmt->bind_result($company_id, $name);
		while($stmt->fetch()) {
			echo "<input type=\"radio\" name=\"bldg_cmpy\" value=$company_id>";
			echo "    $name";
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

	</div></div>

	<div class='container'>
	<div class='row' style='text-align:center;'>
	<input type=\"Submit\" value=\"Insert your Building\" 
	style=\"text-align: center; color: #333; background-color: #fff; border-color: #ccc; 
		text-transform: uppercase; font-size: 14px; font-weight: 400; letter-spacing: 2px; 
		padding: 10px 16px; font-size: 14px; line-height: 1.3333333; border-radius: 6px;\">
	</div>
	</div>
		</form></body></html>";
	
$db->close();
?>
