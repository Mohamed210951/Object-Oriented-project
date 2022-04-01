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

    private ?array $Products = [];
    private ?array $Numbers = [];
    private ?array $Prices = [];
    private ?int $OrderId;
    /**
     * @param int $input1 ProductId
     * @param int $input2 Number Of Product
     * @return mixed
     */
    function Add($input1 = null, $input2 = null, $input3 = null, $input4 = null)
    {
        if ($input2 < 0) {
            return 0;
        }
        $NumberOfProduct = $input2;
        if (!ValueIsThere("Product.txt", $input1, 0)) {
            return 0;
        }
        $ProductId = $input1;
        $Last_Id_In_file = GetLastId("Order Details.txt");
        $Order_Details_Id = $this->setId($Last_Id_In_file + 1);
        $Product = new Product();
        $Product = $Product->Get_Info_Of_Product($ProductId);
        $Total = ($Product->getCost() * $NumberOfProduct);
        array_push($this->Products, $Product->getId());
        array_push($this->Numbers, $NumberOfProduct);
        array_push($this->Prices, $Total);
        FileAdd("Order Details.txt", $Order_Details_Id . "~" . $Product->getId() . "~" . $NumberOfProduct . "~" . $Total . "~\r\n");
    }


    public function ToString()
    {
        $String = "";
        for ($i = 0; $i < count($this->Products); $i++) {
            $String .= $this->OrderId . '~' . $this->Products[$i] . '~' . $this->Numbers[$i] . '~' . $this->Prices[$i] . "~\r\n";
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
    function setOrderId(?int $OrderId): self
    {
        $this->OrderId = $OrderId;
        return $this;
    }
}
// order_id~product_id[0]~number[0]~price[0]~\r\n   -> 2esmaha to string
// lazem kolohom yeb2o mesh f null b function 2esmaha All is set 
