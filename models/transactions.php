<?php


class Transactions extends Database  {

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
		$this->strTableName = "app_transactions";



	}


    function processTransaction() {


		$this->objUsers = new Users;

		//http://restapi.clubappetite.com/api.php?controller=api&action=transaction&token=&first_name=kirk&last_name=walker&amount=10
		$data = json_decode(file_get_contents("php://input"));

		if (!empty($data)) {
			$token = $data->token;
			$first_name = $data->first_name;
			$last_name = $data->last_name;
			$amount = $data->amount;
		} else {
			$token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
			$first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : '';
			$last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : '';
			$amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : '';
		}
		
		/*
		this should be called whenever we ask for data from the api
		This confirms the user is loged into the app and requesting from there
		If the token is valid, it updates its last mod time
		*/
		$res = $this->objUsers->blnValidToken($token);
		$arrResult = array('result' => "error",'code' => "no-method");


		if(!$res){
			
			$arrResult = array(
				'result' => "error", 
				'code' => "no-token", 
				'details' => "Invalid token", 
				'token' => $token, 
				'first_name' => $first_name,
				'last_name' => $last_name,
				'amount' => $amount,
			);
		
		} else {

			$res = $res[0];
			$sublocality_id = $res['sublocality_id'];
			$user_id = $res['userID'];
			$user_points = $res['user_points'];

			//update the user profile
			$keys = array('user_points','first_name','last_name');
			$vals = array($user_points + ($amount*100), $first_name, $last_name);

			$error_message = $this->mysqliupdate('user_profiles',$keys,$vals,$user_id,'id');

			if($error_message != '') {

				$arrResult = array('result' => "error",'code' => "update-fail","details" => $error_message);

			} else {

				$arrResult = array(
					'result' => "success",
					'code' => "profile-updated", 
					"details" => array(
						'user_id' => $user_id, 
						'sublocality_id' => $sublocality_id,
						'user_points' => $user_points,
						'new_user_points' => $vals[0],
						'error_message' => $error_message,				
					)
				); 
			}


			//record the transaction
			$keys = array('userID','sublocality_id','trans_amount','trans_details');
			$vals = array($user_id, $sublocality_id, $amount, 'success');

			$error_message = $this->mysqliinsert($keys,$vals);

			if($error_message != '') {

				$arrResult = array('result' => "error",'code' => "insert-fail","details" => $error_message);

			} else {

				$arrResult = array(
					'result' => "success",
					'code' => "transaction-updated", 
					"keys" => $keys,
					"vals" => $vals,
					"details" => array(
						'user_id' => $user_id, 
						'sublocality_id' => $sublocality_id,
						'user_points' => $user_points,
						'new_user_points' => $vals[0],
						'error_message' => $error_message,				
					),
				);
				

			}

		}

		return json_encode($arrResult);

	}




}