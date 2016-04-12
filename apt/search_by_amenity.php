<?php
require "dbutil.php";
$db = DbUtil::loginConnection();
date_default_timezone_set('America/New_York');
$timestamp = time();
	echo "<html>
	<head>

	<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Custom CSS -->
    <link href=\"css/landing-page.css\" rel=\"stylesheet\">

    <!-- Custom Fonts -->
    <link href=\"font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <link href=\"http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic\" rel=\"stylesheet\" type=\"text/css\">
	
    <title>Filter by Amenity</title>

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

	<div class = \"intro-header\">
		<h1>Search <i>apartment buildings</i> by <i>amenity</i></h1>
		<h3></h3>
		<hr class = \"intro-divider\">
	</div>
	<br /> <br />

	<div class=\"container\">
		<div class=\"row\">
			<div class='col-md-6'>
				<div class='panel panel-default'>
				<div class='panel-heading'>Amenities list</div>
				<div class='panel-body' style='min-height: 300; max-height: 300; overflow-y: auto;'>";
	$stmt = $db->stmt_init();
	if($stmt->prepare("select amenity_id, name from Amenity") or die("Failed to retrieve amenities")) {
		$stmt->execute();
		$stmt->bind_result($amenity_id, $name);
		while($stmt->fetch()) {
			echo "<input type=\"checkbox\" name=\"amenity_input[]\" value=$amenity_id>";
			echo "	$name";
			echo "<br/>";
		}
		$stmt->close();
	}
	echo "</div>
	</div>
	</div>";

	echo "
	<div class='col-md-6'>
		<div class='panel panel-default'>
			<div class='panel-heading'>
				Search Results </div>
			<div class='panel-body' style='min-height: 300; max-height: 300; overflow-y: auto;'>
				<div id=\"apt_result\"></h3></div>
			</div>
		</div>
	</div>

	</div>
	</div>";

	echo "</body></html>";


$db->close();
?>
