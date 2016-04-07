<?php
/*print_r($_POST);
if(isset($_POST['amenity'])){
echo implode(',', $_POST['amenity']);
}*/
/* Array ( [bldg] => 3 
[amenity] => Array ( [0] => 3 [1] => 4 [2] => 15 ) )
 3,4,15*/

require "dbutil.php";
	$db = DbUtil::loginConnection();
	date_default_timezone_set('America/New_York');
	$stmt = $db->stmt_init();
	$timestamp = time();
	$day = date("Y-m-d", $timestamp);
	$time = date("H:i:s", $timestamp);
	$bldg = NULL;
	$error = False;

echo "<html>
	<head><link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\"></head>
	<body>
	<div class=\"dark_filter\">
	<div class=\"background\">";



if (array_key_exists('bldg', $_POST)) 
{	
	$bldg = $_POST['bldg'];
}
else
{
	$error = True;
}

if(!empty($_POST['amenity']) && !$error) {
	foreach($_POST['amenity'] as $amenity)
	{
		if($stmt->prepare("INSERT INTO Building_Amenity(`ba-amenity_id`, `ba-building_id`) VALUES (?, ?)") or die("Error: Insertion not currently possible"))
		{
			$stmt->bind_param(ss, $amenity, $bldg);
			$stmt->execute();
			echo $amenity . " added on $day at $time";
			echo "<br/>";
		}
	}
}
else 
{
	echo "Error: values are not set";
}
$stmt->close();
$db->close();
echo "</div></div><br/>";
echo "<a href=\"./update_amenity.php\"><button>Insert More Building-Amenity Pairs</button></a>";
echo "</body></html>";
?>
