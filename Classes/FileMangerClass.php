<?php
include_once "../System/Back End.php";
class FileManger
{
	private $FileName;
	public function __construct($FileName) {
		$this->FileName = $FileName;
	}
	function GetLastId()
	{
		Decrypt($this->FileName);
		$File = fopen("../Files/" . $this->FileName, 'r');
		$max = 0;
		while ($Line = fgets($File)) {
			$Array = explode('~', $Line);
			$Id = intval($Array[0]);
			if ($Id > $max) {
				$max = $Id;
			}
		}
		Encrypt($this->FileName);
		return $max;
	}
	function ValueIsThere(string $Value, int $Index)
	{
		Decrypt($this->FileName);
		$File = fopen("../Files/" . $this->FileName, 'r');
		while ($Line = fgets($File)) {
			$Array = explode('~', $Line);
			if ($Array[$Index] == $Value) {
				Encrypt($this->FileName);
				return $Line;
			}
		}
		Encrypt($this->FileName);
		return null;
	}
	function GetAllContent()
	{
		Decrypt($this->FileName);
		$File = fopen("../Files/" . $this->FileName, 'r');
		$List = [];
		while ($Line = fgets($File)) {
			array_push($List, $Line);
		}
		Encrypt($this->FileName);
		return $List;
	}
	function FileAdd(string $Line)
	{
		Decrypt($this->FileName);
		$File = fopen("../Files/" . $this->FileName, 'a');
		fwrite($File, $Line);
		Encrypt($this->FileName);
	}
	function FileWrite(string $Line)
	{
		Decrypt($this->FileName);
		$File = fopen("../Files/" . $this->FileName, 'w');
		fwrite($File, $Line);
		Encrypt($this->FileName);
	}
	function FileUpdate(string $Old, string $New)
	{
		Decrypt($this->FileName);
		$contents = file_get_contents("../Files/" . $this->FileName);
		$contents = str_replace($Old, $New, $contents);
		file_put_contents("../Files/" . $this->FileName, $contents);
		Encrypt($this->FileName);
	}
	function FileDelete(string $Data)
	{
		Decrypt($this->FileName);
		$contents = file_get_contents("../Files/" . $this->FileName);
		$contents = str_replace($Data, "", $contents);
		file_put_contents("../Files/" . $this->FileName, $contents);
		Encrypt($this->FileName);
	}
	/**
	 * 
	 * @return mixed
	 */
	function getFileName() {
		return $this->FileName;
	}
	
	/**
	 * 
	 * @param mixed $FileName 
	 * @return FileManger
	 */
	function setFileName($FileName): self {
		$this->FileName = $FileName;
		return $this;
	}
}