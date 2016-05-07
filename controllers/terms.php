<?php


class terms_controller {

	public $strMethod = "";
	public $intUserId = "";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
	

		if($this->strMethod == ''){ //main view

			include_once(ROOT_DIR.'/views/terms.php'); 

		}
	
	}

}