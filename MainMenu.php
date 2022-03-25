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
        $Servis = FromTypeGetServis($Type);
    ?>
    <form action="#" method="post">
        <input type="submit" value="Product" name = "GotoProduct"<?php 
            $flag = 0;
            for ($i=0; $i < count($Servis); $i++) { 
                if(str_contains($Servis[$i],"Product")) $flag = 1;
            }
            if($flag == 0) echo "hidden";
        ?>>
        <input type="submit" value="Order" name = "GoToOrder"<?php 
            $flag = 0;
            for ($i=0; $i < count($Servis); $i++) { 
                if(str_contains($Servis[$i],"Order"))
                     $flag = 1;
            }
            if($flag == 0) echo "hidden";
        ?>>
    </form>
</body> 
</html>
<?php

if(isset($_POST["GotoProduct"]))
{
    header("Location:Product.php");
}
if(isset($_POST["GoToOrder"]))
{
    header("Location:Order.php");
}
