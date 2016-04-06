<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	$stmt = $db->stmt_init();
	
	if($stmt->prepare("select * from Address where street_num like ?") or die(mysqli_error($db))) {
		$searchString = '%' . $_GET['searchStreet'] . '%';
		$stmt->bind_param(s, $searchString);
		$stmt->execute();
		$stmt->bind_result($address_id, $street, $city, $state, $zipcode, $street_num);
		echo "<table border=1><th>ID</th><th>STREET NO.</th><th>STREET</th><th>CITY</th><th>STATE</th><th>ZIPCODE</th>\n";
		while($stmt->fetch()) {
			echo "<tr><td>$address_id</td><td>$street_num</td><td>$street</td><td>$city</td><td>$state</td><td>$zipcode</td></tr>";
		}
		echo "</table>";
	
		$stmt->close();
	}
	
	$db->close();


?>
