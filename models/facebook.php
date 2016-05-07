<?php


class Facebook extends Database  {

	public $strQuery;
	public $arrResult;
	public $intAffectedRows;
	public $intColumns;
	public $strErrorMessage;
	public $strSuccessMessage;
	public $strPassword;
	public $strUsername;
	public $stroken; 



	public function __construct() {

		parent::__construct();
		$this->strErrorMessage = "";






	}


	public function shareMessage() {

		//http://restapi.clubappetite.com/api.php?controller=api&action=sharefacebook&message=test&fbtoken=asfsadf

		$data = json_decode(file_get_contents("php://input"));
		if (!empty($data)) {
			$message = $data->message;
			$fbtoken = $data->fbtoken;
		} else {
			$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : '';
			$fbtoken = isset($_REQUEST['fbtoken']) ? $_REQUEST['fbtoken'] : '';
		}

		$fb = new Facebook\Facebook([
		  'app_id' => '852197224926830',
		  'app_secret' => '7f2f076d0c8a36a5b504c92049c3029e',
		  'default_graph_version' => 'v2.5',
		]);


		$fb->setDefaultAccessToken($fbtoken);

		try {
		  $response = $fb->get('/me');
		  $userNode = $response->getGraphUser();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}




		$arrResult = array('result' => "success",'code' => "no-refresh", "message" => $message, "Logged in as" => $userNode->getName());

		return json_encode($arrResult);

	}







}