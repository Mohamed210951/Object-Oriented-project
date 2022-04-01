<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <?php 
        session_start();
        include_once "Back End.php";
        include_once "../Classes/UserClass.php";
        $Id = $_SESSION["UserId"];
        $Line = ValueIsThere("User.txt",$Id,0);
        $User = User::StringToUser($Line);
        $Line = ValueIsThere("User Type.txt",$User->getType(),0);
        $Array = explode('~',$Line);
        $Type = $Array[1];

    ?>
    <h1>User Profile</h1>
    <h3>Id: <?php echo $User->getId()?></h3>
    <h3>The <?php echo $Type." ".$User->getName()?></h3>
    <h3>Date of Birth <?php echo $User->getDateOfBirth()?></h3><br>
    <form action="#" method="post">
        <div class = "row">
            <label for="UserName">Name</label>
            <input type="text" name="Name">
        </div>
        <div class = "row">
            <label for="OldPassword">Password</label>
            <input type="password" name="Password">
        </div>
        <div class = "row">
            <label for="NewPassword">New Password</label>
            <input type="password" name="NewPassword">
        </div>
        <div class = "row">
            <label for="ConfirmPassword">Confirm Password</label>
            <input type="password" name="ConfirmPassword">
        </div>
        <div class = "row">
            <label for="Date of Birth">Date of Birth  </label><br>
            <label for="Day">Day: </label>
            <select name="Day">
                <option value="">Null</option>
                <?php 
                    for ($i=0; $i < 31; $i++) { 
                        echo "<option>".$i + 1 ."</option>";
                    }
                ?>
            </select>
            <label for="Month">Month: </label>
            <select name="Month">
                <option value="">Null</option>
                <?php 
                    for ($i=0; $i < 12; $i++) { 
                        echo "<option>".$i + 1 ."</option>";
                    }
                ?>
            </select>
            <label for="Year">Year: </label>
            <select name="Year">
                <option value="">Null</option>
                <?php 
                    for ($i=2000; $i < 2050; $i++) { 
                        echo "<option>".$i + 1 ."</option>";
                    }
                ?>
            </select>
        </div>
        <br>
        <div class = "row">
            <input type="submit" value="Update Name" name = "UpdateName">
            <input type="submit" value="Update Password" name = "UpdatePassword">
            <input type="submit" value="Update Date of Birth" name = "UpdateDateOfBirth">
        </div>
    </form>
    <footer>
        <form action="#" method="post">
            <input type="submit" value="Logout" name="Logout">
        </form>
    </footer>
</body>
</html>

<?php
include_once "Back End.php";
include_once "../Classes/UserClass.php";
if(isset($_POST["UpdateName"]))
{
    if($_POST["Password"] == "") die("You Must write your Password");
    if($_POST["Name"] == "") die("You Must write new name");
    $Password = $_POST["Password"];
    if(sha1($Password) != $User->getPassword()) die("wrong Password");
    $UpdatedUser = new User();
    $UpdatedUser->setId($User->getId());
    $UpdatedUser->setName($_POST["Name"]);
    $UpdatedUser->Update();
}
if(isset($_POST["UpdateDateOfBirth"]))
{
    if($_POST["Day"] == "") die("You Must write Day");
    if($_POST["Month"] == "") die("You Must write Month");
    if($_POST["Year"] == "") die("You Must write Year");
    $Day = $_POST["Day"];
    $Month = $_POST["Month"];
    $Year = $_POST["Year"];
    $Date = ToFormatedDate($Day,$Month,$Year);
    $UpdatedUser = new User();
    $UpdatedUser->setId($User->getId());
    $UpdatedUser->setDateOfBirth($Date);
    $UpdatedUser->Update();
}
if(isset($_POST["UpdatePassword"]))
{
    if($_POST["Password"] == "") die("You Must write your Password");
    $Password = $_POST["Password"];
    if(sha1($Password) != $User->getPassword()) die("wrong Password");
    if($_POST["NewPassword"] == "") die("You Must wite the new Password");
    if($_POST["ConfirmPassword"]!=$_POST["NewPassword"]) die ("Must be the same Password!!");
    $UpdatedUser = new User();
    $UpdatedUser->setId($User->getId());
    $UpdatedUser->setName($_POST["NewPassword"]);
    $UpdatedUser->Update();
}
if(isset($_POST["Logout"]))
{
    header("Location:Login.php");
}

