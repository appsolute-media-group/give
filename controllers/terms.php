<?php


class terms_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $strPageName = "Club Appetite - Terms & Conditions";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		$this->objTerms = new InfoPages;

		$this->pageName = "terms";
		$this->objTerms = $this->objTerms->getInfoPageData($this->pageName);

	}


	function showView() {

		if($this->strMethod == ''){ //main view

			include_once(ROOT_DIR.'/views/terms.php'); 

		}

	}


}