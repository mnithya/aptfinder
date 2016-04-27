<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!isset($_SESSION['username'])){
		echo "<script> alert('You do not have permission to enter this page');";
		echo "</script>";
		echo "<script>location.href='index.php'</script>";
		exit();
 	}



?>



<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Apartment Finder</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	
    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">
	<link href="css/thumbnail.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <!-- <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css"> 

    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>   
    <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

</head>

<body>
  <?php 
    session_start();
   

	if ($_SESSION['isAdmin'] == 0) {
		include_once("./libraryC.php");
		}
	else if ($_SESSION['isAdmin'] ==1) {
		include_once("./libraryA.php");
	} else {
		include_once("./libraryB.php");
	}
    $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
  ?>

  <!-- Navigation -->
  <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
      <div class="container topnav">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand topnav" href="index.php#">Home</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                   <?php
                  if ($_SESSION['isAdmin'] == 1){
                    echo "<li> <a href='apt/index.html'> Admin Tools</a></li>" ;  
                  }
                  echo "<li><a href=\"index.php#about\">About</a></li>";
                  echo "<li><a href=\"index.php#advancedSearch\">Search</a></li>";
                  if (isset($_SESSION['username'])){
                    echo "<li> <a href='user_profile.php'> Profile </a> </li>";
                    echo "<li> <a href='logout.php'> Log out</a> </li>";
                  } else {
                    echo "<li> <a href='Signup.php'>Sign Up/Sign In</a> </li>";
                  }
                  ?>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
  </nav>

<!-- Header -->
  <a name="banner"></a>
  <div class="intro-header">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <br/>
                  <br/>
                   <h2 style="text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.6); font-weight: 625">Apartment Finder</h2>
                  <hr class="intro-divider">
               </div> 
          </div>   
      </div>          
  </div>
  <!-- /.intro-header -->

<div class="content-section-b">
    <div class="container">
    <div class="row">
        <!-- KK place username -->
        <div class="col-sm-10"><?php echo "<h1>'" . $_SESSION["username"] . "'s Profile</h1>" ?></div>

        <div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="http://pre10.deviantart.net/b323/th/pre/i/2012/235/0/2/facebook_profile_image_by_edgarsvensson-d5c7rhk.jpg" style="width:150px; height: auto;"></a></div>
    </div>
    <div class="row">
        <div class="col-sm-3"><!--left col-->
              
          <ul class="list-group">
            <li class="list-group-item text-muted">Profile</li>
            <!-- KK grab name -->
            <li class="list-group-item text-right"><span class="pull-left"><strong>Real name</strong></span> 
              <?php
                session_start();
                $query = "SELECT first_name, last_name FROM User WHERE username = '" . $_SESSION["username"] . "';";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                echo $row["first_name"] . " " . $row["last_name"];
              ?>
              <!-- Joseph Doe -->
            </li>

            <li class="list-group-item text-right"><span class="pull-left"><strong>Joined</strong></span> 4.20.2016</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Last seen</strong></span> Today</li>
          </ul> 
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <!-- KK count renting -->
            <li class="list-group-item text-right"><span class="pull-left"><strong>Renting</strong></span>
              <?php
                session_start();
                $query = "SELECT COUNT(Rents.`rents-user_id`) AS c FROM (User NATURAL JOIN Rents) WHERE User.user_id = Rents.`rents-user_id` AND username = '" . $_SESSION["username"] . "' GROUP BY Rents.`rents-user_id`;";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                if ($row["c"] == "") {
                  echo "<p>0</p>";
                }
                else{
                  echo "<p>" . $row["c"] . "</p>";
                }
              ?>
            </li>
            <!-- KK count favourites -->
            <li class="list-group-item text-right"><span class="pull-left"><strong>Favourites</strong></span>
              <?php
                session_start();
                $query = "SELECT COUNT(Favorites.`fav-user_id`) AS c FROM (User INNER JOIN Favorites) WHERE User.user_id = Favorites.`fav-user_id` AND username = '" . $_SESSION["username"] . 
                            "' GROUP BY Favorites.`fav-user_id`;";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                if ($row["c"] == "") {
                  echo "<p>0</p>";
                }
                else {
                  echo "<p>" . $row["c"] . "</p>";
                }
              ?>
            </li>
          </ul> 
               
          <div class="panel panel-default">
            <div class="panel-heading">Contact</div>
            <div class="panel-body">
                <p>
                    <!-- KK add email here -->
                    <?php
                      session_start();
                      $query = "SELECT email FROM User WHERE username = '" . $_SESSION["username"] . "';";
                      $result = mysqli_query($con, $query);
                      $row = mysqli_fetch_assoc($result);
                      echo $row["email"];
                    ?>
                  </br> </br>
                    <i class="fa fa-facebook fa-2x"></i>
                    <i class="fa fa-github fa-2x"></i>
                    <i class="fa fa-twitter fa-2x"></i>
                    <i class="fa fa-pinterest fa-2x"></i>
                    <i class="fa fa-google-plus fa-2x"></i> 
                </p>
            </div>
          </div>
          
        </div><!--/col-3-->
        <div class="col-sm-9">
          
          <ul class="nav nav-tabs" id="myTab">
            <li class="active">
              <a href="#home" data-toggle="tab">
                <i class="fa fa-home fa-1x"></i> 
                Home
              </a>
            </li>
            <li>
              <a href="#favourites" data-toggle="tab">
                <i class="fa fa-heart fa-1x"></i> 
                Favourites
              </a>
            </li>
            <li>
              <a href="#settings" data-toggle="tab">
                <i class="fa fa-cog fa-1x"></i> 
                Settings
              </a>
            </li>
          </ul>
              
          <div class="tab-content">

