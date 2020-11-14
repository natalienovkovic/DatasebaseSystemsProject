<?php
require('connectdb.php');
require('contact_db.php');
$sid = $_POST['sid'];            // need to be passed from previous page
$managerID = $_POST['managerID'];   // need to be passed from previous page
$message = "";

$messages = getAllMessages($sid);
$compName = getName($managerID);
//$companies = getCompanyNames();



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
  <title>DB interfacing</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="shortcut icon" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" type="image/ico" />  
</head>

<body>
<div class="container">

<h2>Message to:
 <?php foreach ($compName as $item)
 
    echo $item['companyName'];                                            

?>


 </h2> 


<!-- <form action="formprocessing.php" method="post">  -->
<form name="mainForm" action="contactform.php" method="post">
<div class="form-group">
    Message:
    <input type="text" class="form-control" name="message" value="<?php echo $message ?>" required /> 
  </div>

  
<input type="submit" value="Add" name="action" class="btn btn-dark" title="Insert a message into a message table" />
</form>  
  
<hr/>
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
   
</body>
</html>
  
