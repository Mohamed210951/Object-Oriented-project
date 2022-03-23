<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login.php</title>
</head>
<body>
    <h1>Login.php</h1>

    <form action="#" method="post">
        <div class="row">
            <label for="UserName">UserName</label>
            <input type="text" name = "UserName" required>
        </div>
        <div class="row">
            <label for="Password">Password</label>
            <input type="Password" name = "Password" required>
        </div>
        <div class="row">
            <input type="submit" value="Login" name = "Login">
        </div>
    </form>
    <form action="#" method="post">
        <div class = 'row'> 
            <input type="submit" value ="SignIn" name = "SignIn">
        </div>
    </form>
</body>
</html>

<?php
include_once "Back End.php";
if(isset( $_POST["Login"]))
{
    $UserName = $_POST["UserName"];
    $Password = $_POST["Password"];
    Login($UserName,$Password);
}
if(isset($_POST["SignIn"]))
{
    header("Location:SignIn.php");
}