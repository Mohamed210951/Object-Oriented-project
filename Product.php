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
            <input type="number" name="Id">
        </div>
        <br>
        <div class = "row">
            <label for="Product Name">Product Name</label>
            <input type="text" name="ProductName">
        </div>
        <br>
        <div class = "row">
            <label for="Product Price">Product Price</label>
            <input type="number" name="ProductPrice">
        </div>
        <br>
        <div class = "row">
            <input type="button" value="Add" name = "Add" <?php if(in_array("Product-Searsh",$Servis)) echo "hidden";?>>
            <input type="button" value="Update" name = "Update"<?php if(in_array("Product-Searsh",$Servis)) echo "hidden";?>>
            <input type="button" value="Search" name = "Search"<?php if(!in_array("Product-Searsh",$Servis)) echo "hidden";?>>
            <input type="button" value="Delete" name = "Delete"<?php if(in_array("Product-Searsh",$Servis)) echo "hidden";?>>
        </div>
    </form>
</body>
</html>

<?php
if(isset($_POST["Add"]))
{
    $google =$_POST["ProductName"];
    echo $google;
}
else if(isset($_POST["Update"]))
{

}
else if(isset($_POST["Search"]))
{

}
else if(isset($_POST["Delete"]))
{
    
}