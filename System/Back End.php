<?php
include_once "../Classes/FileMangerClass.php";
function FromTypeGetServis(string $IdType)
{
	$Servis = [];
	$File = new FileManger("User Type Menu.txt");
	$List = $File->GetAllContent();
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
function Encrypt($FileName) {
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
function DisplayTable(array $List, int $Type = 0,string $UpdateLink = "null")
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
				if($Type == 4)
				{
					echo "<th style='padding: 12px 15px;' ><a href='$UpdateLink?Id1=$Id1&Id2=$Id2'>Update</a></th>";
					echo "<th style='padding: 12px 15px;' ><a href='Del.php?Id1=$Id1&Id2=$Id2&Type=$Type'>Delete</a></th>";
				}
				else{
					if($Type == 3) echo "<th style='padding: 12px 15px;'><a href='OrderDetails.php?OrderId=$Id1'>Order Details</a></th>";
					echo "<th style='padding: 12px 15px;' ><a href='$UpdateLink?Id1=$Id1'>Update</a></th>";
					echo "<th style='padding: 12px 15px;' ><a href='Del.php?Id1=$Id1&Id2=-1&Type=$Type'>Delete</a></th>";
				}
			else
			{
				if($Type == 3) echo "<th style='padding: 12px 15px;' >Order Details</th>";
				echo "<th style='padding: 12px 15px;' >Update</th>";
				echo "<th style='padding: 12px 15px;' >Delete</th>";
			}
		echo "</tr>";
	}
	echo "</table>";
	echo "</center>";
}