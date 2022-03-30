<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>

    <h1>Order Details</h1>
    <h2>    
            <?php session_start(); 
            echo "OrderId: " .$_SESSION["OrderId"];?>
    </h2>
    <form action="#" method="post">

    <div class = "row">
            <label for="Product Name">Product Name</label>
            <select name="ProductName">
                <?php  
                include_once "Back End.php";
                    $List = GetAllContent("Product.txt");
                    for ($i=0; $i < count($List); $i++) { 
                        $Line = explode('~',$List[$i]);
                        echo "<option>". $Line[2]."</option>";
                    }
                ?>
            </select>
        </div>
        <br>
        <div class = "row">
            <label for="Number Of Product">Number Of Product</label>
            <input type="number" name="NumberOfProduct" step = ".001">
        </div>
        <br>
        <div class = "row">
            <input type="submit" value="Add Item" name = "AddItem">
            <input type="submit" value="Delete Item" name = "DeleteItem">
            <input type="submit" value="Update Item" name = "UpdateItem">
            <input type="submit" value="Searsh For An iTem" name = "Searsh">
            <input type="submit" value="Print Order Invoice" name = "PrintOrderInvoice">
        </div>
    </form>

    <footer>
        <form action="#" method="post">
            <input type="submit" value="Logout" name="Logout">
        </form>
    </footer>
</body>
</html>

<?php
include_once "../Classes/OrderDetails.php";
if(isset($_POST["Logout"]))
{
    session_destroy();
    header("Location:Login.php");
}
if(isset($_POST["AddItem"]))
{
    $Product_Name = $_POST["ProductName"];
    $IsExist = ValueIsThere("Product.txt",$Product_Name,2);
    $Line = explode('~',$IsExist);
    $Product_Id=$Line[0];
    $Product_Number=$_POST["NumberOfProduct"];
    $Object_of_order_details=new  Order_Details();
    $Object_of_order_details->Add(intval($Product_Id),intval($Product_Number));


}