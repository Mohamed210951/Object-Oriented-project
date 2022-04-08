<?php
include_once "Back End.php";
session_start();
if(isset($_SESSION["UserId"])) header("Location:MainMenu.php");
else{
$File = fopen("../Files/User.txt", 'r');
if ($Line = fgets($File))
    header("Location:Login.php");
else
    header("Location:SignUp.php");
}