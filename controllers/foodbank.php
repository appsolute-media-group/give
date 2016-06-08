<?php


class foodbank_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $sublocality_id = "";
	public $strPageName = "Club Appetite";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		$this->sublocality_id = $_SESSION['sublocality_id'];

		$this->objSubLocalities = new SubLocalities;
		$this->objCurrent = $this->objSubLocalities->getFoodBankInfo($this->sublocality_id);
		$this->objCurrentContact = $this->objSubLocalities->getFoodBankContact($this->sublocality_id);
		$this->strPageName = $this->objCurrent['page_title'];
	
	}

	function showView() {

		$objCurrent = $this->objCurrent; //cause Bryan can't use classes , views needs to be updated
		$objCurrentContact = $this->objCurrentContact;


		if($this->strMethod == ''){ //main view

			include_once(ROOT_DIR.'/views/foodbank.php'); 

		}

	}



	

}