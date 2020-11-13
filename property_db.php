<?php 

// CREATE TABLE friends (
//    name varchar(30) NOT NULL,
//    major varchar(10) NOT NULL,
//    year int NOT NULL,
//    PRIMARY KEY (name) );  

// Prepared statement (or parameterized statement) happens in 2 phases:
//   1. prepare() sends a template to the server, the server analyzes the syntax
//                and initialize the internal structure.
//   2. bind value (if applicable) and execute
//      bindValue() fills in the template (~fill in the blanks.
//                For example, bindValue(':name', $name);
//                the server will locate the missing part signified by a colon
//                (in this example, :name) in the template
//                and replaces it with the actual value from $name.
//                Thus, be sure to match the name; a mismatch is ignored.
//      execute() actually executes the SQL statement


function getAllProperties()
{

  global $db;
  $query = "SELECT * FROM Property";
  $statement = $db->prepare($query);
  $statement->execute();

  $results = $statement->fetchAll(); // returns an array of rows
  $statement->closeCursor();

 return $results;
	
	
	
}

function addProperty($listingID, $managerID, $move_in_date, $cost_max, $house, $num_tenants, $num_bedrooms, $num_bathrooms, $pets, $parking, $utilities, $general_location, $street, $city, $state, $zipcode)
{

  global $db;

 // $query = "INSERT INTO friends VALUES('" . $name . "','" . $major . "','" . $year .'")";
 // $statement = $db->query($query);

  $query = "INSERT INTO Property VALUES(:listingID, :managerID, :move_in_date, :cost_max, :house, :num_tenants, :num_bedrooms, :num_bathrooms, :pets, :parking, :utilities, :general_location, :street, :city, :state, :zipcode)";
  $statement = $db->prepare($query);
  $statement->bindValue(':listingID', $listingID);
  $statement->bindValue(':managerID', $managerID);
  $statement->bindValue(':move_in_date', $move_in_date);
  $statement->bindValue(':cost_max', $cost_max);
  $statement->bindValue(':house', $house);
  $statement->bindValue(':num_tenants', $num_tenants);
  $statement->bindValue(':num_bedrooms', $num_bedrooms);
  $statement->bindValue(':num_bathrooms', $num_bathrooms);
  $statement->bindValue(':pets', $pets);
  $statement->bindValue(':parking', $parking);
  $statement->bindValue(':utilities', $utilities);
  $statement->bindValue(':general_location', $general_location);
  $statement->bindValue(':street', $street);
  $statement->bindValue(':city', $city);
  $statement->bindValue(':state', $state);
  $statement->bindValue(':zipcode', $zipcode);
  $statement->execute(); // run query
  $statement->closeCursor(); //release hold on this connection
  
}
   
function getPropertyInfo($listingID)
{
  global $db; 
  $query = "SELECT * FROM Property WHERE listingID=:listingID";
  $statement = $db->prepare($query);
  $statement->bindValue(':listingID', $listingID);
  $statement->execute(); // run query
  $results = $statement->fetchAll();
  $statement->closeCursor(); //release hold on this connection
 
  return $results;

	
}

function updateProperty($listingID, $num_tenants)
{

  global $db;
  $query = "UPDATE Property SET num_tenants=:num_tenants WHERE listingID=:listingID";
  $statement = $db->prepare($query);
  $statement->bindValue(':listingID', $listingID);
  $statement->bindValue(':num_tenants', $num_tenants);
  $statement->execute(); // run query
  $statement->closeCursor(); //release hold on this connection		
}

function deleteProperty($listingID)
{
  global $db;
  $query = "DELETE FROM Property WHERE listingID=:listingID";
  $statement = $db->prepare($query);
  $statement->bindValue(':listingID', $listingID);
  $statement->execute(); // run query
  $statement->closeCursor(); //release hold on this connection
	
	
}


function addStudentAccount($username, $passwrd){
  
  global $db;

  $query = "INSERT INTO Student_sign_in VALUES(:username,2, :passwrd)";
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->bindValue(':passwrd', $passwrd);
  $statement->execute(); // run query
  $statement->closeCursor(); //release hold on this connection
  
}
function addManagerAccount($username, $passwrd){
  
  global $db;

  $query = "INSERT INTO Manager_sign_in VALUES(:username, 1, :passwrd)";
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->bindValue(':passwrd', $passwrd);
  $statement->execute(); // run query
  $statement->closeCursor(); //release hold on this connection
  
}


// Need to check the validity of this function
function getPropertySearch($num_bedrooms, $num_bathrooms, $general_location, $cost_min, $cost_max){

  global $db;
  if($num_bedrooms == 4)
    $query = "SELECT * FROM Property WHERE (num_bedrooms>=4:num_bedrooms) OR (num_bathrooms=:num_bathrooms) OR (general_location=:general_location) OR (cost_min>=:cost_min AND cost_max<=:cost_max)";
  if($num_bathrooms == 4)
    $query = "SELECT * FROM Property WHERE (num_bedrooms=:num_bedrooms) OR (num_bathrooms>=:num_bathrooms) OR (general_location=:general_location) OR (cost_min>=:cost_min AND cost_max<=:cost_max)";
  if($cost_min == 1001)
    $query = "SELECT * FROM Property WHERE (num_bedrooms=:num_bedrooms) OR (num_bathrooms=:num_bathrooms) OR (general_location=:general_location) OR (cost_min>:cost_min AND cost_max>:cost_max)";
  else
    $query = "SELECT * FROM Property WHERE (num_bedrooms=:num_bedrooms) OR (num_bathrooms=:num_bathrooms) OR (general_location=:general_location) OR (cost_min>=:cost_min AND cost_max<=:cost_max)";
  // echo $num_bedrooms;
  // echo $num_bathrooms;
  // echo $general_location;
  // echo $cost_min;
  // echo $cost_max;
  $statement = $db->prepare($query);
  $statement->bindValue(':num_bedrooms', $num_bedrooms);
  $statement->bindValue(':num_bathrooms', $num_bathrooms);
  $statement->bindValue(':general_location', $general_location);
  $statement->bindValue(':cost_min', $cost_min);
  $statement->bindValue(':cost_max', $cost_max);
  $statement->execute();

  $results = $statement->fetchAll(); // returns an array of rows
  $statement->closeCursor();

 return $results;
}

// function getPropertyByBedrooms($num_bedrooms){
//   global $db;
//   $query = "SELECT * FROM Property WHERE num_bedrooms=:nu";
//   $statement = $db->prepare($query);
//   $statement->execute();

//   $results = $statement->fetchAll(); // returns an array of rows
//   $statement->closeCursor();

//  return $results;
// }

// function getPropertyByBathrooms($num_bathrooms){
//   global $db;
//   $query = "SELECT * FROM Property WHERE num_bathrooms=:num_bathrooms";
//   $statement = $db->prepare($query);
//   $statement->execute();

//   $results = $statement->fetchAll(); // returns an array of rows
//   $statement->closeCursor();

//  return $results;
// }

// function getPropertyByLocation($general_location){
//   global $db;
//   $query = "SELECT * FROM Property";
//   $statement = $db->prepare($query);
//   $statement->execute();

//   $results = $statement->fetchAll(); // returns an array of rows
//   $statement->closeCursor();

//  return $results;
// }

// function getPropertyByRent($cost_min, $cost_max){
//   global $db;
//   $query = "SELECT * FROM Property";
//   $statement = $db->prepare($query);
//   $statement->execute();

//   $results = $statement->fetchAll(); // returns an array of rows
//   $statement->closeCursor();

//  return $results;
// }

?>
