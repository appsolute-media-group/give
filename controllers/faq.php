<?php


class faq_controller {

	public $strMethod = "";
	public $intUserId = "";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
	

		if($this->strMethod == ''){ //main view

			$this->objFaq = new Faq;

			$objFaq = $this->objFaq->getFaqQuestions();

			include_once(ROOT_DIR.'/views/faq.php'); 

		}
	
	}

}