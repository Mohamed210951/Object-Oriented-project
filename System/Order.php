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
            <label for="Order Id">Order Id</label>
            <input type="number" name="OrderId" step=".001">
        </div>
        <br>
        <?php if ($User->getType() != "3") : ?>
            <div class="row">
                <label for="Clint Id">Clint Id</label>
                <input type="number" name="ClintId" step=".001">
            </div>
            <br>
        <?php endif; ?>
        <div class="row">
            <label for="Day">Day</label>
            <select name="Day">
                <option>null</option>
                <?php
                for ($i = 0; $i < 31; $i++) {
                    echo "<option>" . $i + 1 . "</option>";
                }
                ?>
            </select>
            <label for="Month">Month</label>
            <select name="Month">
                <option>null</option>
                <?php
                for ($i = 0; $i < 12; $i++) {
                    echo "<option>" . $i + 1 . "</option>";
                }
                ?>
            </select>
            <label for="Year">Year</label>
            <select name="Year">
                <option>null</option>
                <?php
                for ($i = 2000; $i < 2050; $i++) {
                    echo "<option>" . $i + 1 . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="row">
            <?php if (in_array("Order-All", $Servis) || in_array("Order-Add", $Servis)) : ?>
                <input type="submit" value="Add Order" name="AddOrder">
            <?php endif; ?>
            <?php if (in_array("Order-All", $Servis)) : ?>
                <input type="submit" value="Update Order" name="UpdateOrder">
                <input type="submit" value="Delete Order" name="DeleteOrder">
            <?php endif; ?>
            <?php if (in_array("Order-All", $Servis) || in_array("Order-Searsh", $Servis)) : ?>
                <input type="submit" value="Search for Order" name="SearchForOrder">
            <?php endif; ?>
            <input type="submit" value="See Order Details" name="ViewOrderDetails">
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

include_once "../Classes/OrderClass.php";
include_once "Back End.php";
if (isset($_POST["AddOrder"])) {

    $Order = new Order();
    if ($User->getType() == "3") $Order->setClientId($User->getId());
    else {
        if ($_POST["ClintId"] == "") die("Clint Id is unset!!");
        $Order->setClientId(intval($_POST["ClintId"]));
        $order->setId(ToFormatedDate($_POST["Day"],$_POST["Month"],$_POST["Year"]));
    }
    $Order->Add();
}
if(isset($_POST["SearchForOrder"]))
{
    $order=new order();
    $order->setId(intval($_POST["OrderId"]));
    $order->setClientId(intval($_POST["ClientId"]));
    $order->setDate(ToFormatedDate($_POST["Day"],$_POST["Month"],$_POST["Year"]));
    $List = $order->Searsh();
    if (in_array("Order-All", $Servis)) DisplayTable($List,2);
    else DisplayTable($List);
}
if (isset($_POST["ViewOrderDetails"])) {
    if ($_POST["OrderId"] == "") exit("Order Id is required");
    if ($isexist = ValueIsThere("Order.txt", $_POST["OrderId"], 0)) {
        $Array = explode('~', $isexist);
        if ($Array[1] != $User->getId() && $User->getType() != "1") {
            exit("You cannot See the details of this order");
        }
        $OrderId = $_POST["OrderId"];
        header("Location:OrderDetails.php?OrderId=$OrderId");
    } else exit("No Order with this Id");
}
if(isset($_POST["DeleteOrder"]))
{
    if ($_POST["OrderId"] == "") exit("Order Id is required");
    $order=new order();
    $order->setId(intval($_POST["OrderId"]));
    $order->Delete();
}
if (isset($_POST["Logout"])) {
    session_unset();
    session_destroy();
    header("Location:Login.php");
}

if (isset($_POST["UpdateOrder"])) {
}
if(isset($_POST["MainMenu"]))
{
    header("Location:index.php");
}