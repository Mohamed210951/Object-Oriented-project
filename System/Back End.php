<?php
function GetLastId(string $fileName) {
	Decrypt($fileName);
	$File = fopen("../Files/".$fileName, 'r');
	$max = 0;
	while($Line = fgets($File))	{
		$Array = explode('~',$Line);
		$Id = intval($Array[0]);
		if($Id > $max) {
			$max = $Id;
		}
	}
	Encrypt($fileName);
	return $max;
}

function DisplayTable(array $List) {
	echo "<table border=1>";
	for ($i=0; $i < count($List); $i++) { 
		echo "<tr>";
		for ($j=0; $j < count($List[$i]); $j++) { 
			echo "<th>".$List[$i][$j]."</th>";
		}
		echo "</tr>";
	}
	echo "</table>";
}
/**
 * 
 * @param string $FileName the Name of the file
 * @param string $Value the value you want to search for
 * @param int $Index the index { in the file format } of the value you want to search for
 * @return mixed Return the line if value founded else return NULL
 */
function ValueIsThere(string $FileName,string $Value,int $Index){
	Decrypt($FileName);
	$File = fopen("../Files/".$FileName, 'r');
	while($Line = fgets($File))	{
		$Array = explode('~',$Line);
		if($Array[$Index] == $Value) 
		{	
			Encrypt($FileName);
			return $Line;
		}
	}
	Encrypt($FileName);
	return null;
}
function GetAllContent(string $FileName){
	Decrypt($FileName);
	$File = fopen("../Files/".$FileName, 'r');
	$List = [];
	while ($Line = fgets($File)) {
		array_push($List, $Line);
	}
	Encrypt($FileName);
	return $List;
}
function FileAdd(string $FileName,string $Line){
	Decrypt($FileName);
	$File = fopen("../Files/".$FileName,'a');
	fwrite($File,$Line);
	Encrypt($FileName);
}
function FileWrite(string $FileName,string $Line){
	Decrypt($FileName);
	$File = fopen("../Files/".$FileName,'w');
	fwrite($File,$Line);
	Encrypt($FileName);
}
function FileUpdate(string $FileName, string $Old, string $New){
	Decrypt($FileName);
	$contents = file_get_contents("../Files/".$FileName);
    $contents = str_replace($Old, $New, $contents);
    file_put_contents("../Files/".$FileName, $contents);
	Encrypt($FileName);
}
function FileDelete(string $FileName, string $Data){
	Decrypt($FileName);
	$contents = file_get_contents("../Files/".$FileName);
    $contents = str_replace($Data, "", $contents);
    file_put_contents("../Files/".$FileName, $contents);
	Encrypt($FileName);
}
function FromTypeGetServis(string $IdType) {
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
function ToFormatedDate(string $Day,string $Month,string $Year)
{
	$String = $Day."/".$Month."/".$Year;
	return $String;
}
function GetDayFromString(string $String)
{
	$Temp = explode('/',$String);
	return intval($Temp[0]);
}
function GetMonthFromString(string $String)
{
	$Temp = explode('/',$String);
	return intval($Temp[1]);
}
function GetYearFromString(string $String)
{
	$Temp = explode('/',$String);
	return intval($Temp[2]);
}
function Encrypt($FileName) {
	$contents = file_get_contents("../Files/".$FileName);
	$Key = 15;
    $Result = "";
    for ($i = 0; $i < strlen($contents); $i++) {
        $c = chr(ord($contents[$i]) + $Key + $i);
        $Result .= $c;
    }
    file_put_contents("../Files/".$FileName, $Result);
}
function Decrypt($FileName) {
	$contents = file_get_contents("../Files/".$FileName);
	$Key = 15;
    $Result = "";
    for ($i = 0; $i < strlen($contents); $i++) {
        $c = chr(ord($contents[$i]) - $Key - $i);
        $Result .= $c;
    }
    file_put_contents("../Files/".$FileName, $Result);
}

