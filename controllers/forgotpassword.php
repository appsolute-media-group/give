<?php


class forgotpassword_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $doRecover = '';
	public $strPageName = "Club Appetite - Forgot Password";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		$this->doRecover = isset($_POST['doRecover']) ? $_POST['doRecover'] : '';
		$this->objUsers = new Users;
		
		if($this->doRecover != ''){
			$result = $this->objUsers->recoverPassword();
			
		}

	}


	function showView() {

		include_once(ROOT_DIR.'/views/forgotpassword.php'); 

	}


}