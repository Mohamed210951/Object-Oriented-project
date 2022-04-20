<?php 
include_once "../Classes/OutPutClass.php";
HTML::Header("1");
$Inputs =[];
array_push($Inputs,new Input("Id","Type Id","number"));
array_push($Inputs,new Input("Name","Type Name","text"));
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
array_push($Inputs,new Input("Add","Add","submit"));
array_push($Inputs,new Input("Update","Update","submit"));
array_push($Inputs,new Input("Search","Search","submit"));
array_push($Inputs,new Input("Delete","Delete","submit"));
$Form = new Form();
$Form->setActionFile("#");
$Form->setInputs($Inputs);
$Form->setTitle("Types of Users");
$Form->DisplayForm();
HTML::Footer();
include_once "Back End.php";
function Getfeatures()
{
    $String = "";
    if($_POST["Product"] == "All")$String.="Product-All~";
    else if($_POST["Product"] == "Search") $String.= "Product-Searsh~";
    else $String.="Product-Non~";
    if($_POST["Order"] == "All")$String.="Order-All~";
    else if($_POST["Order"] == "Search") $String.= "Order-Searsh~";
    else if($_POST["Order"] == "Add") $String.= "Order-Add~";
    else $String.="Order-Non~";
    if($_POST["User"] == "All")$String.="User-All~";
    else if($_POST["User"] == "Search") $String.= "User-Searsh~";
    else $String.="User-Non~";
    return $String;
}
if(isset($_POST["Add"]))
{
    if($_POST["Name"] == "") die("Name is Unset!!");
    $Name = $_POST["Name"];
    $IsExist = ValueIsThere("User Type.txt",$Name,1);
    if($IsExist) die("User Type Name already exists!!");
    $String = Getfeatures();
    if($String == "") die("You must choose his features");
    $Id = GetLastId("User Type.txt") + 1;
    FileAdd("User Type.txt",$Id.'~'.$Name."~\r\n");
    FileAdd("User Type Menu.txt",$Id.'~'.$String."\r\n");
}
if(isset($_POST["Update"]))
{
    if(isset($_POST["Id"]) == "") die("Id is unset!!");
    $Id = $_POST["Id"];
    if($Id == "1") die("You cannot change the Admin");
    $Name = $_POST["Name"];
    $String = Getfeatures();
    if($Name!= "")
    {
        $IsExist = ValueIsThere("User Type.txt",$Id,0);
        FileUpdate("User Type.txt",$IsExist,$Id."~".$Name."~\r\n");
    }
    if($String != "")
    {
        $IsExist = ValueIsThere("User Type Menu.txt",$Id,0);
        FileUpdate("User Type Menu.txt",$IsExist,$Id."~".$String."~\r\n");
    }
}
if(isset($_POST["Search"])){
    $Name = $_POST["Name"];
    $Id = $_POST["Id"];
    $List = [];
    $x = ["Id","Name","Product","Order","User"];
    array_push($List,$x);
    if($Id != "")
    {
        $IsExist = ValueIsThere("User Type.txt",$Id, 0);
        $Array = explode('~', $IsExist);
        array_pop($Array);
        $IsExist = ValueIsThere("User Type Menu.txt", $Id, 0);
        $temp = explode('~',$IsExist);
        for ($i = 1; $i < count($temp); $i++)
        {
            array_push($Array,$temp[$i]);
        }
        array_push($List,$Array);
    }
    else
    {
        if($Name != "")
        {
            $IsExist = ValueIsThere("User Type.txt",$Name, 1);
            $Array = explode('~', $IsExist);
            array_pop($Array);
            $IsExist = ValueIsThere("User Type Menu.txt", $Array[0], 0);
            $temp = explode('~',$IsExist);
            for ($i = 1; $i < count($temp); $i++)
            {
                array_push($Array,$temp[$i]);
            }
            array_push($List,$Array);
        }
        else
        {
            $Temp = [];
            $x = ["Id","Name","Product","Order","User"];
            array_push($Temp,$x);
            $Array = GetAllContent("User Type.txt");
            for ($i = 0; $i < count($Array);$i++)
            {
                $Line = explode('~',$Array[$i]);
                array_pop($Line);
                array_push($Temp,$Line);
                $IsExist = ValueIsThere("User Type Menu.txt", $Line[0], 0);
                $temp = explode('~',$IsExist);
                for ($j = 1; $j < count($temp); $j++)
                {
                    array_push($Temp[$i + 1],$temp[$j]);
                }
            }
            DisplayTable($Temp,5);
            exit;
        }
    }
    DisplayTable($List,5);
}
if(isset($_POST["Delete"]))
{
    if(isset($_POST["Id"]) == "") die("Id is unset!!");
    if($_POST["Id"] == "1") die("You cannot Delete the Admin");
    if($_POST["Id"] == "3") die("You cannot Delete the Clint");
    if($IsExist = ValueIsThere("User Type.txt", $_POST["Id"], 0))
    {
        $Array = explode('~',$IsExist);
        $Id =$Array[0];
        FileDelete("User Type.txt",$IsExist);
        $IsExist = ValueIsThere("User Type Menu.txt",$Id, 0);
        FileDelete("User Type Menu.txt",$IsExist);
        while($IsExist = ValueIsThere("User.txt",$Id,1))
        {
            FileDelete("User.txt",$IsExist);
        }
    }
}

