<?php


class login_controller {

	public $strMethod = "";
	public $doLogin = "";
	public $intUserId = "";
	public $arrSublocalities = array();
	public $listSublocalities = '';
	public $strPageName = "Club Appetite - Login";

	public function __construct() {

		$this->doLogin = isset($_POST['doLogin']) ? $_POST['doLogin'] : '';
		$this->doRegister = isset($_POST['doRegister']) ? $_POST['doRegister'] : '';

		//we need an instance of the user object
		$this->objUsers = new Users;
    // create an instance of the sublocatities object
		$this->objSubs = new SubLocalities;

    // get a list of food banks
		$tArray = $this->objSubs->getSubLocalityList();

    // separate food bank name out for the auto complete
		foreach($tArray As $sub){
			$this->arrSublocalities[] = $sub['sub_name'];
		}

		$this->arrSublocalities = json_encode($this->arrSublocalities);

    	$tdropdownArray = $this->objSubs->getSubLocality_dropdown_List(1);
		// create the list for populating a drop down for food banks
		$this->strSublocality = isset($_POST['sublocality']) ? $_POST['sublocality'] : '';
		$this->listSublocalities = Util::get_dropdown_items($tdropdownArray,$this->strSublocality);

		if($this->doLogin != ''){
			$result = $this->objUsers->loginFromWebpage();
			
		}

		if($this->doRegister != ''){
			$result = $this->objUsers->registerFromWebpage();
			
		}	
		//$objUsers = json_decode($this->objUsers->showUserById($this->intUserId)); //don't forget to convert from json to a php object

		//use this to see all the data being passed to the view
		//var_dump($objUsers);


		
	}






	function showView() {

		include_once(ROOT_DIR.'/views/login.php'); 

	}






}