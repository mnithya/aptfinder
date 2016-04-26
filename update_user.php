<?php
session_start();

include_once("./library.php");
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: ". mysqli_connect_error();
}

$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$email = $_POST['email'];
$email2 = $_POST['email2'];
$pword = $_POST['password'];
$pword = $_POST['password2'];

if ($email == $email2 and $pword == $pword2){
	$p = password_hash($pword, PASSWORD_DEFAULT);
	$query = "UPDATE User 
			SET ...
			WHERE ...";

	$result = mysqli_query($con, $query) or die ("invalid query..".$con->error);
	echo "<script>alert(\"You have updated your settings successfully!\")</script>";
	$URL="user_profile.php";
	echo "<script>location.href='$URL'</script>";
}
else {
	echo "send failed.... mismatch inputs..."
}







?>