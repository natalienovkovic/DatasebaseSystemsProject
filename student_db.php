<?php 

// CREATE TABLE IF NOT EXISTS Student (
// sid VARCHAR(10) NOT NULL PRIMARY KEY, -- Primary Key of this table
// fname VARCHAR(20) NOT NULL,
// lname VARCHAR(20) NOT NULL,
// );



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

   
function getMyFavorites($sid)
{
	global $db;
	$query = "SELECT * FROM Favorite CROSS JOIN Property WHERE Favorite.listingID = Property.listingID AND Favorite.sid=:sid";
	$statement = $db->prepare($query); //make an executable version
	$statement->bindValue(':sid', $sid);
	$statement->execute();
	$results = $statement->fetchAll(); //returns an array of all rows from the result that we execute
	$statement->closeCursor();

	return $results; 
}

function getMyTours($sid)
{
	global $db;
	$query = "SELECT * FROM Tour CROSS JOIN Property WHERE Tour.listingID = Property.listingID AND Tour.sid=:sid";
	$statement = $db->prepare($query); //make an executable version
	$statement->bindValue(':sid', $sid);
	$statement->execute();
	$results = $statement->fetchAll(); //returns an array of all rows from the result that we execute
	$statement->closeCursor();

	return $results; 
}

function myInfo($sid)
{
	global $db;
	$query = "SELECT * FROM Student WHERE sid=:sid";
	$statement = $db->prepare($query); //make an executable version
	$statement->bindValue(':sid', $sid);
	$statement->execute();
	$results = $statement->fetchAll(); //returns an array of all rows from the result that we execute
	$statement->closeCursor();

	return $results; 
}
?>
