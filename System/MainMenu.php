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
        <input type="submit" value="Product" name = "GotoProduct"<?php 
            $flag = 0;
            for ($i=0; $i < count($Servis); $i++) { 
                if(str_contains($Servis[$i],"Product")) $flag = 1;
            }
            if($flag == 0) echo "hidden";
        ?>>
        <input type="submit" value="Order" name = "GoToOrder"<?php 
            $flag = 0;
            for ($i=0; $i < count($Servis); $i++) { 
                if(str_contains($Servis[$i],"Order")) $flag = 1;
            }
            if($flag == 0) echo "hidden";
        ?>>
        <input type="submit" value="User" name="GoToUser"<?php 
             $flag = 0;
             for ($i=0; $i < count($Servis); $i++) { 
                 if(str_contains($Servis[$i],"User")) $flag = 1;
             }
             if($flag == 0) echo "hidden";
        ?>>
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
    session_destroy();
    header("Location:Login.php");
}
if(isset($_POST["Profile"]))
{
    header("Location:Profile.php");
}

