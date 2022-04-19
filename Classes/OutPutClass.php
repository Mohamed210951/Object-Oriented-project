<?php  

class Input 
{
    private $Name;
    private $Type;
    private $Text;

    public function __construct() {
        $this->Name = "NULL";
        $this->Type = "NULL";
        $this->Text = "NULL";
    }
	/**
	 * 
	 * @return mixed
	 */
	function getName() {
		return $this->Name;
	}
	
	/**
	 * 
	 * @param mixed $Name 
	 * @return Input
	 */
	function setName($Name): self {
		$this->Name = $Name;
		return $this;
	}
	/**
	 * 
	 * @return mixed
	 */
	function getType() {
		return $this->Type;
	}
	
	/**
	 * 
	 * @param mixed $Type 
	 * @return Input
	 */
	function setType($Type): self {
		$this->Type = $Type;
		return $this;
	}

    function AllIsSet()
    {
        if($this->Name!="NULL" && $this->Type != "NULL" && $this->Text != "NULL")
        {
            return 1;
        }
        return 0;
    }
    function DisplayInput()
    {
        if($this->AllIsSet() == 0) return 0;
        ?>
            <div>
                <label>
                    <?php $this->Name?>
                    <input type=<?php $this->Type?> name = <?php $this->Name?>>
                </label>
            </div>
        <?php
    }
	
	/**
	 * 
	 * @return mixed
	 */
	function getText() {
		return $this->Text;
	}
	
	/**
	 * 
	 * @param mixed $Text 
	 * @return Input
	 */
	function setText($Text): self {
		$this->Text = $Text;
		return $this;
	}
}
class Form 
{
    private $Title;
    private $ActionFile;
    private $Inputs;
    private $SubmitText;
    public function __construct() {
        $this->Title = "NULL";
        $this->ActionFile = "NULL";
        $this->Inputs = array();
        $this->SubmitText = "NULL";
    }
    public function AllIsSet()
    {
        if($this->Title == "NULL") return 0;
        if($this->ActionFile == "NULL") return 0;
        if(count($this->Inputs) == 0) return 0;
        if($this->SubmitText == "NULL") return 0;
        return 1;
    }
    
    public function DisplayForm()
    {
        if($this->AllIsSet() == 0) return 0;
        ?>
        <div class="container">
        <h2 class="">
            <?php $this->Title?>
        </h2>
        </div>
        <form action=<?php $this->ActionFile?> method="POST">
            <div class="contact_form-container">
              <div>
        <?php
        for ($i=0; $i < count($this->Inputs); $i++) { 
            $this->Inputs[$i]->DisplayInput();
        }
        ?>
        <div class="mt-5">
        <button type="submit">
        <?php $this->SubmitText?>
        </button>
        </div>
        </div>
        </div>
        </form>
        <?php
    }

	/**
	 * 
	 * @return mixed
	 */
	function getTitle() {
		return $this->Title;
	}
	
	/**
	 * 
	 * @param mixed $Title 
	 * @return Form
	 */
	function setTitle($Title): self {
		$this->Title = $Title;
		return $this;
	}
	/**
	 * 
	 * @return mixed
	 */
	function getActionFile() {
		return $this->ActionFile;
	}
	
	/**
	 * 
	 * @param mixed $ActionFile 
	 * @return Form
	 */
	function setActionFile($ActionFile): self {
		$this->ActionFile = $ActionFile;
		return $this;
	}
	/**
	 * 
	 * @return mixed
	 */
	function getInputs() {
		return $this->Inputs;
	}
	
	/**
	 * 
	 * @param mixed $Inputs 
	 * @return Form
	 */
	function setInputs($Inputs): self {
		$this->Inputs = $Inputs;
		return $this;
	}
	/**
	 * 
	 * @return mixed
	 */
	function getSubmitText() {
		return $this->SubmitText;
	}
	
	/**
	 * 
	 * @param mixed $SubmitText 
	 * @return Form
	 */
	function setSubmitText($SubmitText): self {
		$this->SubmitText = $SubmitText;
		return $this;
	}
}
class HTML
{
	private function __construct() {
	}
	static public function Header()
	{
		?>
		<head>
			<!-- Basic -->
			<meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge" />
			<!-- Mobile Metas -->
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
			<!-- Site Metas -->
			<meta name="keywords" content="" />
			<meta name="description" content="" />
			<meta name="author" content="" />

			<title>Intot</title>

			<!-- slider stylesheet -->
			<link rel="stylesheet" type="text/css"
				href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

			<!-- bootstrap core css -->
			<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

			<!-- fonts style -->
			<link href="https://fonts.googleapis.com/css?family=Dosis:400,500|Poppins:400,600,700&display=swap" rel="stylesheet">
			<!-- Custom styles for this template -->
			<link href="css/style.css" rel="stylesheet" />
			<!-- responsive style -->
			<link href="css/responsive.css" rel="stylesheet" />
		</head>
		<body>
		<?php
	}
	static public function Footer()
	{
		?>
			</body>
		<?php
	}
}

?>