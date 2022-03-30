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
	function Get_Info_Of_Product($ID_Nom)
	{
	$isexist =ValueIsthere("product.txt",$ID_Nom,0);
	if($isexist)
	{
		$product=product::FromStringToObject($ID_Nom);
		return $product;
	}
    return null;


	}
	static function FromStringToObject($string)
	{
       $Array_Of_String=explode("~",$string);
	   $product=new Product(intval($Array_Of_String[0]),floatval($Array_Of_String[1]),$Array_Of_String[2]);
	   return $product;
	}
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
	function Searsh($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		
		$list=[];
		$array_of_lines=GetAllContent("../Files/"."Product.txt");
		if($this->getCost()==0&&$this->getName()==""&&$this->getId()==0)
		{
		 for($i=0;$i<count($array_of_lines);$i++)
		  {
		   $convert=explode("~",$array_of_lines[$i]);
		   array_push($list,$convert);
		  }
		}
		if($this->getId()!=0)
		{
			for($i=0;$i<count($array_of_lines);$i++)
			 {
			 $isexist=ValueIsThere("Product.txt",$this->Id,0);
			 $array=explode("~",$isexist);
			 array_push($list,$array);
			 }
		}
		else if($this->getName()!="")
		{
		 for($i=0;$i<count($array_of_lines);$i++)
	   	    {
				$array=explode("~",$array_of_lines[$i]);
				if(str_contains($array[2],$this->Name))
				{
				array_push($list,$array);
				}
			}
		}
		else if($this->getCost()!=0)
		{
			for($i=0;$i<count($array_of_lines);$i++)
	   		{
				$array=explode("~",$array_of_lines[$i]);
				if(floatval($array[1])==$this->Cost)
				{
					array_push($list,$array);
				}
			}
		}
		DisplayTable($list);	
	}
	function Delete($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		if($this->getId()!=0)
		{
            $isexist=ValueIsThere("Product.txt",$this->getId(),0);
		    FileDelete("Product.txt", $isexist);
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
}