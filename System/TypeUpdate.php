<?php

include_once "../Classes/OutPutClass.php";
include_once "../Classes/UserClass.php";
include_once "../Classes/TypeClass.php";
include_once "Back End.php";
$UserId = $_SESSION["UserId"];
$Line = ValueIsThere("User.txt", $UserId, 0);
$User = User::FromStringToObject($Line);
HTML::Header($User->getType());
$Type = Type::FromStringToObject(ValueIsThere("User Type Menu.txt",$_GET["Id1"],0));
$Type->setName(explode('~',ValueIsThere("User Type.txt",$Type->getId(),0))[1]);


$Inputs = [];
array_push($Inputs,new Input("Name","Type Name","text",$Type->getName()));
$Input = new Input();
$Input->setName("Product");
$Text = ["Non","All","Add","Search"];
$Input->setText($Text);
$Input->setValue($Text);
$Input->setType("select");
array_push($Inputs,$Input);
$Input = new Input();
$Input->setName("Order");
$Text = ["Non","All","Add","Search"];
$Input->setText($Text);
$Input->setValue($Text);
$Input->setType("select");
array_push($Inputs,$Input);
$Input = new Input();
$Input->setName("User");
$Text = ["Non","All","Search"];
$Input->setText($Text);
$Input->setValue($Text);
$Input->setType("select");
array_push($Inputs,$Input);

array_push($Inputs,new Input("Update","Set new values","submit"));
$Form = new Form();
$Form->setActionFile("#");
$Form->setInputs($Inputs);
$Form->setTitle("Update Type ".$Type->getName());
$Form->DisplayForm();
HTML::Footer();

if($Form->InfoIsTaken())
{
    $UpdatedType = new Type($Type->getId(),$_POST["Name"],$_POST["Product"],$_POST["Order"],$_POST["User"]);
    $UpdatedType->Update();
    echo(" <script> location.replace('Type.php'); </script>");
}