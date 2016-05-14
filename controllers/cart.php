<?php


class cart_controller {

	public $strMethod = "";
	public $intUserId = "";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		$objProducts = new Products;

		if($this->strMethod == ''){ //cart view


			$arrProducts = $objProducts->getWebProducts();

			include_once(ROOT_DIR.'/views/cart.php'); 

		}
	
	}

}