<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Menu</title>
</head>
<body>
    <h1>Order Menu</h1>
    <form action="#" method="post">
        <div class = "row">
            <label for="Order Id">Order Id</label>
            <input type="number" name="OrderId" step = ".001">
        </div>
        <br>
        <div class = "row">
            <label for="Clint Id">Clint Id</label>
            <input type="number" name="ClintId" step = ".001">
        </div>
        <br>
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
        </div>
        <div class = "row">
            <input type="submit" value="Finish Order" name = "Finish">
            <input type="submit" value="Delete Order" name = "DeleteOrder">
            <input type="submit" value="Search for Order" name = "SearchForOrder">
            <input type="submit" value="View Order Details" name = "ViewOrderDetails">
        </div>
    </form>
</body>
</html>