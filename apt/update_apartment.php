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
	<h2>Add an <i>apartment</i>:</h2>
	<form action= \"insert_apartment.php\" method=\"post\"> <br/>
	Apartment Number: <input type=\"text\" name=\"apt_num\"> <br/>
	Number of Bedrooms: <input type=\"text\" name=\"apt_beds\"> <br/>
	Number of Bathrooms: <input type=\"text\" name=\"apt_baths\"> <br/>
	Rent: <input type=\"text\" name=\"apt_rent\"> <br/>
	Availability: <select name=\"apt_avail\">
		<option value=\"1\">Yes</option>
		<option value=\"0\">No</option>
		</select> <br/>
	Apartment Name: <br/>
	<ul>";

	$stmt = $db->stmt_init();
	if($stmt->prepare("select building_id, name from Building") or die(mysqli_error($db))) {
		$stmt->execute();
		$stmt->bind_result($building_id, $name);
		while($stmt->fetch()) {
			echo "<input type=\"radio\" name=\"apt_bldg_id\" value=$building_id>";
			echo "$name";
			echo "</br>";
		}
		$stmt->close();
	}
	else{
		echo "Failed to retrieve addresses";
	}
	echo "</ul></div></div>";
	echo "</ul><input type=\"Submit\" value=\"Insert your Apartment\">
		</form></body></html>";
$db->close();
?>
