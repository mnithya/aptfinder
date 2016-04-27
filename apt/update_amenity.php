<?php
session_start();

if (!isset($_SESSION['username'])){
		echo "<script> alert('You do not have permission to enter this page');";
		echo "</script>";
		echo "<script>location.href='../index.php'</script>";
		exit();
 	}


require "dbutil.php";
$db = DbUtil::loginConnection();
date_default_timezone_set('America/New_York');
$timestamp = time();
	echo "<html>
	<!-- Bootstrap Core CSS -->
    <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Custom CSS -->
    <link href=\"css/landing-page.css\" rel=\"stylesheet\">

    <!-- Custom Fonts -->
    <link href=\"font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <link href=\"http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic\" rel=\"stylesheet\" type=\"text/css\">
	
    <title>Add Amenity Listings</title>
    </head>

	<body>

	<div class = \"intro-header\">
			<h1>Add an <i>amenity</i> to a <i>building</i></h1>
			<h3></h3>
			<hr class = \"intro-divider\">
		</div>

	<div class=\"container\">
	<div class=\"row\">

	<form action= \"insert_amenity.php\" method=\"post\"> <br/>

	<div class='col-md-6'>
	<div class='panel panel-default'>
		<div class='panel-heading'>
			Select Building
			</div>
			<div class='panel-body' style='min-height: 300; max-height: 300; overflow-y: auto;'>";

	$stmt = $db->stmt_init();
	if($stmt->prepare("select name, building_id from Building") or die("Failed to retrieve buildings")) {
		$stmt->execute();
		$stmt->bind_result($name, $building_id);
		while($stmt->fetch()) {
			echo "<input type=\"radio\" name=\"bldg\" value=$building_id required>";
			echo "	$name";
			echo "</br>";
		}
		$stmt->close();
	}
	
	echo "</div></div></div>";

	echo "<div class='col-md-6'>
	<div class='panel panel-default'>
		<div class='panel-heading'> Select Building Amenities</div>
		<div class='panel-body' style='min-height: 300; max-height: 300; overflow-y: auto;'>
		";
	$stmt = $db->stmt_init();
	if($stmt->prepare("select amenity_id, name from Amenity") or die("Failed to retrieve amenities")) {
		$stmt->execute();
		$stmt->bind_result($amenity_id, $name);
		while($stmt->fetch()) {
			echo "<input type=\"checkbox\" name=\"amenity[]\" value=$amenity_id>";
			echo "	$name";
			echo "<br/>";
		}
		$stmt->close();
	}

	echo "</div>
	</div>
	</div>
	</div>
	</div>
	<div class='container'>
	<div class='row' style='text-align:center;'>
		<input type=\"Submit\" value=\"Update Building-Amenity Listing\" 
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
