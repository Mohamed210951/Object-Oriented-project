<?php
function GetLastId(string $fileName) {
	$File = fopen("../Files/".$fileName, 'r');
	$max = 0;
	while($Line = fgets($File))	{
		$Array = explode('~',$Line);
		$Id = intval($Array[0]);
		if($Id > $max) {
			$max = $Id;
		}
	}
	return $max;
}
function IdIsThere(string $FileName, int $Value){
	$File = fopen("../Files/".$FileName, 'r');
	while($Line = fgets($File))	{
		$Array = explode('~',$Line);
		if($Array[0] == $Value) return 1;
	}
	return 0;
}
function UserNameIsThere(string $FileName,string $Value){
	$File = fopen("../Files/".$FileName, 'r');
	while($Line = fgets($File))	{
		$Array = explode('~',$Line);
		if($Array[2] == $Value) 
		{
			return $Array;
		}
	}
	return null;
}
function GetAllContent(string $FileName){
	$File = fopen("../Files/".$FileName, 'r');
	$List = [];
	while ($Line = fgets($File)) {
		array_push($List, $Line);
	}
	return $List;
}
function FileAdd(string $FileName,string $Line){
	$File = fopen("../Files/".$FileName,'a');
	fwrite($File,$Line);
}
function FileWrite(string $FileName,string $Line){
	$File = fopen("../Files/".$FileName,'w');
	fwrite($File,$Line);
}
function FileUpdate(string $FileName, string $Old, string $New){
	$contents = file_get_contents("../Files/".$FileName);
    $contents = str_replace($Old, $New, $contents);
    file_put_contents("../Files/".$FileName, $contents);
}
function FileDelete(string $FileName, string $Data){
	$contents = file_get_contents("../Files/".$FileName);
    $contents = str_replace($Data, "", $contents);
    file_put_contents("../Files/".$FileName, $contents);
}

