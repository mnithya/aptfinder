<?php

session_start();

if ($_SESSION['isAdmin'] == 0) {
	include_once("./libraryC.php");
	}
else if ($_SESSION['isAdmin'] ==1) {
	include_once("./libraryA.php");
} else {
	include_once("./libraryB.php");
	}
	
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
session_start();

if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: ". mysqli_connect_error();
}

$apt_num = $_GET['apt_num'];
$building_id = $_GET['id'];
$username = $_SESSION['username'];

$query_userid = "select user_id from User where username = '$username'";

$result = mysqli_query($con, $query_userid);
$userid = -1;
$num = $result->num_rows;

while($row = mysqli_fetch_assoc($result)) {
	$userid = $row['user_id'];
}

$query = "insert into Rents (`rents-apt_num`, `rents-building_id`, `rents-user_id`) values($apt_num, $building_id, $userid)";

$result = mysqli_query($con, $query);
echo $query;
echo $result->num_rows;

$newURL = "./apt_page?id=$building_id";

echo $username;
echo $userid;
//header('Location: '.$newURL);

mysqli_close($db_connection);


?>
