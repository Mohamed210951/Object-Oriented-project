<?php

include_once "../Classes/OutPutClass.php";
include_once "../Classes/OrderDetailsClass.php";
include_once "../Classes/UserClass.php";
include_once "Back End.php";

$UserId = $_SESSION["UserId"];
$Line = ValueIsThere("User.txt", $UserId, 0);
$User = User::FromStringToObject($Line);
HTML::Header($User->getType());
$OrderDetails = Order_Details::GetOrderDelail($_GET["Id1"],$_GET["Id2"]);
array_push($Inputs,new Input("NumberOfProduct","Number Of Product","number",$OrderDetails->getNumbers()));
array_push($Inputs,new Input("Set new Values"));

$Form = new Form();
$Form->setActionFile("#");
$Form->setInputs($Inputs);
$Form->setTitle("Update Order detail ".$OrderDetails->getProduct_Id());

$Form->DisplayForm();
HTML::Footer();

if($Form->InfoIsTaken())
{
    $UpdatedOrderDetail = new Order_Details();
    $UpdatedOrderDetail->setOrderId($OrderDetails->getId());
    $UpdatedOrderDetail->setProduct_Id($OrderDetails->getId());
    $UpdatedOrderDetail->setNumbers($_POST["NumberOfProduct"]);
    $UpdatedOrderDetail->Update();
    echo(" <script> location.replace('OrderDetails.php'); </script>");
}