<?php
require('connectdb.php');
require('tour_db.php');
//$sid = $_POST['sid'];            // need to be passed from previous page
//$listingID = $_POST['listingID'];   // need to be passed from previous page


$sid = "vn3gc";            // need to be passed from previous page
$listingID = "5"; 


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(!empty($_POST['action']) && ($_POST['action']=='Add'))
	{
     addTour($sid, $listingID, $_POST['date'], $_POST['time']); 
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
  <title>Tour</title>
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
    </div>
  </nav>
  <!-- End Navbar code -->

<div class='container'>
  <h2>Schedule A Tour</h2> 

  <form name="dateForm" action="propertyview.php" method="post">
    <label for="date">Date:</label>
    <input type="date" name="date"><br>
    <label for="time">Select a time:</label>
    <input type="time" name="time"><br>
    <input type="submit" value="Schedule" name="action" class="btn btn-dark" title="Submit Date" />
  </form>
</div>

</body>
</html>
  
