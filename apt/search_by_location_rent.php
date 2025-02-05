<?php
require "dbutil.php";

$db = DbUtil::loginConnection();
date_default_timezone_set('America/New_York');
$timestamp = time();

$stmt = $db->stmt_init();

/*
include_once("./library.php");
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
session_start();

if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: ". mysqli_connect_error();
}
*/

$location= '%' . $_GET['searchLoc'] . '%';
$min_rent = $_GET['minrent'];
$max_rent = $_GET['maxrent'];

$conditions = [];

if(!empty($_GET['searchLoc'])) {
	array_push($conditions, "(Address.city LIKE '$location' OR Address.state LIKE '$location' OR Address.zipcode LIKE '$location')");
}

if(isset($_GET['minrent']) || isset($_GET['minrent_input'])) {
	if(empty($_GET['minrent']) || empty($_GET['minrent_input'])) {
		$min_rent = 0;
	}
	if(!empty($_GET['minrent_input'])) {
		$min_rent = $_GET['minrent_input'];
	}
	array_push($conditions, "Apartment.rent >= " . $min_rent);
} 

if(isset($_GET['maxrent']) || isset($_GET['maxrent_input'])) {
	if(empty($_GET['maxrent']) || empty($_GET['maxrent_input'])) {
		$max_rent = 1000000;
	}
	if(!empty($_GET['maxrent_input'])) {
		$max_rent = $_GET['maxrent_input'];
	}
	array_push($conditions, "Apartment.rent <= " . $max_rent);
}

if(isset($_GET['state']) && $_GET['state'] !== "null") {
	array_push($conditions, "Address.state LIKE '%" . $_GET['state'] . "%'");
}

if(isset($_GET['city']) && $_GET['city'] !== "null") {
	array_push($conditions, "Address.city LIKE '%" . $_GET['city'] . "%'");
}

if(isset($_GET['beds_list']) && !empty($_GET['beds_list'])) {
	$beds_list = explode("beds_list%5B%5D=", $_GET['beds_list']);
	$beds = array();
	for($i = 1; $i < count($beds_list); $i++) 
	{	
		array_push($beds, str_replace('&', '',$beds_list[$i]));
	}
	$size = count($beds);
	$count = 0;
	$beds_string = "";
	foreach($beds as $num_beds) {
		$beds_string .= "Apartment.num_bedrooms >= $num_beds";
		$count++;
		if($count < $size) {
			$beds_string .= " OR ";
		}
	}
	array_push($conditions, $beds_string);
}

if(isset($_GET['baths_list']) && !empty($_GET['baths_list'])) {
	$baths_list = explode("baths_list%5B%5D=", $_GET['baths_list']);
	$baths = array();
	for($i = 1; $i < count($baths_list); $i++) 
	{	
		array_push($baths, str_replace('&', '',$baths_list[$i]));
	}
	$size = count($baths);
	$count = 0;
	$baths_string = "";
	foreach($baths as $num_baths) {
		$baths_string .= "Apartment.num_bathrooms >= $num_baths";
		$count++;
		if($count < $size) {
			$baths_string .= " OR ";
		}
	}
	array_push($conditions, $baths_string);
}

if(isset($_GET['amenities_list']) && !empty($_GET['amenities_list'])) {
	$string = $_GET['amenities_list'];
	//echo $string;
	//print_r($_GET['amenities_list']);
	$include = "(";
	$and = "";
	$elements = explode("amenity_input%5B%5D=", $string);
	//echo "<br>";
	$amen = array();
	for($i = 1; $i < count($elements); $i++) 
	{	
		array_push($amen, str_replace('&', '',$elements[$i]));
		
	}
	
	for($i = 0; $i < count($amen); $i++) 
	{	
		if($i < count($amen)-1)
		{
			$include = $include . "'" . $amen[$i] . "', ";
			$and = $and . "'" . $amen[$i] . "')". " AND `name` IN (SELECT `name` FROM `Building_Amenity` INNER JOIN `Building` ON `ba-building_id`=`building_id` WHERE `ba-amenity_id` =";
		}
		else 
		{
			$include = $include . "'" . $amen[$i] . "')";
			$and = $and . "'" . $amen[$i] . "')";

		}
		 
	}
	
	$sql = "`name` IN (SELECT `name` FROM `Building_Amenity` INNER JOIN `Building` ON `ba-building_id`=`building_id` WHERE `ba-amenity_id` =" . $and;
	array_push($conditions, $sql);
}


