<?php

include_once "../Classes/OutPutClass.php";
include_once "../Classes/UserClass.php";
include_once "../Classes/FileMangerClass.php";
include_once "Back End.php";
$UserId = $_SESSION["UserId"];
$UserFile = new FileManger("User.txt");
$Line = $UserFile->ValueIsThere( $UserId, 0);
$UserNow = User::FromStringToObject($Line);
HTML::Header($UserNow->getType());
$User = User::FromStringToObject($UserFile->ValueIsThere($_GET["Id1"],0));
array_push($Inputs,new Input("Name","User Name","text",$User->getName()));
array_push($Inputs,new Input("Date","Date of Birth","date"));
$Input = new Input();
$Texts = [];
$Values = [];
$UserTypeFile = new FileManger("User Type.txt");
$List = $UserTypeFile->GetAllContent();
for ($i = 0; $i < count($List); $i++) {
    $Array = explode('~', $List[$i]);
    $Type = $Array[1];
    $TypeId = $Array[0];
    array_push($Texts,$Type);
    array_push($Values,$TypeId);
}
$Input->setText($Texts);
$Input->setName("Type");
$Input->setValue($Values);
$Input->setType("select");
array_push($Inputs,$Input);

array_push($Inputs,new Input("Update","Set New Values","submit"));

$Form = new Form();
$Form->setActionFile("#");
$Form->setInputs($Inputs);
$Form->setTitle("Update User ".$User->getId());
$Form->DisplayForm();
HTML::Footer();

if($Form->InfoIsTaken())
{
    $UpdatedUser = new User();
    $UpdatedUser->setId($User->getId());
    $UpdatedUser->setName($_POST["Name"]);
    $UpdatedUser->setDateOfBirth($_POST["Date"]);
    $UpdatedUser->setType($_POST["Type"]);
    $UpdatedUser->Update(1);
}