<?php


class foodbank_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $sublocality_id = "";


	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		$this->sublocality_id = $_SESSION['sublocality_id'];


		$this->objSubLocalities = new SubLocalities;

		$objCurrent = $this->objSubLocalities->getFoodBankInfo($this->sublocality_id);
		$objCurrentContact = $this->objSubLocalities->getFoodBankContact($this->sublocality_id);

		if($this->strMethod == ''){ //main view

			include_once(ROOT_DIR.'/views/foodbank.php'); 

		}
	
	}



	

}