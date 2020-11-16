<?php
require('connectdb.php');
require('tour_db.php');
require('favorite_db.php');
require('student_db.php');
require('property_db.php');
require('waitlist_db.php');
session_start();

$sid = $_SESSION['sid'];
if(!isset($_SESSION['sid']))
	header("Location:properties.php");

$info = myInfo($sid);
$properties = getAllProperties();
$favorites = getMyFavorites($sid);
$tours = getAllTours($sid);
$i=1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!empty($_POST['action']) && $_POST['action'] == 'Remove') {
		removeFavorite($sid, $_POST['favorite_to_delete']);
		$favorites = getMyFavorites($sid);
} else if (!empty($_POST['action']) && ($_POST['action'] == 'Cancel')) {
	removeTour($sid, $_POST['tour_to_delete']);
	$tours = getMyTours($sid);
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
			<h1 style='text-align: center'>Welcome back, <em><?php echo $info[0]['fname'] . " " . $info[0]['lname']?></em></h1>
		</div>
		<div name='info' style='width: 80%;display:block;margin: auto;'>
			<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSZVLlHlKrUYXoD_kgc2VHr7qRiQppYqYAeNw&usqp=CAU" alt="Your profile photo here!" style=''>
			<div class='align-middle' name='basic_info' style='margin:auto;display: inline-block;'>
				<p>Full Name: <?php echo $info[0]['fname'] . " " . $info[0]['lname']?></p>
				<p>Email: <?php echo $info[0]['semail']?></p>
			</div>
		</div>
		<div class='container'>
			<hr style='background-color:#343a40;border:solid 1px;height: 1px;'>
			<?php if($favorites != null): ?>
				<h2>My Favorites</h2>
				<div class='container'>
					<?php foreach ($favorites as $p): ?>
						<div class="container" style='padding: 10px;border: solid 1px;border-radius: 30px; margin-bottom: 20px;margin-right:0px;margin-left:0px;margin-top:10px;'>
							<div class='row'>
								<div class='col-4'>
									<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcT1d8HV0p6VGisUDcr3SHplfhTARrvDeX9IHw&usqp=CAU" alt="Home picture here!" style='float:left;width:300px; height:300px;'>
								</div>
								<div class="col-8">
									<p>General Location:<?php echo $p['general_location']; ?></p>
									<p>Address:<?php echo $p['street'] . ", " . $p['city'] . ", " . $p['state'] . ", " . $p['zipcode']; ?></p>
									<p>Move-in:<?php echo $p['move_in_date']; ?></p>
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
								<p>Cost:$<?php echo $p['cost_max']?></p>
								<?php if(count(getPosition($sid, $p['listingID']))!=0): ?>
									<p>Place in waitlist:<?php echo getPosition($sid, $p['listingID'])[0]['placeInWaitlist']?></p>
								<?php endif; ?>
								<form name="mainForm" action="propertyview.php" method="post" style='display:inline-block;'>
									<input type="hidden" name="listingID" value="<?php echo $p['listingID'] ?>" />
									<input type="submit" value="More info!" name="action" class='btn btn-primary' style='margin-top: 10px;background-color: #84DCC6; border-color: #84DCC6;color:#000;'/>
								</form>
								<form style='display:inline-block;' action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
									<input type="submit" value="Remove" name="action" class="btn btn-danger" title="Permanently delete the record" style='color:black;margin-top:10px;'/>
									<input type="hidden" name="favorite_to_delete" value="<?php echo $p['listingID'] ?>" />
								</form>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<?php else:?>
					<h2>You have no favorites</h2>
				</div>
			<?php endif; ?>
		</div>
		<div class='container'>
			<hr style='background-color:#343a40;border:solid 1px;height: 1px;'>
			<?php if($tours != null):?>
				<h2>My Scheduled Tours</h2>
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Address</th>
							<th scope="col">Date</th>
							<th scope="col">Time</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($tours as $item): ?>
							<tr>
								<th scope='row'><?php echo $i; $i+=1;?></th>
								<td><?php echo $item['street'] . ", " . $item['city'] . ", " . $item['state'] . ", " . $item['zipcode']; ?></td>        
								<td><?php echo $item['tourDate']; ?></td> 
								<td><?php echo $item['tourTime']; ?></td>                         
								<td>
									<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
										<input type="submit" value="Cancel" name="action" class="btn btn-danger" title="Permanently delete the record" style='color:black;'/>
										<input type="hidden" name="tour_to_delete" value="<?php echo $item['listingID'] ?>" />
									</form>
								</td>                                              
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php else:?>
					<h2>You have no scheduled tours</h2>
				<?php endif; ?>
			</div>
		</div>
	</body>
	</html>