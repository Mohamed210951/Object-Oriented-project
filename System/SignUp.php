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
                <?php 
                include_once "Back End.php";
                    $List = GetAllContent("User Type.txt");
                    for ($i=0; $i < count($List); $i++) { 
                        $Array = explode('~',$List[$i]);
                        $Type = $Array[1];
                        echo "<option value='$Type'>$Type</option>";
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
if(isset($_POST["submit"]))
{
    $UserName = $_POST["UserName"];
    $Password = $_POST["Password"];
    $ConPass = $_POST["ConPass"];
    $Type = $_POST["Type"];
    if($ConPass == $Password) {
        SignUp($UserName,$Password,$Type);
    }
    else {
        echo "Must be the same Password!!";
    }
}