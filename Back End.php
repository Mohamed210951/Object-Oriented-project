<?php
function GetLastId(string $fileName) {
	$File = fopen("Files/".$fileName, 'r');
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
	$File = fopen("Files/".$FileName, 'r');
	while($Line = fgets($File))	{
		$Array = explode('~',$Line);
		if($Array[0] == $Value) return 1;
	}
	return 0;
}
function UserNameIsThere(string $FileName,string $Value){
	$File = fopen("Files/".$FileName, 'r');
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
	$File = fopen("Files/".$FileName, 'r');
	$List = [];
	while ($Line = fgets($File)) {
		array_push($List, $Line);
	}
	return $List;
}
function FileAdd(string $FileName,string $Line){
	$File = fopen("Files/".$FileName,'a');
	fwrite($File,$Line);
}
function FileWrite(string $FileName,string $Line){
	$File = fopen("Files/".$FileName,'w');
	fwrite($File,$Line);
}
function Login(string $UserName,string $Password){
	if($Array = UserNameIsThere("User.txt",$UserName))
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
function FromTypeGetServis(string $Type)
{
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
function SignIn(string $UserName,string $Password,string $Type){
	$newUser = new User(GetLastId("User.txt") + 1,$Type,$UserName,$Password);
	if($newUser->AllIsSet()) {
		if(!UserNameIsThere("User.txt",$newUser->getName())) {
			FileAdd("User.txt",$newUser->ToString());
			FileWrite("UserNow.txt",$newUser->getType());
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
class Person{
    protected int $Id;
    protected string $Name;
	/**
	 * 
	 * @return int
	 */
	function getId(): int {
		return $this->Id;
	}
	/**
	 * 
	 * @param int $Id 
	 * @return Person
	 */
	function setId(int $Id): self {
		$this->Id = $Id;
		return $this;
	}
	/**
	 * 
	 * @return string
	 */
	function getName(): string {
		return $this->Name;
	}
	/**
	 * 
	 * @param string $Name 
	 * @return Person
	 */
	function setName(string $Name): int {
		if(str_contains($Name,'~')) return 0;
		$this->Name = $Name;
		return 1;
	}
}
class User extends Person{
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
	/**
	 * 
	 * @return mixed
	 */
	function getPassword() {
		return $this->Password;
	}
	/**
	 * 
	 * @param mixed $Password 
	 */
	function setPassword($Password) {
		if(str_contains($Password,'~')) return 0;
		$this->Password = $Password;
		return 1;
	}
	/**
	 * 
	 * @return mixed
	 */
	function getType() {
		return $this->Type;
	}
	/**
	 * 
	 * @param mixed $Type 
	 */
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
}
class Product extends Person{
	private float $Cost;
	
	/**
	 * 
	 * @return float
	 */
	function getCost(): float {
		return $this->Cost;
	}
	
	/**
	 * 
	 * @param float $Cost 
	 * @return Product
	 */
	function setCost(float $Cost): self {
		$this->Cost = $Cost;
		return $this;
	}
	/**
	 * @param $Cost float 
	 */
	
	function __construct(int $Id = null,string $Name = null,float $Cost = null) {
		if($Id!=null)
		{
			$this->setId($Id);
			$this->setName($Name);
			$this->setCost($Cost);
		}
	}
	public function ToString()
	{
		$String = $this->Id + "~" + $this->Name + "~" + $this->Price + "~";
		return $String;
	}
}