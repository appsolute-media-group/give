<?php


class cart_controller {

	public $strMethod = "";
	public $intUserId = "";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
	

		if($this->strMethod == ''){ //cart view

			include_once(ROOT_DIR.'/views/cart.php'); 

		}
	
	}

}