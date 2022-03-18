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
            <input type="submit" value="Login" name = "submit">
        </div>
    </form>
</body>
</html>

<?php
include_once "Back End.php";
if(isset( $_POST["submit"]))
{
    $UserName = $_POST["UserName"];
    $Password = $_POST["Password"];
    if($Array = UserNameIsThere("User.txt",$UserName))
    {
        if($Array[3] == $Password)
        {
            $Type = $Array[1];
            $File = fopen("Files/UserNow.txt",'w');
            fwrite($File,$Type);
            header("Location:Menu.php");
        }
        else
        {
            echo "Wrong UserName or Password!!";
        }
    }
    else
    {
        echo "Wrong UserName or Password!!";
    }
}
