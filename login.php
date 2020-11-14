<?php
    require('connectdb.php');
    require('property_db.php');
    $username = "";
    $password = "";
    $mainpage = "register.php"; 

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!empty($_POST['submit'])) {
            
            if($_POST['submit'] == 'student'){
                if(validate_student_password($username, $password) == 1){
                    //goto property page
                    header("Location: http://cs.virginia.edu/~era9dv/files/register.php");
                    echo "<span class='msg'>Username and password match our record</span> <br/>";
                }
            }   
            if($_POST['submit'] == 'manager'){
                if(validate_manager_password($username, $password) == 1){
                    //goto property page
                    header("Location:  http://cs.virginia.edu/~era9dv/files/register.php");
                    echo "<span class='msg'>Username and password match our record1</span> <br/>";
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

            <h1>Cville Student Housing DB</h1>

            <!-- <form action="formprocessing.php" method="post">  -->
            <form name="mainForm" action="login.php" method="post">
                <div class="form-group">
                    Username:
                    <input type="text" class="form-control" name="username" placeholder="username"  required />        
                </div>  
                <div class="form-group">
                    Password:
                    <input type="password" class="form-control" name="password" placeholder="password"  required /> 
                </div> 

                <!-- buttons -->
                <input 
                    type="submit" 
                    value="student" 
                    name="submit" 
                    class="btn btn-dark" 
                    title="validate student credentials" 
                />
                <input 
                    type="submit" 
                    value="manager" 
                    name="submit" 
                    class="btn btn-dark" 
                    title="validate manager credentials" 
                />
                

            </form><br>
            <input 
                    id="register"
                    type="button" 
                    value="Register" 
                    name="action" 
                    class="btn btn-dark" 
                    title="navigate to register screen"
                />
                <script type="text/javascript">
                    document.getElementById("register").onclick = function () {
                        location.href = "register.php";
                    };
                </script>   
        </div>    
    </body>
</html>