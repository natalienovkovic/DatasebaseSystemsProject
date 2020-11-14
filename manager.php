<?php
require('connectdb.php');
require('property_db.php');
//$friends = ''; //null
$properties = getAllProperties();
$listingID = "";
$managerID = "";
$move_in_date = "";
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

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(!empty($_POST['action']) && ($_POST['action']=='Add'))
  {
   addProperty($_POST['listingID'], $_POST['managerID'], $_POST['move_in_date'], $_POST['cost_max'], $_POST['house'], $_POST['num_tenants'], $_POST['num_bedrooms'], $_POST['num_bathrooms'], $_POST['pets'], $_POST['parking'], $_POST['utilities'], $_POST['general_location'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zipcode']);
   $properties = getAllProperties();
 }
 elseif(!empty($_POST['action']) && ($_POST['action']=='Delete'))
 {
   deleteProperty($_POST['property_to_delete']);
   $properties = getAllProperties();
 }
 elseif(!empty($_POST['action']) && ($_POST['action']=='Update'))
 {
   $propertyToUpdate = getPropertyInfo($_POST['property_to_update']);
   foreach ($propertyToUpdate as $p):
     $listingID = $p['listingID'];
     $managerID = $p['managerID'];
     $move_in_date = $p['move_in_date'];
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
  <title>My Account</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="shortcut icon" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" type="image/ico" />  
</head>

<body>

  <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#" style='color: #84DCC6;'>C'Ville Student Housing</a>
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
    </div>
  </nav>

  <div class="container">

    <h1>Add and Update a Property</h1>
    <!-- <form action="formprocessing.php" method="post">  -->
      <form name="mainForm" action="manager.php" method="post">
        <div class='container'> 
          <div class='row'>
            <div class="col-sm form-group">
              ListingID <?php echo $listingID ?>:
              <input type="text" class="form-control" name="listingID" value="<?php echo $listingID ?>" required />        
            </div>  
            <div class="col-sm form-group">
              ManagerID:
              <input type="text" class="form-control" name="managerID" value="<?php echo $managerID ?>" required /> 
            </div> 
          </div>
          <div class='row'>
            <div class="col-sm form-group">
              Move in Date:
              <input type="text" class="form-control" name="move_in_date" value="<?php echo $move_in_date ?>" required />        
            </div>  
            <div class="col-sm form-group">
              Rent:
              <input type="text" class="form-control" name="cost_max" value="<?php echo $cost_max ?>" required/>        
            </div> 
            <div class="col-sm form-group">
              House:
              <!-- <input type="text" class="form-control" name="house" value="<?php echo $house ?>" required />         -->
              <select class='custom-select'>
                <?php if($house == null): ?>
                  <option selected value="<?php echo $parking ?>"></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  <?php elseif($house == 1): ?>
                    <option selected value="1">Yes</option>
                    <option value="0">No</option>
                    <?php elseif($house == 0): ?>
                      <option value="1">Yes</option>
                      <option selected value="0">No</option>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm form-group">
                  Number of Tenants:
                  <input type="text" class="form-control" name="num_tenants" value="<?php echo $num_tenants ?>"  required/>        
                </div>  
                <div class="col-sm form-group">
                  Number of Bedrooms:
                  <input type="text" class="form-control" name="num_bedrooms" value="<?php echo $num_bedrooms ?>" required /> 
                </div>  
                <div class="col-sm form-group">
                  Number of Bathrooms:
                  <input type="text" class="form-control" name="num_bathrooms" value="<?php echo $num_bathrooms ?>" required /> 
                </div>
              </div>  
              <div class='row'>
                <div class="col-sm form-group">
                  Pets:
                  <!-- <input type="text" class="form-control" name="pets" value="<?php echo $pets ?>" required /> -->
                  <select required class='custom-select'>
                    <?php if($pets == null): ?>
                      <option selected value="<?php echo $parking ?>"></option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                      <?php elseif($pets == 1): ?>
                        <option selected value="1">Yes</option>
                        <option value="0">No</option>
                        <?php elseif($pets == 0): ?>
                          <option value="1">Yes</option>
                          <option selected value="0">No</option>
                        <?php endif; ?>
                      </select> 
                    </div>  
                    <div class="col-sm form-group">
                      Parking:
                      <!-- <input type="text" class="form-control" name="parking" value="<?php echo $parking ?>"  /> -->
                      <select required class='custom-select'>
                        <?php if($parking == null): ?>
                          <option selected value="<?php echo $parking ?>"></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <?php elseif($parking == 1): ?>
                            <option selected value="1">Yes</option>
                            <option value="0">No</option>
                            <?php elseif($parking == 0): ?>
                              <option value="1">Yes</option>
                              <option selected value="0">No</option>
                            <?php endif; ?>
                          </select>        
                        </div> 
                        <div class="col-sm form-group">
                          Utilities:
                          <!-- <input type="text" class="form-control" name="utilities" value="<?php echo $utilities ?>" /> -->
                          <select required class='custom-select'>
                            <?php if($utilities == null): ?>
                              <option selected value="<?php echo $parking ?>"></option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                              <?php elseif($utilities == 1): ?>
                                <option selected value="1">Yes</option>
                                <option value="0">No</option>
                                <?php elseif($utilities == 0): ?>
                                  <option value="1">Yes</option>
                                  <option selected value="0">No</option>
                                <?php endif; ?>
                              </select>        
                            </div> 
                          </div>
                          <div class='row'>
                            <div class="col-sm form-group">
                              General Location:
                              <!-- <input type="text" class="form-control" name="general_location" value="<?php echo $general_location ?>" required />         -->
                              <select required name='loc' class="custom-select" id="inputGroupSelect01">
                                <?php if($general_location == null): ?>
                                  <option disabled selected>Choose...</option>
                                  <option value="JPA">JPA</option>
                                  <option value="North Grounds">North Grounds</option>
                                  <option value="Rugby Road/Corner">Rugby Road/Corner</option>
                                  <?php elseif($general_location == "JPA"): ?>
                                    <option selected value="JPA">JPA</option>
                                    <option value="North Grounds">North Grounds</option>
                                    <option value="Rugby Road/Corner">Rugby Road/Corner</option>
                                    <?php elseif($general_location == "North Grounds"): ?>
                                      <option value="JPA">JPA</option>
                                      <option selected value="North Grounds">North Grounds</option>
                                      <option value="Rugby Road/Corner">Rugby Road/Corner</option>
                                      <?php elseif($general_location == "Rugby Road/Corner"): ?>
                                        <option value="JPA">JPA</option>
                                        <option value="North Grounds">North Grounds</option>
                                        <option selected value="Rugby Road/Corner">Rugby Road/Corner</option>
                                      <?php endif; ?>
                                    </select>
                                  </div>
                                  <div class="col-8 form-group">
                                    Street:
                                    <input type="text" class="form-control" name="street" value="<?php echo $street ?>" required  />        
                                  </div>  
                                </div>
                                <div class='row'>
                                <div class="col-6 form-group">
                                  City:
                                  <input type="text" class="form-control" name="city" value="<?php echo $city ?>" required />        
                                </div> 
                                <div class="col-3 form-group">
                                  State:
                                  <input type="text" class="form-control" name="state" value="<?php echo $state ?>" required  />        
                                </div> 
                                <div class="col-3 form-group">
                                  Zipcode:
                                  <input type="text" class="form-control" name="zipcode" value="<?php echo $zipcode ?>" required/>        
                                </div> 
                              </div>
                                <input type="submit" value="Add" name="action" class="btn btn-dark" title="Insert a property into a properties table" />
                                <input type="submit" value="Confirm update" name="action" class="btn btn-dark" title="Confirm update a property" />

                              </div>
                            </form>  


                            <hr/>
                            <h2>Current Listings</h2>
                            <div style="width:100%; overflow:auto;">
                              <table class="w3-table w3-bordered w3-card-4 center" style="overflow:auto">
                                <thead>
                                  <tr style="background-color:#B0B0B0">
                                    <th width="25%">ListingID</th>        
                                    <th width="10%">ManagerID</th>        
                                    <th width="25%">Move in date</th> 
                                    <th width="10%">Rent</th> 
                                    <th width="25%">House</th>        
                                    <th width="25%"># Tenants</th>    
                                    <th width="25%"># Bedrooms</th>      
                                    <th width="25%"># Bathrooms</th>  
                                    <th width="25%">Pets</th>  
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
                                    <td><?php echo $item['cost_max']; ?></td> 
                                    <td><?php echo $item['house']; ?></td> 
                                    <td><?php echo $item['num_tenants']; ?></td> 
                                    <td><?php echo $item['num_bedrooms']; ?></td> 
                                    <td><?php echo $item['num_bathrooms']; ?></td> 
                                    <td><?php echo $item['pets']; ?></td> 
                                    <td><?php echo $item['parking']; ?></td>  
                                    <td><?php echo $item['utilities']; ?></td>
                                    <td><?php echo $item['general_location']; ?></td>
                                    <td><?php echo $item['street']; ?></td> 
                                    <td><?php echo $item['city']; ?></td>
                                    <td><?php echo $item['state']; ?></td>
                                    <td><?php echo $item['zipcode']; ?></td>
                                    <td>
                                      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                                        <input type="submit" value="Update" name="action" class="btn btn-primary" title="Update the record" />             
                                        <input type="hidden" name="property_to_update" value="<?php echo $item['listingID'] ?>" />
                                      </form> 
                                    </td>                        
                                    <td>
                                      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                                        <input type="submit" value="Delete" name="action" class="btn btn-danger" title="Permanently delete the record" />      
                                        <input type="hidden" name="property_to_delete" value="<?php echo $item['listingID'] ?>" />
                                      </form>
                                    </td>                                              
                                  </tr>
                                <?php endforeach; ?>
                              </table>
                            </div>

                          </div>    
                        </body>
                        </html>