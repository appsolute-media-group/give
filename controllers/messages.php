<?php


class messages_controller {

	public $strMessageId = "";
	public $intUserId = "";
	public $arrMessages;
	public $strPageName = "Club Appetite - Messages";

	public function __construct() {

		$this->strMessageId = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		$this->objMessages = new Messages;
		if($this->strMessageId == ''){ //main view

			$this->arrMessages = $this->objMessages->getMessageArray();

		} else {

			$this->arrMessages = $this->objMessages->getMessageById($this->strMessageId);

		}
	
	}



	function showView() {

		
		if($this->strMessageId == ''){ //main view

			include_once(ROOT_DIR.'/views/messages.php'); 

		} else {
	
			include_once(ROOT_DIR.'/views/message_details.php'); 

		}


	}


	

}