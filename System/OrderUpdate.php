<?php 

include_once "../Classes/OrderClass.php";
include_once "../Classes/UserClass.php";
include_once "../Classes/OutPutClass.php";
include_once "Back End.php";
include_once "../Classes/FileMangerClass.php";
$UserId = $_SESSION["UserId"];
$UserFile = new FileManger("User.txt");
$Line = $UserFile->ValueIsThere($UserId, 0);
$User = User::FromStringToObject($Line);
HTML::Header($User->getType());
$Order = new order();
$Order->setId($_GET["Id1"]);
$Order = order::FromStringToObject($Order->getId());


$Inputs = [];
if ($User->getType() != "3") array_push($Inputs,new Input("ClintId","Clint Id","number",$Order->getClientId()));
array_push($Inputs,new Input("Date","Date of order","date"));

$Form = new Form();
$Form->setActionFile("#");
$Form->setInputs($Inputs);
$Form->setTitle("Update Order ".$Order->getId());

$Form->DisplayForm();

HTML::Footer();

if($Form->InfoIsTaken())
{
    $UpdatedOrder = new order();
    $UpdatedOrder->setId($Order->getId());
    if($User->getType()!=3) $UpdatedOrder->setClientId($_POST["ClintId"]);
    else $UpdatedOrder->setClientId($Order->getClientId());
    $UpdatedOrder->setDate($_POST["Date"]);
    $UpdatedOrder->Update();
    echo(" <script> location.replace('Order.php'); </script>");
}