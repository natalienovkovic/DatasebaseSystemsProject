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


function getAllTours($sid)
{

  global $db;
  $query = "SELECT * FROM Tour WHERE sid=:sid";
  $statement = $db->prepare($query);
  $statement->bindValue(':sid', $sid);
  $statement->execute();

  $results = $statement->fetchAll(); // returns an array of rows
  $statement->closeCursor();

  return $results;
	
}

function getTour($sid, $listingID)
{

  global $db;
  $query = "SELECT * FROM Tour WHERE sid=:sid AND listingID=:listingID";
  $statement = $db->prepare($query);
  $statement->bindValue(':sid', $sid);
  $statement->bindValue(':listingID', $listingID);
  $statement->execute();

  $results = $statement->fetchAll(); // returns an array of rows
  $statement->closeCursor();

  return $results;
	
}

function addTour($sid, $listingID, $tourDate, $tourTime)
{

  global $db;
  $query = "INSERT INTO Tour VALUES(:sid, :listingID, :tourDate, :tourTime)";
  $statement = $db->prepare($query);
  $statement->bindValue(':sid', $sid);
  $statement->bindValue(':listingID', $listingID);
  $statement->bindValue(':tourDate', $tourDate);
  $statement->bindValue(':tourTime', $tourTime);
  $statement->execute(); // run query
  $statement->closeCursor(); //release hold on this connection
  
}

function removeTour($sid, $listingID)
{

  global $db;
  $query = "DELETE FROM Tour WHERE sid=:sid AND listingID=:listingID";
  $statement = $db->prepare($query);
  $statement->bindValue(':sid', $sid);
  $statement->bindValue(':listingID', $listingID);
  $statement->execute();

  $statement->closeCursor();
  
	
}


?>
