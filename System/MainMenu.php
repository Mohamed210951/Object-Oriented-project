<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MainMenu.php</title>
</head>
<body>
    <h1>MainMenu.php</h1>
    <?php
        session_start();
        include_once "Back End.php";
        include_once "../Classes/UserClass.php";
        $Id = $_SESSION["UserId"];
        $Line = ValueIsThere("User.txt",$Id,0);
        $User = User::StringToUser($Line);
        $Servis = FromTypeGetServis($User->getType());
    ?>
    <form action="#" method="post">
        <?php if(!str_contains($Servis[0],"Product-Non")) : ?>
            <input type="submit" value="Product" name = "GotoProduct">
        <?php endif; ?>
        <?php if(!str_contains($Servis[1],"Order-Non")) : ?>
            <input type="submit" value="Order" name = "GoToOrder">
        <?php endif; ?>
        <?php if(!str_contains($Servis[2],"User-Non")) : ?>
            <input type="submit" value="User" name="GoToUser">
        <?php endif; ?>
        <?php if($User->getType() == "1") : ?>
            <input type="submit" value="Type of Users" name = "GoToType">
        <?php endif; ?>
    </form>

    <footer>
        <form action="#" method="post">
            <input type="submit" value="Logout" name="Logout">
            <input type="submit" value="Profile" name = "Profile">
        </form>
    </footer>
</body> 
</html>
<?php

if(isset($_POST["GotoProduct"]))
{
    header("Location:Product.php");
}
if(isset($_POST["GoToOrder"]))
{
    header("Location:Order.php");
}
if(isset($_POST["GoToUser"]))
{
    header("Location:User.php");
}
if(isset($_POST["Logout"]))
{
    session_unset();
    session_destroy();
    header("Location:Login.php");
}
if(isset($_POST["Profile"]))
{
    header("Location:Profile.php");
}

if(isset($_POST["GoToType"]))
{
    header("Location:Type.php");
}
