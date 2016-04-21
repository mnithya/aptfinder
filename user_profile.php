<!DOCTYPE html>
<html lang="en">

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
    include_once("library.php"); // To connect to the database
    $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $query = "SELECT DISTINCT * FROM User INNER JOIN Images 
    ON Images.purpose_user_id = User.user_id 
    WHERE username = " . $_SESSION['username'];
// KK FIXME
    $result = mysqli_query($con, $query);
    if ($result->num_rows != 1) {

    }
    $row = mysqli_fetch_assoc($result); //grab user data
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
                    <li>
                        <a href="apt/index.html">Admin Tools</a>
                    </li>
                    <li>
                        <a href="index.php#about">About</a>
                    </li>
                    <li>
                        <a href="index.php#advancedSearch">Search</a>
                    </li>
                    <li>
                        <a href="user_profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="Signup.php">Sign Up/Sign In</a>
                    </li>
                    <li>
                        <a href="index.php#contact">Contact Us</a>
                    </li>
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
    <hr>
    <div class="container">
    <div class="row">
        <!-- KK place username -->
        <div class="col-sm-10"><h1>UserNameGoesHere!!</h1></div>
        <div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="http://pre10.deviantart.net/b323/th/pre/i/2012/235/0/2/facebook_profile_image_by_edgarsvensson-d5c7rhk.jpg" style="width:150px; height: auto;"></a></div>
    </div>
    <div class="row">
        <div class="col-sm-3"><!--left col-->
              
          <ul class="list-group">
            <li class="list-group-item text-muted">Profile</li>
            <!-- KK grab name -->
            <li class="list-group-item text-right"><span class="pull-left"><strong>Real name</strong></span> Joseph Doe</li>

            <li class="list-group-item text-right"><span class="pull-left"><strong>Joined</strong></span> 4.20.2016</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Last seen</strong></span> Today</li>
          </ul> 
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <!-- KK count renting -->
            <li class="list-group-item text-right"><span class="pull-left"><strong>Renting</strong></span> 2</li>
            <!-- KK count favourites -->
            <li class="list-group-item text-right"><span class="pull-left"><strong>Favourites</strong></span> 13</li>
          </ul> 
               
          <div class="panel panel-default">
            <div class="panel-heading">Contact</div>
            <div class="panel-body">
                <p>
                    <!-- KK add email here -->
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
            <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-home fa-1x"></i> Home</a></li>
            <li><a href="#favourites" data-toggle="tab"><i class="fa fa-heart fa-1x"></i> Favourites</a></li>
            <li><a href="#settings" data-toggle="tab"><i class="fa fa-cog fa-1x"></i> Settings</a></li>
          </ul>
              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
              <h4>Currently Renting</h4>
              <!-- KK add apartment detail for apartments renting! -->
              <div class="table-responsive" id="sec0">
                <div class="col-md-9">
<?php
// $stmt = $db->stmt_init();

$username = $_SESSION["username"]
$query = "SELECT user_id FROM User WHERE username = username";
$result = mysqli_query($con, $query);
$user_id = mysql_fetch_row($result)["user_id"];

if (is_null($user_id)) {
  echo "Failed to read query...".mysqli_connect_error();
}

echo "user_id: " . $user_id;
// $query = "SELECT * FROM Rents NATURAL JOIN Building NATURAL JOIN Apartment NATURAL JOIN Address 
//     INNER JOIN Images ON Images.purpose_building_id = Building.building_id WHERE Rents.`rents-user_id` = " . $user_id;
// $first = True;

// $beforeGrouping = $query;

// $limit = 4;  
// // if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
// $start_from = ($page-1) * $limit; 

// $query = $query . " group by building_id";

// echo $query;
// if($stmt->prepare($query) or die("Failed to retrieve apartments")) {
//     echo $query;
//      $stmt->execute();

//      /*Bind result start*/
//      //source: https://gunjanpatidar.wordpress.com/2010/10/03/bind_result-to-array-with-mysqli-prepared-statements/
//      $meta = $stmt->result_metadata();
//      $result = array();
//      while ($field = $meta->fetch_field())
//      {
//             $result[$field->name] = NULL;
//             $params[] = &$result[$field->name];
//      }
 
