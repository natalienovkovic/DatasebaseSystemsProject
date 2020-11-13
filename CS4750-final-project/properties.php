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
$num_bedrooms = "";
$num_bathrooms = "";
$pets = "";
$parking = "";
$utilities = "";
$general_location = "";
$street = "";
$city = "";
$state = ""; 
$zipcode = "";
$d_bedNum = "";
$d_bathNum = "";
$d_loc = "";
$d_rentMin = "";
$d_rentMax = "";


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(!empty($_POST['action']) && ($_POST['action']=='Add'))
  {
   addProperty($_POST['listingID'], $_POST['managerID'], $_POST['move_in_date'], $_POST['cost_min'], $_POST['cost_max'], $_POST['house'], $_POST['num_tenants'], $_POST['num_bedrooms'],$_POST['num_bathrooms'],$_POST['pets'], $_POST['parking'], $_POST['utilities'], $_POST['general_location'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zipcode']);
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
     $num_bedrooms = $p['num_bedrooms'];
     $num_bathrooms = $p['num_bathrooms'];
     $pets = $p['pets'];
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
  <link rel='stylesheet' href='styles.css'>
  <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSraCv5uiN9OtQOm6QiXnFzKmkDSkytAlJ4ow&usqp=CAU" type="image/ico" />  
</head>

<body>

  <!-- Navbar template from bootstrap website -->
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#" style='color: #84DCC6;'>Possible Name?</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">My Account</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" name='sl' placeholder="Search listings" aria-label="Search">
        <button class="sl-btn" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <!-- End Navbar code -->

  <!-- Header -->
  <div class="container">
    <h2>Property Listings</h2>
  </div>

  <!-- Search bar -->
  <div class="container">
    <hr style='background-color:#343a40;border:none;height: 1px;margin-bottom:10px;'>
    <h4 style='margin-top: 0px;'>Search listings</h4>
    <div class="row mb-3">
      <form action='' name='searchform' method='post' style='display:contents;'>
        <div class='form-group col-sm'>
          <select name='beds' class="custom-select" id="inputGroupSelect01">
            <option selected>Bedrooms</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4+</option>
          </select>
        </div>
        <div class='form-group col-sm'>
          <select name='baths' class="custom-select" id="inputGroupSelect01">
            <option selected>Bathrooms</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4+</option>
          </select>
        </div>
        <div class='form-group col-sm'>
          <select name='loc' class="custom-select" id="inputGroupSelect01">
            <option selected>Location</option>
            <option value="JPA">JPA</option>
            <option value="North Grounds">North Grounds</option>
            <option value="Rugby Road/Corner">Rugby Road/Corner</option>
          </select>
        </div>
        <div class='form-group col-sm'>
          <select name='rent_amt' class="custom-select" id="inputGroupSelect01">
            <option selected>Rent</option>
            <option value="1-275">1-275</option>
            <option value="276-500">276-500</option>
            <option value="501-750">501-750</option>
            <option value="750-1000">750-1000</option>
            <option value="1001+">1001+</option>
          </select>
        </div>
      </div>
      <div class='row' style='margin:auto;display: block; text-align:center;'>
        <input class="btn btn-primary" name='action' value='Search' type="submit" style='width: 45%;'/>
      </div>
    </form>
    <!-- In the php below, the "d_" prefix denotes desired value from form -->
    <?php 
    if(!empty($_POST['action']) && ($_POST['action'] == 'Search')){
      if($_POST['beds'] != "Bedrooms")
        $d_bedNum = $_POST['beds'];
      if($_POST['baths'] != "Bathrooms")
        $d_bathNum = $_POST['baths'];
      if($_POST['loc'] != "Location")
        $d_loc = $_POST['loc'];
      if($_POST['rent_amt'] != "Rent") {
        if(strpos($_POST['rent_amt'], "+") == false){
          list($d_rentMin, $d_rentMax) = explode('-', $_POST['rent_amt']);
        }
        else{
          list($d_rentMin, $d_rentMax) = explode('+', $_POST['rent_amt']);
        }
      }
      if($_POST['beds'] == "Bedrooms" AND $_POST['baths'] == "Bathrooms" AND $_POST['loc'] == "Location" AND $_POST['rent_amt'] == "Rent")
        $properties = getAllProperties();
      else
        $properties = getPropertySearch($d_bedNum, $d_bathNum, $d_loc, $d_rentMin, $d_rentMax);
    }
    ?>
    <div class='row' style='margin:auto;display: block; text-align:center;'>
      <hr style='background-color:#343a40;border:none;height: 1px;'>
    </div>

    <!-- Loop to display listings -->
    <div class='container'>
      <?php foreach ($properties as $p): ?>
        <div class="container" style='padding: 10px;border: solid 1px;margin: 10px;border-radius: 30px; margin-bottom: 20px;'>
          <div class='row'>
            <div class='col-4'>
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcT1d8HV0p6VGisUDcr3SHplfhTARrvDeX9IHw&usqp=CAU" alt="Home picture here!" style='float:left;width:300px; height:300px;'>
            </div>
            <div class="col-8">
              <p>General Location:<?php echo $p['general_location']; ?></p>
              <p>Address:<?php echo $p['street'] . ", " . $p['city'] . ", " . $p['state'] . ", " . $p['zipcode']; ?></p>
              <p>Move-in:<?php echo $p['move_in_date']; ?></p>
              <p>House:<?php if($p['house'] == 0)
              echo "Yes";
              else
                echo "No";
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
            <?php if($p['cost_min'] != $p['cost_max']): ?>
              <div class='row' style='width: 50%;'>
                <div class='col-sm'>
                  <p>Min Cost:$<?php echo $p['cost_min']; ?></p>
                </div>
                <div class='col-sm'>
                  <p>Max Cost:$<?php echo $p['cost_max']; ?></p>
                </div>
              </div>
              <?php else: ?>
                <p>Cost:$<?php echo $p['cost_min']; ?></p>
              <?php endif; ?>
              <div class='row'></div>
              <button class='btn btn-primary' style='margin-top: 10px;'>More Info!</button> <!-- Need to implement this button to redirect to the property -->
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </body>
  </html>