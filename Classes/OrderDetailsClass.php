<?php
include_once "../System/Back End.php";
include_once "PersonClass.php";
include_once "ProductClass.php";

/*
    Product m4 hatb2a array hya oe number oe prices

    5od balk mn Order Id 
*/

class Order_Details extends Person implements File
{

    private ?int  $Product_Id;
    private ?int $Numbers;
    private ?float $Prices;
    private ?int $OrderId;
    /**
     * @param int $input1 ProductId
     * @param int $input2 Number Of Product
     * @return mixed
     */
    function Add($input1 = null, $input2 = null, $input3 = null, $input4 = null)
    {
        $Last_Id_In_file = GetLastId("Order Details.txt");
        $Order_Details_Id = $this->setId($Last_Id_In_file + 1);
        $Product = new Product();
        $Product = $Product->Get_Info_Of_Product($ProductId);
        $Total = ($Product->getCost() * $NumberOfProduct);
        FileAdd("Order Details.txt", $OrderId . "~" . $Product->getId() . "~" . $NumberOfProduct . "~" . $Total . "~\r\n");
    }


    public function ToString()
    {
        $String = "";
        $String .= $this->OrderId . '~' . $this->Product_Id . '~' . $this->Numbers . '~' . $this->Prices . "~\r\n";
        return string;
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
    function Update($input1 = null, $input2 = null, $input3 = null, $input4 = null)
    {
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
    function Searsh($input1 = null, $input2 = null, $input3 = null, $input4 = null)
    {
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
    function Delete($input1 = null, $input2 = null, $input3 = null, $input4 = null)
    {
        if ($this->getId() < 0) {
            return 0;
        }
        if (ValueIsThere("Order Details.txt", $this->getId(), 0)) {
            $h = ValueIsThere("Order Details.txt", $this->getId(), 0);
            FileDelete("Order Details.txt", $h);
        }
    }
    /**
     * 
     * @return ?int
     */
    function getOrderId(): ?int
    {
        return $this->OrderId;
    }

    /**
     * 
     * @param ?int $OrderId 
     * @return Order_Details
     */
    function setOrderId(?int $OrderId): int
    {
        if ($OrderId > 0) {
            $this->OrderId = $OrderId;
            return 1;
        }
        return 0;
    }
    /**
     * 
     * @return ?int
     */
    function getProduct_Id(): ?int
    {
        return $this->Product_Id;
    }

    /**
     * 
     * @param ?int $Product_Id 
     * @return Order_Details
     */
    function setProduct_Id(?int $Product_Id): int
    {
        if ($Product_Id > 0) {
            $this->Product_Id = $Product_Id;
            return 1;
        }
        return 0;
    }
    /**
     * 
     * @return ?int
     */
    function getNumbers(): ?int
    {
        return $this->Numbers;
    }

    /**
     * 
     * @param ?int $Numbers 
     * @return Order_Details
     */
    function setNumbers(?int $Numbers): int
    {
        if ($Numbers > 0) {
            $this->Numbers = $Numbers;
            return 1;
        }
        return 0;
    }
    /**
     * 
     * @return ?float
     */
    function getPrices(): ?float
    {
        return $this->Prices;
    }

    /**
     * 
     * @param ?float $Prices 
     * @return Order_Details
     */
    function setPrices(?float $Prices): int
    {
        if($Prices>0)
        {
          $this->Prices = $Prices;
          return 1;
        }
        return 0;
    }
}
// order_id~product_id[0]~number[0]~price[0]~\r\n   -> 2esmaha to string
// lazem kolohom yeb2o mesh f null b function 2esmaha All is set 
