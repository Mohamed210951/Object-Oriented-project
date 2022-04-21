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
    echo(" <script> location.replace('User.php'); </script>");
}
if($Type == "2")
{
    include_once "../Classes/ProductClass.php";
    $Product = new Product();
    $Product->setId(intval($Id1));
    $Product->Delete();
    header("Location:Product.php");
    echo(" <script> location.replace('Product.php'); </script>");
}
if($Type == "3")
{
    include_once "../Classes/OrderClass.php";
    $Order = new Order();
    $Order->setId(intval($Id1));
    $Order->Delete();
    header("Location:Order.php");
    echo(" <script> location.replace('Order.php'); </script>");
}
if($Type == "4")
{
    include_once "../Classes/OrderDetailsClass.php";
    $OrderDetails = new Order_Details();
    $OrderDetails->setOrderId(intval($Id1));
    $Id2 = $_GET["Id2"];
    $OrderDetails->setProduct_Id(intval($Id2));
    $OrderDetails->Delete();
    echo(" <script> location.replace('OrderDetails.php?OrderId=$Id1'); </script>");
}
if($Type == "5")
{
    include_once "../Classes/TypeClass.php";
    $Type = new Type();
    $Type->setId($Id1);
    $Type->Delete();
    echo(" <script> location.replace('Type.php'); </script>");
}