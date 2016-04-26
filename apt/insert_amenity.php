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
	$stmt = $db->stmt_init();
	$bldg = NULL;
	$error = False;


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
		if($stmt->prepare("INSERT INTO Building_Amenity(`ba-amenity_id`, `ba-building_id`) VALUES (?, ?)") or die(header('Location: ./error.html')))
		{
			$stmt->bind_param(ss, $amenity, $bldg);
			$stmt->execute();
		}
	}
}
else 
{
	//echo "Error: values are not set";
}
$stmt->close();
$db->close();
header('Location: ./index.html');

?>
