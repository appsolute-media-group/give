<?php


class contact_controller {

	public $strMethod = "";
	public $intUserId = "";


	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';

	}


	function showView() {

		include_once(ROOT_DIR.'/views/contact.php'); 

	}

}