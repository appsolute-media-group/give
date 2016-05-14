<?php


class Products extends Database  {

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
		$this->strTableName = "products";



	}


	function getWebProducts($product_ids) {

		$sublocality_id = $_SESSION['sublocality_id'];

		//this returns the full list of active records
		$this->strSubQuery = "(SELECT p.*, '0' As user_qty
		FROM $this->strTableName p 
		WHERE p.blnActive = 1 
		AND p.id in (SELECT product_id FROM needed_now_links WHERE charity_id=0)";

		if($product_ids != "") {
			$this->strSubQuery .= " AND p.id IN ($product_ids)";
		}

		$this->strSubQuery .= " ORDER BY p.id LIMIT 10) UNION 
		(SELECT p.*, '0' As user_qty
		FROM $this->strTableName p 
		WHERE p.blnActive = 1 
		AND p.id in (SELECT product_id FROM needed_now_links WHERE charity_id=$sublocality_id)";

		if($product_ids != "") {
			$this->strSubQuery .= " AND p.id IN ($product_ids)";
		}

		$this->strSubQuery .= " ORDER BY p.id LIMIT 10)";

		$details = $this->getMysqliResults( $this->strSubQuery, true );
		if(count($details) >0) {
       	 	return $details;
    	} else {
    		return null;
    	}

	}




	/********DO NOT USE ANYTHING BELOW THIS LINE**********/
    function getProducts() {


		$this->objUsers = new Users;

		//http://restapi.clubappetite.com/api.php?controller=api&action=products&token=cBPI8I2ZoX63zAQDT7vzvLjMwI1w0BtwlSc&last_mod=2016-03-15 00:09:07
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
			
			$arrResult = array('result' => "error", 'code' => "no-token", 'details' => "Invalid token", 'token' => $token, 'last_mod' => $last_mod);
		
		} else {

			$res = $res[0];
			$sublocality_id = $res['sublocality_id'];
			$user_id = $res['userID'];

			$arrResult = array('result' => "success",'code' => "no-refresh", "details" => 'No new products'); //this is the most likely response.

			//this first query checks to see if any new records have been posted since the last time the app checked.
			//this ignores the active switch. Deleted id's will be flagged with a new last_mod date and cause the list to be re-polled
			$this->strQuery = "SELECT 
				(SELECT max(last_mod) FROM $this->strTableName) As max_mod      
			FROM $this->strTableName  
			WHERE last_mod > '$last_mod'";

			if($this->query( $this->strQuery )) {

				$max_mod = $this->getMysqliResults( $this->strQuery, true );
				if(count($max_mod) >0) {
					$max_mod = $max_mod[0];

					//this returns the full list of active records
					$this->strSubQuery = "SELECT *, '0' As user_qty
					FROM $this->strTableName  
					WHERE blnActive = 1";

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
