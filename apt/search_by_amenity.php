<?php
require "dbutil.php";
$db = DbUtil::loginConnection();
date_default_timezone_set('America/New_York');
$timestamp = time();
	echo "<html>
	<head><link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
	<script src=\"js/jquery-1.6.2.min.js\" type=\"text/javascript\"></script> 
	<script src=\"js/jquery-ui-1.8.16.custom.min.js\" type=\"text/javascript\"></script>


	<script>
	$(document).ready(function() {
		$( 'input[type=checkbox]' ).change(function() {
			$.ajax({
				url: 'amenity_finder.php', 
				data: {amenities: $( 'input[type=checkbox]' ).serialize()},
				success: function(data){
					$('#apt_result').html(data);	
				
				}
			});
		});
		
	});

	</script>

	</head>
	<body>
	<div class=\"dark_filter\">
	<div class=\"background\">
	<h3>Search Apartments by Amenity:</h3>";
	echo "<div id=\"amenities_list\">";
	echo "Amenity: <br/> <ul  id=\"list\">";
	$stmt = $db->stmt_init();
	if($stmt->prepare("select amenity_id, name from Amenity") or die("Failed to retrieve amenities")) {
		$stmt->execute();
		$stmt->bind_result($amenity_id, $name);
		while($stmt->fetch()) {
			echo "<input type=\"checkbox\" name=\"amenity_input[]\" value=$amenity_id>";
			echo "$name";
			echo "<br/>";
		}
		$stmt->close();
	}
	echo "</ul></div><br/>";
	echo "<div id=\"apt_result\">Apartment Results</div>";

	echo "</body></html>";


$db->close();
?>
