<?php


class profile_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $strEmail = "";
	public $strErrorMessage = '';
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



			include_once(ROOT_DIR.'/views/profile.php'); 

		} 
		

	}






}