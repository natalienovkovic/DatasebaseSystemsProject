<?php
require('connectdb.php');
require('property_db.php');
require('contact_db.php');
require('waitlist_db.php');
require('favorite_db.php');

$listingID = "2"; // needs to come from previous page
$sid = "vn3gc";   //needs to come from account?
$properties = getPropertyInfo($listingID);
$managerID = "";
foreach ($properties as $item){
    $managerID = $item['managerID']; 
}  
                                         
$compName = getName($managerID);
$waitlistNum = getPosition($sid, $listingID);
$check = checkFavorite($sid, $listingID);


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
  <title>DB interfacing</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="shortcut icon" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" type="image/ico" />

<style>
section {
  float: left;
  width: 50%;
}
aside {
  float: right;
  width: 50%;
}

</style>  
</head>

<body>
<div class="container">

<h1>
<?php foreach ($properties as $item) 
    echo $item['street'];
?>
    
 <?php foreach ($check as $item){ ?>
     <span style="font-size:100%;color:red;">&hearts;</span>
 <?php }; ?>
</h1>


 <?php foreach ($compName as $item)
     echo $item['companyName'];                                            

  ?>
<p></p>

<section>
<img src="house.png" alt="House" width="180" height="200">
                                           
  <p></p>
  <?php foreach ($waitlistNum as $item){
    echo "Place in Waitlist: ";
    echo $item['placeInWaitlist']; }
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
 
<form name="managerForm" action="contactform.php" method="post">
  <input type="hidden" name="managerID" value="<?php echo $managerID ?>" /><br>
  <input type="hidden" name="sid" value="<?php echo $sid ?>" /><br>
  <input type="submit" class="btn btn-dark" value="Contact Agency"/>
</form>   

<br></br>

</section>


<aside>

<div style="width:100%; overflow:auto;">

<?php foreach ($properties as $item): ?>
    <div>
    <h3 style="display: inline;">General Location </h3>
    <p style="display: inline;"><?php echo $item['general_location']; ?></p>
    </div>
    <p></p>
    <div>
    <h3 style="display: inline;">Address </h3>
    <p style="display: inline;">
    <?php echo $item['street']; ?>
    <?php echo $item['city']; ?>
    <?php echo $item['state']; ?>
    <?php echo $item['zipcode']; ?>
    </p>
    </div>
    <p></p>
    <div>
    <h3 style="display: inline;">Move in Date: </h3>
    <p style="display: inline;"><?php echo $item['move_in_date']; ?></p>
    </div>
    <p></p>
    <div>
    <h3 style="display: inline;">Cost</h3>
    <p style="display: inline;"><?php echo $item['cost_min']; ?> to 
    <?php echo $item['cost_max']; ?></p>
    </div>
    <p></p>
    <div>
    <h3 style="display: inline;">House: </h3>
    <p style="display: inline;"><?php if($item['house'] == "1"){
        echo "Yes"; }
	else{ echo "No";}; ?>
    </p>
    </div>
    <p></p>
    <div>
    <h3 style="display: inline;">Number of Tenants: </h3>
    <p style="display: inline;"><?php echo $item['num_tenants']; ?></p>
    </div>
    <p></p>
    <div>
    <h3 style="display: inline;">Number of Bedrooms: </h3>
    <p style="display: inline;"><?php echo $item['num_bedrooms']; ?></p>
    </div>
    <p></p>
    <div>
    <h3 style="display: inline;">Number of Bathrooms: </h3>
    <p style="display: inline;"><?php echo $item['num_bathrooms']; ?></p>
    </div>
    <p></p>
    <div>
    <h3 style="display: inline;">Parking Included: </h3>
    <p style="display: inline;"><?php if($item['parking'] == "1"){
        echo "Yes"; }
	else{ echo "No";}; ?></p>
    </div>
    <p></p>
    <div>
    <h3 style="display: inline;">Pets Allowed: </h3>
    <p style="display: inline;"><?php if($item['pets'] == "1"){
        echo "Yes"; }
	else{ echo "No";}; ?></p>
    </div>
    <p></p>
    <div>
    <h3 style="display: inline;">Utilites included in rent: </h3>
    <p style="display: inline;"><?php if($item['utilities'] == "1"){
        echo "Yes"; }
	else{ echo "No";}; ?></p>
     </div>
    <p></p>
 
<?php endforeach; ?>

</div>  
</aside>    
</div> 
   
</body>
</html>
  
