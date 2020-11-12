<?php
    require('connectdb.php');
    require('property_db.php');
    $username = "";
    $password = "";
    $acctype = $_POST['acctype'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['submit'])) {
            if(isset($_POST['radio'])){
                if($_POST['radio'] == 'student'){
                    addStudentAccount($_POST['username'], $_POST['password']);
                }
                if($_POST['radio'] == 'manager'){
                    addManagerAccount($_POST['username'], $_POST['password']);
                }
            }
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

            <h1>Create Your Account</h1>

            <!-- <form action="formprocessing.php" method="post">  -->
            <form name="mainForm" action="register.php" method="post">
                <div class="form-group">
                    Username:
                    <input type="text" class="form-control" name="username" placeholder="username" value="<?php echo $username ?>" required />        
                </div>  
                <div class="form-group">
                    Password:
                    <input type="password" class="form-control" name="password" placeholder="password" value="<?php echo $password ?>" required /> 
                </div> 
                <div class = "form-group">
                    Account Type:<br>
                    <input type="radio" id="manager" name="radio" value="manager" required>
                    <label for="manager">Manager</label><br>
                    <input type="radio" id="student" name="radio" value="student" required>
                    <label for="student">Student</label><br>
                </div>
                <input 
                    type="submit" 
                    value="Register" 
                    name="submit" 
                    class="btn btn-dark" 
                    title="create account"
                /> 

                <!-- buttons -->
                

            </form><br>
            <input 
                    type="button" 
                    value="Return to Login" 
                    name="goback" 
                    class="btn btn-dark" 
                    title="navigate to login screen"
                    onclick="location.href = 'login.php';" 
                /> 
            <div>
            
            </div>                 
        </div>    
    </body>
</html>