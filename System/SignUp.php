<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<body>
    <h1>Sign In</h1>
    <form action="#" method="post">
        <div class = "row">
            <label for="UserName">UserName</label>
            <input type="text" name = "UserName" required>
        </div>
        <br>
        <div class = "row">
            <label for="Password">Password</label>
            <input type="text" name = "Password" required>
        </div>
        <br>
        <div class = "row">
            <label for="ConfirmPassword">Confirm Password</label>
            <input type="password" name = "ConPass" required>
        </div>
        <br>
        <div class = "row">
            <label for="SelectType">Select Your Type</label>
            <select name="Type">
                <option value="Null">Null</option>
                <?php 
                    include_once "Back End.php";
                    $List = GetAllContent("User Type.txt");
                    for ($i=0; $i < count($List); $i++) { 
                        $Array = explode('~',$List[$i]);
                        $Type = $Array[1];
                        $TypeId = $Array[0];
                        echo "<option value='$TypeId'>$Type</option>";
                    }
                ?>
            </select>
        </div>
        <div class = "row">
            <label for="DateOfBirth">Date of Birth  </label> <br>
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
                    for ($i=1950; $i < 2050; $i++) { 
                        echo "<option>".$i + 1 ."</option>";
                    }
                ?>
            </select>
        </div>
        <br>
        <div class = "row">
            <input type="submit" value="Sign Up" name = "submit">
        </div>
    </form>
</body>
</html>
<?php
include_once "Back End.php";
include_once "../Classes/UserClass.php";
if(isset($_POST["submit"]))
{
    if($_POST["UserName"] == "") die("Name is Unset");
    $UserName = $_POST["UserName"];
    if($_POST["Password"] == "") die("Password is Unset");
    $Password = $_POST["Password"];
    if($_POST["Type"] == "") die("Type is Unset");
    $Type = $_POST["Type"];
    if($_POST["Day"] == "") die("Day is Unset");
    $Day = $_POST["Day"];
    if($_POST["Month"] == "") die("Month is Unset");
    $Month = $_POST["Month"];
    if($_POST["Year"] == "") die("Year is Unset");
    $Year = $_POST["Year"];
    $ConPass = $_POST["ConPass"];
    if($ConPass == $Password) {
        $DateOfBirth = ToFormatedDate($Day,$Month,$Year);
        $newUser = new User(GetLastId("User.txt") + 1, $Type, $UserName, $Password,$DateOfBirth);
	    $newUser->Add();
        session_destroy();
        session_start();
        $_SESSION["UserId"] = $newUser->getId();
        header("Location:MainMenu.php");
    }
    else {
        echo "Must be the same Password!!";
    }
}

