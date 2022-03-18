<?php
    $File = fopen("Files/User.txt",'r');
    if($Line = fgets($File)) 
        header("Location:Login.php");
    else 
        header("Location:SignIn.php");