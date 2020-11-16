<?php
require('connectdb.php');
require('manager_db.php');
require('property_db.php');
session_start();

$managerID = $_SESSION["managerID"];

if(!isset($_SESSION['managerID']))
	header("Location:properties.php");

$info = getMyInfo($managerID);
$properties = getMyProperties($managerID);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!empty($_POST['action']) && $_POST['action'] == 'Add') {
		addProperty($_POST['managerID'], $_POST['companyName'], $_POST['phone'], $_POST['email']);
    $properties = getMyProperties($managerID); //returns an array containing a that manager's properties
} else if (!empty($_POST['action']) && ($_POST['action'] == 'Delete')) {
	deleteProperty($_POST['property_to_delete']); //TODO: make deleteProperty method
	$properties = getMyProperties($managerID);
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

	<?php include 'navbar.html' ?>

	<div name='body'>
		<div name='welcome-msg'>
			<h1 style='text-align: center'>Welcome back, <em><?php echo $info[0]['companyName']?></em></h1>
		</div>
		<div name='info' style='width: 80%;display:block;margin: auto;'>
			<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSZVLlHlKrUYXoD_kgc2VHr7qRiQppYqYAeNw&usqp=CAU" alt="Your profile photo here!" style=''>
			<div class='align-middle' name='basic_info' style='margin:auto;display: inline-block;'>
				<p>Company Name: <?php echo $info[0]['companyName']?></p>
				<p>Phone: <?php echo $info[0]['phone']?></p>
				<p>Email: <?php echo $info[0]['email']?></p>
				<button onclick="location.href = 'addListing.php'" class="btn btn-primary" style='background-color: #84DCC6; border-color: #84DCC6;color:#000;'>Add a listing</button> <!-- Needs to redirect to the manager's listings -->
			</div>
		</div>
		<div class='container'>
			<hr style='background-color:#343a40;border:none;height: 1px;'>
			<!-- Loop to display listings -->
			<div class='container'>
				<?php if($properties == null): ?>
					<h2 style='text-align:center;'>You don't have any listings!</h2>
				<?php else:?>
					<h2>Your Listings</h2>
				<?php foreach ($properties as $p): ?>
					<div class="container" style='padding: 10px;border: solid 1px;margin: 10px;border-radius: 30px; margin-bottom: 20px;'>
						<div class='row'>
							<div class='col-4'>
								<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcT1d8HV0p6VGisUDcr3SHplfhTARrvDeX9IHw&usqp=CAU" alt="Home picture here!" style='float:left;width:300px; height:300px;'>
							</div>
							<div class="col-8">
								<p>General Location:<?php echo $p['general_location']; ?></p>
								<p>Address:<?php echo $p['street'] . ", " . $p['city'] . ", " . $p['state'] . ", " . $p['zipcode']; ?></p>
								<p>Move-in Date:<?php echo $p['move_in_date']; ?></p>
								<p><?php if($p['house'] == 0)
								echo "Apartment";
								else
									echo "House";
								?>
							</p>
							<div class='row'style='width: 75%;'>
								<div class='col-sm'>
									<p>Bedrooms:<?php echo $p['num_bedrooms'];?></p>
								</div>
								<div class='col-sm'>
									<p>Bathrooms:<?php echo $p['num_bathrooms'];?></p>
								</div>
								<div class='col-sm'>
									<p>Pets:<?php if($p['pets'] == 0)
									echo "Yes";
									else
										echo "No";
									?></p>
								</div>
							</div>
							<div class='row' style='width: 50%;'>
								<div class='col-sm' style='margin-right:0px;'>
									<p>Parking Spots:<?php if($p['parking'] == 0) echo 'No'; else echo "Yes";?></p>
								</div>
								<div class='col-sm' style='padding:0px;'>
									<p>Utilities Included:<?php if($p['utilities'] == 0) echo 'No'; else echo "Yes";?></p>
								</div>
							</div>
							<p style='margin-bottom:15px;'>Cost:$<?php echo $p['cost_max']?></p>
							<div class='row' style='padding-left:15px;'>
								<form action="addListing.php" method="post">
									<input type="submit" value="Update" name="action" class="btn btn-primary" title="Update the record" style='margin-right:15px;color:black;background-color:#84DCC6;border-color:#84DCC6;'/>
									<input type="hidden" name="property_to_update" value="<?php echo $p['listingID'] ?>" />
				                </form> 
				                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
									<input type="submit" value="Delete" name="action" class="btn btn-danger" title="Permanently delete the record" style='color:black;'/>
									<input type="hidden" name="property_to_delete" value="<?php echo $p['listingID'] ?>" />
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif;?>
		</div>
	</div>
</div>

</body>
</html>