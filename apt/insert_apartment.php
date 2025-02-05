<?php
require "dbutil.php";
	$db = DbUtil::loginConnection();
	$timestamp = time();
	date_default_timezone_set('America/New_York');
	$day = date("Y-m-d", $timestamp);
	$time = date("H:i:s", $timestamp);
	$stmt = $db->stmt_init();
//print_r($_POST);
/* Array ( [apt_num] => $apt_num
[apt_beds] => $beds
[apt_baths] => $baths
[apt_rent] => $rent
 [apt_avail] =>  $avail
 [apt_bldg_id] => $bldg_id
 )
*/
// default values
$beds = 1;
$baths = 1;
$availability = 1;
$rent = NULL;
$bldg_id = NULL;
$apt_num = NULL;
$error = False;


if(isset($_POST['apt_beds']) && (int)$_POST['apt_beds'] > 0)
{
	$beds = $_POST['apt_beds'];
}
else 
{
	header('Location: ./error.html');
}

if(isset($_POST['apt_baths']) && (int)$_POST['apt_baths'] > 0)
{
	$baths = $_POST['apt_baths'];
}
else 
{
	header('Location: ./error.html');
}


if(isset($_POST['apt_avail']))
{
	$avail = $_POST['apt_avail'];
}

if (array_key_exists('apt_bldg_id', $_POST)) 
{	
	$bldg_id = $_POST['apt_bldg_id'];
}
else
{
	header('Location: ./error.html');
}

if(!empty($_POST['apt_num']) && (int)$_POST['apt_num'] > 0)
{
	$apt_num = $_POST['apt_num'];
}
else
{
	header('Location: ./error.html');
}

if(!empty($_POST['apt_rent']) && (float)$_POST['apt_rent'] > (float)0)
{
	$rent = $_POST['apt_rent'];
}
else
{
	header('Location: ./error.html');
}

/* INSERT INTO `Apartment`(`building_id`, `apt_num`, `availability`, `num_bathrooms`, `num_bedrooms`, `rent`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])*/


if(!$error && $stmt->prepare("INSERT INTO Apartment(building_id, apt_num, availability, num_bathrooms, num_bedrooms, rent) VALUES
		(?, ?, ?, ?, ?, ?)") or die(header('Location: ./error.html')))
	{
			$stmt->bind_param(ssssss, $bldg_id, $apt_num, $availability, $baths, $beds, $rent);
			$stmt->execute();
			$stmt->close();
			//echo $_POST['apt_num'] . " added on $day at $time";
	}
	else
	{
		//echo "Error: You were not able to insert into the database, unfortunately!";
	}
	$db->close();
header('Location: ./index.html');

?>
