<?php


class SponsorDeals extends Database  {

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
		$this->strTableName = "sponsor_deals";
		$this->objUsers = new Users;


	}


    function getSponsorDeals() {


		//http://restapi.clubappetite.com/api.php?controller=api&action=sponsordeals&token=&last_mod=2016-03-15 00:09:07&search=coffee
		$data = json_decode(file_get_contents("php://input"));

		if (!empty($data)) {
			$token = isset($data->token) ? $data->token : '';
			$last_mod = isset($data->last_mod) ? $data->last_mod : '';
			$searchTerm = isset($data->search) ? $data->search : '';
		} else {
			$token = isset($_GET['token']) ? $_GET['token'] : '';
			$last_mod = isset($_GET['last_mod']) ? $_GET['last_mod'] : '';
			$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
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
				(SELECT max(sd.last_mod) 
					FROM $this->strTableName sd 
					LEFT JOIN sponsors s On s.id=sd.sponsor_id 
					WHERE s.sublocality_id='$sublocality_id') 
			As max_mod      
			FROM $this->strTableName sd  
			LEFT JOIN sponsors s On s.id=sd.sponsor_id 
			LEFT JOIN sponsor_deal_cat dc on dc.id=sd.cat_id 
			WHERE s.sublocality_id='$sublocality_id' 
			AND sd.last_mod > '$last_mod'";


			if($searchTerm != '') {

				$this->strQuery .= " AND (deal_title like '%$searchTerm%' OR deal_desc like '%$searchTerm%' OR cat_title like '%$searchTerm%')";

			}

//echo ($this->strQuery);

			if($this->query( $this->strQuery )) {

				$max_mod = $this->getMysqliResults( $this->strQuery, true );

				if(count($max_mod) >0) {
					$max_mod = $max_mod[0];

					//this returns the full list of active sponsors
					$this->strSubQuery = "SELECT sd.id, sd.sponsor_id, 
						sd.deal_title, sd.deal_image, sd.deal_price, sd.barcode_image,
						sd.deal_short_desc, sd.deal_desc, sd.cat_id, dc.cat_title, sd.search_data    
					FROM $this->strTableName  sd
					LEFT JOIN sponsors s On s.id=sd.sponsor_id 
					LEFT JOIN sponsor_deal_cat dc on dc.id=sd.cat_id 
					WHERE s.sublocality_id='$sublocality_id' 
					AND sd.blnActive = 1";


					if($searchTerm != '') {

						$this->strSubQuery .= " AND (deal_title like '%$searchTerm%' OR deal_desc like '%$searchTerm%' OR cat_title like '%$searchTerm%')";

					}

//echo ($this->strSubQuery);


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







	function confirmDeal() {
	
		//http://restapi.clubappetite.com/api.php?controller=api&action=confirmdeal&token=0CszyPdfoWrIVRNMSPBGadfyToB4XZMg1u7&amount=5000$deal_id=1

		$data = json_decode(file_get_contents("php://input"));
		//$data = $_GET['token'];

		if (!empty($data)) {
			$token = isset($data->token) ? $data->token : '';
			$amount = isset($data->amount) ? $data->amount : '';
			$deal_id = isset($data->deal_id) ? $data->deal_id : '';
		} else {
			$token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
			$amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : '';
			$deal_id = isset($_REQUEST['deal_id']) ? $_REQUEST['deal_id'] : '';
		}

		$arrResult = array('result' => "error");

		$res = $this->objUsers->blnValidToken($token);
		if(empty($res)){

			$arrResult += array('details' => "Invalid token for this id",'token' => $token);
		
		} elseif($amount == '' || $deal_id == '') {
			
			$arrResult += array('details' => "Missing details",'token' => $token,'amount' => $amount,'deal_id' => $deal_id);

		} else {

			
			$res = $res[0];
			$sublocality_id = $res['sublocality_id'];
			$user_id = $res['userID'];
			$user_points = ($res['user_points']-$amount);

			$keys = array('user_points');
			$vals = array($user_points);

			$error_message = $this->mysqliupdate('user_profiles',$keys,$vals,$user_id,'id');
			if($error_message != '') {
				$arrResult += array('code' => "update-fail","details" => $error_message);
			//} else {
				//$arrResult = array('result' => "success",'code' => "points record updated", "details" => array("vals" => $vals));
			}


			$barcode = $this->getFieldByID($deal_id, 'sponsor_deals', 'barcode_image');

				
			$keys = array('amount','deal_id','user_id','sublocality_id');
			$vals = array($amount,$deal_id,$user_id,$sublocality_id);


			$error_message = $this->mysqliinsert($keys,$vals,'sponsor_deal_trans');

			if($error_message != '') {
				$arrResult += array('code2' => "update-fail","details" => $error_message);
			} else {
				$arrResult = array('result' => "success",'code' => "record updated" ) + $barcode;
			}



		}

		return json_encode($arrResult);

	}








}



?>