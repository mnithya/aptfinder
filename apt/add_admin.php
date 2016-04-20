<?php
	
require "dbutil.php";
$db = DbUtil::loginConnection();
$stmt = $db->stmt_init();
	
	//print_r($_POST['update_user']);
 	if (!empty($_POST['update_user']))
 	{
 		foreach($_POST['update_user'] as $new_admin)
 		{
 
			if($stmt->prepare("UPDATE User SET isAdmin=1 WHERE user_id=$new_admin") or die(header('Location: ./error.html')))
 			{
 				$stmt->execute();
 			}
 		}
 	}

$stmt->close();
$db->close();
header('Location: ./index.html');
	
?>