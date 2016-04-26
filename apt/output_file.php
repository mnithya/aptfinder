<?php

require "dbutil.php";
ini_set('display_errors', 1);
	$db = DbUtil::loginConnection();
	date_default_timezone_set('America/New_York');
	$timestamp = time();
	$day = date("Y-m-d", $timestamp);
	$time = date("H:i:s", $timestamp);

	
	session_start();

	if ($_SESSION['isAdmin'] == 0) {
		include_once("../libraryC.php");
		}
	else if ($_SESSION['isAdmin'] ==1) {
		include_once("../libraryA.php");
	} else {
		include_once("../libraryB.php");
	}

 	$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE); 
 	// Check connection
 	if (mysqli_connect_errno()) {
 		header('Location: ./error.html');
		//echo "error connection death";
 	}

	$stmt = $db->stmt_init();
	$columns = array();

	if(!isset($_POST['export']))
	{
		header('Location: ./error.html');
	}		

	$output_file = "exported_table.xml";
	// http://stackoverflow.com/questions/13760860/how-to-create-xml-files-via-php-and-mysql
	// http://stackoverflow.com/questions/5648420/get-all-columns-from-all-mysql-tables
	$f_handle = fopen($output_file, 'w+') or die(header('Location: ./error.html'));
	//need to make a 'fatal error' html page or some sort of javascript alert
	
	$stmt = $db->stmt_init();
	if($stmt->prepare("SELECT column_name FROM information_schema.columns WHERE table_schema= 'cs4750kwh5ye' AND table_name='". $_POST['export'] . "'") or die(header('Location: ./error.html')))
	{
		$stmt->execute();
		$stmt->bind_result($col);
		while($stmt->fetch())
		{
		array_push($columns, $col);
		}
	$stmt->close();		

	}

	$output_text = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
	$output_text .= "<cs4750kwh5ye.".$_POST['export'].">\r\n";

	$query = "SELECT * FROM ". $_POST['export'];
	$result = mysqli_query($con, $query);
	
	while($row = mysqli_fetch_array($result)) {
		$output_text .= "\t<".$_POST['export'] ." ". $columns[0] ."=\"". $row[$columns[0]] ."\">\r\n";
 		for( $i = 1; $i < count($columns); $i++)
		{	
		$output_text .= "\t\t<". $columns[$i]. ">".  $row[$columns[$i]] . "</". $columns[$i]. ">\r\n";	
		}
		$output_text .= "\t</".$_POST['export'].">\r\n";
 	}
	

	$output_text .= "</cs4750kwh5ye.". $_POST['export'] .">\r\n";
	$db->close();
	mysqli_close($con);

	fwrite($f_handle, $output_text);
	fclose($f_handle);

	header('Content-type: text/xml');
	header('Content-Disposition: attachment; filename="exported_table.xml"');
	header("Content-Type: application/force-download");	
	@readfile($output_file);
	?>

