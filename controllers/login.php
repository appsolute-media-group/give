<?php


class login_controller {

	public $strMethod = "";
	public $doLogin = "";
	public $intUserId = "";

	public function __construct() {

		$this->doLogin = isset($_POST['doLogin']) ? $_POST['doLogin'] : '';
		//we need an instance of the user object
		$this->objUsers = new Users;





		if($this->doLogin != ''){
			$result = $this->objUsers->loginFromWebpage();
			
		}
	
		//$objUsers = json_decode($this->objUsers->showUserById($this->intUserId)); //don't forget to convert from json to a php object

		//use this to see all the data being passed to the view
		//var_dump($objUsers);

		include_once(ROOT_DIR.'/views/login.php'); 

		

	}



}