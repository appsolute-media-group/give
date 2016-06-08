<?php


class profile_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $objUsers;
	public $objUser;
	public $objDS;
	public $objDonations;
	public $arrSubs;

	public $intSublocalityId = "";
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
		$this->strSuccessMessage = '';

		if($this->strMethod == ''){ //main view

			$this->objUsers = new Users;
			$this->objSubs = new SubLocalities;
			$this->objDS = new DonationSched;

		
			$this->objDonations = $this->objDS->getAllByUser();
			$this->objDonationHistory = $this->objDS->getHistoryByUser();



			$this->objUser = json_decode($this->objUsers->showUserById($_SESSION['userID'])); 
			



			$this->arrSubs = $this->objSubs->getSubLocality_dropdown_List(1);


			if(isset($_POST['doPost'])){

				$this->handleForm();

			} elseif(isset($_POST['doDonationPost'])){

				$this->handleDonateForm();

			} else {

				$this->initializeForm();

			}

			// create the list for populating a drop down for food banks
			$this->listSublocalities = Util::get_dropdown_items($this->arrSubs, $this->intSublocalityId);

			

		} 
		

	}





	function showView() {

		include_once(ROOT_DIR.'/views/profile.php'); 

	}





	function initializeForm() {


		$this->strFirstName = $this->objUser->first_name;
		$this->strEmail = $this->objUser->email;

		$this->strLastName = $this->objUser->last_name;
		$this->strAddress =  $this->objUser->tax_address;
		$this->strCity = $this->objUser->tax_city;
		$this->strProvince = $this->objUser->tax_prov;
		$this->strCountry = $this->objUser->tax_country;
		$this->strPostal = $this->objUser->tax_pc;
		$this->intSublocalityId = $this->objUser->sublocality_id;


	}


	function handleDonateForm() {

		$this->decAmount = isset($_POST['amount']) ? $_POST['amount'] : '';
		$this->intFreq = isset($_POST['freq']) ? $_POST['freq'] : '';

		
		$this->objDS->updateDonationSchedule($this->decAmount,$this->intFreq);
		$this->objDonations = $this->objDS->getAllByUser();



	}


	function handleForm() {

		$this->strEmail = isset($_POST['email']) ? $_POST['email'] : '';
		$this->strFirstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
		$this->strLastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
		$this->strAddress = isset($_POST['address']) ? $_POST['address'] : '';
		$this->strCity = isset($_POST['city']) ? $_POST['city'] : '';
		$this->strProvince = isset($_POST['province']) ? $_POST['province'] : '';
		$this->strCountry = isset($_POST['country']) ? $_POST['country'] : '';
		$this->strPostal = isset($_POST['postal']) ? $_POST['postal'] : '';
		$this->intSublocalityId = isset($_POST['sublocality']) ? $_POST['sublocality'] : '0';


		do {


			if($this->intSublocalityId == '0'){
				$this->strErrorMessage = "Please choose a Location<br />";
				break;
			}
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

		if($this->strErrorMessage == ""){
			$res = $this->objUsers->updateWebUser($this);
			$this->strSuccessMessage = "Your record has been saved";
		}


	}



}