<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	$name = $_POST['bldg_name'];
	$url = $_POST['bldg_url'];
	$walk_score = $_POST['bldg_walk_score'];
	$rating = $_POST['bldg_rating'];
	$pets = $_POST['bldg_pets'];
	$addr_id = NULL;
	$cmpy = NULL;

	$addr_str_num = $_POST['address_street_num'];
	$addr_str = $_POST['address_street'];
	$addr_city = $_POST['address_city'];
	$addr_state = $_POST['address_state'];
	$addr_zc = $_POST['address_zipcode'];
	

	//iterate through the possible attributes and see if we need to insert none into them
	//print_r($_POST);
	/*
	Array ( [bldg_name] => 		$name
	[bldg_url] => 				$url
	[bldg_walk_score] =>  		$walk_score
	[bldg_rating] =>  			$rating
	[bldg_pets] => 1  			$pets
	[bldg_addr] => 1  			$addr_id
	[bldg_cmpy] => 				$cmpy
	)
	*/
	$stmt = $db->stmt_init();
	if($stmt->prepare("INSERT INTO Address(street, city, state, zipcode, street_num) VALUES (?, ?, ?, ?, ?)") or die(header('Location: ./error.html')))
	{
			$stmt->bind_param(sssss, $addr_str, $addr_city, $addr_state, $addr_zc, $addr_str_num);
			$stmt->execute();
			$stmt->close();
			//echo $_POST['name'] . " added on $day at $time";
	}

	$addr_id = $db->insert_id;

	if(is_null($addr_id))
	{
		header('Location: ./error.html');
	}

	$stmt = $db->stmt_init();
	if (array_key_exists('bldg_cmpy', $_POST)) 
	{
		$cmpy = $_POST['bldg_cmpy'];
	}

	if($stmt->prepare("INSERT INTO Building(address_id, website_url, walk_score, pets_allowed, rating, name, `bldg-company_id`) VALUES (?, ?, ?, ?, ?, ?, ?)") or die(header('Location: ./error.html')))
	{
			$stmt->bind_param(sssssss, $addr_id, $url, $walk_score, $pets, $rating, $name, $cmpy);
			$stmt->execute();
			$stmt->close();
			//echo $_POST['name'] . " added on $day at $time";
	}
	$db->close();
	header('Location: ./index.html');
?>
