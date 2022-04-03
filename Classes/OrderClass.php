<?php
include_once "../System/Back End.php";
include_once "PersonClass.php";
include_once "OrderDetails.php";
class Product extends Person implements File {
	private ?float $Cost;
	function getCost(): float {
		return $this->Cost;
	}
	function setCost(?float $Cost): int {
		if($Cost < 0) return 0;
		$this->Cost = $Cost;
		return 1;
	}
	function __construct(int $Id = null,float $Cost = null,string $Name = null) {
		if($Id!=null)
		{
			$this->setId($Id);
			$this->setName($Name);
			$this->setCost($Cost);
		}
	}
	public function ToString() {
		$String = $this->Id . "~" . $this->Cost  . "~" . $this->Name . "~\r\n";
		return $String;	
	}
	public function AllIsSet() {
		if($this->Id == null) return 0;
		if($this->Name == null) return 0;
		if($this->Cost == null) return 0;
		return 1;
	}
	function Add($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		if($this->Name == null) return 0;
		if($this->Cost == null) return 0;
		$Last_Id_In_file = GetLastId("Product.txt");
    	$this->setId($Last_Id_In_file+1);
    	$isexist= ValueIsThere("Product.txt",$this->Name,2);
    	if($isexist==null) FileAdd("Product.txt",$this->ToString());
    	else {
			echo "the product is already exist";
			return 0;
		}
		return 1;
	}
	function Update($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		//Code
	}
	function Searsh($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		//Code
	}
	function Delete($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		//Code
	}
}
class Child extends Person implements File {
	
	private ?string $Password;
	private ?int $Age;
	function Add($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		// Code
	}
	function Update($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		//Code
	}
	function Searsh($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		//Code
	}
	function Delete($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		//Code
	}
	function getPassword(): string {
		return $this->Password;
	}
	function setPassword(?string $Password): int {
		if(str_contains($Password,'~')) return 0;
		$this->Password = $Password;
		return 1;
	}
	function getAge(): int {
		return $this->Age;
	}
	function setAge(?int $Age): int {
		if(str_contains($Age,'~')) return 0;
		$this->Age = $Age;
		return 1;
	}
	function __construct(int $Id = null, string $Name = null, string $Age = null,string $Password = null) {
		if(!$this->setId($Id)) $this->Id = null;
		if(!$this->setName($Name)) $this->Name = null;
		if(!$this->setPassword($Password))$this->Name = null;
		if(!$this->setAge($Age))$this->Name = null;
	}
	public function AllIsSet()
	{
		if(is_null($this->Id)) return 0;
		if(is_null($this->Name)) return 0;
		if(is_null($this->Age)) return 0;
		if(is_null($this->Password)) return 0;
		return 1;
	}
	public function ToString() {
		$String = $this->Id."~".$this->Name."~".$this->Age."~".$this->Password."~\r\n";
		return $String;
	}
}
class order extends Person implements File {
	private float $total;
	private int $ClientId;
	private string $date;
	public function AllIsSet() {
		if($this->Id==null) return 0;
		if($this->ClientId==null) return 0;
		return 1;
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
    public function ToString() {
		$String = $this->Id."~".$this->ClientId."~\r\n";
		return $String;
	}
	function Add($input1 = null, $input2 = null, $input3 = null, $input4 = null) {

        $LastId=GetLastId("Order.txt");
        $this->setId($LastId+1);
		if($this->AllIsSet())
        {
            $IsOrderExist=ValueIsThere("Order.txt",$this->Id,0);
            if($IsOrderExist==null)
            {
                FileAdd("Order.txt",$this->ToString());
            }
            else{
                echo"the order is exist";
                return 0;
            }
            return 1;
        }
        else{
            return 0;
        }
	}
    static function FromStringToObject($string)
	{
       $Array_Of_String=explode("~",$string);
	   $Order=new order(intval($Array_Of_String[0]),intval($Array_Of_String[1]));
	   return $Order;
	}
	
	function Update($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		$SearchId= $this->Id;
		$isexist=ValueIsThere("Order.txt",$SearchId,0);
		$Order=Order::FromStringToObject($isexist);
		if($this->getId()==0)
		{
			$this->Id=$Order->getId();
		}
		if($this->getClientId()=="")
		{
		   $this->ClientId=$Order->getClientId();
		}
		FileUpdate("Order.txt",$Order->ToString(),$this->ToString());
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
	 * @return string
	 */
	function getDate(): string {
		return $this->date;
	}
	
	function setDate(string $date): int  {
		if($date <= 0) return 0;
		$this->date = $date;
		return 1;
	}

	function getClientId(): int {
		return $this->ClientId;
	}
	

	function setClientId(int $ClientId): int  {
		if($ClientId <= 0) return 0;
		$this->ClientId = $ClientId;
		return 1;
	}

    function setProductId(int $ProductId): int  {
		if($ProductId <= 0) return 0;
		$this->ProductId = $ProductId;
		return 1;
	}
    function getProductId(): int {
		return $this->ProductId;
	}

	public static function StringToObject(string $String) {

	}


	/**
	 * 
	 * @return string
	 */

}