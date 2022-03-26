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
            <input type="submit" value="Search" name = "Search"<?php if(!in_array("Product-Searsh",$Servis)) echo "hidden";?>>
            <input type="submit" value="Delete" name = "Delete"<?php if(in_array("Product-Searsh",$Servis)) echo "hidden";?>>
        </div>
    </form>
</body>
</html>

<?php
include_once "Back End.php";
if(isset($_POST["Add"]))
{
    $New_Product = new Product();
    $New_Product->setName($_POST["ProductName"]);
    $New_Product->setCost($_POST["ProductPrice"]);
    $Last_Id_In_file =GetLastId("Product.txt");
    $New_Product->setId($Last_Id_In_file+1);
    $isexist= UserNameIsThere("Product.txt",$New_Product->getName());
    if($isexist==null)
    {
    FileAdd("Product.txt",$New_Product->ToString());
    }
   else
    {
    echo "the product is already exist";
    }
}
else if(isset($_POST["Update"]))
{
   $Product_to_change = new Product();
   $Product_to_change->setName($_POST["ProductName"]);
   $isexist= UserNameIsThere("Product.txt",$Product_to_change->getName());
   if($isexist!=null)
   { 
   $Product_to_change->setCost($_POST["ProductPrice"]);
   }
}
else if(isset($_POST["Search"]))
{

}
else if(isset($_POST["Delete"]))
{
    
}
?>