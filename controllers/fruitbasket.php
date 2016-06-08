<?php


class fruitbasket_controller {

	public $strMethod = "";
	public $intUserId = "";


	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';

	}


	function showView() {

		include_once(ROOT_DIR.'/views/fruitbasket.php');  

	}



	function showMetaData(){

		echo "<link href='/scripts/videoplayer/assets/css/video-default.css' rel='stylesheet'>";



	}


}