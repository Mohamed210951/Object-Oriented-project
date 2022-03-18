<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<body>
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
            <input type="submit" value="Sign In" name = "submit">
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
    if($ConPass == $Password) {
        $newAdmin = new Admin(GetLastId("User.txt") + 1,$UserName,$Password);
        if($newAdmin->AllIsSet()) {
            if(!UserNameIsThere("User.txt",$newAdmin->getName())) {
                FileAdd("User.txt",$newAdmin->ToString());
                $File = fopen("Files/UserNow.txt",'w');
                fwrite($File,"Admin");
                header("Location:MainMenu.php");
            }
            else {
                echo "This UserName is alrady exists!!";
            }
        }
        else {
            echo "Please Try again but prevent using '~'!!";
        }
    }
    else {
        echo "Must be the same Password!!";
    }
}