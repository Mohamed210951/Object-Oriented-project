<?php
include_once "../System/Back End.php";
include_once "PersonClass.php";
include_once "ProductClass.php";

/*
    Product m4 hatb2a array hya oe number oe prices

    5od balk mn Order Id 



    Lazm t3ml static function 

    GetOrderDetail($Id1,$Id2)
    $Id1 da hoa order Id;
    $Id2 da hoa Product Id;
    return Object feh OrderDetail mo3yn mn 2lfile!!!
    
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
        if($this->OrderId>0&&$this->Product_Id>0&&$this->Numbers>0)
        {
            $Last_Id_In_file = GetLastId("Order Details.txt");
            $Order_Details_Id = $this->setId($Last_Id_In_file + 1);
            $Product = new Product();
            $Product = $Product->Get_Info_Of_Product($this->Product_Id);
            $this->Prices = ($Product->getCost() * $this->Numbers);
            FileAdd("Order Details.txt", $this->ToString());
            return 1;
        }
        else
        {
            return 0;

        }
    }


    public function ToString()
    {
        $String = "";
        $String .= $this->OrderId . '~' . $this->Product_Id . '~' . $this->Numbers . '~' . $this->Prices . "~\r\n";
        return $String;
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
    static function FromStringToObject($Line)
    {
        $array=explode("~",$Line);
        $Order_Details= new Order_Details();
        $Order_Details->setOrderId(intval($array[0]));
        $Order_Details->setProduct_Id(intval($array[1]));
        $Order_Details->setNumbers(intval($array[2]));
        $Order_Details->setPrices(intval($array[3]));
        return $Order_Details;
    }
    function Searsh($input1 = null, $input2 = null, $input3 = null, $input4 = null)
    {
        $List=GetAllContent("Order Details.txt");
        for($i=0;$i< count($List);$i++)
        {
            $Order_Details=Order_Details::FromStringToObject($List[$i]) ;
            if($Order_Details->getOrderId()!=$this->OrderId)
            {
              array_splice($List,$i,1);
              $i--;
            }
        }
        

        // lesa fyh hena 7abet 2akwad ;

        // Tl3 product name ***M4*** product id



        $array=[];//       xxxxxxxxxx
        $temp=["Order Id","Product_Id","Number of Product","Price"];
        array_push($array,$temp);
        for($i=0;$i< count($List);$i++)
        {
            array_push($array,explode("~",$List[$i]));
        }
        return $array;
    }

    /**
     *
     * @param mixed $input1
     * @param mixed $input2
     * @param mixed $input3
     * @param mixed $input4
     * @return mixed
     */

     // 8lt m7tag t3dyl
    function Delete($input1 = null, $input2 = null, $input3 = null, $input4 = null)
    {
        if ($this->OrderId == 0) {
            return 0;
        }
        if (ValueIsThere("Order Details.txt", $this->Product_Id, 0)) {
            $h = ValueIsThere("Order Details.txt", $this->Product_Id, 0);
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
	/**
	 */
	function __construct() {
        $this->OrderId = 0;
        $this->Product_Id = 0;
        $this->Numbers = 0;
        $this->Prices = 0;
	}
}
// order_id~product_id[0]~number[0]~price[0]~\r\n   -> 2esmaha to string
// lazem kolohom yeb2o mesh f null b function 2esmaha All is set 
