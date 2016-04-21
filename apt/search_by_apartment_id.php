<?php
require "dbutil.php";

$db = DbUtil::loginConnection();
date_default_timezone_set('America/New_York');
$timestamp = time();

$stmt = $db->stmt_init();

$username = $_SESSION["username"]
$query = "SELECT user_id FROM User WHERE username = username";
$result = mysqli_query($db, $query);
$user_id = mysql_fetch_row($result)["user_id"];

if (is_null($user_id)) {
	echo "Failed to read query...".mysqli_connect_error();
}

// $location= '%' . $_GET['searchLoc'] . '%';
$min_rent = 0;
$max_rent = 10000000;

$conditions = [];

// if(!empty($_GET['searchLoc'])) {
	array_push($conditions, "(Address.city LIKE '$location' OR Address.state LIKE '$location' OR Address.zipcode LIKE '$location')");
// }

array_push($conditions, "Apartment.rent >= " . $min_rent);
array_push($conditions, "Apartment.rent <= " . $max_rent);

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

$query = "SELECT * FROM Rents NATURAL JOIN Building NATURAL JOIN Apartment NATURAL JOIN Address 
		INNER JOIN Images ON Images.purpose_building_id = Building.building_id WHERE Rents.user_id = " . $user_id;
$first = True;

$beforeGrouping = $query;

$limit = 4;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit; 

$query = $query . " group by building_id";

echo $query;
if($stmt->prepare($query) or die("Failed to retrieve apartments")) {
		echo $query;
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
		//echo "</tbody></table>"; 
		/*	$total_pages = ceil($total_records / $limit);  
			$pagLink = "<ul class='pagination'>";  
			for ($i=1; $i<=$total_pages; $i++) {  
						 $pagLink .= "<li><a href='index.php?page=".$i."'>".$i."</a></li>";  
			};  
			echo $pagLink . "</ul>";  
		*/
		$stmt->close(); 
	}
	
$db->close();

?>