$query = "select * from Building natural join Apartment natural join Address inner join Images on Images.purpose_building_id = Building.building_id where ";
$first = True;
$size = count($conditions);
$count = 0;
foreach($conditions as $condition) {
	$query = $query . $condition;
	$count++;
	if($size != $count) {
		$query = $query . " AND ";
	}
}

$beforeGrouping = $query;

$limit = 4;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit; 

$query = $query . " group by building_id";

$resultQ = mysqli_query($con, $query);

//echo $query;
if($stmt->prepare($query) or die("Failed to retrieve apartments")) {
		//echo $query;
		 $stmt->execute();

		 /*Bind result start*/
		 //source: https://gunjanpatidar.wordpress.com/2010/10/03/bind_result-to-array-with-mysqli-prepared-statements/
		 $meta = $stmt->result_metadata();
		 $result = array();
		 while ($field = $meta->fetch_field())
		 {
		        $result[$field->name] = NULL;
		        $params[] = &$result[$field->name];
		 }
 
		call_user_func_array(array($stmt, 'bind_result'), $params);
		
		/*Bind result end */
		
		//echo "<table class='table table-bordered'>";
		//echo "<thead><th>building_id</th><th>apt_num</th><td>Image</td></thead><tbody>\n";
		$total_records = 0;

	//while($result = mysqli_fetch_assoc($resultQ)) {

		while($stmt->fetch()) {
			echo "<div class='post-container'>";
			$image = "";
			if($result['img_url'] === null || $result['img_url'] === "" || sizeof($result['img_url']) == 0) {
				//default image if img URL not set
				$image = "http://i.imgur.com/OK5gGu4.png";				
			}
			else {
				$image = $result['img_url'];
			}
			echo "<div class='post-thumb'><img class='span2' src='" . $image . "' alt='' style='width:304px; height: 228;'></div>";
			echo "<div class='post-content-container'><div class='post-content'>";
			echo "<h3 class='post-heading'><a href='apt_page.php?id=" . $result['building_id'] . "'>" . $result['name'] . "</a></h3>";
			echo "<div class='rating inline'>"; 
			$full_stars_num = floor($result['rating']);
			$half_star = False;
			if($result['rating'] - $full_stars_num >= .5) {
				$half_star = True;
			}
			echo " ";
			for($i = 0; $i < $full_stars_num; $i++) {
				echo "<i class='fa fa-star fa-lg'></i>";
			}
			if($half_star) {
				echo "<i class='fa fa-star-half fa-lg'></i>";
			}
			echo "</div>";
			echo "<div class='post-rent'>$" . number_format($result['rent']) . "/month</div>";
			echo "<br/><br/>";
                        echo "<div class='post-location'>" . $result['city'] . ", " . $result['state'] . "</div>";

			echo "<p class='description'>"; 
			echo "<br/>Bedrooms: " . $result['num_bedrooms'] . "<br/>";
			echo "Bathrooms: " . $result['num_bathrooms'] . "<br/>";
			echo "<font color='#2FC500'>Walk Score: " . $result['walk_score'] . "</font>";
			echo "</p>";
			echo "</div>";
			echo "</div></div><br/>";
			$total_records++;
		}
	}
		//echo "</tbody></table>"; 
		/*	$total_pages = ceil($total_records / $limit);  
			$pagLink = "<ul class='pagination'>";  
			for ($i=1; $i<=$total_pages; $i++) {  
						 $pagLink .= "<li><a href='index.php?page=".$i."'>".$i."</a></li>";  
			};  
			echo $pagLink . "</ul>";  
		*/
		$stmt->close(); 
	
	
$db->close();

?>
