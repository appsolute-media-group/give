<?php


class donate_controller {

	public $strMethod = "";
	public $intUserId = "";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
	

		if($this->strMethod == ''){ //main view

			include_once(ROOT_DIR.'/views/donate.php'); 

		} elseif($this->strMethod == 'form'){

			include_once(ROOT_DIR.'/views/ccform.php'); 

		} elseif($this->strMethod == 'thankyou'){

			include_once(ROOT_DIR.'/views/thankyou.php'); 

		}
	
	}

}