//     call_user_func_array(array($stmt, 'bind_result'), $params);
//     /*Bind result end */
    
//     //echo "<table class='table table-bordered'>";
//     //echo "<thead><th>building_id</th><th>apt_num</th><td>Image</td></thead><tbody>\n";
//     $total_records = 0;
//     while($stmt->fetch()) {
//       echo "<div class='post-container'>";
//       $image = "";
//       if($result['img_url'] === null || $result['img_url'] === "" || sizeof($result['img_url']) == 0) {
//         //default image if img URL not set
//         $image = "http://i.imgur.com/OK5gGu4.png";        
//       }
//       else {
//         $image = $result['img_url'];
//       }
//       echo "<div class='post-thumb'><img class='span2' src='" . $image . "' alt='' style='width:304px; height: 228;'></div>";
//       echo "<div class='post-content-container'><div class='post-content'>";
//       echo "<h3 class='post-heading'><a href='apt_page.php?id=" . $result['building_id'] . "'>" . $result['name'] . "</a></h3>";
//       echo "<div class='rating inline'>"; 
//       $full_stars_num = floor($result['rating']);
//       $half_star = False;
//       if($result['rating'] - $full_stars_num >= .5) {
//         $half_star = True;
//       }
//       echo " ";
//       for($i = 0; $i < $full_stars_num; $i++) {
//         echo "<i class='fa fa-star fa-lg'></i>";
//       }
//       if($half_star) {
//         echo "<i class='fa fa-star-half fa-lg'></i>";
//       }
//       echo "</div>";
//       echo "<div class='post-rent'>$" . number_format($result['rent']) . "/month</div>";
//       echo "<br/><br/>";
//                         echo "<div class='post-location'>" . $result['city'] . ", " . $result['state'] . "</div>";

//       echo "<p class='description'>"; 
//       echo "<br/>Bedrooms: " . $result['num_bedrooms'] . "<br/>";
//       echo "Bathrooms: " . $result['num_bathrooms'] . "<br/>";
//       echo "<font color='#2FC500'>Walk Score: " . $result['walk_score'] . "</font>";
//       echo "</p>";
//       echo "</div>";
//       echo "</div></div><br/>";
//       $total_records++;
//     }
//     //echo "</tbody></table>"; 
//     /*  $total_pages = ceil($total_records / $limit);  
//       $pagLink = "<ul class='pagination'>";  
//       for ($i=1; $i<=$total_pages; $i++) {  
//              $pagLink .= "<li><a href='index.php?page=".$i."'>".$i."</a></li>";  
//       };  
//       echo $pagLink . "</ul>";  
//     */
//     $stmt->close(); 
//   }
?>

                </div> 
              </div>
              
             </div><!--/tab-pane-->
             <div class="tab-pane" id="favourites">
               
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Label 1</th>
                      <th>Label 2</th>
                      <th>Label 3</th>
                      <th>Label </th>
                      <th>Label </th>
                      <th>Label </th>
                    </tr>
                  </thead>
                  <tbody id="items">
                    <tr>
                      <td>1</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                    </tr>
                  </tbody>
                </table>
                <hr>
                <div class="row">
                  <div class="col-md-4 col-md-offset-4 text-center">
                    <ul class="pagination" id="myPager"></ul>
                  </div>
                </div>
              </div><!--/table-resp-->
              
              <hr>
            
               
             </div><!--/tab-pane-->
             <div class="tab-pane" id="settings">
                    
                
                  <hr>
                  <form class="form" action="##" method="post" id="registrationForm">
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
                              <input class="form-control" id="location" placeholder="somewhere" title="enter a location" type="email">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="password"><h4>Password</h4></label>
                              <input class="form-control" name="password" id="password" placeholder="password" title="enter your password." type="password">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="password2"><h4>Verify</h4></label>
                              <input class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2." type="password">
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                <button class="btn btn-lg" type="reset"><i class="fa fa-repeat" aria-hidden="true"></i> Reset</button>
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