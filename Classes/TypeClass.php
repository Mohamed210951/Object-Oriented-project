<?php
include_once "PersonClass.php";
include_once "../System/Back End.php";
class Type extends Person implements File
{
    private $Product;
    private $Order;
    private $User;
    public function __construct($Id = null,$Name = null,$Product=null,$Order=null,$User=null) {
        if($Id!=null) $this->setId($Id);
        else $this->Id = 0;
        if($Name!=null) $this->setName($Name);
        else $this->Name = "";
        if($Product!=null) $this->setProduct($Product);
        else $this->Product = "Product-Non";
        if($Order!=null) $this->setOrder($Order);
        else $this->Order = "Order-Non";
        if($User!=null) $this->setUser($User);
        else $this->User = "User-Non";
    }
	/**
	 * 
	 * @return mixed
	 */
	function getProduct() {
		return $this->Product;
	}
	
	/**
	 * 
	 * @param mixed $Product 
	 * @return Type
	 */
	function setProduct($Product): self {
		$this->Product = "Product-".$Product;
		return $this;
	}
	/**
	 * 
	 * @return mixed
	 */
	function getOrder() {
		return $this->Order;
	}
	
	/**
	 * 
	 * @param mixed $Order 
	 * @return Type
	 */
	function setOrder($Order): self {
		$this->Order = "Order-".$Order;
		return $this;
	}
	/**
	 * 
	 * @return mixed
	 */
	function getUser() {
		return $this->User;
	}
	
	/**
	 * 
	 * @param mixed $User 
	 * @return Type
	 */
	function setUser($User): self {
		$this->User = "User-".$User;
		return $this;
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
	function Add($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
        $IsExist = ValueIsThere("User Type.txt",$this->Name,1);
        if($IsExist) die("User Type Name already exists!!");
        if($this->Product == "Product-Non"||$this->Order == "Order-Non"||$this->User == "User-Non")
            die("You must choose his features");
        $this->Id = GetLastId("User Type.txt") + 1;
        FileAdd("User Type.txt",$this->Id.'~'.$this->Name."~\r\n");
        FileAdd("User Type Menu.txt",$this->ToString());
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
        if($this->Id == "0") return;
        $OldType = Type::FromStringToObject(ValueIsThere("User Type Menu.txt",$this->Id,0));
        $OldType->setName(explode("~",ValueIsThere("User Type.txt",$this->Id,0))[1]);
        if($this->Name=="") $this->Name = $OldType->getName();
        FileUpdate("User Type Menu.txt",ValueIsThere("User Type Menu.txt",$this->Id,0),$this->ToString());
        FileUpdate("User Type.txt",ValueIsThere("User Type.txt",$this->Id,0),$this->Id."~".$this->Name."~\r\n");
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
    public function DisplayedString()
    {
        $String = $this->getId()."~".$this->getName()."~".$this->getProduct()."~".$this->getOrder()."~".$this->getUser()."~";
        return $String;
    }
	function Searsh($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
        $DisplayList = [];
        
        if($this->Name!="")
        {
            $List = ValueIsThere("User Type.txt",$this->Name,1);
            $Array = explode('~',$List);
            $Type = new Type($Array[0],$Array[1]);
            $List = ValueIsThere("User Type Menu.txt",$Type->getId(),0);
            $Array = explode('~',$List);
            $Type->setProduct($Array[1]);
            $Type->setOrder($Array[2]);
            $Type->setUser($Array[3]);
            $String = $Type->DisplayedString();
            array_push($DisplayList,$String);
        }
        else
        {
            $List = GetAllContent("User Type Menu.txt");
            for ($i=0; $i < count($List); $i++) { 
                $Type = Type::FromStringToObject($List[$i]);
                if($this->Id!="0")
                {
                    if($this->Id != $Type->getId())
                    {
                        array_splice($List,$i,1);
                        $i--;
                    }
                }
                if($this->Product!="Product-Non")
                {
                    if($this->Product != $Type->getProduct())
                    {
                        array_splice($List,$i,1);
                        $i--;
                    }
                }
                if($this->Order!="Order-Non")
                {
                    if($this->Order != $Type->getOrder())
                    {
                        array_splice($List,$i,1);
                        $i--;
                    }
                }
                if($this->User!="User-Non")
                {
                    if($this->User != $Type->getUser())
                    {
                        array_splice($List,$i,1);
                        $i--;
                    }
                }
            }
            for ($i=0; $i < count($List); $i++) { 
                $Type = Type::FromStringToObject($List[$i]);
                $Line = ValueIsThere("User Type.txt",$Type->getId(),0);
                $Array = explode('~',$Line);
                $Type->setName($Array[1]);
                array_push($DisplayList,$Type->DisplayedString());
            }

        }
        $Temp = ["Type Id","Name","Product Mode","Order Mode","User Mode"];
        $Display = [];
        array_push($Display,$Temp);
        for ($i=0; $i < count($DisplayList); $i++) {
            $Array = explode("~",$DisplayList[$i]);
            array_push($Display,$Array);
        }

        return $Display;
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
        if($this->Id == "0") return;
        if($this->Id == "1" || $this->Id == "3")
        {
            echo("Admin and CLint Cannot be updated");
            exit();
        }
        if($IsExist = ValueIsThere("User Type.txt", $this->Id, 0))
        {
            $Array = explode('~',$IsExist);
            $Id =$Array[0];
            FileDelete("User Type.txt",$IsExist);
            $IsExist = ValueIsThere("User Type Menu.txt",$Id, 0);
            FileDelete("User Type Menu.txt",$IsExist);
            while($IsExist = ValueIsThere("User.txt",$Id,1))
            {
                FileDelete("User.txt",$IsExist);
            }
        }
	}
	/**
	 *
	 * @return mixed
	 */
	function ToString() {
        $String = $this->Id."~".$this->Product."~".$this->Order."~".$this->User."~\r\n";
        return $String;
	}
    static public function FromStringToObject(String $Line) {
        $Array = explode('~',$Line);
        $Product = explode('-',$Array[1])[1];
        $Type = new Type($Array[0],null,explode('-',$Array[1])[1],explode('-',$Array[2])[1],explode('-',$Array[3])[1]);
        return $Type;
    }
}