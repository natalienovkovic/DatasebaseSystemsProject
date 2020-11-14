<?php
require('connectdb.php');
require('contact_db.php');
//$sid = $_GET['sid'];            // need to be passed from previous page
//$managerID = $_GET['managerID'];   // need to be passed from previous page
$message = "";
$sid = "vn3gc"  ;         // need to be passed from previous page
$managerID = "1234"; 
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
  <title>Contact</title>
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
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" name='sl' placeholder="Search listings" aria-label="Search">
        <button class="sl-btn" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <!-- End Navbar code -->

<div class='container'>
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
   </div>
</body>
</html>
  
