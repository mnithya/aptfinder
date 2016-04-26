<?php
	
	session_start();

	if ($_SESSION['isAdmin'] == 0) {
		include_once("../libraryC.php");
		}
	else if ($_SESSION['isAdmin'] ==1) {
		include_once("../libraryA.php");
	} else {
		include_once("../libraryB.php");
	}
 	$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 	// Check connection
 	if (mysqli_connect_errno())
 	{
 		echo "Sorry - this page is not working right now!";
 	}
	
	$string = $_GET['amenities'];
	//echo $string;
	//print_r($_GET['amenities']);
	$include = "(";
	$and = "";
	$elements = explode("amenity_input%5B%5D=", $string);
	$amen = array();
	for($i = 1; $i < count($elements); $i++) 
	{	
		array_push($amen, str_replace('&', '',$elements[$i]));
		
	}
	//print_r($amen);
	for($i = 0; $i < count($amen); $i++) 
	{	
		if($i < count($amen)-1)
		{
			$include = $include . "'" . $amen[$i] . "', ";
			$and = $and . "'" . $amen[$i] . "') AS T". $i . " NATURAL JOIN (SELECT `ba-building_id`, `name` FROM `Building_Amenity` INNER JOIN `Building` ON `ba-building_id`=`building_id` WHERE `ba-amenity_id` =";
		}
		else 
		{
			$include = $include . "'" . $amen[$i] . "')";
			$and = $and . "'" . $amen[$i] . "') AS T". $i. ")";

		}
		
	}
	//echo $include;
	//$sql = "SELECT `ba-building_id`, `name` FROM `Building_Amenity` INNER JOIN `Building` ON `ba-building_id`=`building_id` WHERE `ba-amenity_id` IN " . $include;
	$sql = "SELECT `name` FROM ((SELECT `ba-building_id`, `name` FROM `Building_Amenity` INNER JOIN `Building` ON `ba-building_id`=`building_id` WHERE `ba-amenity_id` =" . $and;
	//echo $sql;
	//echo "<br/>";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)) {
 		echo $row['name'];
		echo "<br/>";
		//echo "building: ". $row['ba-building_id'];
		//echo "<br/>";
 	}
	mysqli_close($con);


?>