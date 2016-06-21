<?php


class Sponsors extends Database  {

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
		$this->strTableName = "sponsors";

	}


	function getWebSponsors($searchTerm='') {

		$sublocality_id = $_SESSION['sublocality_id'];

		//this returns the full list of active sponsors
		$this->strSubQuery = "SELECT s.*,  
			concat((SELECT img_root FROM config WHERE id=1),(SELECT img_url FROM sponsor_img WHERE sponsor_id=s.id AND img_index=1)) As sponsor_img,
			concat((SELECT img_root FROM config WHERE id=1),(SELECT img_url FROM sponsor_img WHERE sponsor_id=s.id AND img_index=2)) As sponsor_img2 
		FROM $this->strTableName s 
		WHERE s.sublocality_id='$sublocality_id' 
		AND s.blnActive = 1 
		AND sponsor_type = 1 ";

		if($searchTerm != ''){
			$this->strSubQuery .= " AND sponsor_name like '%$searchTerm%'";
		}

		$this->strSubQuery .= " ORDER BY page_idx ASC";

		$details = $this->getMysqliResults( $this->strSubQuery, true );
		if (count($details) > 0) {
      $number_entries = count($details);
      for ($i=0; $i < $number_entries; $i++) {
        $details[$i]['sponsor_name']       = trim(($details[$i]['sponsor_name']));  
        $details[$i]['sponsor_url']        = trim(($details[$i]['sponsor_url']));  
        $details[$i]['sponsor_address']    = trim(($details[$i]['sponsor_address']));  

        $details[$i]['sponsor_slogan']     = trim(($details[$i]['sponsor_slogan']));  
        $details[$i]['sponsor_email']      = trim(($details[$i]['sponsor_email']));  
        $details[$i]['sponsor_city']       = trim(($details[$i]['sponsor_city']));  
        $details[$i]['sponsor_contact_nm'] = trim(($details[$i]['sponsor_city']));  
      }
      return $details;
    }
	}


	function getWebSponsorById($id) {

		$this->strSubQuery = "SELECT s.*,  
			concat((SELECT img_root FROM config WHERE id=1),(SELECT img_url FROM sponsor_img WHERE sponsor_id=s.id AND img_index=1)) As sponsor_img,
			concat((SELECT img_root FROM config WHERE id=1),(SELECT img_url FROM sponsor_img WHERE sponsor_id=s.id AND img_index=2)) As sponsor_img2,
			l.lat As centerLat, l.lng As centerLng  
		FROM $this->strTableName s 
		LEFT JOIN sublocalities l on l.id=s.sublocality_id 
		WHERE s.id='$id' 
		AND s.blnActive = 1";

		$details = $this->getMysqliResults( $this->strSubQuery, true );
		if (count($details) > 0) {
      $details[0]['sponsor_name']       = trim(($details[0]['sponsor_name']));  
      $details[0]['sponsor_url']        = trim(($details[0]['sponsor_url']));  
      $details[0]['sponsor_address']    = trim(($details[0]['sponsor_address']));  

      $details[0]['sponsor_slogan']     = trim(($details[0]['sponsor_slogan']));  
      $details[0]['sponsor_email']      = trim(($details[0]['sponsor_email']));  
      $details[0]['sponsor_city']       = trim(($details[0]['sponsor_city']));  
      $details[0]['sponsor_contact_nm'] = trim(($details[0]['sponsor_city'])); 
      return $details[0];
    }
	}

	function getWebSponsorContacts($id) {

		$this->strSubQuery = "SELECT s.* 
		FROM sponsor_contacts s 
		WHERE sponsor_id='$id'
		AND is_primary=1";
 

		$details = $this->getMysqliResults( $this->strSubQuery, true );
		if (count($details) > 0) {
      $details[0]['fname']      = trim(($details[0]['fname']));  
      $details[0]['lname']      = trim(($details[0]['lname']));  
      $details[0]['email']      = trim(($details[0]['email'])); 
      $details[0]['position']   = trim(($details[0]['position']));  
      return $details[0];
    }

	}






/****************

API functions only below this line 
*/



    function getSponsors() {


		$this->objUsers = new Users;

		//http://restapi.clubappetite.com/api.php?controller=api&action=sponsors&token=MprKnTIPthdtxDD6Y7xubvmcVOEjELAbrWm&last_mod=2016-03-15 00:09:07
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
				(SELECT max(last_mod) FROM $this->strTableName WHERE sublocality_id='$sublocality_id') As max_mod      
			FROM $this->strTableName s   
			WHERE s.sublocality_id='$sublocality_id' 
			AND s.last_mod > '$last_mod'";


			if($this->query( $this->strQuery )) {

				$max_mod = $this->getMysqliResults( $this->strQuery, true );

				if(count($max_mod) >0) {
					$max_mod = $max_mod[0];

					//this returns the full list of active sponsors
					$this->strSubQuery = "SELECT s.*,  
						(SELECT img_url FROM sponsor_img WHERE sponsor_id=s.id AND img_index=1) As sponsor_img,
						(SELECT img_url FROM sponsor_img WHERE sponsor_id=s.id AND img_index=2) As sponsor_img2 
					FROM $this->strTableName s 
					WHERE s.sublocality_id='$sublocality_id' 
					AND s.blnActive = 1 AND sponsor_type = 1";


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



?>