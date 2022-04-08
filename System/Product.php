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
    session_start();
    include_once "../Classes/UserClass.php";
    $Id = $_SESSION["UserId"];
    $Line = ValueIsThere("User.txt", $Id, 0);
    $User = User::StringToUser($Line);
    $Servis = FromTypeGetServis($User->getType());
    ?>
    <form action="#" method="post">
        <div class="row">
            <label for="Product Id">Product Id</label>
            <input type="number" name="Id" step=".001">
        </div>
        <br>
        <div class="row">
            <label for="Product Name">Product Name</label>
            <input type="text" name="ProductName">
        </div>
        <br>
        <div class="row">
            <label for="Product Price">Product Price</label>
            <input type="number" name="ProductPrice" step=".001">
        </div>
        <br>
        <div class="row">
            <?php if (in_array("Product-All", $Servis)) : ?>
                <input type="submit" value="Add" name="Add">
                <input type="submit" value="Update" name="Update">
                <input type="submit" value="Delete" name="Delete">
            <?php endif; ?>
            <input type="submit" value="Search" name="Search">
        </div>
    </form>

    <footer>
        <form action="#" method="post">
            <input type="submit" value="Main Menu" name="MainMenu">
            <input type="submit" value="Logout" name="Logout">
        </form>
    </footer>
</body>

</html>

<?php
include_once "Back End.php";
$Flag = 0;
include_once "../Classes/ProductClass.php";
if (isset($_POST["Add"])) {
    if ($_POST["ProductName"] == "") exit("Product Name required!!");
    if ($_POST["ProductPrice"] == "") exit("Product Price required!!");
    $New_Product = new Product();
    $New_Product->setName($_POST["ProductName"]);
    $New_Product->setCost($_POST["ProductPrice"]);
    $New_Product->Add();
} else if (isset($_POST["Update"])) {
    if ($_POST["Id"] == "") exit("Product Id required!!");
    $Product = new Product();
    $Product->SetId($_POST["Id"]);
    $Product->setName($_POST["ProductName"]);
    $Product->setCost(floatval($_POST["ProductPrice"]));
    $Product->Update();
} else if (isset($_POST["Search"])) {
    $Product = new Product();
    $Product->SetId(intval($_POST["Id"]));
    $Product->setName($_POST["ProductName"]);
    $Product->setCost(floatval($_POST["ProductPrice"]));
    $List = $Product->Searsh();
    if(in_array("Product-All", $Servis)) DisplayTable($List,2);
    else DisplayTable($List);
    $Flag = 1;
} else if (isset($_POST["Delete"])) {
    $Product = new Product();
    if($_POST["Id"] == "") exit("Id is required!!");
    $Product->SetId(intval($_POST["Id"]));
    $Product->Delete();
}

if (isset($_POST["Logout"])) {
    session_unset();
    session_destroy();
    header("Location:Login.php");
}

if(isset($_POST["MainMenu"]))
{
    header("Location:MainMenu.php");
}

if($Flag == 0)
{
    $Product = new Product();
    $Product->SetId(0);
    $Product->setName("");
    $Product->setCost(0);
    $List = $Product->Searsh();
    if(in_array("Product-All", $Servis)) DisplayTable($List,2);
    else DisplayTable($List);
}