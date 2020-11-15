<?php 

// CREATE TABLE IF NOT EXISTS PropertyManager (
// managerID INT NOT NULL PRIMARY KEY, -- Primary Key of this table
// companyName VARCHAR(50) NOT NULL,
// phone VARCHAR(10),
// email VARCHAR(50) NOT NULL,
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

   
function getMyProperties($managerID)
{
	global $db;
	$query = "SELECT * FROM Property WHERE managerID=:managerID";
	$statement = $db->prepare($query); //make an executable version
	$statement->bindValue(':managerID', $managerID);
	$statement->execute();
	$results = $statement->fetchAll(); //returns an array of all rows from the result that we execute
	$statement->closeCursor();

	return $results; 
}

function getMyInfo($managerID)
{
	global $db;
	$query = "SELECT * FROM PropertyManager WHERE managerID=:managerID";
	$statement = $db->prepare($query); //make an executable version
	$statement->bindValue(':managerID', $managerID);
	$statement->execute();
	$results = $statement->fetchAll(); //returns an array of all rows from the result that we execute
	$statement->closeCursor();

	return $results; 
}
?>
