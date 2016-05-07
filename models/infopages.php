<?php


class InfoPages extends Database  {

	public $strQuery;
	public $arrResult;
	public $strTableName;
	public $objDB;
	public $intAffectedRows;
	public $intColumns;
	public $strErrorMessage;
	public $strSuccessMessage;
	public $strPassword;
	public $strUsername;



	public function __construct() {

		parent::__construct();
		$this->strErrorMessage = "";
		$this->strTableName = "info_pages";



	}

	public function getInfoPageData($name) {

		$result = array('result' => "error");

		if($name !='') {
	        $this->strQuery = "SELECT page_title, logo, `text`,`last_mod` From $this->strTableName WHERE `name`='$name'";
	        if($this->query($this->strQuery)) {
	            $details = $this->getMysqliResults($this->strQuery,true);
	            $details = $details[0];
	            $result = $details;
	        }
	    }
		return $result;

    }

    public function getInfoPages() {
    	
    	$this->objUsers = new Users;

		//http://appdev.appsolutemg.com/api.php?controller=api&action=infopage
		$data = json_decode(file_get_contents("php://input"));

		if (!empty($data)) {
			$token = $data->token;
			$last_mod = $data->last_mod;
		} else {
			$token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
			$last_mod = isset($_REQUEST['last_mod']) ? $_REQUEST['last_mod'] : '';
		}
		
		/*
		this should be called whenever we ask for data from the api
		This confirms the user is loged into the app and requesting from there
		If the token is valid, it updates its last mod time
		*/
		$res = $this->objUsers->blnValidToken($token);

		if(!$res){
			$arrResult = array('result' => "error", 'details' => "Invalid token.", 'token' => $token, 'last_mod' => $last_mod);
		} else {
			$res = $res[0];
			$sublocality_id = $res['sublocality_id'];
			$user_id = $res['userID'];
			$page_name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';

			if($page_name == 'foodbank'){
				//this is for food bank page only
				//We pull region data instead
				$this->objSubLocalities = new SubLocalities;
				$objCurrent = $this->objSubLocalities->getFoodBankInfo($sublocality_id);
				
			} else {
				//this is for any other infopage
				$objCurrent = $this->getInfoPageData($page_name);
			}

			$current_mod = $objCurrent['last_mod'];
			$page_title = $objCurrent['page_title'];
			$logo = $objCurrent['logo'];
			$current_text = array('text' => $objCurrent['text']);


			$arrResult = array(
				'token' => $token, 
				'sublocality_id' => $sublocality_id, 
				'page_name' => $page_name, 
				'last_mod' => $last_mod, 
				'page_title' => $page_title, 
				'logo' => $logo, 
				'current_mod' => $current_mod);


			if(strtotime($current_mod) > strtotime($last_mod) ){
				$arrResult = array_merge(array('result' => "update"),$arrResult);

				$arrResult = array_merge($arrResult, $current_text);
			} else {
				$arrResult = array_merge(array('result' => "nochanges"),$arrResult);
			}


		}

		
		return json_encode($arrResult);

	}



}



?>