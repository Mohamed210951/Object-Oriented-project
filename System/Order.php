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
array_push($Inputs,new Input("OrderId","Order Id","number"));
if ($User->getType() != "3") array_push($Inputs,new Input("ClintId","Clint Id","number"));
array_push($Inputs,new Input("Date","Date of order","date"));
if (in_array("Order-All", $Servis) || in_array("Order-Add", $Servis)) 
{   array_push($Inputs,new Input("AddOrder","Add Order","submit"));}
if (in_array("Order-All", $Servis))
{
    array_push($Inputs,new Input("UpdateOrder","Update Order","submit"));
    array_push($Inputs,new Input("DeleteOrder","Delete Order","submit"));
}
if (in_array("Order-All", $Servis) || in_array("Order-Searsh", $Servis))
{
    array_push($Inputs,new Input("SearchForOrder","Search for Order","submit"));
}
array_push($Inputs,new Input("ViewOrderDetails","See Order Details","submit"));
$Form = new Form();
$Form->setActionFile("#");
$Form->setInputs($Inputs);
$Form->setTitle("Orders");
$Form->DisplayForm();
HTML::Footer();

include_once "../Classes/OrderClass.php";
include_once "Back End.php";
if (isset($_POST["AddOrder"])) {

    $Order = new Order();
    if ($User->getType() == "3") $Order->setClientId($User->getId());
    else {
        if ($_POST["ClintId"] == "") die("Clint Id is unset!!");
        $Order->setClientId(intval($_POST["ClintId"]));
    }
    $Order->setDate($_POST["Date"]);
    $Order->Add();
    unset($_POST["AddOrder"]);
    unset($_POST["ClintId"]);
    unset($_POST["Date"]);
}
$flag = 0;
if(isset($_POST["SearchForOrder"]))
{
    $flag = 1;
    $order=new order();
    $order->setId(intval($_POST["OrderId"]));
    $order->setClientId(intval($_POST["ClientId"]));
    $order->setDate($_POST["Date"]);
    $List = $order->Searsh();
    if (in_array("Order-All", $Servis)) DisplayTable($List,2,"OrderUpdate.php");
    else DisplayTable($List);
    unset($_POST["SearchForOrder"]);
    unset($_POST["OrderId"]);
    unset($_POST["ClintId"]);
    unset($_POST["Date"]);
}
if (isset($_POST["ViewOrderDetails"])) {
    if ($_POST["OrderId"] == "") exit("Order Id is required");
    if ($isexist = ValueIsThere("Order.txt", $_POST["OrderId"], 0)) {
        $Array = explode('~', $isexist);
        if ($Array[1] != $User->getId() && $User->getType() != "1") {
            exit("You cannot See the details of this order");
        }
        $OrderId = $_POST["OrderId"];
        echo(" <script> location.replace('OrderDetails.php?OrderId=$OrderId'); </script>");
    } else exit("No Order with this Id");
}
if(isset($_POST["DeleteOrder"]))
{
    if ($_POST["OrderId"] == "") exit("Order Id is required");
    $order=new order();
    $order->setId(intval($_POST["OrderId"]));
    $order->Delete();
    unset($_POST["OrderId"]);
    unset($_POST["ClintId"]);
    unset($_POST["Date"]);
}

if (isset($_POST["UpdateOrder"])) {
}
if($flag == 0)
{
    $order=new order();
    $order->setId(0);
    $order->setClientId(0);
    $order->setDate("");
    $List = $order->Searsh();
    if (in_array("Order-All", $Servis)) DisplayTable($List,2,"OrderUpdate.php");
    else DisplayTable($List);
}