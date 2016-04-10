<?php

require "dbutil.php";
ini_set('display_errors', 1);
	$db = DbUtil::loginConnection();
	date_default_timezone_set('America/New_York');
	$timestamp = time();
	$day = date("Y-m-d", $timestamp);
	$time = date("H:i:s", $timestamp);

	$stmt = $db->stmt_init();

	$output_file = "exported_table.xml";
	//http://stackoverflow.com/questions/13760860/how-to-create-xml-files-via-php-and-mysql
	$f_handle = fopen($output_file, 'w+') or die("Could not make file");
	//need to make a 'fatal error' html page or some sort of javascript alert


	$output_text = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
	$output_text .= "<list>\r\n";
	//$_POST['export'] TODO

	if($stmt->prepare("SELECT user_id, first_name, last_name, username, isAdmin FROM User") or die("That's unfortunate"))
	{
			$stmt->execute();
			$stmt->bind_result($id, $fname, $lname, $uname, $admin);
			while($stmt->fetch()) {
				$output_text .= "\t<user id=\"". $id ."\">\r\n";
				$output_text .= "\t\t<first_name>". $fname . "</first_name>\r\n";
				$output_text .= "\t\t<last_name>" . $lname . "</last_name>\r\n";
				$output_text .= "\t\t<username>" . $uname . "</username>\r\n";
				$output_text .= "\t\t<isAdmin>" . $admin . "</isAdmin>\r\n";
				$output_text .= "\t</user>\r\n";
		}
	    $stmt->close();
	}

	$output_text .= "</list>\r\n";
	$output_text .= "xml file generated on ". $day ." at ". $time;
	$db->close();

	fwrite($f_handle, $output_text);
	fclose($f_handle);

	header('Content-type: text/xml');
	header('Content-Disposition: attachment; filename="exported_table.xml"');
	header("Content-Type: application/force-download");	
	@readfile($output_file);
	?>

