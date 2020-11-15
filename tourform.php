<?php
session_start();
require('connectdb.php');
require('tour_db.php');


$sid = "";
$listingID="";

if(isset($_SESSION['sid'])){
  $sid = $_SESSION['sid'];
}

if(isset($_SESSION["listingID"])){
  $listingID = $_SESSION["listingID"];
}

$tour = getTour($sid, $listingID);


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(!empty($_POST['action']) && ($_POST['action']=='Schedule'))
	{
     addTour($sid, $listingID, $_POST['date'], $_POST['time']); 
     $tour = getTour($sid, $listingID);
  }
  if(!empty($_POST['action']) && ($_POST['action']=='Cancel Tour'))
	{
       removeTour($sid, $listingID);
       $tour = getTour($sid, $listingID);
	}
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">      
  <title>Tour</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel='stylesheet' href='styles.css'>
  <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSraCv5uiN9OtQOm6QiXnFzKmkDSkytAlJ4ow&usqp=CAU" type="image/ico" />  
</head>

<body>

  <!--header file -->
  <?php include 'navbar.html' ?>

<div class="container">


<!-- <?php foreach ($tour as $item)
  $managerID = $item['managerID']; 
?> -->

<h2>Schedule A Tour</h2> 

<?php if(empty($tour)){ ?>

<br></br>

<form name="dateForm" action="tourform.php" method="post">
  <label for="date">Date:</label>
  <input type="date" name="date"><br><br>
  <label for="time">Select a time:</label>
  <input type="time" name="time"><br></br>
  <input type="submit" value="Schedule" name="action" class="btn btn-dark" title="Submit Date" />
</form>

<?php }

else {
  ?> <br></br><?php
  foreach ($tour as $item){?>
    <h3>Your tour is scheduled for : <?php echo $item['tourDate'];?> at <?php echo $item['tourTime'];?></h3>
    <?php }; ?>
   <br></br>
  <form name="TourFormRemove" action="tourform.php" method="post" style="display:inline-block">
    <input type="submit" class="btn btn-dark" name="action" value="Cancel Tour"/>
  </form> 

<?php }; ?>


<form name="Back" action="propertyview.php" method="post">
  <input type="submit" class="btn btn-dark" name="action" value="Back to Listing" style='margin-top: 10px;background-color: #84DCC6; border-color: #84DCC6;color:#000;'/>
</form> 


</div>

</body>
</html>
  
