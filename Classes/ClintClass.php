<?php
include_once "../System/Back End.php";
include_once "PersonClass.php";


class Clint extends Person implements File {
	
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