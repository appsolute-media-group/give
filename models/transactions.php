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
	public $strActiveServerURL;
	private $merchantAuthentication;


	public function __construct() {

		parent::__construct();
		$this->strErrorMessage = "";
		$this->strTableName = "app_transactions";
		
    	$this->API_SANDBOX = "https://apitest.authorize.net";
    	$this->API_PRODUCTION = "https://api2.authorize.net";


    	//set this to switch between live and sandbox
    	$this->strActiveServerURL = $this->API_SANDBOX;

		$objSubLocalities = new SubLocalities;
		$objSubDetails = $objSubLocalities->getAPIAuthNetKey($_SESSION['sublocality_id']); //this comes from the users session variables
		$strAPI_Login = $objSubDetails['API_Login'];
		$strAPI_Key = $objSubDetails['API_Key'];

		// Common setup for API credentials
		$this->merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
		$this->merchantAuthentication->setName($strAPI_Login);
		$this->merchantAuthentication->setTransactionKey($strAPI_Key);



	}



	function getPaymentProfiles(){

		

		$request = new AnetAPI\GetCustomerProfileRequest();
		$request->setMerchantAuthentication($this->merchantAuthentication);
		$request->setCustomerProfileId($_SESSION['APIprofileID']);

		$controller = new AnetController\GetCustomerProfileController($request);

		$response = $controller->executeWithApiResponse($this->strActiveServerURL);



		if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
		{
			//echo "GetCustomerProfile SUCCESS : " .  "<br />";
			$profileSelected = $response->getProfile();
			$paymentProfilesSelected = $profileSelected->getPaymentProfiles();
			//echo "Profile Has " . count($paymentProfilesSelected). " Payment Profiles" . "<br />";
			//Util::dump($paymentProfilesSelected[0]->getCustomerPaymentProfileId());

			$this->arrResult = array(
				"result" => "success", 
				"reason" => "",
				"code" => "",
				"error" => "",
				"paymentprofileid" => $paymentProfilesSelected[0]->getCustomerPaymentProfileId()
				);

		}
		else
		{
			//echo "ERROR :  GetCustomerProfile: Invalid response<br />";
			$errorMessages = $response->getMessages()->getMessage();
			//echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "<br />";


			$this->arrResult = array(
				"result" => "error", 
				"reason" => "Failed to find payment profile",
				"code" => $errorMessages[0]->getCode(),
				"error" => $errorMessages[0]->getText(),
				"paymentprofileid" => ""
				);

		}

		return $this->arrResult;

	}


	function ProcessProfileTransaction($profileid,$paymentprofileid, $objDetails){
		
		$refId = 'ref' . time();
		
		$profileToCharge = new AnetAPI\CustomerProfilePaymentType();
	    $profileToCharge->setCustomerProfileId($profileid);
	    $paymentProfile = new AnetAPI\PaymentProfileType();
	    $paymentProfile->setPaymentProfileId($paymentprofileid);
	    $profileToCharge->setPaymentProfile($paymentProfile);

	    $transactionRequestType = new AnetAPI\TransactionRequestType();
	    $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
	    $transactionRequestType->setAmount($objDetails['Amount']);
	    $transactionRequestType->setProfile($profileToCharge);

	    $request = new AnetAPI\CreateTransactionRequest();
		$request->setMerchantAuthentication($this->merchantAuthentication);//from above
		$request->setRefId( $refId);//from above
		$request->setTransactionRequest($transactionRequestType);//from above
		$controller = new AnetController\CreateTransactionController($request);


		//this posts the actual request to authorize.net
		$response = $controller->executeWithApiResponse($this->strActiveServerURL);

		//used to insert the data into the tranaction table
		$transTableVals = array($_SESSION['userID'], $_SESSION['sublocality_id'], $objDetails['Type'], $objDetails['Amount']);
		if ($response != null) {
		    $tresponse = $response->getTransactionResponse();

		    if (($tresponse != null) && ($tresponse->getResponseCode()== 1) ) {
		      
		      echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "<br />";
		      echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "<br />";


		      $this->arrResult = array(
		      	"result" => "success", 
		      	"AuthCode" => $tresponse->getAuthCode(),
		      	"TransID" => $tresponse->getTransId()
		      	);


			  array_push($transTableVals,'success',$tresponse->getAuthCode(),$tresponse->getTransId());

		} else {

		        
		        //echo  "Charge Credit Card ERROR :  Invalid response<br />";

        		$errorNotice = $response->getMessages()->getMessage();
				//echo "Response : " . $errorNotice[0]->getCode() . "  " .$errorNotice[0]->getText() . "<br />";

        		$errorMessages = $tresponse->getErrors();
        		$errorMessages = $errorMessages[0];
				$errorMessageText = $errorMessages->getErrorText();
				$errorMessageCode = $errorMessages->getErrorCode();
				//echo "Error Code : " . $errorMessageCode . "<br />";
				//echo "Error Text : " . $errorMessageText . "<br />";

        		$this->arrResult = array(
		      	"result" => "error", 
		      	"code" => $errorMessages->getErrorCode(),
		      	"error" => $errorMessages->getErrorText(),
      			"userdetails" => $objDetails
		      	);

	
				array_push($transTableVals,'error',$errorMessages->getErrorCode(),$errorMessages->getErrorText());
		    }


		}


		//record the transaction in the local database
		$keys = array('userID','sublocality_id','trans_type','trans_amount','trans_details','trans_code','trans_data');
		$r = $this->mysqliinsert($keys,$transTableVals);
	

	  	return $this->arrResult;

	}





	function processWebTransaction($ccnum,$ccexpire,$cccode,$objDetails,$objCustomer) {

		$this->arrResult = array(
      	"result" => "error", 
      	"reason" => "Charge Credit card Null response returned",
      	"code" => "",
      	"error" => "",
      	"userdetails" => $objDetails
      	);

		$refId = 'ref' . time();

		// Create the payment data for a credit card
		$creditCard = new AnetAPI\CreditCardType();
		$creditCard->setCardNumber($ccnum);//method parameter
		$creditCard->setExpirationDate($ccexpire);//method parameter
		$creditCard->setCardCode($cccode);//method parameter

		$paymentOne = new AnetAPI\PaymentType();
		$paymentOne->setCreditCard($creditCard);//from above


		$order = new AnetAPI\OrderType();
		$order->setDescription($objDetails['Description']);//method parameter

		
		// Create the Bill To info
		$billto = new AnetAPI\CustomerAddressType();
		$billto->setFirstName($objCustomer['first_name']);
		$billto->setLastName($objCustomer['last_name']);
		//$billto->setCompany("Souveniropolis");
		$billto->setAddress($objCustomer['address']);
		$billto->setCity($objCustomer['city']);
		$billto->setState($objCustomer['state']);
		$billto->setZip($objCustomer['postal']);
		$billto->setCountry($objCustomer['country']);

		//create a transaction
		$transactionRequestType = new AnetAPI\TransactionRequestType();
		$transactionRequestType->setTransactionType( "authCaptureTransaction"); 
		$transactionRequestType->setAmount($objDetails['Amount']); //method parameter
		$transactionRequestType->setOrder($order); //from above
		$transactionRequestType->setPayment($paymentOne);//from above


		$transactionRequestType->setBillTo($billto);

		$request = new AnetAPI\CreateTransactionRequest();
		$request->setMerchantAuthentication($this->merchantAuthentication);//from above
		$request->setRefId( $refId);//from above
		$request->setTransactionRequest($transactionRequestType);//from above
		$controller = new AnetController\CreateTransactionController($request);


		//this posts the actual request to authorize.net
		$response = $controller->executeWithApiResponse($this->strActiveServerURL);

		//used to insert the data into the tranaction table
		$transTableVals = array($_SESSION['userID'], $_SESSION['sublocality_id'], $objDetails['Type'], $objDetails['Amount']);

		if ($response != null) {
		    $tresponse = $response->getTransactionResponse();

		    if (($tresponse != null) && ($tresponse->getResponseCode()== 1) ) {
		      
		      echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "<br />";
		      echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "<br />";


		      $this->arrResult = array(
		      	"result" => "success", 
		      	"AuthCode" => $tresponse->getAuthCode(),
		      	"TransID" => $tresponse->getTransId()
		      	);


			  array_push($transTableVals,'success',$tresponse->getAuthCode(),$tresponse->getTransId());


			  //create a profile


				$customerProfile = new AnetAPI\CustomerProfileBaseType();
				$customerProfile->setDescription("Web Portal Customer");
				$customerProfile->setMerchantCustomerId("X_".$_SESSION['userID']);
				$customerProfile->setEmail($_SESSION['email']);
	
				$new_request = new AnetAPI\CreateCustomerProfileFromTransactionRequest();
				$new_request->setMerchantAuthentication($this->merchantAuthentication);
				$new_request->setTransId($tresponse->getTransId());
				$new_request->setCustomer($customerProfile);

				$new_controller = new AnetController\CreateCustomerProfileFromTransactionController($new_request);
				$new_response = $new_controller->executeWithApiResponse($this->strActiveServerURL);

				if (($new_response != null) && ($new_response->getMessages()->getResultCode() == "Ok") )
				{
				  echo "SUCCESS: PROFILE ID : " . $new_response->getCustomerProfileId() . "<br />";

				  $ProfileId = $new_response->getCustomerProfileId();


				}
				else
				{
				  echo "ERROR :  Invalid response<br />";
				  $errorMessages = $new_response->getMessages()->getMessage();
				  echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "<br />";

				  Util::dump($new_response);
				  $ProfileId = '';
				}

				//update the user profile
			    $keys = array('user_points','APIprofileID');
			    $vals = array($_SESSION['user_points'],$ProfileId);

			    $r = $this->mysqliupdate('user_profiles',$keys,$vals,$_SESSION['userID'],'id');

				$_SESSION['APIprofileID'] = $ProfileId;
				$_SESSION['user_points'] = $_SESSION['user_points']+ ($objDetails['Amount']*100);

		    } else {

		        
		        //echo  "Charge Credit Card ERROR :  Invalid response<br />";

        		$errorNotice = $response->getMessages()->getMessage();
				//echo "Response : " . $errorNotice[0]->getCode() . "  " .$errorNotice[0]->getText() . "<br />";

        		$errorMessages = $tresponse->getErrors();
        		$errorMessages = $errorMessages[0];
				$errorMessageText = $errorMessages->getErrorText();
				$errorMessageCode = $errorMessages->getErrorCode();
				//echo "Error Code : " . $errorMessageCode . "<br />";
				//echo "Error Text : " . $errorMessageText . "<br />";

        		$this->arrResult = array(
		      	"result" => "error", 
		      	"code" => $errorMessages->getErrorCode(),
		      	"error" => $errorMessages->getErrorText(),
      			"userdetails" => $objDetails
		      	);

	
				array_push($transTableVals,'error',$errorMessages->getErrorCode(),$errorMessages->getErrorText());
		    }


		}


		//record the transaction in the local database
		$keys = array('userID','sublocality_id','trans_type','trans_amount','trans_details','trans_code','trans_data');
		$r = $this->mysqliinsert($keys,$transTableVals);
	

	  	return $this->arrResult;

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