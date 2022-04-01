<?php

include_once "../System/Back End.php";
include_once "PersonClass.php";
class User extends Person implements File {
	private $Password;
	private $TypeId;
	public function __construct(int $Id = null,string $TypeId = null, string $Name = null, string $Password = null) {
		if($Id != null) {
			$this->setId($Id);
			$this->setName($Name);
			$this->setPassword($Password);
			$this->setType($TypeId);
		}
	}
	public function AllIsSet(): int {
		if(is_null($this->Id)) return 0;
		if(is_null($this->Name)) return 0;
		if(is_null($this->Password)) return 0;
		if(is_null($this->TypeId)) return 0;
		return 1;
	}
	public function ToString(): string {
		$Line = $this->Id . '~' . $this->TypeId . '~' . $this->Name . '~' . sha1($this->Password) . "~\r\n";
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
		return $this->TypeId;
	}
	function setType($Type) {
		$List = GetAllContent("User Type.txt");
		$flag = 0;
		for ($i=0; $i < count($List); $i++) { 
			$Array = explode('~',$List[$i]);
			if($Array[0] == $Type) $flag = 1;
		}
		if($flag == 0) return 0;
		$this->TypeId = $Type;
		return 1;
	}
	function Login() {
		if($Line = ValueIsThere("User.txt",$this->Name,2))
		{
			$Array = explode('~',$Line);
			if($Array[3] == sha1($this->Password))
			{
				$this->TypeId = $Array[1];
				session_start();
    			$_SESSION["UserId"] = $Array[0];
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
	function Add($input1 = null, $input2 = null, $input3 = null, $input4 = null) {
		if($this->AllIsSet()) {
			if(!ValueIsThere("User.txt",$this->Name,2)) {
				FileAdd("User.txt",$this->ToString());
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
<<<<<<< HEAD
	/**
	 * 
	 * @return mixed
	 */
	function getDateOfBirth() {
		return $this->DateOfBirth;
	}
	
	/**
	 * 
	 * @param mixed $DateOfBirth 
	 * @return User
	 */
	function setDateOfBirth($DateOfBirth): int {
		$this->DateOfBirth = $DateOfBirth;
		return 1;
	}
}

=======
}
>>>>>>> parent of 29c7375 (Merge branch 'main' of https://github.com/Mohamed210951/Object-Oriented-project)
