<?php
include_once "../Classes/OutPutClass.php";
include_once "Back End.php";
include_once "../Classes/UserClass.php";
if(session_id() == ''){
    session_start();
}
if(!isset($_SESSION["UserId"])) HTML::Header("non");
else {
    $Id = $_SESSION["UserId"];
    $Line = ValueIsThere("User.txt", $Id, 0);
    $User = User::FromStringToObject($Line);
    HTML::Header($User->getType());
}
echo "<h1>Welcome to our project</h1>";
HTML::Footer();