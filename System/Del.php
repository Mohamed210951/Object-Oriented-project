<?php 

$Id1 = $_GET["Id1"];
$Type = $_GET["Type"];
if($Type == "1")
{
    include_once "../Classes/UserClass.php";
    $User = new User();
    $User->setId(intval($Id1));
    $User->Delete();
    header("Location:User.php");
}
if($Type == "2")
{
    include_once "../Classes/ProductClass.php";
    $Product = new Product();
    $Product->setId(intval($Id1));
    $Product->Delete();
    header("Location:Product.php");
}
if($Type == "3")
{
    include_once "../Classes/OrderClass.php";
    $Order = new Order();
    $Order->setId(intval($Id1));
    $Order->Delete();
    header("Location:Order.php");
}
if($Type == "4")
{
    include_once "../Classes/OrderDetailsClass.php";
    $OrderDetails = new Order_Details();
    $OrderDetails->setOrderId(intval($Id1));
    $Id2 = $_GET["Id2"];
    $OrderDetails->SetId(intval($Id2));
    $OrderDetails->Delete();
    header("Location:OrderDetails.php?OrderId=$Id1");
}
if($Type == "5")
{
    include_once "Back End.php";
    if($IsExist = ValueIsThere("User Type.txt", $Id1, 0))
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
    header("Location:Type.php");
}