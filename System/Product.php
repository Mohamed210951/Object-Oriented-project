<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>
    <h1>Product Menu</h1>
    <?php 
    include_once "Back End.php";
        $Array = GetAllContent("UserNow.txt");
        $Type = $Array[0];
        $Servis = FromTypeGetServis($Type);
    ?>
    <form action="#" method="post">
        <div class = "row">
            <label for="Product Id">Product Id</label>
            <input type="number" name="Id" step = ".001">
        </div>
        <br>
        <div class = "row">
            <label for="Product Name">Product Name</label>
            <input type="text" name="ProductName">
        </div>
        <br>
        <div class = "row">
            <label for="Product Price">Product Price</label>
            <input type="number" name="ProductPrice" step = ".001">
        </div>
        <br>
        <div class = "row">
            <input type="submit" value="Add" name = "Add" <?php if(in_array("Product-Searsh",$Servis)) echo "hidden";?>>
            <input type="submit" value="Update" name = "Update"<?php if(in_array("Product-Searsh",$Servis)) echo "hidden";?>>
            <input type="submit" value="Search" name = "Search"<?php if(!in_array("Product-Searsh",$Servis) && !in_array("Product",$Servis)) echo "hidden";?>>
            <input type="submit" value="Delete" name = "Delete"<?php if(in_array("Product-Searsh",$Servis)) echo "hidden";?>>
        </div>
    </form>
</body>
</html>

<?php
include_once "Back End.php";
include_once "../Classes/ProductClass.php";
if(isset($_POST["Add"]))
{
    if($_POST["ProductName"] == "") exit("Product Name unset!!");
    if($_POST["ProductPrice"] == "") exit("Product Price unset!!");
    $New_Product = new Product();
    $New_Product->setName($_POST["ProductName"]);
    $New_Product->setCost($_POST["ProductPrice"]);
    $New_Product->Add();
}
else if(isset($_POST["Update"]))
{
    if($_POST["Id"] == "") exit("Product Id unset!!");
    $Product = new Product();
    $Product->SetId($_POST["Id"]);
    $Product->setName($_POST["ProductName"]);
    $Product->setCost(floatval($_POST["ProductPrice"]));
    $Product->Update();
}
else if(isset($_POST["Search"]))
{
    $Product = new Product();
    $Product->SetId(intval($_POST["Id"]));
    $Product->setName($_POST["ProductName"]);
    $Product->setCost(floatval($_POST["ProductPrice"]));
    $Product->Searsh();
}
else if(isset($_POST["Delete"]))
{
    $Product = new Product();
    $Product->SetId(intval($_POST["Id"]));
    $Product->Delete();
}