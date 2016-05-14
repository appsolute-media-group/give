<?php


class cart_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $objProducts = "";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		$this->objProducts = new Products;

		if($this->strMethod == ''){ //cart view


			$arrProducts = $this->objProducts->getWebProducts("");

			include_once(ROOT_DIR.'/views/cart.php'); 

		} elseif($this->strMethod == 'checkout'){

			$this->handleCheckout();

		} elseif($this->strMethod == 'form'){

			//$this->handleForm();

		}
	
	}



	function handleCheckout() {


		//Util::dump($_POST);
		$arrQty = isset($_REQUEST['user_qty']) ? $_REQUEST['user_qty'] : '';
		$arrPid = isset($_REQUEST['product_id']) ? $_REQUEST['product_id'] : '';


		$idx = 0;
		$pids = array();

		foreach($arrQty As $a){
			if($a > 0){
				//echo "Adding product " . $arrPid[$idx] . "x" . $a . "<br />";
				$pids[] = $arrPid[$idx];
			}
			$idx++;
		}

		$arrProducts = $this->objProducts->getWebProducts(implode(",", $pids));

		//Util::dump($arrProducts);

		include_once(ROOT_DIR.'/views/checkout.php');

	}




}