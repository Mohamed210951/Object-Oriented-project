<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>

<body>
    <h1>User.php</h1>
    <?php
    include_once "Back End.php";
    session_start();
    include_once "../Classes/UserClass.php";
    $Id = $_SESSION["UserId"];
    $Line = ValueIsThere("User.txt", $Id, 0);
    $User = User::FromStringToObject($Line);
    $Servis = FromTypeGetServis($User->getType());
    ?>
    <form action="#" method="post">
        <div class="row">
            <label for="User Id">User Id</label>
            <input type="number" name="UserId">
        </div>
        <div class="row">
            <label for="User Name">User Name</label>
            <input type="text" name="UserName">
        </div>
        <div class="row">
            <label for="User Type">User Type</label>
            <select name="UserType">
                <?php
                include_once "Back End.php";
                $List = GetAllContent("User Type.txt");
                for ($i = 0; $i < count($List); $i++) {
                    $Array = explode('~', $List[$i]);
                    $Type = $Array[1];
                    $TypeId = $Array[0];
                    echo "<option value='$TypeId'>$Type</option>";
                }
                ?>
            </select>
        </div>
        <div class="row">
            <?php if (in_array("User-All", $Servis)) : ?>
                <input type="submit" value="Add User" name="AddUser">
                <input type="submit" value="Update User Type" name="UpdateUserType">
                <input type="submit" value="Searsh For User" name="SearshForUser">
                <input type="submit" value="Delete User" name="DeleteUser">
            <?php endif; ?>
            <?php if(in_array("User-Searsh", $Servis)) : ?>
                <input type="submit" value="Searsh For User" name="SearshForUser">
            <?php endif; ?>
        </div>
    </form>

    <footer>
        <form action="#" method="post">
            <input type="submit" value="Main Menu" name="MainMenu">
            <input type="submit" value="Logout" name="Logout">
        </form>
    </footer>
</body>

</html>
<?php
include_once "Back End.php";
include_once "../Classes/UserClass.php";
if (isset($_POST["AddUser"])) {
    header("Location:SignUp.php");
}
if (isset($_POST["UpdateUserType"])) {
    $User = new User();
    if ($_POST["UserId"] == "") die("User Id is unset!!");
    if ($_POST["UserType"] == "") die("User type unset!!");
    $User->setId(intval($_POST["UserId"]));
    $User->setType(intval($_POST["UserType"]));
    $User->Update();
}
if (isset($_POST["SearshForUser"])) {
    $User = new User();
    $User->setId(intval($_POST["UserId"]));
    $User->setName($_POST["UserName"]);
    $User->setType(intval($_POST["UserType"]));
    $List = $User->Searsh();
    if (in_array("User-All", $Servis)) DisplayTable($List,1);
    else DisplayTable($List);
}
if (isset($_POST["DeleteUser"])) {
    if ($_POST["UserId"] == "") die("User Id unset!!");
    $User = new User();
    $User->setId(intval($_POST["UserId"]));
    $User->Delete();
}
if (isset($_POST["Logout"])) {
    session_unset();
    session_destroy();
    header("Location:Login.php");
}
if(isset($_POST["MainMenu"]))
{
    header("Location:index.php");
}