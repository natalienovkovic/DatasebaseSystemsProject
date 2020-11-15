<?php
session_start();
require('connectdb.php');

unset($_SESSION['sid']);
unset($_SESSION['managerID']);
session_destroy();


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">      
  <title>Logout</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel='stylesheet' href='styles.css'>
  <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSraCv5uiN9OtQOm6QiXnFzKmkDSkytAlJ4ow&usqp=CAU" type="image/ico" />  

</head>

<body>


<div class='container'>

<h2>Logged out</h2>

</br>


<form name="Back" action="login.php" method="post" value="1">
  <input type="submit" class="btn btn-dark" name="action" value="Log back in" style='margin-top: 10px;background-color: #84DCC6; border-color: #84DCC6;color:#000;'/>
</form> 
<br></br>




</div>
   
</body>
</html>
  
