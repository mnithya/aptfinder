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
	<h2>Add an <i>amenity</i> to a <i>building</i>:</h2>
	<form action= \"insert_amenity.php\" method=\"post\"> <br/>
	Building: <br/>
	<ul>";

	$stmt = $db->stmt_init();
	if($stmt->prepare("select name, building_id from Building") or die("Failed to retrieve buildings")) {
		$stmt->execute();
		$stmt->bind_result($name, $building_id);
		while($stmt->fetch()) {
			echo "<input type=\"radio\" name=\"bldg\" value=$building_id>";
			echo "$name";
			echo "</br>";
		}
		$stmt->close();
	}
	
	echo "</ul>";
	echo "Amenity: <br/> <ul>";
	$stmt = $db->stmt_init();
	if($stmt->prepare("select amenity_id, name from Amenity") or die("Failed to retrieve amenities")) {
		$stmt->execute();
		$stmt->bind_result($amenity_id, $name);
		while($stmt->fetch()) {
			echo "<input type=\"checkbox\" name=\"amenity[]\" value=$amenity_id>";
			echo "$name";
			echo "<br/>";
		}
		$stmt->close();
	}

	echo "</ul></div></div><input type=\"Submit\" value=\"Update\">
		</form></body></html>";
$db->close();
?>
