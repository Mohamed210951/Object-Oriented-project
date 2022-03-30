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
            <label for="Product Id">Product Id</label>
            <input type="number" name="ProductId" step = ".001">
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
            <input type="submit" value="See Order Details" name = "ViewOrderDetails">
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

if(isset($_POST["Logout"]))
{
    session_destroy();
    header("Location:Login.php");
}