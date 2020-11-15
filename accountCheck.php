<?php
session_start();
require('connectdb.php');

if(isset( $_SESSION['sid'])){
  header("Location:studAcct.php");
}

if(isset($_SESSION["managerID"])){
  header("Location:properties.php");
}
header("Location:properties.php");



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">      
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel='stylesheet' href='styles.css'>
  <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSraCv5uiN9OtQOm6QiXnFzKmkDSkytAlJ4ow&usqp=CAU" type="image/ico" />  

</head>

<body>

   
</body>
</html>
  
