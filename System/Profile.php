
<?php
session_start();
include_once "Back End.php";
include_once "../Classes/UserClass.php";
include_once "../Classes/OutPutClass.php";
$Id = $_SESSION["UserId"];
$Line = ValueIsThere("User.txt", $Id, 0);
$User = User::FromStringToObject($Line);
$Line = ValueIsThere("User Type.txt", $User->getType(), 0);
$Array = explode('~', $Line);
$Type = $Array[1];
HTML::Header($User->getType());
?>
<center><h1>PROFILE</h1></center>
<h3>Id: <?php echo $User->getId() ?></h3>
<h3>The <?php echo $Type . " " . $User->getName() ?></h3>
<h3>Date of Birth <?php echo $User->getDateOfBirth() ?></h3><br>
<?php 
$Inputs = [];
array_push($Inputs,new Input("Name","Name","text"));
array_push($Inputs,new Input("Password","Password","password"));
array_push($Inputs,new Input("NewPassword","New Password","password"));
array_push($Inputs,new Input("ConfirmPassword","Confirm Password","password"));
array_push($Inputs,new Input("Date","Date of Birth","date"));
array_push($Inputs,new Input("UpdateName","Update Name","submit"));
array_push($Inputs,new Input("UpdatePassword","Update Password","submit"));
array_push($Inputs,new Input("UpdateDateOfBirth","Update Date Of Birth","submit"));
$Form = new Form();
$Form->setActionFile("#");
$Form->setInputs($Inputs);
$Form->setTitle(" ");
$Form->DisplayForm();
HTML::Footer();
include_once "Back End.php";
include_once "../Classes/UserClass.php";
if (isset($_POST["UpdateName"])) {
    if ($_POST["Password"] == "") die("You Must write your Password");
    if ($_POST["Name"] == "") die("You Must write new name");
    $Password = $_POST["Password"];
    if (sha1($Password) != $User->getPassword()) die("wrong Password");
    $UpdatedUser = new User();
    $UpdatedUser->setId($User->getId());
    $UpdatedUser->setName($_POST["Name"]);
    $UpdatedUser->Update();
}
if (isset($_POST["UpdateDateOfBirth"])) {
    if(isset($_POST["Date"])) die("Date is unset!!");
    $Date = $_POST["Date"];
    $UpdatedUser = new User();
    $UpdatedUser->setId($User->getId());
    $UpdatedUser->setDateOfBirth($Date);
    $UpdatedUser->Update();
}
if (isset($_POST["UpdatePassword"])) {
    if ($_POST["Password"] == "") die("You Must write your Password");
    $Password = $_POST["Password"];
    if (sha1($Password) != $User->getPassword()) die("wrong Password");
    if ($_POST["NewPassword"] == "") die("You Must wite the new Password");
    if ($_POST["ConfirmPassword"] != $_POST["NewPassword"]) die("Must be the same Password!!");
    $UpdatedUser = new User();
    $UpdatedUser->setId($User->getId());
    $UpdatedUser->setName($_POST["NewPassword"]);
    $UpdatedUser->Update();
}

