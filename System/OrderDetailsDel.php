<?php
include_once "../Classes/OrderDetailsClass.php";
$OrderDetails = new Order_Details();
$OrderDetails->setOrderId(intval($_GET["Id1"]));
$Id2 = $_GET["Id2"];
$OrderDetails->setProduct_Id(intval($_GET["Id2"]));
$OrderDetails->Delete();
echo(" <script> location.replace('OrderDetails.php?OrderId=$Id1'); </script>");