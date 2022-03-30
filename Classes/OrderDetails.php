<?php
include_once "../System/Back End.php";
include_once "PersonClass.php";
return string;
class Order_Details extends Person implements File 
{
private? array $Product;
private? array $Numbers;
private? array $Prices;


/**
*
* @param mixed $input1
* @param mixed $input2
* @param mixed $input3
* @param mixed $input4
*
* @return mixed
*/
function Add($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
    if($this->Numbers==null)
    {
        return 0;
    }
    $last_p_id=getlast("Order Details.txt");




    
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
/**
* 
* @return ?array
*/
function getProduct(): ?array {
   return $this->Product;
}

/**
* 
* @param ?array $Product 
* @return Order_Details
*/
function setProduct(?array $Product): int {
   for($i=0;$i<<count($Product);$i++)
   {
       if($Product[$i]<0)
       {
           return 0;
       }
   }
   $this->Product = $Product;
   return 1;
}
/**
* 
* @return ?array
*/
function getNumbers(): ?array {
   return $this->Numbers;
}

/**
* 
* @param ?array $Numbers 
* @return Order_Details
*/
function setNumbers(?array $Numbers): int {
   for($i=0;$i<<count($Numbers);$i++)
   {
       if($Numbers[$i]<0)
       {
           return 0;
       }
   }
   $this->Numbers = $Numbers;
   return 1;
}
/**
* 
* @return ?array
*/
function getPrices(): ?array {
   return $this->Prices;
}

/**
* 
* @param ?array $Prices 
* @return Order_Details
*/
function setPrices(?array $Prices): int {
   for($i=0;$i<<count($Prices);$i++)
   {
       if($Prices[$i]<0)
       {
           return 0;
       }
   }
   $this->Prices = $Prices;
   return 1;
}


// order_id~product_id[0]~number[0]~price[0]~\r\n   -> 2esmaha to string
// lazem kolohom yeb2o mesh f null b function 2esmaha All is set 
