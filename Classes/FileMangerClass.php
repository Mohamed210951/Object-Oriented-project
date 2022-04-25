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
			if($Array[1]!="Deleted")
			{
				if ($Array[$Index] == $Value) {
					Encrypt($this->FileName);
					return $Line;
				}
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
			$Array = explode("~",$Line);
			if($Array[1]!="Deleted")
			{
				array_push($List, $Line);
			}
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
		$Array = explode("~",$Data);
		$DeletedData = "".$Array[0]."~";
		for ($i=1; $i < count($Array)-1; $i++) { 
			$DeletedData.="Deleted~";
		}
		$DeletedData.="\r\n";
		$this->FileUpdate($Data,$DeletedData);
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