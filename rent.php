<?php

include_once("./library.php");
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

mysqli_query($con, $query);

?>
