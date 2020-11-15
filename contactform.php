<?php
session_start();
require('connectdb.php');
require('contact_db.php');

$sid = "";
$managerID="";

if(isset( $_SESSION['sid'])){
  $sid = $_SESSION['sid'];
}

if(isset($_SESSION["managerID"])){
  $managerID = $_SESSION["managerID"];
}

$message = "";

$messages = getAllMessages($sid);
$compName = getName($managerID);




if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(!empty($_POST['action']) && ($_POST['action']=='Add'))
	{
       addMessage($sid, $managerID, $_POST['message']);
       $messages = getAllMessages($sid);
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
  <title>Contact</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel='stylesheet' href='styles.css'>
  <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSraCv5uiN9OtQOm6QiXnFzKmkDSkytAlJ4ow&usqp=CAU" type="image/ico" />  
</head>

<body>

<!--header file -->
<?php include 'navbar.html' ?>


<div class='container'>
<h2>Message to:
 <?php foreach ($compName as $item)
 
    echo $item['companyName'];                                            

?>
</h2>

</br>


<!-- <form action="formprocessing.php" method="post">  -->

<form name="mainForm" action="contactform.php" method="post">
<div class="form-group">
    Message:
    <input type="text" class="form-control" name="message" value="<?php echo $message ?>" required /> 
  </div> 
<input type="submit" value="Add" name="action" class="btn btn-dark" title="Insert a message into a message table" />
</form>  

<form name="Back" action="propertyview.php" method="post">
  <input type="submit" class="btn btn-dark" name="action" value="Back to Listing" style='margin-top: 10px;background-color: #84DCC6; border-color: #84DCC6;color:#000;'/>
</form> 
<br></br>

<h2>Your Messages</h2>
<div style="width:100%; overflow:auto;">
<table class="w3-table w3-bordered w3-card-4 center" style="overflow:auto">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="10%">Message To</th>               
    <th width="20%">Message</th> 

  </tr>
  </thead>
  <?php foreach ($messages as $item): ?>
  <tr>
    <td><?php echo $item['companyName']; ?></td> 
    <td><?php echo $item['message']; ?></td>                                           
  </tr>
<?php endforeach; ?>
</table>
</div>


</div>
   
</body>
</html>
  
