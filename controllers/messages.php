<?php


class messages_controller {

	public $strMethod = "";
	public $intUserId = "";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
	

		if($this->strMethod == ''){ //main view

			include_once(ROOT_DIR.'/views/messages.php'); 

		} elseif($this->strMethod == 'details'){

			//include_once(ROOT_DIR.'/views/message_details.php'); 

		}
	
	}

}