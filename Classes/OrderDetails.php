<?php
include_once "../System/Back End.php";
include_once "PersonClass.php";
include_once "ProductClass.php";
class Order_Details extends Person implements File 
{
private? array $Products;
private? array $Numbers;
private? array $Prices;

private? int $OrderId;
/**
*
* @param int $input1 ProductId
* @param int $input2 Number Of Product
* @return mixed
*/
function Add($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
    if($this->Numbers==null)
    {
        return 0;
    }
    $Last_Id_In_file = GetLastId("Order Details.txt");
    $Order_Details_Id=$this->setId($Last_Id_In_file+1);
    $Product = new Product();
    $Product->Get_Info_Of_Product($input1);
    $NumberOfProduct = $input2;
    array_push($this->Products,$Product->getId());
    array_push($this->Numbers,$NumberOfProduct);
    $Product_Pricess= array_push($this->Prices,($Product->getCost() * $NumberOfProduct ));
    $file=fopen("Order Details.txt","a");

    fwrite($file,$Order_Details_Id."~".$input1."~".$NumberOfProduct."~".$Product_Pricess."~"."~\r\n");


}

    public function ToString()
    {
        $String = "";
        for ($i=0; $i < count($this->Products); $i++) { 
            $String .= $this->OrderId . '~' . $this->Products[$i] . '~' . $this->Numbers[$i] . '~' . $this->Prices[$i]."~\r\n";
        }
    }
    /**
    *
    * @param mixed $input1
    * @param mixed $input2
    * @param mixed $input3
    * @param mixed $input4
    *
    * @return mixed
    */
    function Update($input1 = null, $input2 = null, $input3 = null, $input4 = null) {

    }

    /**
    *
    * @param mixed $input1
    * @param mixed $input2
    * @param mixed $input3
    * @param mixed $input4
    *
    * @return mixed
    */
    function Searsh($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
        
    }

    /**
    *
    * @param mixed $input1
    * @param mixed $input2
    * @param mixed $input3
    * @param mixed $input4
    *
    * @return mixed
    */
    function Delete($input1 = null, $input2 = null, $input3 = null, $input4 = null) {

    }
}
// order_id~product_id[0]~number[0]~price[0]~\r\n   -> 2esmaha to string
// lazem kolohom yeb2o mesh f null b function 2esmaha All is set 
