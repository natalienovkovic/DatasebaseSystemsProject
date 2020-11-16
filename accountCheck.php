<?php
session_start();
require('connectdb.php');


if($_SESSION['type'] == "student"){
  header("Location:studAcct.php");
}

else if($_SESSION["type"]=="manager"){
  header("Location:manAcct.php");
}
else{
header("Location:properties.php");
}

?>