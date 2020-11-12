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


function getAllMessages($sid)
{

  global $db;
  $query = "SELECT * FROM Contact NATURAL JOIN PropertyManager WHERE sid=:sid";
  $statement = $db->prepare($query);
  $statement->bindValue(':sid', $sid);
  $statement->execute();

  $results = $statement->fetchAll(); // returns an array of rows
  $statement->closeCursor();

  return $results;
	
	
	
}

function addMessage($sid, $managerID, $message)
{

  global $db;


  $query = "INSERT INTO Contact VALUES(:sid, :managerID, :message)";
  $statement = $db->prepare($query);
  $statement->bindValue(':sid', $sid);
  $statement->bindValue(':managerID', $managerID);
  $statement->bindValue(':message', $message);
  $statement->execute(); // run query
  $statement->closeCursor(); //release hold on this connection
  
}
   
function getManager_by_listing($listingID)
{
  global $db; 
  $query = "SELECT managerID FROM Property WHERE listingID=:listingID";
  $statement = $db->prepare($query);
  $statement->bindValue(':listingID', $listingID);
  $statement->execute(); // run query
  $results = $statement->fetchAll();
  $statement->closeCursor(); //release hold on this connection
 
  return $results;	
}

function getCompanyNames()
{
  global $db; 
  $query = "SELECT DISTINCT companyName FROM PropertyManager";
  $statement = $db->prepare($query);
  $statement->execute(); // run query
  $results = $statement->fetchAll();
  $statement->closeCursor(); //release hold on this connection
 
  return $results;
	
}

function getName($managerID)
{
  global $db; 
  $query = "SELECT * FROM PropertyManager WHERE managerID=:managerID";
  $statement = $db->prepare($query);
  $statement->bindValue(':managerID', $managerID);
  $statement->execute(); // run query
  $results = $statement->fetchAll();
  $statement->closeCursor(); //release hold on this connection
 
  return $results;
	
}

?>
