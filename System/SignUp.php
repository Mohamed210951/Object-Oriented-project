
<?php
include_once "../Classes/OutPutClass.php";
include_once "Back End.php";
HTML::Header("null");
$Inputs = [];
array_push($Inputs,new Input("UserName","Username","text"));
array_push($Inputs,new Input("Password","Password","password"));
array_push($Inputs,new Input("ConPass","Confirm password","password"));
$List = GetAllContent("User Type.txt");
$Text = [];
$Value = [];
$Input = new Input();
$Input->setName("Type");
$Input->setType("select");
array_push($Text,"Null");
array_push($Value,"Null");
for ($i = 0; $i < count($List); $i++) {
    $Array = explode('~', $List[$i]);
    $Type = $Array[1];
    $TypeId = $Array[0];
    array_push($Text,$Type);
    array_push($Value,$TypeId);
}
$Input->setText($Text);
$Input->setValue($Value);
array_push($Inputs,$Input);
array_push($Inputs,new Input("Date","Date of Birth","date"));
array_push($Inputs,new Input("submit","Sign Up","submit"));
$Form = new Form();
$Form->setActionFile("#");
$Form->setInputs($Inputs);
$Form->setTitle("Sign Up");
$Form->DisplayForm();
HTML::Footer();
include_once "Back End.php";
include_once "../Classes/UserClass.php";
if (isset($_POST["submit"])) {
    if ($_POST["UserName"] == "") die("Name is Unset");
    $UserName = $_POST["UserName"];
    if ($_POST["Password"] == "") die("Password is Unset");
    $Password = $_POST["Password"];
    if ($_POST["Type"] == "") die("Type is Unset");
    $Type = $_POST["Type"];
    $Date = $_POST["Date"];
    $ConPass = $_POST["ConPass"];
    if ($ConPass == $Password) {
        $DateOfBirth = $Date;
        $newUser = new User(GetLastId("User.txt") + 1, $Type, $UserName, $Password, $DateOfBirth);
        $newUser->Add();
        if(session_id() == '') {
            session_start();
        }
        $_SESSION["UserId"] = $newUser->getId();
        header("Location:index.php");
    } else {
        echo "Must be the same Password!!";
    }
}
