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

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   <script>
	$(document).ready(function() {
		$( "#searchByLocRentButton" ).click(function() {
		
			$.ajax({
				url: 'apt/search_by_location_rent.php', 
				data: {
					searchLoc: $("#location").val(),
					minrent: $("#minrent" ).val(),
					maxrent: $("#maxrent").val()
				},
				success: function(data){
					$('#searchResult').html(data);	
				
				},
				//error:function(exception){alert('Exeption:'+exception);}
				error: function (data) { console.log(data); }
			});
		});
	});
	</script>

</head>
  
<body>
	<?php
	require "apt/dbutil.php";
    $db = DbUtil::loginConnection();
	date_default_timezone_set('America/New_York');
	$timestamp = time();
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
                     <h2 style="text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.6); font-weight: 625">Login/Sign Up</h2>
                     <h4 style="text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.6); font-weight: 625">Find your dream home today!</h4>
                    <hr class="intro-divider">
                 </div> 
            </div>   
        </div>          
    </div>
    <!-- /.intro-header -->



    <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Sign Up</h2>
                    <p class="lead">
						<form class="col-md-12" method="POST" action="Signup.php">
						    <div class="form-group">
						        <input type="text" class="form-control input-lg" placeholder="First Name" name = "inputFname">
						    </div>
						    <div class="form-group">
						        <input type="text" class="form-control input-lg" placeholder="Last Name" name="inputLname">
						    </div>
						    <div class="form-group">
						        <input type="text" class="form-control input-lg" placeholder="Email" name="inputEmail">
						    </div>
						    <div class="form-group">
						        <input type="text" class="form-control input-lg" placeholder="Username" name = "inputUname">
						    </div>
						    <div class="form-group">
						        <input type="password" class="form-control input-lg" placeholder="Password" name = "inputPword">
						    </div>
						    <div class="form-group">
						        <input type="password" class="form-control input-lg" placeholder="Confirm Password" name="inputconfirm">
						    </div>
						    <div class="form-group">
						        <button class="btn btn-primary btn-lg btn-block" name="register">Create Account</button>
						    </div>
						</form>
                    </p>
                </div>

				<div class="col-lg-5 col-sm-pull-6  col-sm-6">
                	<hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Login</h2>
                    <p class="lead">

						<form class="col-md-12" method="POST" action="Signup.php">
						    <div class="form-group">
						        <input type="text" class="form-control input-lg" placeholder="Username" name="inputUsername">
						    </div>
						    <div class="form-group">
						        <input type="password" class="form-control input-lg" placeholder="Password" name="inputPassword">
						    </div>
						    <div class="form-group">
						        <button class="btn btn-primary btn-lg btn-block" name="signin">Sign In</button>
						    </div>
						</form>
                    </p>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>



	  <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#about">About</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#services">Services</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#contact">Contact</a>
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




<?php
	session_start();
	if (isset($_POST["register"])){

		//SQL injection needs to be prevented;

	
	
		include_once("./library.php");
		$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
	
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: ". mysqli_connect_error();
		}
		

		$f = $_POST["inputFname"];
		$l = $_POST["inputLname"];
		$e = $_POST["inputEmail"];
		$u = stripslashes($_POST["inputUname"]);
		$p = $_POST["inputPword"];
		$c = $_POST["inputconfirm"];
	
	
		if($p == $c){
		
			$sql = "Select * FROM User";
			$result = mysqli_query($con, $sql);
	
			while ($row = mysqli_fetch_array($result)){
				//echo $row['username'];
				//echo "<br>";
				}
	
			$row = $result -> num_rows;
			$count = $row + 5;
			//echo $count;
	
			$sql2 = "SELECT username from User where User.username = '$u'";
			$result2 = mysqli_query($con, $sql2);
			$nrow = $result2 -> num_rows;
	
			//password hashing 
			$p = password_hash($p, PASSWORD_DEFAULT);
	
			//echo $p;
	
			//$ct = 0;
			if ($nrow == 0 ) {
	
				$query = "insert into User( user_id, username, pword, email, first_name, last_name) values ('$count','$u', '$p', '$e','$f','$l')";
				$result3 = mysqli_query($con, $query) or die ("wrong: ".$con-> error);
			
				
				echo "<script>alert (\"You have registered succesfully! Welcome!\")</script>";
				$URL="index.php";
				echo "<script>location.href='$URL'</script>";
				
				//welcoming new user by redirecting to a homepage; cookie setting needed;	
				} 
			else if ($nrow > 0) {
				echo "<script>alert (\"Username already exists. Pleaes choose different username!\")</script>";
	
				}
		} else {
	
	
			echo "<script>alert (\"you have entered different passwords, please confirm your password again\")</script>";
			//echo "you have entered different passwords, please confirm your password again";
			mysqli_close($db_connection);
		
		}
	}

	else if (isset($_POST["signin"])){
		
		include_once("./library.php");
		$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
	
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: ". mysqli_connect_error();
			}
		
	
			$un = stripslashes($_POST["inputUsername"]);
			$pw = $_POST["inputPassword"];
	
			$stmt = $con->prepare('SELECT * FROM User Where username = ?');
			$stmt-> bind_param('s', $name);
			$stmt->execute();
			$stmt->close();

			
			
			$query = "select * FROM User WHERE username='$un'";
			$result = mysqli_query($con, $query);
			$num = $result->num_rows;
	
			$query_isAdmin = "select * FROM User WHERE username='$un'";
			$resulta = mysqli_query($con, $query_isAdmin);
			
			$row = $resulta ->fetch_array();
			$Admin = $row['isAdmin'];
	
			
	
			$_SESSION['isAdmin'] = -1;
		
			if ($num == 1) {
					$row = $result->fetch_array();
					if (password_verify($pw, stripslashes($row['pword']))) {
							$_SESSION['username'] = $un;
							
							
							if ($Admin == 0){
								$_SESSION['isAdmin'] = 0;
								}
							else if ($Admin == 1){
								$_SESSION['isAdmin'] = 1;
							}

							//echo '<script type="text/javascript">alert("'.$_SESSION['isAdmin'].'");</script>';
							
							echo "<script> alert('You are logged in successfully');";
							echo "</script>";

							$URL="index.php";
							echo "<script>location.href='$URL'</script>";
							exit();
					} else {
						echo '<h3>The username or password do not match </h3>';
					}
					
			}
	
		mysqli_close($conn);
	
		}
			
?>
		
		
		