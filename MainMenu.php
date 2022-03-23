<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MainMenu.php</title>
</head>
<body>
    <h1>MainMenu.php</h1>
    <?php
        include_once "Back End.php";
        $Array = GetAllContent("UserNow.txt");
        $Type = $Array[0];
        $List = GetAllContent("User Type.txt");
        $IdType = "-1";
        for ($i=0; $i < count($List); $i++) { 
            $array = explode('~',$List[$i]);
            if($array[1] == $Type) $IdType = $array[0];
        }
        $Servis = [];
        $List = GetAllContent("User Type Menu.txt");
        for ($i=0; $i < count($List); $i++) { 
            $array = explode('~',$List[$i]);
            if($array[0] == $IdType)
            {
                for ($j=1; $j < count($array); $j++) { 
                    array_push($Servis,$array[$j]);
                }
            }
        }
    ?>
    <form action="#" method="post">
        <input type="submit" value="Product" name = "GotoProduct"<?php 
            if(!in_array("Product",$Servis)) echo "hidden";
        ?>>
    </form>
</body> 
</html>
<?php

if(isset($_POST["GotoProduct"]))
{
    header("Location:Product.php");
}
