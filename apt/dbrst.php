<?php
	
	require_once('./library.php');
 	$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE); 
 	// Check connection
 	if (mysqli_connect_errno()) {
 		header('Location: ./error.html');
 	}

 	$query = "UPDATE Apartment SET availability=1 WHERE availability=0";
	$result = mysqli_query($con, $query);

	if(mysqli_errno($con))
	{
		header('Location: ./error.html');
	}
	else
	{
		header('Location: ./view_availability.php');
	}
	
	mysqli_close($con);
?>