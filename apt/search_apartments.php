<?php

include_once("./library.php"); // To connect to the database
 	$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 	// Check connection
 	if (mysqli_connect_errno())
 	{
 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
 	}

date_default_timezone_set('America/New_York');
$timestamp = time();

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

if(isset($_GET['state']) && $_GET['state'] !== "null") {
	array_push($conditions, "Address.state LIKE '%" . $_GET['state'] . "%'");
}

if(isset($_GET['city']) && $_GET['city'] !== "null") {
	array_push($conditions, "Address.city LIKE '%" . $_GET['city'] . "%'");
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

$query = $query . " group by building_id LIMIT $start_from, $limit";

echo $query;

$total_records = 0;
$searchResults = mysqli_query($con,$query);
while($result = mysqli_fetch_array($searchResults)) {	
		
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
			$total_records++;
	}
	
	
	echo "<ul class='pagination text-center' id='pagination'>";
	if(!empty($total_pages)) {
		for($i=1; $i<=$total_pages; $i++) {
			if($i == 1) {
				echo "<li class='active' id='$i'><a href='pagination.php?page=$i'>$i</a></li>";
			}
			else {
				echo "<li id='$i'><a href='pagination.php?page=$i>$i</a></li>";
			}
		}
	} 
	
	mysqli_close($con);

?>
