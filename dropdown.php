<?php
require('connectdb.php');
require('contact_db.php');
$sid = "ct4wa";
$messages = getAllMessages($sid);
$managerID = "";
$message = "";
$listingID = "";
$companies = getCompanyNames();
$selected = "";
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

<h2>Message to: </h2> 

<form action="" method="post">

Select Company to Send Message
 <select name="comp" value= "">
 		<option></option>
		<?php foreach($companies as $row){ ?>
    		<option><?php echo $row['companyName'] ?></option>
              
  	<?php  } ?>
<input type="submit" name="button" value="Submit"/></form>
</form>


<?php

if(isset($_POST['comp'])) {
    $selected = $_POST['comp'];
}

echo $selected;

?>

  
<hr/>


   
</body>
</html>
  
