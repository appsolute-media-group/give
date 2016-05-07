<?php

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;



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
	public $API_SANDBOX;
	public $API_PRODUCTION;


	public function __construct() {

		parent::__construct();
		$this->strErrorMessage = "";
		$this->strTableName = "app_transactions";
		
    	$this->API_SANDBOX = "https://apitest.authorize.net";
    	$this->API_PRODUCTION = "https://api2.authorize.net";


	}





	function processWebTransaction($subID,$amount) {

		// Common setup for API credentials
      $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
      $merchantAuthentication->setName('93pWcL9c');
      $merchantAuthentication->setTransactionKey('45Z2mz9bzTMq8B7M');
      $refId = 'ref' . time();
		

      // Create the payment data for a credit card
      $creditCard = new AnetAPI\CreditCardType();
      $creditCard->setCardNumber("5424000000000015");
      $creditCard->setExpirationDate("1220");
      $creditCard->setCardCode("999");

      $paymentOne = new AnetAPI\PaymentType();
      $paymentOne->setCreditCard($creditCard);//from above

      $order = new AnetAPI\OrderType();
      $order->setDescription("Web Portal Test");

      //create a transaction
      $transactionRequestType = new AnetAPI\TransactionRequestType();
      $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
      $transactionRequestType->setAmount($amount); //method parameter
      $transactionRequestType->setOrder($order); //from above
      $transactionRequestType->setPayment($paymentOne);//from above


  	  $request = new AnetAPI\CreateTransactionRequest();
      $request->setMerchantAuthentication($merchantAuthentication);//from above
      $request->setRefId( $refId);//from above
      $request->setTransactionRequest($transactionRequestType);//from above
      $controller = new AnetController\CreateTransactionController($request);
      $response = $controller->executeWithApiResponse($this->API_SANDBOX);


      if ($response != null) {
	        $tresponse = $response->getTransactionResponse();

	        if (($tresponse != null) && ($tresponse->getResponseCode()== 1) ) {
	          
	          echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "<br />";
	          echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "<br />";

	        } else {
	            
	            echo  "Charge Credit Card ERROR :  Invalid response<br />";
	            echo  "Charge Credit Card CODE : ".$tresponse->getResponseCode()."<br />";
	            //echo  "Charge Credit Card getTransactionResponse : ";
	           // print_r($tresponse)."<br />";


	            echo  "Charge Credit Card response : <pre>";
	            var_dump($response)."<br />";
	            echo "</pre>";
	        }
	        
      } else {

        echo  "Charge Credit card Null response returned";

      }
	   
	  //chargeCreditCard($amount);


      die();

	  return '';

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