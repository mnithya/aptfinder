<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	$timestamp = time();
	date_default_timezone_set('America/New_York');
	$day = date("Y-m-d", $timestamp);
	$time = date("H:i:s", $timestamp);
	$stmt = $db->stmt_init();
	$name = $_POST['bldg_name'];
	$url = $_POST['bldg_url'];
	$max_occ = $_POST['bldg_max_occ'];
	$walk_score = $_POST['bldg_walk_score'];
	$rating = $_POST['bldg_rating'];
	$pets = $_POST['bldg_pets'];
	$addr_id = NULL;
	$cmpy = NULL;
	

	//iterate through the possible attributes and see if we need to insert none into them
	//print_r($_POST);
	/*
	Array ( [bldg_name] => 		$name
	[bldg_url] => 				$url
	[bldg_max_occ] =>  			$max_occ
	[bldg_walk_score] =>  		$walk_score
	[bldg_rating] =>  			$rating
	[bldg_pets] => 1  			$pets
	[bldg_addr] => 1  			$addr_id
	[bldg_cmpy] => 				$cmpy
	)
	*/
	// using empty() over isset()
	// empty: it will return true if the variable is an empty string, false, array(), NULL, “0?, 0, and an unset variable.
	/*INSERT INTO `Building`(`building_id`, `address_id`, `website_url`, `max_occupancy`, `walk_score`, `pets_allowed`, `rating`, `bldg-company_id`, `name`) 
	VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9])*/
	if (array_key_exists('bldg_cmpy', $_POST)) 
	{
		$cmpy = $_POST['bldg_cmpy'];
	}

	if (array_key_exists('bldg_addr', $_POST)) 
	{	
		$addr_id = $_POST['bldg_addr'];
	}

	if($stmt->prepare("INSERT INTO Building(address_id, website_url, max_occupancy, walk_score, pets_allowed, rating, name, `bldg-company_id`) VALUES
		(?, ?, ?, ?, ?, ?, ?, ?)") or die("Error: You were not able to insert into the database, Sorry!"))
	{
			$stmt->bind_param(ssssssss, $addr_id, $url, $max_occ, $walk_score, $pets, $rating, $name, $cmpy);
			$stmt->execute();
			$stmt->close();
			echo $_POST['name'] . " added on $day at $time";
	}
	$db->close();
	header('Location: ./index.html');
?>
