<?php
function GetLastId(string $fileName)
{
	Decrypt($fileName);
	$File = fopen("../Files/" . $fileName, 'r');
	$max = 0;
	while ($Line = fgets($File)) {
		$Array = explode('~', $Line);
		$Id = intval($Array[0]);
		if ($Id > $max) {
			$max = $Id;
		}
	}
	Encrypt($fileName);
	return $max;
}

/*
* @param int Type 1,User -- 2,Product -- 3,Order -- 4,OrderDetails
*/
function DisplayTable(array $List, int $Type = 0)
{
	echo "<center>";
	$Table = "box-shadow: 0 0 20px rgba(0,0,0,0.15); border-collapse: collapse; border-radius: 10px 10px 0 0; overflow: hidden; margin: 25px 0; font-size: 0.9em; font-family: sans-serif; min-width: 400px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);";
	$TableHead = "background-color: #a0e711; color: #ffffff; text-align: left; padding: 12px 15px;";
	echo "<table style='$Table'>";
	for ($i = 0; $i < count($List); $i++) {
		if($i == 0) echo "<tr style='$TableHead'>";
		else if($i == count($List) - 1) echo "<tr style='border-bottom: 2px solid #a0e711'>";
		else echo "<tr style='border-bottom: 1px solid #dddddd'>";
		for ($j = 0; $j < ($i>0?count($List[$i])-1:count($List[$i])); $j++) {
			echo "<th style='padding: 12px 15px; '>" . $List[$i][$j] . "</th>";
		}
		$Id1 = $List[$i][0];
		$Id2 = $List[$i][1];
		if($Type!=0)
			if($i!=0)
				if($Type != 4)
					echo "<th style='padding: 12px 15px;' ><a href='Del.php?Id1=$Id1&Id2=-1&Type=$Type'>Delete</a></th>";
				else
					echo "<th style='padding: 12px 15px;' ><a href='Del.php?Id1=$Id1&Id2=$Id2&Type=$Type'>Delete</a></th>";
			else
				echo "<th style='padding: 12px 15px;' >Delete</th>";
		echo "</tr>";
	}
	echo "</table>";
	echo "</center>";
}
/**
 * 
 * @param string $FileName the Name of the file
 * @param string $Value the value you want to search for
 * @param int $Index the index { in the file format } of the value you want to search for
 * @return mixed Return the line if value founded else return NULL
 */
function ValueIsThere(string $FileName, string $Value, int $Index)
{
	Decrypt($FileName);
	$File = fopen("../Files/" . $FileName, 'r');
	while ($Line = fgets($File)) {
		$Array = explode('~', $Line);
		if ($Array[$Index] == $Value) {
			Encrypt($FileName);
			return $Line;
		}
	}
	Encrypt($FileName);
	return null;
}
function GetAllContent(string $FileName)
{
	Decrypt($FileName);
	$File = fopen("../Files/" . $FileName, 'r');
	$List = [];
	while ($Line = fgets($File)) {
		array_push($List, $Line);
	}
	Encrypt($FileName);
	return $List;
}
function FileAdd(string $FileName, string $Line)
{
	Decrypt($FileName);
	$File = fopen("../Files/" . $FileName, 'a');
	fwrite($File, $Line);
	Encrypt($FileName);
}
function FileWrite(string $FileName, string $Line)
{
	Decrypt($FileName);
	$File = fopen("../Files/" . $FileName, 'w');
	fwrite($File, $Line);
	Encrypt($FileName);
}
function FileUpdate(string $FileName, string $Old, string $New)
{
	Decrypt($FileName);
	$contents = file_get_contents("../Files/" . $FileName);
	$contents = str_replace($Old, $New, $contents);
	file_put_contents("../Files/" . $FileName, $contents);
	Encrypt($FileName);
}
function FileDelete(string $FileName, string $Data)
{
	Decrypt($FileName);
	$contents = file_get_contents("../Files/" . $FileName);
	$contents = str_replace($Data, "", $contents);
	file_put_contents("../Files/" . $FileName, $contents);
	Encrypt($FileName);
}
function FromTypeGetServis(string $IdType)
{
	$Servis = [];
	$List = GetAllContent("User Type Menu.txt");
	for ($i = 0; $i < count($List); $i++) {
		$array = explode('~', $List[$i]);
		if ($array[0] == $IdType) {
			for ($j = 1; $j < count($array); $j++) {
				array_push($Servis, $array[$j]);
			}
		}
	}
	return $Servis;
}
function ToFormatedDate(string $Day, string $Month, string $Year)
{
	$String = $Year . "-" . $Month . "-" . $Day;
	return $String;
}
function GetDayFromString(string $String)
{
	$Temp = explode('-', $String);
	return intval($Temp[2]);
}
function GetMonthFromString(string $String)
{
	$Temp = explode('-', $String);
	return intval($Temp[1]);
}
function GetYearFromString(string $String)
{
	$Temp = explode('-', $String);
	return intval($Temp[0]);
}
function Encrypt($FileName)
{
	$contents = file_get_contents("../Files/" . $FileName);
	$Key = 15;
	$Result = "";
	for ($i = 0; $i < strlen($contents); $i++) {
		$c = chr(ord($contents[$i]) + $Key + $i);
		$Result .= $c;
	}
	file_put_contents("../Files/" . $FileName, $Result);
}
function Decrypt($FileName)
{
	$contents = file_get_contents("../Files/" . $FileName);
	$Key = 15;
	$Result = "";
	for ($i = 0; $i < strlen($contents); $i++) {
		$c = chr(ord($contents[$i]) - $Key - $i);
		$Result .= $c;
	}
	file_put_contents("../Files/" . $FileName, $Result);
}
