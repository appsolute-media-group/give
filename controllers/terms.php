<?php


class terms_controller {

	public $strMethod = "";
	public $intUserId = "";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
	

		if($this->strMethod == ''){ //main view

			$this->objTerms = new InfoPages;


			$this->pageName = "terms";
			$objTerms = $this->objTerms->getInfoPageData($this->pageName);


			$this->pageName = "privacy";
			$objPrivacy = $this->objTerms->getInfoPageData($this->pageName);

			include_once(ROOT_DIR.'/views/terms.php'); 

		}
	
	}

}