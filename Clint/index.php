<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello In Orphanage</title>
</head>
<body>
    <h1>Hello In Orphanage</h1>
    <form action="#" method="post">
        <div class  = "row">
            <input type="submit" value="New Child" name = "NewChild">
            <input type="submit" value="Login" name = "Login">
        </div>
    </form>
</body>
</html>

<?php

if(isset($_POST["NewChild"]))
{
    header("Location:Sign Up.php");
}
if(isset($_POST["Login"]))
{
    header("Location:Login.php");
}