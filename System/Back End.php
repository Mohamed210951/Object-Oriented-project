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

function DisplayTable(array $List) {
	echo "<table style = 'border: 1px solid black'>";
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
	$File = fopen("../Files/".$FileName, 'r');
	while($Line = fgets($File))	{
		$Array = explode('~',$Line);
		if($Array[$Index] == $Value) return $Line;
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
