<?php


class SponsorDealCats extends Database  {

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
		$this->strTableName = "sponsor_deal_cat";



	}



	function getWebDealCats() {

		$this->strSubQuery = "SELECT sdc.id, sdc.cat_title, sdc.search_data, sdc.icon_font  
		FROM $this->strTableName  sdc
		WHERE sdc.blnActive = 1";

		$details = $this->getMysqliResults( $this->strSubQuery, true );
		if(count($details) >0) {
       	 	return $details;
    	}

	}





    function getSponsorDealCats() {



		$this->objUsers = new Users;

		//http://restapi.clubappetite.com/api.php?controller=api&action=sponsors&token=fu6lPLWt3mM5SPQdQxkFXwJIfFZdylrq1DJ&last_mod=2016-03-15 00:09:07
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
		
		$arrResult = array('result' => "success");

		if(!$res){
			
			$arrResult = array('result' => "error", 'code' => "no-token", 'details' => "Invalid token.", 'token' => $token, 'last_mod' => $last_mod);
		
		} else {

			$res = $res[0];
			$sublocality_id = $res['sublocality_id'];
			$user_id = $res['userID'];

			$arrResult += array('code' => "no-refresh", "details" => 'No new sponsors for this locality'); //this is the most likely response.

			//this first query checks to see if any new messags have been posted since the last time the app checked.
			//this ignores the active switch. Deleted id's will be flagged with a new last_mod date and cause the list to be re-polled
			$this->strQuery = "SELECT 
				(SELECT max(last_mod) FROM $this->strTableName) 
			As max_mod      
			FROM $this->strTableName sdc  
			WHERE sdc.last_mod > '$last_mod'";



			if($this->query( $this->strQuery )) {

				$max_mod = $this->getMysqliResults( $this->strQuery, true );

				if(count($max_mod) >0) {
					$max_mod = $max_mod[0];

					//this returns the full list of active sponsors
					$this->strSubQuery = "SELECT sdc.id, sdc.cat_title, sdc.search_data  
					FROM $this->strTableName  sdc
					WHERE sdc.blnActive = 1";


					$details = $this->getMysqliResults( $this->strSubQuery, true );
					if(count($details) >0) {
		           	 	$arrResult = array('result' => "success",'code' => "refresh") + $max_mod + array("details" => $details);
		        	}
		        }
	        }
	    }

        return json_encode($arrResult);

	}	

}



?>