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

$i = 0;

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
  <title>Listings</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="shortcut icon" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" type="image/ico" />  
</head>

<body>
  <div class="container">
    <h2>Property Listings</h2>
  </div>

  <div class='container'>
    <?php foreach ($properties as $p): ?>
      <div class="container" style='padding: 10px;border: solid 1px;margin: 10px;border-radius: 30px'>
        <div class='row'>
          <div class='col-4'>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcT1d8HV0p6VGisUDcr3SHplfhTARrvDeX9IHw&usqp=CAU" alt="Home picture here!" style='float:left;width:300px; height:300px;'>
          </div>
          <div class="col-8">
            <p>General Location: <?php echo $p['general_location']; ?></p>
            <p>Address: <?php echo $p['street'] . ", " . $p['city'] . ", " . $p['state'] . ", " . $p['zipcode']; ?></p>
            <p>Move-in: <?php echo $p['move_in_date']; ?></p>
            <p>House: <?php if($p['house'] == 0)
            echo "Yes";
            else
              echo "No";
            ?>
          </p>
          <div class='row' style='width: 75%;'>
            <div class='col-sm'>
              <p>Tenants: <?php echo $p['num_tenants']; ?></p>
            </div>
            <div class='col-sm'>
              <p>Parking Spots: <?php echo $p['parking']; ?></p>
            </div>
            <div class='col-sm'>
              <p>Utilities: <?php echo $p['utilities']?></p>
            </div>
          </div>
          <div class='row' style='width: 50%;'>
            <div class='col-sm'>
              <p>Min Cost: $<?php echo $p['cost_min']; ?></p>
            </div>
            <div class='col-sm'>
              <p>Max Cost: $<?php echo $p['cost_max']; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

</body>
</html>