<?php
include_once "Back End.php";
$File = fopen("../Files/User.txt", 'r');
if ($Line = fgets($File))
    header("Location:Login.php");
else
    header("Location:SignUp.php");
