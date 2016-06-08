<?php


class notfound_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $strPageName = "Club Appetite - Page Not Found";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		

	}


	function showView() {

		include_once(ROOT_DIR.'/views/404.php'); 

	}


}