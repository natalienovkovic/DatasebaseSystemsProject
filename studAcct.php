<?php
require('connectdb.php');
require('manager_db.php');
require('property_db.php');

$properties = getAllProperties(); //this needs to be replaced with the specific manager's listings (i.e. getMyProperties();)
//instantiate any variables as necessary
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!empty($_POST['action']) && $_POST['action'] == 'Add') {
		addProperty($_POST['managerID'], $_POST['companyName'], $_POST['phone'], $_POST['email']);
    $properties = getMyProperties(); //returns an array containing a that manager's properties
} else if (!empty($_POST['action']) && ($_POST['action'] == 'Delete')) {
	deleteProperty($_POST['property_to_delete']); //TODO: make deleteProperty method
	$properties = getAllProperties();
}
}
?>

<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="your name">
	<meta name="description" content="include some description about your page">
	<title>My Account</title>

	<!-- Adding bootstrap and W3.CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel='stylesheet' href="styles.css">

	<!-- Adding tab icon -->
	<link rel="shortcut icon" href="https://www.materialui.co/materialIcons/action/account_circle_grey_192x192.png" type="image/ico" />
</head>

<body>
	<!-- Navbar template from bootstrap website -->
	<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
		<span class="navbar-brand" style='color: #84DCC6;'>C'Ville Student Housing</span>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="properties.php">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="#">My Account</a>
				</li>
			</ul>
		</div>
	</nav>
	<!-- End Navbar code -->

	<div name='body'>
		<div name='welcome-msg'>
			<h1 style='text-align: center'>Welcome back, *name here*</h1>
		</div>
		<div name='info' style='width: 80%;display:block;margin: auto;'>
			<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSZVLlHlKrUYXoD_kgc2VHr7qRiQppYqYAeNw&usqp=CAU" alt="Your profile photo here!" style=''>
			<div class='align-middle' name='basic_info' style='margin:auto;display: inline-block;'>
				<p>Full Name: </p>
				<p>Phone: </p>
				<p>Email: </p>
				<!-- <button onclick="location.href = 'addListing.php'" class="btn btn-primary" style='background-color: #84DCC6; border-color: #84DCC6;color:#000;' action='addListing.php' href='addListing.php'>Add a listing</button> -->
			</div>
		</div>
		<div class='container'>
			<hr style='background-color:#343a40;border:none;height: 1px;'>
		</div>
</body>
</html>