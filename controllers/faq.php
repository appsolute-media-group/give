<?php


class faq_controller {

	public $strMethod = "";
	public $intUserId = "";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
	

		if($this->strMethod == ''){ //main view

			$this->objFaq = new InfoPages;
			$this->pageName = "faq";
			$objFaq = $this->objFaq->getInfoPageData($this->pageName);

			include_once(ROOT_DIR.'/views/faq.php'); 

		}
	
	}

}