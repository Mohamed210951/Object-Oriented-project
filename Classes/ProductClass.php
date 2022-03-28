<?php

include_once "../System/Back End.php";
include_once "PersonClass.php";

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
	static function FromStringToObject($string)
	{
       $Array_Of_String=explode("~",$string);
	   $product=new Product(intval($Array_Of_String[0]),floatval($Array_Of_String[1]),$Array_Of_String[2]);
	   return $product;
	}
	/*
	/
	/
	/
	/
	*/
	function Update($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		$Search_for_Id=$this->Id;
		$isexist=ValueIsThere("Product.txt",$Search_for_Id,0);
		$product=Product::FromStringToObject($isexist);
        if($this->getCost()==0)
		{
             $this->Cost=$product->getCost();
		}
		if($this->getName()=="")
		{
             $this->Name=$product->getName();
		}
		FileUpdate("Product.txt",$product->ToString(),$this->ToString());
	}
	function Search($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		//Code
	}
	function Delete($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		//Code
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
}