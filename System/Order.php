<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Menu</title>
</head>
<body>
    <h1>Order Menu</h1>
    <form action="#" method="post">
        <div class = "row">
            <label for="Order Id">Order Id</label>
            <input type="number" name="OrderId" step = ".001">
        </div>
        <br>
        <div class = "row">
            <label for="Clint Id">Clint Id</label>
            <input type="number" name="ClintId" step = ".001">
        </div>
        <br>
        <div class = "row">
            <label for="Day">Day</label>
            <select name="Day">
                <option>null</option>
                <?php 
                    for ($i=0; $i < 31; $i++) { 
                        echo "<option>".$i + 1 ."</option>";
                    }
                ?>
            </select>
            <label for="Month">Month</label>
            <select name="Month">
                <option>null</option>
                <?php 
                    for ($i=0; $i < 12; $i++) { 
                        echo "<option>".$i + 1 ."</option>";
                    }
                ?>
            </select>
            <label for="Year">Year</label>
            <select name="Year">
                <option>null</option>
                <?php 
                    for ($i=2000; $i < 2050; $i++) { 
                        echo "<option>".$i + 1 ."</option>";
                    }
                ?>
            </select>
        </div>
        <div class = "row">
            <input type="submit" value="Add Order" name = "AddOrder">
            <input type="submit" value="Update Order" name  = "UpdateOrder">
            <input type="submit" value="Delete Order" name = "DeleteOrder">
            <input type="submit" value="Search for Order" name = "SearchForOrder">
            <input type="submit" value="See Order Details" name = "ViewOrderDetails">
        </div>
    </form>
    <footer>
        <form action="#" method="post">
            <input type="submit" value="Logout" name="Logout">
            <input type="submit" value="Profile" name = "Profile">
        </form>
    </footer>
</body>
</html>
<?php

include_once "../Classes/OrderClass.php";
include_once "Back End.php";
if(isset($_POST["AddOrder"]))
{
  $Order = new Order();
  $Order-> setClientId(intval($_POST["ClintId"]));
  $Order->Add();
}

if(isset($_POST["ViewOrderDetails"]))
{
    Decrypt("Order.txt");
    if($_POST["OrderId"] == "") exit("Must Write Order Id");
    
    if(ValueIsThere("Order.txt",$_POST["OrderId"],0))
    {
        session_start();
        
        $_SESSION["OrderId"] = $_POST["OrderId"];
        header("Location:OrderDetails.php");
    }
}

if(isset($_POST["Logout"]))
{
    session_destroy();
    header("Location:Login.php");
}

if(isset($_POST["UpdateOrder"]))
{
    
}
if(isset($_POST["Profile"]))
{
    header("Location:Profile.php");
}
?>
