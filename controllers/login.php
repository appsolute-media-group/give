<?php


class login_controller {

	public $strMethod = "";
	public $doLogin = "";
	public $intUserId = "";
	public $arrSublocalities = array();

	public function __construct() {

		$this->doLogin = isset($_POST['doLogin']) ? $_POST['doLogin'] : '';
		$this->doRegister = isset($_POST['doRegister']) ? $_POST['doRegister'] : '';

		//we need an instance of the user object
		$this->objUsers = new Users;

		$this->objSubs = new SubLocalities;
		$tArray = $this->objSubs->getSubLocalityList();

		foreach($tArray As $sub){
			$this->arrSublocalities[] = $sub['sub_name'];
		}

		$this->arrSublocalities = json_encode($this->arrSublocalities);

		if($this->doLogin != ''){
			$result = $this->objUsers->loginFromWebpage();
			
		}

		if($this->doRegister != ''){
			$result = $this->objUsers->registerFromWebpage();
			
		}	
		//$objUsers = json_decode($this->objUsers->showUserById($this->intUserId)); //don't forget to convert from json to a php object

		//use this to see all the data being passed to the view
		//var_dump($objUsers);

		include_once(ROOT_DIR.'/views/login.php'); 

		

	}











}