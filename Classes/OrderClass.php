<?php
include_once "../System/Back End.php";
include_once "PersonClass.php";
include_once "OrderDetailsClass.php";
class order extends Person implements File
{
	private ?float $total;
	private ?int $ClientId;
	private ?string $date;
	public function AllIsSet()
	{
		if ($this->Id == null) return 0;
		if ($this->ClientId == null) return 0;
		return 1;
	}
	/**
	 *
	 * @param mixed $input1
	 * @param mixed $input2
	 * @param mixed $input3
	 * @param mixed $input4
	 *
	 * @return mixed
	 */
	public function ToString()
	{
		$String = $this->Id . "~" . $this->ClientId . "~\r\n";
		return $String;
	}
	function Add($input1 = null, $input2 = null, $input3 = null, $input4 = null)
	{
		$LastId = GetLastId("Order.txt");
		$this->setId($LastId + 1);
		if ($this->AllIsSet()) {
			$IsOrderExist = ValueIsThere("Order.txt", $this->Id, 0);
			if ($IsOrderExist == null) {
				FileAdd("Order.txt", $this->ToString());
				session_start();
				$_SESSION["OrderId"] = $this->getId();
				header("Location:OrderDetails.php");
			} else {
				echo "the order is exist";
				return 0;
			}
			return 1;
		} else {
			return 0;
		}
	}
	function Update($input1 = null, $input2 = null, $input3 = null, $input4 = null)
	{
	}

	/**
	 *
	 * @param mixed $input1
	 * @param mixed $input2
	 * @param mixed $input3
	 * @param mixed $input4
	 *
	 * @return mixed
	 */
	function Searsh($input1 = null, $input2 = null, $input3 = null, $input4 = null)
	{
	}

	/**
	 *
	 * @param mixed $input1
	 * @param mixed $input2
	 * @param mixed $input3
	 * @param mixed $input4
	 *
	 * @return mixed
	 */
	function Delete($input1 = null, $input2 = null, $input3 = null, $input4 = null)
	{
	}
	/**
	 * 
	 * @return string
	 */
	function getDate(): string
	{
		return $this->date;
	}

	function setDate(string $date): int
	{
		if ($date <= 0) return 0;
		$this->date = $date;
		return 1;
	}

	function getClientId(): int
	{
		return $this->ClientId;
	}


	function setClientId(int $ClientId): int
	{
		if ($ClientId <= 0) return 0;
		$this->ClientId = $ClientId;
		return 1;
	}

	function setProductId(int $ProductId): int
	{
		if ($ProductId <= 0) return 0;
		$this->ProductId = $ProductId;
		return 1;
	}
	function getProductId(): int
	{
		return $this->ProductId;
	}

	public static function StringToObject(string $String)
	{
	}


	/**
	 * 
	 * @return string
	 */

	/**
	 */
	function __construct()
	{
		$this->ClientId = null;
		$this->date = null;
		$this->Id = null;
		$this->total = null;
		$this->Name = null;
	}
}
