<?php


class Messages extends Database  {

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
		$this->strTableName = "messages";



	}



	function getMessageArray() {

		$sublocality_id = $_SESSION['sublocality_id'];

		$this->strQuery = "SELECT id, message_title, message_content, last_mod
			FROM $this->strTableName  
			WHERE sublocality_id='$sublocality_id' 
			AND blnActive = 1  AND blnApproved=1";

		$details = $this->getMysqliResults( $this->strQuery, true );
		
		return $details;


	}

	function getMessageById($id) {

		$this->strQuery = "SELECT id, message_title, message_content, last_mod
			FROM $this->strTableName  
			WHERE id='$id' 
			AND blnActive = 1 AND blnApproved=1";

		$details = $this->getMysqliResults( $this->strQuery, true );
		if(count($details) >0) {
			return $details[0];
		} else{
			return null;
		}

	}




    function getMessages() {


		$this->objUsers = new Users;

		//http://restapi.clubappetite.com/api.php?controller=api&action=messages&token=cBPI8I2ZoX63zAQDT7vzvLjMwI1w0BtwlSc&last_mod=2016-03-15 00:09:07
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
			
			$arrResult = array('result' => "error", 'code' => "no-token", 'details' => "Invalid token.", 'token' => $token, 'last_mod' => $last_mod);
		
		} else {

			$res = $res[0];
			$sublocality_id = $res['sublocality_id'];
			$user_id = $res['userID'];

			$arrResult = array('result' => "success",'code' => "no-refresh", "details" => 'No new messages for this locality'); //this is the most likely response.

			//this first query checks to see if any new messags have been posted since the last time the app checked.
			//this ignores the active switch. Deleted id's will be flagged with a new last_mod date and cause the list to be re-polled
			$this->strQuery = "SELECT 
				(SELECT max(last_mod) FROM $this->strTableName WHERE sublocality_id='$sublocality_id') As max_mod      
			FROM $this->strTableName  
			WHERE sublocality_id='$sublocality_id' 
			AND last_mod > '$last_mod' AND blnApproved=1";




			if($this->query( $this->strQuery )) {

				$max_mod = $this->getMysqliResults( $this->strQuery, true );
				if(count($max_mod) >0) {
					$max_mod = $max_mod[0];

					//this returns the full list of active messages
					//a subqury returns the highest last_mod that will be used to poll for new messages later
					$this->strSubQuery = "SELECT id, message_title, message_content, last_mod
					FROM $this->strTableName  
					WHERE sublocality_id='$sublocality_id' 
					AND blnActive = 1  AND blnApproved=1";

					$details = $this->getMysqliResults( $this->strSubQuery, true );
					if(count($details) >0) {
		           	 	$arrResult = array('result' => "success",'code' => "refresh") + $max_mod + array("details" => $details);
		        	}
		        } else {


		        	$arrResult = array('result' => "success",'code' => "no-records", "details" => 'No results'); 
		        }
	        }
	    }

        return json_encode($arrResult);

	}	

}
