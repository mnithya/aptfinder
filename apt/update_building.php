<?php
require "dbutil.php";
$db = DbUtil::loginConnection();
date_default_timezone_set('America/New_York');
$timestamp = time();
	echo "<html>
	<head><link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\"></head>
	<body>
	<div class=\"dark_filter\">
	<div class=\"background\">
	<h2>Add a <i>building</i>:</h2>
	<form action= \"insert_building.php\" method=\"post\"> <br/>
	Building Name: <input type=\"text\" name=\"bldg_name\"> <br/>
	Website: <input type=\"text\" name=\"bldg_url\"> <br/>
	Max Occupancy: <input type=\"text\" name=\"bldg_max_occ\"> <br/>
	Walk Score: <input type=\"text\" name=\"bldg_walk_score\"> <br/>
	Rating: <input type=\"text\" name=\"bldg_rating\"> <br/>
	Pets Allowed: <select name=\"bldg_pets\">
		<option value=\"1\">Yes</option>
		<option value=\"0\">No</option>
		</select> <br/>
	Building Address: <br/>
	<ul>";

	$stmt = $db->stmt_init();
	if($stmt->prepare("select * from Address") or die(mysqli_error($db))) {
		$stmt->execute();
		$stmt->bind_result($address_id, $street, $city, $state, $zipcode, $street_num);
		while($stmt->fetch()) {
			echo "<input type=\"radio\" name=\"bldg_addr\" value=$address_id>";
			echo "$street_num $street $city, $state $zipcode";
			echo "</br>";
		}
		$stmt->close();
	}
	else{
		echo "Failed to retrieve addresses";
	}
	echo "</ul>";
	echo "Company that Owns the Building: <br/> <ul>";
	$stmt = $db->stmt_init();
	if($stmt->prepare("select company_id, name from Company") or die(mysqli_error($db))) {
		$stmt->execute();
		$stmt->bind_result($company_id, $name);
		while($stmt->fetch()) {
			echo "<input type=\"radio\" name=\"bldg_cmpy\" value=$company_id>";
			echo "$name";
			echo "</br>";
		}
		$stmt->close();
	}
	else{
		echo "Failed to retrieve addresses";
	}
	echo "</ul></div></div><input type=\"Submit\" value=\"Insert your Building\">
		</form></body></html>";
	
$db->close();
?>
