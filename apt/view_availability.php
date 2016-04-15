<?php
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
	
    <title>Availability</title>
    </head>

	<body>

	<div class = \"intro-header\">
			<h1>Apartment availability</i></h1>
			<h3></h3>
			<hr class = \"intro-divider\">
		</div>

		<br /> <br />
	<div class=\"container\">
	<div class=\"row\">


	<div class='col-md-12'>
			<div style='min-height: 300; max-height: 500; overflow-y: auto;'>";

			$stmt = $db->stmt_init();
			if($stmt->prepare("SELECT * FROM Apt_Availability") or die("Failed to retrieve buildings")) {
			$stmt->execute();
			$stmt->bind_result($bldg_id, $bldg_name, $apt_totals, $vacancy);
				echo "<table><th><h4 class='text-muted'>Building Name</h4></th><th><h4 class='text-muted'>Total Apartments</h4></th><th><h4 class='text-muted'>Available Apartments</h4></th>";
				while($stmt->fetch()) {
					echo "<tr><td>$bldg_name</td><td>$apt_totals</td><td>$vacancy</td></tr>";
				}	
				echo "</table>";
				$stmt->close();
		}
	
	echo "</div></div>
	</div>
	</div>";

	echo "</body></html>";
$db->close();
?>
