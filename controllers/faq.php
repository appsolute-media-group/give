<?php


class faq_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $strPageName = "Club Appetite - Frequently Asked Questions";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		$this->objFaq = new Faq;
		$this->objFaq = $this->objFaq->getFaqQuestions();
	
	}


	function showView() {

		if($this->strMethod == ''){ //main view

			include_once(ROOT_DIR.'/views/faq.php');  

		}

	}


}