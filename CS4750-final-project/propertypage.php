<?php
require('connectdb.php');
require('property_db.php');
//$friends = ''; //null
$properties = getAllProperties();
$listingID = "";
$managerID = "";
$move_in_date = "";
$cost_min = "";
$cost_max = "";
$house = "";
$num_tenants = "";
$parking = "";
$utilities = "";
$general_location = "";
$street = "";
$city = "";
$state = ""; 
$zipcode = "";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(!empty($_POST['action']) && ($_POST['action']=='Add'))
	{
     addProperty($_POST['listingID'], $_POST['managerID'], $_POST['move_in_date'], $_POST['cost_min'], $_POST['cost_max'], $_POST['house'], $_POST['num_tenants'], $_POST['parking'], $_POST['utilities'], $_POST['general_location'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zipcode']);
     $friends = getAllProperties();
	}
  elseif(!empty($_POST['action']) && ($_POST['action']=='Delete'))
	{
	deleteProperty($_POST['property_to_delete']);
        $properties = getAllProperties();
	}
  elseif(!empty($_POST['action']) && ($_POST['action']=='Update'))
	{
	$propertyToUpdate = getPropertyInfo_by_id($_POST['property_to_update']);
	 foreach ($propertyToUpdate as $p):
         $listingID = $p['listingID'];
         $managerID = $p['managerID'];
         $move_in_date = $p['move_in_date'];
	 $cost_min = $p['cost_min'];
	 $cost_max = $p['cost_max'];
	 $house = $p['house'];
	 $num_tenants = $p['num_tenants'];
	 $parking = $p['parking'];
	 $utilities = $p['utilities'];
	 $general_location = $p['general_location'];
	 $street = $p['street'];
	 $city = $p['city'];
	 $state = $p['state']; 
	 $zipcode = $p['zipcode'];
	endforeach;
        
        }
  elseif(!empty($_POST['action']) && ($_POST['action']=='Confirm update'))
	{
     updateProperty($_POST['listingID'], $_POST['num_tenants']);
     $properties = getAllProperties();
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
  <title>Property Listings</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="shortcut icon" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" type="image/ico" />  
</head>

<body>
<div class="container">

<hr/>
<h2>Current Properties</h2>
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
    <td>                                   
  </tr>
<?php endforeach; ?>
</table>
</div>
        
</div>    
</body>
</html>
  