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
	<script src="http://rawgit.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>

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
					maxrent: $("#maxrent").val(),
					state: $("#select-state").val(),
					city: $("#select-city").val()
				},
				success: function(data){
					if($("#minrent" ).val() != 0) {
						$('#minrent_input').val($("#minrent" ).val());
					}
					if($("#maxrent" ).val() != 1000000) {
							$("#maxrent_input").val($("#maxrent" ).val());
					}
					$('#searchResult').html(data);	
					//$("#target-content").load("search_apartments.php?page=1");
				},
				//error:function(exception){alert('Exeption:'+exception);}
				error: function (data) { console.log(data); }
			});
		});
		$( "#select-state").change(function() {
			$.ajax({
				url: 'apt/search_by_location_rent.php', 
				data: {
					searchLoc: $("#location").val(),
					minrent: $("#minrent" ).val(),
					maxrent: $("#maxrent").val(),
					state: $("#select-state").val(),
					city: $("#select-city").val()
				},
				success: function(data){
					$('#searchResult').html(data);	
				},
				error: function (data) { console.log(data); }
			});
		});
		$( "#select-city").change(function() {
			$.ajax({
				url: 'apt/search_by_location_rent.php', 
				data: {
					searchLoc: $("#location").val(),
					minrent: $("#minrent" ).val(),
					maxrent: $("#maxrent").val(),
					state: $("#select-state").val(),
					city: $("#select-city").val()
				},
				success: function(data){
					$('#searchResult').html(data);	
				},
				//error:function(exception){alert('Exeption:'+exception);}
				error: function (data) { console.log(data); }
			});
		});
		$( "input[type=checkbox]").change(function() {
			$.ajax({
				url: 'apt/search_by_location_rent.php', 
				data: {
					searchLoc: $("#location").val(),
					minrent: $("#minrent" ).val(),
					maxrent: $("#maxrent").val(),
					state: $("#select-state").val(),
					city: $("#select-city").val(),
					beds_list: $("input[name='beds_list[]']").serialize(),
					baths_list: $("input[name='baths_list[]']").serialize(),
					amenities_list: $("input[name='amenity_input[]']").serialize()
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
	session_start();
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
                    ?>
                    <li>
                        <a href="index.php#about">About</a>
                    </li>
                    <li>
                        <a href="index.php#advancedSearch">Search</a>
                    </li>
                    <?php
                    session_start();
                    if (isset($_SESSION['username'])){
                    	echo "<li> <a href='user_profile.php'> Profile </a></li>" ;   
                    	echo "<li> <a href='logout.php'> Log out </a></li>" ;   
                    } else {
                    	echo "<li> <a href='Signup.php'> Sign Up/Sign in </a></li>" ;   
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
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Apartment Finder</h1>
                        <h3></h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                               <input type="text" style="width: 230px;" class="form-control" id="location" name="location" placeholder="Enter city, state, or zip code"/>
                            </li>
							<li>
								<select class="form-control" id="minrent" name="minrent">
									<option value="0" data-hidden="true">Minimum Rent</option>
									<option value="100">$100</option>
									<option value="200">$200</option>
									<option value="300">$300</option>
									<option value="400">$400</option>
									<option value="500">$500</option>
									<option value="600">$600</option>
									<option value="700">$700</option>
									<option value="800">$800</option>
									<option value="900">$900</option>
									<option value="1000">$1000</option>
									<option value="1200">$1100</option>
									<option value="1400">$1400</option>
									<option value="1600">$1600</option>
									<option value="1800">$1800</option>
								</select>
							</li>
							<li>
								<select class="form-control" id="maxrent" name="maxrent">
									<option value="1000000" data-hidden="true">Maximum Rent</option>
									<option value="100">$100</option>
									<option value="200">$200</option>
									<option value="300">$300</option>
									<option value="400">$400</option>
									<option value="500">$500</option>
									<option value="600">$600</option>
									<option value="700">$700</option>
									<option value="800">$800</option>
									<option value="900">$900</option>
									<option value="1000">$1000</option>
									<option value="1200">$1100</option>
									<option value="1400">$1400</option>
									<option value="1600">$1600</option>
									<option value="1800">$1800</option>
								</select>
							</li>
							<li>
								<button type="button" class="btn btn-default" id="searchByLocRentButton" onclick="location.href='#advancedSearch';">Search</button>
							</li>
							<li>
								<button type="button" class="btn btn-default" onclick="location.href='#advancedSearch';">Advanced Search</button>
							</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->

    <div class="content-section-b" id="about">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Find Your Dream Apartment<br>by Team Awesome-Sawce</h2>
                    <p class="lead">
                        You are only a few clicks away from finding your dream home or an apartment for a secret getaway. Check out our <a target="_blank" href="http://www.psdcovers.com/">Apartment Finder</a>! Become a member and you can check out an apartment with a single click!
                    </p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" style="border-radius: 4px;" src="img/apt_dream.jpg" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-b -->

    <!-- Header -->
    <div class="intro-header"  id="advancedSearch">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <br/>
                    <br/>
                     <h2 style="text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.6); font-weight: 625">Find your dream home today!</h2>
                    <hr class="intro-divider">
                 </div> 
            </div>   
        </div>          
    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->

		<div class="container">
			<div class="row">
					<br/><br/><br/>
				<div class="col-md-3" id="leftCol">
					<div class="well"> 
						<ul class="nav nav-stacked" id="sidebar">
						  <h4 class="text-muted large-text">
							Refine By
  						  </h4>
						  <li>
						  <label>State</label>
						  <select id="select-state" class="form-control bfh-states" data-country="US">
							<option data-hidden="true" value="null">Select One</option>
							<?php
							$stmt = $db->stmt_init();
								if($stmt->prepare("select distinct state from Address order by state") or die("Failed to retrieve amenities")) {
										$stmt->execute();
										$stmt->bind_result($state);
										while($stmt->fetch()) {
												echo "<option value='$state'>$state</option>";
										}
										$stmt->close();
								}
							?>
						  </select>
						  </li>
						  <li>
						  <label>City</label>
						  <select id="select-city" class="form-control bfh-states" data-country="US">
							<option data-hidden="true" value="null">Select One</option>
						    <?php
							$stmt = $db->stmt_init();
								if($stmt->prepare("select distinct city from Address order by city") or die("Failed to retrieve amenities")) {
										$stmt->execute();
										$stmt->bind_result($city);
										while($stmt->fetch()) {
												echo "<option value='$city'>$city</option>";
										}
										$stmt->close();
								}
							?>
						  </select>
						  </li>
						  <li>
							  <label>Bedrooms</label>
							  <div id="bedroom-select">
								  <div class="checkbox">
								  <label><input type="checkbox" name="beds_list[]" value="1">1</label>
								  </div>
								  <div class="checkbox">
								  <label><input type="checkbox" name="beds_list[]" value="2">2</label>
								  </div>
								  <div class="checkbox">
								  <label><input type="checkbox" name="beds_list[]" value="3">3</label>
								  </div>
								  <div class="checkbox">
								  <label><input type="checkbox" name="beds_list[]" value="4">4+</label>
								  </div>
							  </div>
						  </li>
						  <li>
						      <label>Baths</label>
							  <div id="bathroom-select">
								  <div class="checkbox">
								  <label><input type="checkbox" name="baths_list[]" value="1">1</label>
								  </div>
								  <div class="checkbox">
								  <label><input type="checkbox" name="baths_list[]" value="2">2</label>
								  </div>
								  <div class="checkbox">
								  <label><input type="checkbox" name="baths_list[]" value="3">3+</label>
								  </div>
							  </div>
						  </li>
						  <li>
							  <label>Rent</label>
							  <form class="form-inline" role="form">
								  <div class="form-group">
									<label for="minrent_input">$</label>
									<input type="number" class="rent-filter" id="minrent_input">
								  </div>
								  <div class="form-group">
									<label for="maxrent_input" style="margin-left: 2px;">  to $</label>
									<input type="number" class="rent-filter" id="maxrent_input">
								  </div>
								  <button type="submit" class="btn btn-default btn-rent" id="rent_range">Go</button>
								</form>
						  </li>
						  <li style="margin-top: 10px;">
						      <label>Apartment Amenities</label>
							  <div id="amenities">
							  <?php
								$stmt = $db->stmt_init();
								if($stmt->prepare("select amenity_id, name from Amenity") or die("Failed to retrieve amenities")) {
										$stmt->execute();
										$stmt->bind_result($amenity_id, $name);
										while($stmt->fetch()) {
												echo "<div class='checkbox'>";
												echo "<label><input type=\"checkbox\" name='amenity_input[]' value=$amenity_id>";
												echo "$name</label></div>";
										}
										$stmt->close();
								}
							  ?>
							</div>
						  </li>
						</ul>
					</div>
				</div>  
				<div class="col-md-9">
					<h2 id="sec0">Results</h2>
				
						<div id="searchResult"></div>
						<div id="page-selection"></div>
				</div> 
			</div>
		</div>

	<a  name="contact"></a>
    <div class="banner">
        <div class="container">
            <div class="row">
                    <h3>A Final Project for Nada Basit's Database Class (CS4750) at UVA</h3>

                     <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-linkedin fa-fw"></i> <span class="network-name">Linkedin</span></a>
                        </li>
                    </ul> 
            </div>
        </div>
        <!-- /.container -->

    </div>
    <!-- /.banner -->

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

</html>
