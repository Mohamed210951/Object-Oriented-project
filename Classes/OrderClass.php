<?php
include_once "../System/Back End.php";
include_once "PersonClass.php";
include_once "OrderDetailsClass.php";
class order extends Person implements File {
	private ?float $total = 0;
	private ?int $ClientId = 0;
	private ?string $date = "";
	public function AllIsSet() {
		if($this->Id==null) return 0;
		if($this->ClientId==0) return 0;
		if($this->date=="") return 0;
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
		$String = $this->Id."~".$this->ClientId."~".$this->date."~".$this->total."~\r\n";
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
				$this->total=0;
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
	   $Order=new order(intval($Array_Of_String[0]),intval($Array_Of_String[1]),($Array_Of_String[2]));
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
		if($this->getClientId()==0)
		{
		   $this->ClientId=$Order->getClientId();
		}
		if($this->getDate()=="")
		{
			$this->date=$Order->getDate();
		}
		if($this->gettotal()=="")
		{
			$this->total=$Order->getTotal();
		}
		FileUpdate("Order.txt",$Order->ToString(),$this->ToString());
	}
	function Searsh($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
     $ArrayOfLines=GetAllContent("Order.txt");
	 $ArrayOfOrders=[];
	 for($i=0;$i<count($ArrayOfLines);$i++)
	 {
		$Order=order::FromStringToObject($ArrayOfLines[$i]);
        array_push($ArrayOfOrders[$i],$Order);
	 }
	 for($i=0;$i<count($ArrayOfOrders);$i++)
	 {
		 if($ArrayOfOrders[$i]->getDate()!=$this->getDate())
		 {
			array_splice($ArrayOfOrders,$i,1);
			$i--;
		 }
		 if($ArrayOfOrders[$i]->getId()!=$this->getId())
		 {
			array_splice($ArrayOfOrders,$i,1);
			$i--;
		 }
		 if($ArrayOfOrders[$i]->getTotal()!=$this->getTotal())
		 {
			array_splice($ArrayOfOrders,$i,1);
			$i--;
		 }
		 if($ArrayOfOrders[$i]->getClientId()!=$this->getClientId())
		 {
			array_splice($ArrayOfOrders,$i,1);
			$i--;
		 }
	 }
	 return $ArrayOfOrders;
	}
	function Delete($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
     if($this->getId()!=0)
	 {
		$isexist=ValueIsThere("Order.txt",$this->getId(),0);
		FileDelete("Order.txt",$isexist);
	 }
	}
	
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

	function getTotal(): ?float {
		return $this->total;
	}
	
	function setTotal(?float $total): self {
		$this->total = $total;
		return $this;
	}
}