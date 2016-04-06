<?php
require "dbutil.php";
$db = DbUtil::loginConnection();
date_default_timezone_set('America/New_York');
$timestamp = time();
	echo "<html>
	<head><link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
	<script src=\"js/jquery-1.6.2.min.js\" type=\"text/javascript\"></script> 
	<script src=\"js/jquery-ui-1.8.16.custom.min.js\" type=\"text/javascript\"></script>
	</head>
	<body>
	<div class=\"dark_filter\">
	<div class=\"background\">
	<h3>Search Apartments by Amenity:</h3>";
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
	echo "</ul><br/>";
	echo "<div id=\"street_result\">Apartment Results</div>";
	echo "</body></html>";
$db->close();
?>
