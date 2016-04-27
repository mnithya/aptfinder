<?php


session_start();

if (!isset($_SESSION['username'])){
		echo "<script> alert('You do not have permission to enter this page');";
		echo "</script>";
		echo "<script>location.href='../index.php'</script>";
		exit();
 	}






require "dbutil.php";
$db = DbUtil::loginConnection();
date_default_timezone_set('America/New_York');
$timestamp = time();
	echo "<html>
	<!-- Bootstrap Core CSS -->
    <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Custom CSS -->
    <link href=\"css/landing-page.css\" rel=\"stylesheet\">
    <link href=\"css/table.css\" rel=\"stylesheet\">

    <!-- Custom Fonts -->
    <link href=\"font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <link href=\"http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic\" rel=\"stylesheet\" type=\"text/css\">
	
    <title>Add Administrators</title>
    </head>

	<body>

	<div class = \"intro-header\">
			<h1>Add Site Administrators</h1>
			<h3></h3>
			<hr class = \"intro-divider\">
		</div>

	<div class=\"container\">
	<div class=\"row\">

	<form action= \"add_admin.php\" method=\"post\"> <br/>

	<div class='col-md-12'>
	<div class='panel panel-default'>
		<div class='panel-heading'>
			View Users
			</div>
			<div class='panel-body' style='min-height: 300; max-height: 400; overflow-y: auto;'>";

	$stmt = $db->stmt_init();
	if($stmt->prepare("SELECT user_id, username, first_name, last_name, email, isAdmin from User") or die(header('Location: ./view_availability.php'))) {
		$stmt->execute();
		$stmt->bind_result($user_id, $uname, $fname, $lname, $email, $admin);
		echo "<table><th>Username</th><th>Name</th><th>Email</th><th>Add admin</th>";
		while($stmt->fetch()) 
		{
			if($admin)
			{
				echo "<tr><td>$uname</td><td>$fname $lname</td><td>$email</td><td></td></tr>";
			}
			else
			{
				echo "<tr><td>$uname</td><td>$fname $lname</td><td>$email</td><td>
				<input type=\"checkbox\" name=\"update_user[]\" value=$user_id>
				</td></tr>";
			}
		}
		echo "</table>";
		$stmt->close();
	}
	
	echo "</div></div></div>

	</div>
	</div>
	<div class='container'>
	<div class='row' style='text-align:center;'>
		<input type=\"Submit\" value=\"Update Permissions\" 
		style=\"text-align: center; color: #333; background-color: #fff; border-color: #ccc; 
		text-transform: uppercase; font-size: 14px; font-weight: 400; letter-spacing: 2px; 
		padding: 10px 16px; font-size: 14px; line-height: 1.3333333; border-radius: 6px;\">
	<span style=\"display:inline-block; width:15;\"></span>
	<a href=\"./index.html\" class=\"btn btn-default btn-lg\"><span class=\"network-name\">Homepage</span></a>
	</div>
	</div>
		</form></body></html>";
$db->close();
?>
