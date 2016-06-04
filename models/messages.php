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

		$this->strQuery = "SELECT m.id, 
		m.message_title, 
		m.message_content, 
		m.last_mod, 
		m.start_date, 
		m.end_date,
		a.fname,
		a.lname
         FROM $this->strTableName  m 
         left join users_admin a on a.id=m.author 
         WHERE (sublocality_id='$sublocality_id' OR all_foodbanks=1) AND 
               m.blnActive = 1 AND 
               m.blnApproved = 1";

		$details = $this->getMysqliResults( $this->strQuery, true );
		
    // step thru the array, checking the start and end dates


		//to be removed
    if (count($details) > 0) {
    	$today_str = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
    	$date_details = array();
    	for ($i=0; $i < count($details); $i++) {
        $is_ok        = true;
        $id           = $details[$i]['id'];    
        $msg_title    = trim(stripslashes($details[$i]['message_title']));  
        $msg_content  = trim(stripslashes($details[$i]['message_content'])); 
        $last_mod     = $details[$i]['last_mod'];    
        $start_date   = $details[$i]['start_date'];
        $end_date     = $details[$i]['end_date'];
        // check for null dates ('0000-00-00') and reset to ""
        $start_date     = Util::clear_empty_date($start_date);
        $end_date       = Util::clear_empty_date($end_date);
         // check for start and end dates
        if ($start_date > '' and $end_date > '') {
          $is_ok = ($today_str >= $start_date and $today_str <= $end_date);
        }
        if ($is_ok) {
          $date_details[$i]['id']              = $id;    
          $date_details[$i]['message_title']   = $msg_title;    
          $date_details[$i]['message_content'] = $msg_content;  
          $date_details[$i]['last_mod']        = $last_mod;    
          $date_details[$i]['start_date']      = $start_date;
          $date_details[$i]['end_date']        = $end_date;
          $date_details[$i]['fname']        = $details[$i]['fname'];
          $date_details[$i]['lname']        = $details[$i]['lname'];
        }
      }
      $details = $date_details;
    }
    return $details;
	}




	function getMessageById($id) {

		$this->strQuery = "SELECT 
			m.id, 
			m.message_title, 
			m.message_content, 
			m.last_mod, 
			a.fname, 
			a.lname 
		FROM $this->strTableName  m 
		left join users_admin a on a.id=m.author 
		WHERE m.id='$id' 
		AND m.blnActive = 1 AND m.blnApproved=1";

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
