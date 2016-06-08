<?php


class main_controller {

	public $strMethod = "";
	public $intUserId = "";


	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';

	}

	function showView() {

		if($this->strMethod == 'logout') {

			session_unset();
		    session_destroy();
		    session_write_close();
			echo "<script>window.location.href='/login/'</script>";
			
		} else {

			include_once(ROOT_DIR.'/views/mainpage.php'); 

		} 

	}



}