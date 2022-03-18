<?php
function GetLastId(string $fileName) {
	$File = fopen("Files/".$fileName, 'r');
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
function IdIsThere(string $FileName, int $Value){
	$File = fopen("Files/".$FileName, 'r');
	while($Line = fgets($File))	{
		$Array = explode('~',$Line);
		if($Array[0] == $Value) return 1;
	}
	return 0;
}
function UserNameIsThere(string $FileName,string $Value){
	$File = fopen("Files/".$FileName, 'r');
	while($Line = fgets($File))	{
		$Array = explode('~',$Line);
		if($Array[2] == $Value) return 1;
	}
	return 0;
}
function FileAdd(string $FileName,string $Line){
	$File = fopen("Files/".$FileName,'a');
	fwrite($File,$Line);
}

trait Person{
    protected int $Id;
    protected string $Name;
	/**
	 * 
	 * @return int
	 */
	function getId(): int {
		return $this->Id;
	}
	
	/**
	 * 
	 * @param int $Id 
	 * @return Person
	 */
	function setId(int $Id): self {
		$this->Id = $Id;
		return $this;
	}
	/**
	 * 
	 * @return string
	 */
	function getName(): string {
		return $this->Name;
	}
	
	/**
	 * 
	 * @param string $Name 
	 * @return Person
	 */
	function setName(string $Name): int {
		if(str_contains($Name,'~')) return 0;
		$this->Name = $Name;
		return 1;
	}
}
trait User{
	use Person;
    protected string $Password;
	/**
	 * 
	 * @return string
	 */
	function getPassword(): string {
		return $this->Password;
	}
	
	/**
	 * 
	 * @param string $Password 
	 * @return User
	 */
	function setPassword(string $Password):int {
		if(str_contains($Password,'~')) return 0;
		$this->Password = $Password;
		return 1;
	}

}
trait  InOrphanage{
	use Person;
    protected string $DateOfBirth;
	/**
	 * 
	 * @return string
	 */
	function getDateOfBirth(): string {
		return $this->DateOfBirth;
	}
	
	/**
	 * 
	 * @param string $DateOfBirth 
	 * @return InOrphanage
	 */
	function setDateOfBirth(string $DateOfBirth): self {
		$this->DateOfBirth = $DateOfBirth;
		return $this;
	}

}
trait Adult{
	use Person;
	protected string $Phone;
	protected int $NationalId;
	protected string $Address;
	
	/**
	 * 
	 * @return string
	 */
	function getPhone(): string {
		return $this->Phone;
	}
	
	/**
	 * 
	 * @param string $Phone 
	 * @return Adult
	 */
	function setPhone(string $Phone): self {
		$this->Phone = $Phone;
		return $this;
	}
	/**
	 * 
	 * @return int
	 */
	function getNationalId(): int {
		return $this->NationalId;
	}
	
	/**
	 * 
	 * @param int $NationalId 
	 * @return Adult
	 */
	function setNationalId(int $NationalId): self {
		$this->NationalId = $NationalId;
		return $this;
	}
	/**
	 * 
	 * @return string
	 */
	function getAddress(): string {
		return $this->Address;
	}
	
	/**
	 * 
	 * @param string $Address 
	 * @return Adult
	 */
	function setAddress(string $Address): self {
		$this->Address = $Address;
		return $this;
	}
}
class Worker{
	use Adult;
	use InOrphanage;
	use User;
	protected float $Salary;
	protected int $NumberDaysWorking;
	protected int $NumberHoursWorking;
	
	/**
	 * 
	 * @return float
	 */
	function getSalary(): float {
		return $this->Salary;
	}
	
	/**
	 * 
	 * @param float $Salary 
	 * @return Worker
	 */
	function setSalary(float $Salary): self {
		$this->Salary = $Salary;
		return $this;
	}
	/**
	 * 
	 * @return int
	 */
	function getNumberDaysWorking(): int {
		return $this->NumberDaysWorking;
	}
	
	/**
	 * 
	 * @param int $NumberDaysWorking 
	 * @return Worker
	 */
	function setNumberDaysWorking(int $NumberDaysWorking): self {
		$this->NumberDaysWorking = $NumberDaysWorking;
		return $this;
	}
	/**
	 * 
	 * @return int
	 */
	function getNumberHoursWorking(): int {
		return $this->NumberHoursWorking;
	}
	
	/**
	 * 
	 * @param int $NumberHoursWorking 
	 * @return Worker
	 */
	function setNumberHoursWorking(int $NumberHoursWorking): self {
		$this->NumberHoursWorking = $NumberHoursWorking;
		return $this;
	}
}
class Food_Information{
	protected string $FoodLoveType;
	protected int $FoodNumber;
	
	/**
	 * 
	 * @return string
	 */
	function getFoodLoveType(): string {
		return $this->FoodLoveType;
	}
	
	/**
	 * 
	 * @param string $FoodLoveType 
	 * @return Food_Information
	 */
	function setFoodLoveType(string $FoodLoveType): self {
		$this->FoodLoveType = $FoodLoveType;
		return $this;
	}
	/**
	 * 
	 * @return int
	 */
	function getFoodNumber(): int {
		return $this->FoodNumber;
	}
	
	/**
	 * 
	 * @param int $FoodNumber 
	 * @return Food_Information
	 */
	function setFoodNumber(int $FoodNumber): self {
		$this->FoodNumber = $FoodNumber;
		return $this;
	}
}
class Learning_Information{
	protected int $EducationYear;
	protected float $Grede;
	/**
	 * 
	 * @return int
	 */
	function getEducationYear(): int {
		return $this->EducationYear;
	}
	
	/**
	 * 
	 * @param int $EducationYear 
	 * @return Learning_Information
	 */
	function setEducationYear(int $EducationYear): self {
		$this->EducationYear = $EducationYear;
		return $this;
	}
	/**
	 * 
	 * @return float
	 */
	function getGrede(): float {
		return $this->Grede;
	}
	
	/**
	 * 
	 * @param float $Grede 
	 * @return Learning_Information
	 */
	function setGrede(float $Grede): self {
		$this->Grede = $Grede;
		return $this;
	}
}
class Children{
	use InOrphanage;
	protected string $Gender;
	protected Food_Information $Food;
	protected string $Date_Sign_In;
	protected Learning_Information $Learning;
	
	/**
	 * 
	 * @return string
	 */
	function getGender(): string {
		return $this->Gender;
	}
	
	/**
	 * 
	 * @param string $Gender 
	 * @return Children
	 */
	function setGender(string $Gender): self {
		$this->Gender = $Gender;
		return $this;
	}
	/**
	 * 
	 * @return Food_Information
	 */
	function getFood(): Food_Information {
		return $this->Food;
	}
	
	/**
	 * 
	 * @param Food_Information $Food 
	 * @return Children
	 */
	function setFood(Food_Information $Food): self {
		$this->Food = $Food;
		return $this;
	}
	/**
	 * 
	 * @return string
	 */
	function getDate_Sign_In(): string {
		return $this->Date_Sign_In;
	}
	
	/**
	 * 
	 * @param string $Date_Sign_In 
	 * @return Children
	 */
	function setDate_Sign_In(string $Date_Sign_In): self {
		$this->Date_Sign_In = $Date_Sign_In;
		return $this;
	}
	/**
	 * 
	 * @return Learning_Information
	 */
	function getLearning(): Learning_Information {
		return $this->Learning;
	}
	
	/**
	 * 
	 * @param Learning_Information $Learning 
	 * @return Children
	 */
	function setLearning(Learning_Information $Learning): self {
		$this->Learning = $Learning;
		return $this;
	}
}

class Nursemaid extends Worker{
	public function UpdateChildrenINfo(Children $Child)
	{
		// Update Child
	}
	public function SearchForChildren(Children $Child)
	{
		// Search For Child
	}
	public function ChangeOwnInformaton(Nursemaid $Updated)
	{
		// Update this
	}
	public function SeeChildrenInformaion(int $Id)
	{
		// Get Children Id
	}
}
class Admin {
	use User;
	public function __construct(int $Id = null, string $Name = null, string $Password = null) {
		if($Id != null) {
			$this->setId($Id);
			$this->setName($Name);
			$this->setPassword($Password);
		}
	}
	public function AllIsSet(): int {
		if(is_null($this->Id)) return 0;
		if(is_null($this->Name)) return 0;
		if(is_null($this->Password)) return 0;
		return 1;
	}
	public function ToString(): string {
		$Line = $this->Id . '~' . "Admin" . '~' . $this->Name . '~' . $this->Password . "~\r\n";
		return $Line;
	}
}

