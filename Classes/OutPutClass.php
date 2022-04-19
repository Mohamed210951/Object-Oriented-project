<?php  
if(session_id() == ''){
    session_start();
}
class Input 
{
    private $Name;
    private $Type;
    private $Text;

    public function __construct($Name = "NULL",$Text = "NULL",$Type = "NULL") {
        if($Name == "NULL")
		{
			$this->Name = "NULL";
			$this->Type = "NULL";
			$this->Text = "NULL";
		}
		else
		{
			$this->Name = $Name;
			$this->Type = $Type;
			$this->Text = $Text;
		}
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
			<?php if($this->Type!="submit") {?>
            <div>
                <label>
					
                    <?php echo $this->Text?>
                    <input type=<?php echo $this->Type?> name = <?php echo $this->Name?>>
					
                </label>
            </div>
			<?php } else {?>
				<div class="mt-5">
                  <button type="submit" name = <?php echo $this->Name?>>
                    <?php echo $this->Text?>
                  </button>
			<?php }?>
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
    public function __construct() {
        $this->Title = "NULL";
        $this->ActionFile = "NULL";
        $this->Inputs = array();
	}
    public function AllIsSet()
    {
        if($this->Title == "NULL") return 0;
        if($this->ActionFile == "NULL") return 0;
        if(count($this->Inputs) == 0) return 0;
		return 1;
    }
    
    public function DisplayForm()
    {
        if($this->AllIsSet() == 0) return 0;
        ?>
		<section class="contact_section layout_padding">
        <div class="container">
			<h2 class="">
				<?php echo $this->Title?>
			</h2>
        </div>
		<div class="container">
      	<div class="row">
        <div class="col-md-6 ">
        <form action=<?php echo $this->ActionFile?> method="POST">
            <div class="contact_form-container">
              <div>
        <?php
        for ($i=0; $i < count($this->Inputs); $i++) { 
            $this->Inputs[$i]->DisplayInput();
        }
        ?>
        </div>
        </div>
        </form>
		</div>
		</div>
		</div>
		</section>
        <?php
    }
	public function InfoIsTaken()
	{
		for ($i=0; $i < count($this->Inputs); $i++) { 
			if($this->Inputs[$i]->getType() == "submit")
			{
				if(isset($_POST[$this->Inputs[$i]->getName()]))
				{
					return $this->Inputs[$i]->getName();
				}
			}
		}
		return false;
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
}
class HTML
{
	private function __construct() {
	}
	static public function Header($Type)
	{
		$Servis = FromTypeGetServis($Type);
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

			<title>Project</title>

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
		<body class="sub_page"> 
		<div class="hero_area">
      <!-- header section strats -->
      <header class="header_section">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="index.php">
              <span>
                Project
              </span>
            </a>

            <div class="navbar-collapse" id="">
              <div class="d-none d-lg-flex ml-auto flex-column flex-lg-row align-items-center">
                <ul class="navbar-nav">
				<?php if(isset($_SESSION["UserId"])) {?>
					<li class="nav-item">
                    <a class="nav-link" href="Logout.php">
                      <img src="images/login.png" alt="" />
                      <span>Logout</span></a>
                  </li>
				<?php }else{?>
                  <li class="nav-item">
                    <a class="nav-link" href="Login.php">
                      <img src="images/login.png" alt="" />
                      <span>Login</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="SignUp.php">
                      <img src="images/signup.png" alt="" />
                      <span>Sign Up</span>
                    </a>
                  </li>
				<?php }?>
                </ul>
                <form class="form-inline my-2 mb-3 mb-lg-0  mr-5">
                </form>
              </div>
			  <?php if(isset($_SESSION["UserId"])) {?>
              <div class="custom_menu-btn">
                <button onclick="openNav()">
                  <span class="s-1">
                  </span>
                  <span class="s-2">
                  </span>
                  <span class="s-3">
                  </span>
                </button>
              </div>
				<div id="myNav" class="overlay">
					<div class="overlay-content">
					<a href="index.php">HOME</a>
					<?php if(!str_contains($Servis[0],"Product-Non")){ ?>
					<a href="Product.php">Product</a>
					<?php }?>
					<?php if(!str_contains($Servis[1],"Order-Non")){ ?>
					<a href="Order.php">Order</a>
					<?php }?>
					<?php if(!str_contains($Servis[2],"User-Non")){?>
					<a href="User.php">User</a>
					<?php }?>
					<?php if($Type == "1"){?>
					<a href="Type.php">Type of Users</a>
					<?php }?>
                </div>
			  <?php }?>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <!-- end header section -->
    </div>
		<?php
	}
	static public function Footer()
	{
		?>
		</section>
		<script>
			function openNav() {
			document.getElementById("myNav").classList.toggle("menu_width")
			document.querySelector(".custom_menu-btn").classList.toggle("menu_btn-style")
			}
		</script>
			</body>
		<?php
	}
}

?>