function Login(string $FileName,string $UserName,string $Password) {
	if($Array = UserNameIsThere($FileName,$UserName))
    {
        if($Array[3] == $Password)
        {
            $Type = $Array[1];
            FileWrite("UserNow.txt",$Type);
            header("Location:MainMenu.php");
        }
        else
        {
            echo "Wrong UserName or Password!!";
        }
    }
    else
    {
        echo "Wrong UserName or Password!!";
    }
}
function FromTypeGetServis(string $Type) {
	$List = GetAllContent("User Type.txt");
	$IdType = "-1";
	for ($i=0; $i < count($List); $i++) { 
		$array = explode('~',$List[$i]);
		if($array[1] == $Type) $IdType = $array[0];
	}
	$Servis = [];
	$List = GetAllContent("User Type Menu.txt");
	for ($i=0; $i < count($List); $i++) { 
		$array = explode('~',$List[$i]);
		if($array[0] == $IdType)
		{
			for ($j=1; $j < count($array); $j++) { 
				array_push($Servis,$array[$j]);
			}
		}
	}
	return $Servis;
}
function SignUp(string $UserName,string $Password,string $Type){
	$newUser = new User(GetLastId("User.txt") + 1,$Type,$UserName,$Password);
	$newUser->Add();
}
function Encrypt($Word, $Key) {
    $Result = "";
    for ($i = 0; $i < strlen($Word); $i++) {
        $c = chr(ord($Word[$i]) + $Key + $i);
        $Result .= $c;
    }
    return $Result;
}
function Decrypt($Word, $Key) {
    $Result = "";
    for ($i = 0; $i < strlen($Word); $i++) {
        $c = chr(ord($Word[$i]) - $Key - $i);
        $Result .= $c;
    }
    return $Result;
}
class Person {
    protected ?int $Id;
    protected ?string $Name;
	function getId(): int {
		return $this->Id;
	}
	function setId(?int $Id): int {
		if($Id <= 0) return 0;
		$this->Id = $Id;
		return 1;
	}
	function getName(): string {
		return $this->Name;
	}
	function setName(?string $Name): int {
		if(str_contains($Name,'~')) return 0;
		$this->Name = $Name;
		return 1;
	}
}
interface File {
	public function Add($input1 = null,$input2 = null,$input3 = null,$input4 = null);
	public function Update($input1 = null,$input2 = null,$input3 = null,$input4 = null);
	public function Searsh($input1 = null,$input2 = null,$input3 = null,$input4 = null);
	public function Delete($input1 = null,$input2 = null,$input3 = null,$input4 = null);
}
class User extends Person implements File {
	private $Password;
	private $Type;
	public function __construct(int $Id = null,string $Type = null, string $Name = null, string $Password = null) {
		if($Id != null) {
			$this->setId($Id);
			$this->setName($Name);
			$this->setPassword($Password);
			$this->setType($Type);
		}
	}
	public function AllIsSet(): int {
		if(is_null($this->Id)) return 0;
		if(is_null($this->Name)) return 0;
		if(is_null($this->Password)) return 0;
		if(is_null($this->Type)) return 0;
		return 1;
	}
	public function ToString(): string {
		$Line = $this->Id . '~' . $this->Type . '~' . $this->Name . '~' . $this->Password . "~\r\n";
		return $Line;
	}
	public static function StringToUser(string $Line){
		$Array = explode('~',$Line);
		$user = new User(intval($Array[0]),$Array[1],$Array[2],$Array[3]);
		return $user;
	}
	function getPassword() {
		return $this->Password;
	}
	function setPassword($Password) {
		if(str_contains($Password,'~')) return 0;
		$this->Password = $Password;
		return 1;
	}
	function getType() {
		return $this->Type;
	}
	function setType($Type) {
		$List = GetAllContent("User Type.txt");
		$flag = 0;
		for ($i=0; $i < count($List); $i++) { 
			$Array = explode('~',$List[$i]);
			if($Array[1] == $Type) $flag = 1;
		}
		if($flag == 0) return 0;
		$this->Type = $Type;
		return 1;
	}
	function Add($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		if($this->AllIsSet()) {
			if(!UserNameIsThere("User.txt",$this->Name)) {
				FileAdd("User.txt",$this->ToString());
				FileWrite("UserNow.txt",$this->Type);
				header("Location:MainMenu.php");
			}
			else {
				echo "This UserName is alrady exists!!";
			}
		}
		else {
			echo "Please Try again but prevent using '~'!!";
		}
	}
	
	/**
	 * 
	 * @param string $input1 Note1
	 * @param float $input2 Note2
	 */
	function Update($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		// Code
	}
	function Searsh($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		// Code
	}
	function Delete($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		// Code
	}
}
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
    	$isexist= UserNameIsThere("Product.txt",$this->Name);
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
	private float $Total;
	private int $ClientId;
	private string $date;
	public function AllIsSet() {
		if($this->Id == null) return 0;
		if($this->Name == null) return 0;
		if($this->Total == null) return 0;
		if($this->ClientId == null) return 0;
		if($this->Date == null) return 0;
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
	function Add($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
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
	 * @return string
	 */
	function getDate(): string {
		return $this->date;
	}
	
	/**
	 * 
	 * @param string $date 
	 * @return order
	 */
	function setDate(string $date): self {
		$this->date = $date;
		return $this;
	}
	/**
	 * 
	 * @return float
	 */
	function getTotal(): float {
		return $this->total;
	}
	
	/**
	 * 
	 * @param float $total 
	 * @return order
	 */
	function setTotal(float $total): self {
		$this->total = $total;
		return $this;
	}
	/**
	 * 
	 * @return int
	 */
	function getClientId(): int {
		return $this->ClientId;
	}
	
	/**
	 * 
	 * @param int $ClientId 
	 * @return order
	 */
	function setClientId(int $ClientId): self {
		$this->ClientId = $ClientId;
		return $this;
	}
	/**
	 * 
	 * @return string
	 */

}
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

}