<!-- ********************************************************************
     ******            Home/Curent Renting Listing Tab             ******
     ********************************************************************
 -->
<div class="tab-pane active" id="home">
  <h4>Currently Renting</h4>
  <!-- KK add apartment detail for apartments renting! -->
  <div class="table-responsive" id="sec0">
    <div class="col-md-9">
<?php
  session_start();
  $query = "SELECT DISTINCT * FROM User INNER JOIN Rents NATURAL JOIN Apartment NATURAL JOIN Address NATURAL JOIN Building INNER JOIN Images ON Images.purpose_building_id = Building.building_id AND User.user_id = Rents.`rents-user_id` AND Rents.`rents-apt_num` = Apartment.apt_num AND Rents.`rents-building_id` = Building.building_id WHERE username = '". $_SESSION["username"] ."'";

  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  echo "<div style='text-align: justify; margin-left: 50px; margin-right: 50px;'>";
        //grab building image
      if($row['img_url'] === null || $row['img_url'] === "" || sizeof($row['img_url']) == 0) {
        //default image if img URL not set
        $image = "http://i.imgur.com/OK5gGu4.png";        
      }
      else {
        $image = $row['img_url'];
      }
      
      //display building image
      echo "<div class='col-xs-12 col-md-8'>";
        echo "<img src='" . $image . "' style='width:500px; height: auto; max-width:100%; max-height:100%;'>";
      echo "</div>";

      echo "<div class='row'>";
        echo "<h2 class='section-heading'><a href='apt_page.php?id=" . $row['building_id'] . "'>" . $row['name'] . "</a></h2></br>";
        //display rating
        $full_stars_num = floor($row['rating']);
        $half_star = False;
        if($row['rating'] - $full_stars_num >= .5) {
          $half_star = True;
        }
        echo " ";
        for($i = 0; $i < $full_stars_num; $i++) {
          echo "<i class='fa fa-star'></i>";
        }
        if($half_star) {
          echo "<i class='fa fa-star-half'></i>";
        }
        
        //listing address
        echo "<br><small>" 
        . $row['street_num'] . " " . $row['street'] . " " . "<br/>" 
        . "Apartment #" . $row['apt_num'] . "<br/>"
        . $row['city'] . ", " . $row['state'] . " " . $row['zipcode'] . "</small></h2>";
        
        echo "<br/>";
    echo "</div></div>";

?>

    </div> 
  </div>
  
 </div><!--/tab-pane-->

