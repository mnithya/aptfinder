<?php
require "dbutil.php";
$db = DbUtil::loginConnection();
date_default_timezone_set('America/New_York');
$timestamp = time();

$stmt = $db->stmt_init();

$location= '%' . $_GET['searchLoc'] . '%';
$min_rent = $_GET['minrent'];
$max_rent = $_GET['maxrent'];

$conditions = [];

if(!empty($_GET['searchLoc'])) {
	array_push($conditions, "(Address.city LIKE '$location' OR Address.state LIKE '$location' OR Address.zipcode LIKE '$location')");
}

if(isset($_GET['minrent'])) {
	array_push($conditions, "Apartment.rent >= " . $min_rent);
} 

if(isset($_GET['maxrent'])) {
	array_push($conditions, "Apartment.rent <= " . $max_rent);
}

$query = "select * from Apartment natural join Building natural join Address inner join Images on Images.purpose_building_id = Building.building_id where ";
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


if($stmt->prepare($query) or die("Failed to retrieve apartments")) {
		
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
		while($stmt->fetch()) {
			echo "<div class='post-container'>";
			echo "<div class='post-thumb'><img class='span2' src='" . $result['img_url'] . "' alt='' style='width:304px; height: 228;'></div>";
			echo "<div class='post-content-container'><div class='post-content'>";
			echo "<h3 class='post-heading'>" . $result['name'] . "</h3>";
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
		}
		//echo "</tbody></table>";
		
		$stmt->close(); 
	}
	
$db->close();

?>
