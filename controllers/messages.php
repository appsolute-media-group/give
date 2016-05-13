<?php


class messages_controller {

	public $strMessageId = "";
	public $intUserId = "";
	public $arrMessages;

	public function __construct() {

		$this->strMessageId = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		$objMessages = new Messages;

		if($this->strMessageId == ''){ //main view

			$this->arrMessages = $objMessages->getMessageArray();

			include_once(ROOT_DIR.'/views/messages.php'); 

		} else {

			$this->arrMessages = $objMessages->getMessageById($this->strMessageId);
			
			include_once(ROOT_DIR.'/views/message_details.php'); 

		}
	
	}

}