<!-- ********************************************************************
     ******                  Favourites Listing Tab                ******
     ********************************************************************
 -->

  <div class="tab-pane" id="favourites">
    <h4>Your List of Favourite Apartments!</h4>
<?php
  $username = $_SESSION["username"];

  $query = "SELECT * FROM User NATURAL JOIN Favorites NATURAL JOIN Building NATURAL JOIN 
        Apartment NATURAL JOIN Address INNER JOIN Images 
      ON Images.purpose_building_id = Building.building_id AND 
        Favorites.`fav-user_id` = User.user_id AND 
        Favorites.`fav-apt_id` = Apartment.apt_num AND 
        Favorites.`fav-building_id` = Building.building_id
      WHERE User.username = '$username'
      GROUP BY Building.building_id";

  $result_table = mysqli_query($con, $query);
while ($result = mysqli_fetch_assoc($result_table)) {
    echo "<div class='post-container'>";
    $image = "";
    if($result['img_url'] === null || $result['img_url'] === "" || sizeof($result['img_url']) == 0) {
      //default image if img URL not set
      $image = "http://i.imgur.com/OK5gGu4.png";        
    }
    else {
      $image = $result['img_url'];
    }
    echo "<div class='post-thumb'><img class='span2' src='$image' alt='' 
            style='width:304px; height: 228;'></div>";
    echo "<div class='post-content-container'><div class='post-content'>";
      echo "<h3 class='post-heading'><a href='apt_page.php?id=" . $result['building_id'] . 
              "'>" . $result['name'] . "</a></h3>";
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
      echo "<div class='post-location'>" . $result['city'] . ", " . 
              $result['state'] . "</div>";
      echo "<p class='description'>"; 
      echo "<br/>Bedrooms: " . $result['num_bedrooms'] . "<br/>";
      echo "Bathrooms: " . $result['num_bathrooms'] . "<br/>";
      echo "<font color='#2FC500'>Walk Score: " . $result['walk_score'] . "</font>";
      echo "</p>";
    echo "</div>";
  echo "</div></div><br/>";
}



?>   
</div><!--/tab-pane-->

<!-- ********************************************************************
     *********                   Settings  Tab                 **********
     ********************************************************************
 -->

<div class="tab-pane" id="settings">
    <hr>
    <form class="form" action="update_user.php" method="post" id="registrationForm">
        <div class="form-group">
            
            <div class="col-xs-6">
                <label for="first_name"><h4>First name</h4></label>
                <input class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any." type="text">
            </div>
        </div>
        <div class="form-group">
            
            <div class="col-xs-6">
              <label for="last_name"><h4>Last name</h4></label>
                <input class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any." type="text">
            </div>
        </div>

        <div class="form-group">
            
            <div class="col-xs-6">
                <label for="email"><h4>Email</h4></label>
                <input class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email." type="email">
            </div>
        </div>
        <div class="form-group">
            
            <div class="col-xs-6">
                <label for="email"><h4>Verify Email</h4></label>
                <input class="form-control" name="email2" id="email2" placeholder="you@email.com" title="enter a location" type="email">
            </div>
        </div>
        <div class="form-group">
            
            <div class="col-xs-6">
                <label for="password"><h4>New Password</h4></label>
                <input class="form-control" name="password" id="password" placeholder="password" title="enter your password." type="password">
            </div>
        </div>
        <div class="form-group">
            
            <div class="col-xs-6">
              <label for="password2"><h4>Verify</h4></label>
                <input class="form-control" name="password2" id="password2" placeholder="password" title="enter your password2." type="password">
            </div>
        </div>

        <div class="form-group">
             <div class="col-xs-12">
                  <br>
                  <a><button class="btn btn-lg btn-success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button></a>
                  <a><button class="btn btn-lg" type="reset"><i class="fa fa-repeat" aria-hidden="true"></i> Reset</button></a>
              </div>
        </div>
  </form>
</div>
</div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
</div><!-- /.content-section-b -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="index.php#about">About</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="index.php#services">Services</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="index.php#contact">Contact</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; University of Virginia 2016. All Rights Reserved o(>_<)o </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>