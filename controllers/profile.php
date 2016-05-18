<?php


class profile_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $strEmail = "";
	public $strErrorMessage = "";
	public $strSuccessMessage = "";
	public $strFirstName = "";
	public $strLastName = "";
	public $strAddress = "";
	public $strCity = "";
	public $strProvince = "";
	public $strCountry = "";
	public $strPostal = "";
	

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
	

		if($this->strMethod == ''){ //main view


			$this->objUser = new Users;
			$objUser = json_decode($this->objUser->showUserById($_SESSION['userID'])); 
			$this->strFirstName = $objUser->first_name;
			$this->strEmail = $objUser->email;

			$this->strLastName = $objUser->last_name;
			$this->strAddress =  $objUser->tax_address;
			$this->strCity = $objUser->tax_city;
			$this->strProvince = $objUser->tax_prov;
			$this->strCountry = $objUser->tax_country;
			$this->strPostal = $objUser->tax_pc;

			if(isset($_POST['doPost'])){


				$this->handleForm();



			}

			include_once(ROOT_DIR.'/views/profile.php'); 

		} 
		

	}



	function handleForm() {


		$this->strFirstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
		$this->strLastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
		$this->strAddress = isset($_POST['address']) ? $_POST['address'] : '';
		$this->strCity = isset($_POST['city']) ? $_POST['city'] : '';
		$this->strProvince = isset($_POST['province']) ? $_POST['province'] : '';
		$this->strCountry = isset($_POST['country']) ? $_POST['country'] : '';
		$this->strPostal = isset($_POST['postal']) ? $_POST['postal'] : '';



		do {


			if($this->strFirstName == ''){
				$this->strErrorMessage = "Please enter a first name<br />";
				break;
			}
			if($this->strLastName == ''){
				$this->strErrorMessage = "Please enter a last name<br />";
				break;
			}
			if($this->strAddress == ''){
				$this->strErrorMessage = "Please enter a address<br />";
				break;
			}
			if($this->strCity == ''){
				$this->strErrorMessage = "Please enter a city<br />";
				break;
			}
			if($this->strProvince == ''){
				$this->strErrorMessage = "Please enter a province<br />";
				break;
			}
			if($this->strCountry == ''){
				$this->strErrorMessage = "Please enter a country<br />";
				break;
			}
			if($this->strPostal == ''){
				$this->strErrorMessage = "Please enter a postal code<br />";
				break;
			}

			break;
		} while ($this->strErrorMessage == "");


		$res = $this->objUser->updateWebUser($this);



		$this->strSuccessMessage == "Your record has been saved";



	}



}