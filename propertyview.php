<?php
session_start();

require('connectdb.php');
require('property_db.php');
require('contact_db.php');
require('waitlist_db.php');
require('favorite_db.php');
require('tour_db.php');

$_SESSION["sid"]="vn3gc";
$sid = $_SESSION["sid"];

if(!empty($_POST['listingID'])) {
   $_SESSION['listingID']= $_POST['listingID']; 
  }
  $listingID= $_SESSION["listingID"];


$properties = getPropertyInfo($listingID);
foreach ($properties as $item){
  $managerID = $item['managerID']; 
}

$_SESSION["managerID"]=$managerID;
                                         
$compName = getName($managerID);
$waitlistNum = getPosition($sid, $listingID);
$check = checkFavorite($sid, $listingID);
$tour = getTour($sid, $listingID);



if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(!empty($_POST['action']) && ($_POST['action']=='Add to Waitlist'))
	{
       addToWaitlist($sid, $listingID);
       $waitlistNum = getPosition($sid, $listingID);
	}
  if(!empty($_POST['action']) && ($_POST['action']=='Remove from Waitlist'))
	{
       removeFromWaitlist($sid, $listingID);
       $waitlistNum = getPosition($sid, $listingID);
	}
 if(!empty($_POST['action']) && ($_POST['action']=='Add to Favorites'))
	{
       addToFavorite($sid, $listingID);
       $check = checkFavorite($sid, $listingID);
	}
 if(!empty($_POST['action']) && ($_POST['action']=='Remove from Favorites'))
	{
       removeFavorite($sid, $listingID);
       $check = checkFavorite($sid, $listingID);
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
  <title>Property Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel='stylesheet' href='styles.css'>
  <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSraCv5uiN9OtQOm6QiXnFzKmkDSkytAlJ4ow&usqp=CAU" type="image/ico" />  
</head>

<style>
section {
  float: left;
  width: 40%;
}
aside {
  float: right;
  width: 60%;
}

</style>  
</head>

<body>

  <!--header file -->
<?php include 'navbar.html' ?>


<div class="container">

<div>
<h1 style="display: inline;">
  <?php foreach ($properties as $item) 
    echo $item['street'];
  ?>

 <?php foreach ($check as $item){ ?>
     <span style="font-size:100%;color:red;">&hearts;</span>
 <?php }; ?>
</h1>

<p style="display: inline;">  
  <?php foreach ($waitlistNum as $item){
    echo "Place in Waitlist: ";
    echo $item['placeInWaitlist']; }
  ?>
</p>
</div>

 <?php foreach ($compName as $item)
     echo $item['companyName'];                                            

  ?>
<p></p>

<section>
<img src="house.png" alt="House" width="200" height="200">
                                           
  <p></p>


<p></p>
  <?php foreach ($tour as $t){
    echo "Tour Scheduled for : ";
    echo $t['tourDate'];
    echo " at : ";
    echo $t['tourTime'];
  }
  ?>

  <br></br>
      
<form name="mainForm" action="propertyview.php" method="post">
     
  <?php if(empty($waitlistNum)){?>
  <input type="submit" value="Add to Waitlist" name="action" class="btn btn-dark" title="Add student to waitlist table" />
  <?php }; ?>

   <?php if(!empty($waitlistNum)){?>
  <input type="submit" value="Remove from Waitlist" name="action" class="btn btn-dark" title="Remove student from waitlist table" />
 <?php }; ?>
  
  <br></br>

   <?php if(empty($check)){?>
       <input type="submit" value="Add to Favorites" name="action" class="btn btn-dark" title="Add property to favorites" />
  <?php }; ?>

  <?php if(!empty($check)){?>
    <input type="submit" value="Remove from Favorites" name="action" class="btn btn-dark" title="Remove from Favorites" />
   <?php }; ?>
  
</form>
 
  <p></p>

<div> 
<form name="managerForm" action="contactform.php" method="post" style="display:inline-block">
  <input type="hidden" name="managerID" value="<?php echo $managerID ?>" />
  <input type="hidden" name="sid" value="<?php echo $sid ?>" />
  <input type="submit" class="btn btn-dark" value="Contact Agency" style='margin-top: 10px;background-color: #84DCC6; border-color: #84DCC6;color:#000;'/>
</form>   

<?php if(empty($tour)){?>
<form name="TourForm" action="tourform.php" method="post" style="display:inline-block">
  <input type="hidden" name="listingID" value="<?php echo $listingID ?>" />
  <input type="hidden" name="sid" value="<?php echo $sid ?>" />
  <input type="submit" class="btn btn-dark" value="Request Tour" style='margin-top: 10px;background-color: #84DCC6; border-color: #84DCC6;color:#000;'/>
</form> 
<?php }; ?> 

<?php if(!empty($tour)){?>
<form name="TourFormRemove" action="tourform.php" method="post" style="display:inline-block">
  <input type="submit" class="btn btn-dark" name="action" value="Schedule/Cancel Tour" style='margin-top: 10px;background-color: #84DCC6; border-color: #84DCC6;color:#000;'/>
</form> 
<?php }; ?> 

</div>

</section>


<aside>



<?php foreach ($properties as $p): ?>
  <div class="container" style='padding: 10px;border: solid 1px;margin: 10px;border-radius: 15px; margin-bottom: 10px;'>
          <div class='row'>
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
            <div class='row' style='width: 100%;'>
              <div class='col-sm' style='margin-right:0px;'>
                <p>Parking Spots:<?php if($p['parking'] == 0) echo 'No'; else echo "Yes";?></p>
              </div>
              <div class='col-sm' style='padding:0px;'>
                <p>Utilities Included:<?php if($p['utilities'] == 0) echo 'No'; else echo "Yes";?></p>
              </div>
            </div>
            <p>Cost:$<?php echo $p['cost_max']?></p>
              <div class='row'></div>
            
            </div>
          </div>
        </div>
 
<?php endforeach; ?>


</aside>    
</div> 
   
</body>
</html>