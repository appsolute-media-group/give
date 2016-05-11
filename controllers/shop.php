<?php


class shop_controller {

	public $strMethod = "";
	public $intUserId = "";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
	

		if($this->strMethod == ''){ //shop view

			$this->objProducts = new Products;

			include_once(ROOT_DIR.'/views/shop.php'); 

		}
	
	}

}