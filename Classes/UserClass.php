<?php

include_once "FileMangerClass.php";
include_once "PersonClass.php";
class User extends Person implements File
{
	private $Password;
	private $TypeId;
	private $DateOfBirth;
	private $FileManger;
	public function __construct(int $Id = null, string $TypeId = null, string $Name = null, string $Password = null, string $DateOfBirth = null)
	{
		if ($Id != null) {
			$this->setId($Id);
			$this->setName($Name);
			$this->setPassword($Password);
			$this->setType($TypeId);
			$this->setDateOfBirth($DateOfBirth);
		}
		$this->FileManger = new FileManger("User.txt");
	}
	public function AllIsSet(): int
	{
		if (is_null($this->Id)) return 0;
		if (is_null($this->Name)) return 0;
		if (is_null($this->Password)) return 0;
		if (is_null($this->TypeId)) return 0;
		if (is_null($this->DateOfBirth)) return 0;
		return 1;
	}
	public function ToString(): string
	{
		$Line = $this->Id . '~' . $this->TypeId . '~' . $this->Name . '~' . sha1($this->Password) . "~" . $this->DateOfBirth . "~\r\n";
		return $Line;
	}
	public static function FromStringToObject(string $Line)
	{
		$Array = explode('~', $Line);
		$user = new User(intval($Array[0]), $Array[1], $Array[2], $Array[3], $Array[4]);
		return $user;
	}
	function getPassword()
	{
		return $this->Password;
	}
	function setPassword($Password)
	{
		if (str_contains($Password, '~')) return 0;
		$this->Password = $Password;
		return 1;
	}
	function getType()
	{
		return $this->TypeId;
	}
	function setType($Type)
	{
		$this->TypeId = $Type;
	}
	function Login()
	{
		if ($Line = $this->FileManger->ValueIsThere($this->Name, 2)) {
			$Array = explode('~', $Line);
			if ($Array[3] == sha1($this->Password)) {
				return $Array[0];
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	function Add($input1 = null, $input2 = null, $input3 = null, $input4 = null)
	{
		if ($this->AllIsSet()) {
			if (!$this->FileManger->ValueIsThere($this->Name, 2)) {
				$this->FileManger->FileAdd($this->ToString());
			} else {
				echo "This UserName is already exists!!";
			}
		} else {
			echo "Please Try again but prevent using '~'!!";
		}
	}

	/**
	 * 
	 * @param string $input1 Note1
	 * @param float $input2 Note2
	 */
	function Update($input1 = null, $input2 = null, $input3 = null, $input4 = null)
	{
		// Code
	}
	function Searsh($input1 = null, $input2 = null, $input3 = null, $input4 = null)
	{
		// Code
		$List = [];
		return $List;
	}
	function Delete($input1 = null, $input2 = null, $input3 = null, $input4 = null)
	{
		// Code
	}
	/**
	 * 
	 * @return mixed
	 */
	function getDateOfBirth()
	{
		return $this->DateOfBirth;
	}

	/**
	 * 
	 * @param mixed $DateOfBirth 
	 * @return User
	 */
	function setDateOfBirth($DateOfBirth): int
	{
		$this->DateOfBirth = $DateOfBirth;
		return 1;
	}
}
