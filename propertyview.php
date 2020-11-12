<?php
require('connectdb.php');
require('property_db.php');
require('contact_db.php');
require('waitlist_db.php');
$listingID = "1"; // needs to come from previous page
$sid = "er7sp";   //needs to come from account?
$properties = getPropertyInfo($listingID);
$managerID = "";
foreach ($properties as $item){
    $managerID = $item['managerID']; 
}                                           
$compName = getName($managerID);

$waitlistNum = getPosition($sid, $listingID);


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(!empty($_POST['action']) && ($_POST['action']=='Add to Waitlist'))
	{
       addToWaitlist($sid, $listingID);
	}
 if(!empty($_POST['action']) && ($_POST['action']=='Add to Favorites'))
	{
       addMessage($sid, $listingID);
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
</head>

<body>
<div class="container">

<h1>Property</h1>

 <?php foreach ($compName as $item)
     echo $item['companyName'];                                            

  ?>
  <?php foreach ($waitlistNum as $item)?>
    <p>Place in waitlist for property: <?php echo $item['placeInWaitlist']; ?> </p>                                            

   

      
<!-- <form action="formprocessing.php" method="post">  -->
<form name="mainForm" action="propertyview.php" method="post">
     
  <input type="submit" value="Add to Waitlist" name="action" class="btn btn-dark" title="Add student to waitlist table" />
  <input type="submit" value="Add to Favorites" name="action" class="btn btn-dark" title="Add property to favorites" />
  
</form>  


<div style="width:100%; overflow:auto;">
<table class="w3-table w3-bordered w3-card-4 center" style="overflow:auto">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="25%">ListingID</th>        
    <th width="10%">ManagerID</th>        
    <th width="25%">Move in date</th> 
    <th width="10%">Min Cost</th>
    <th width="10%">Max Cost</th> 
    <th width="25%">House</th>        
    <th width="25%"># Tenants</th>        
    <th width="25%">Parking</th> 
    <th width="10%">Utilites</th>
    <th width="10%">General Loc</th>
    <th width="25%">Street</th>        
    <th width="25%">City</th>        
    <th width="25%">State</th> 
    <th width="10%">Zipcode</th>
  </tr>
  </thead>
<?php foreach ($properties as $item): ?>
  <tr>
    <td><?php echo $item['listingID']; ?></td>
    <td><?php echo $item['managerID']; ?></td>        
    <td><?php echo $item['move_in_date']; ?></td> 
    <td><?php echo $item['cost_min']; ?></td>
    <td><?php echo $item['cost_max']; ?></td> 
    <td><?php echo $item['house']; ?></td> 
    <td><?php echo $item['num_tenants']; ?></td> 
    <td><?php echo $item['parking']; ?></td>  
    <td><?php echo $item['utilities']; ?></td>
    <td><?php echo $item['general_location']; ?></td>
    <td><?php echo $item['street']; ?></td> 
    <td><?php echo $item['city']; ?></td>
    <td><?php echo $item['state']; ?></td>
    <td><?php echo $item['zipcode']; ?></td>
                                            
  </tr>
<?php endforeach; ?>

</table>
</div>
        
</div>    
</body>
</html>
  
