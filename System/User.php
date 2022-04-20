<?php
include_once "Back End.php";
session_start();
include_once "../Classes/UserClass.php";
include_once "../Classes/OutPutClass.php";
$Id = $_SESSION["UserId"];
$Line = ValueIsThere("User.txt", $Id, 0);
$User = User::FromStringToObject($Line);
$Servis = FromTypeGetServis($User->getType());

HTML::Header($User->getType());
$Inputs = [];
array_push($Inputs,new Input("UserId","User Id","number"));
array_push($Inputs,new Input("UserName","User Name","text"));
$Input = new Input();
$Texts = [];
$Values = [];
include_once "Back End.php";
$List = GetAllContent("User Type.txt");
for ($i = 0; $i < count($List); $i++) {
    $Array = explode('~', $List[$i]);
    $Type = $Array[1];
    $TypeId = $Array[0];
    array_push($Texts,$Type);
    array_push($Values,$TypeId);
}
$Input->setText($Texts);
$Input->setName("UserType");
$Input->setValue($Values);
$Input->setType("select");
array_push($Inputs,$Input);
if (in_array("User-All", $Servis))
{
    array_push($Inputs,new Input("AddUser","Add User","submit"));
    array_push($Inputs,new Input("UpdateUserType","Update User Type","submit"));
    array_push($Inputs,new Input("SearshForUser","Searsh For User","submit"));
    array_push($Inputs,new Input("DeleteUser","Delete User","submit"));
}
else if(in_array("User-Searsh", $Servis))
{
    array_push($Inputs,new Input("SearshForUser","Searsh For User","submit"));
}
$Form = new Form();
$Form->setActionFile("#");
$Form->setInputs($Inputs);
$Form->setTitle("Users");
$Form->DisplayForm();
HTML::Footer();
include_once "Back End.php";
include_once "../Classes/UserClass.php";
if (isset($_POST["AddUser"])) {
    echo(" <script> location.replace('SignUp.php'); </script>");
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
