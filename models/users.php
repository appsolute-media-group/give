<?php


class Users extends Database  {

	public $strQuery;
	public $arrResult;
	public $strTableName;
	public $objDB;
	public $intAffectedRows;
	public $intColumns;
	public $strErrorMessage;
	public $strLoginErrorMessage;
	public $strSuccessMessage;
	public $strPassword;
	public $strUsername;
	public $strUseremail;
	public $strTimeout; 
	public $intTokenLength; 
	public $referalCode = '';
	public $strSublocality = '';



	public function __construct() {

		parent::__construct();
		$this->strErrorMessage = "";
		$this->strLoginErrorMessage = "";
		$this->strTableName = "user_profiles";
		$this->strTimeout = "-90 minutes"; //the timeout length for tokens
		$this->intTokenLength = "35"; //the string length for tokens


	}

	function deleteCard() {

		$userID = $_SESSION['userID'];
		$_SESSION['APIprofileID'] = '';
		
		$res = $this->short_query("UPDATE $this->strTableName SET APIprofileID=Null WHERE id=".$userID);
		
		if($res) {

			$arrResult = array('result' => "success",'code' => "deleted", "details" => $res);

		} else {

			$arrResult = array('result' => "error",'code' => "??", "details" => $res);
		}

        return json_encode($arrResult);




	}


	function updateWebUser($objData) {
	
		//$sublocality_id = $_SESSION['sublocality_id'];
		$user_id = $_SESSION['userID'];
	
		$keys = array(
			'first_name',
			'last_name',
			'sublocality_id',
			'tax_address',
			'tax_city',
			'tax_prov',
			'tax_country',
			'tax_pc');

		$vals = array(
			$objData->strFirstName,
			$objData->strLastName,
			$objData->intSublocalityId,
			$objData->strAddress,
			$objData->strCity,
			$objData->strProvince,
			$objData->strCountry,
			$objData->strPostal);

		$error_message = $this->mysqliupdate('user_profiles',$keys,$vals,$user_id,'id');

		$_SESSION['sublocality_id'] = $objData->intSublocalityId;


		if($error_message != '') {
			$arrResult = array('result' => "error",'code' => "update-fail","details" => $error_message, 'vals' => $vals);
		} else {
			$arrResult = array('result' => "success",'code' => "record updated", "details" => array("vals" => $vals));
		}

		return json_encode($arrResult);

	}




	function validateCode(){


		//http://givedemo.clubappetite.com/api/validatecode/1/
		$this->referalCode = isset($_GET['var1']) ? $_GET['var1'] : '';
		$arrData = array('result' => "error" , "code"=>"Invalid", "details"=>"The code you have entered is not valid:".$this->referalCode);
		
		

		if(!empty($this->referalCode) && $this->referalCode != ''){
			
			$res = $this->getUserByCode($this->referalCode);
			if(!empty($res[0])){
				//valid code
				$arrData = array('result' => "success","code"=>"Valid", "details"=>"The code you have entered is valid");
			}

			$res2 = $this->getSponsorByCode($this->referalCode);
			if(!empty($res2[0])){
				//valid code
				$arrData = array('result' => "success","code"=>"Valid", "details"=>"The code you have entered is valid");
			}

		}

		return json_encode($arrData);


	}




	function updateProfile($vals){

		//update the user profile with the new Profile ID from suthorize.net
		$keys = array('APIprofileID','first_name','last_name', 'tax_address', 'tax_pc', 'tax_country', 'tax_prov', 'tax_city');


		$r = $this->mysqliupdate('user_profiles',$keys,$vals,$_SESSION['userID'],'id');
		$_SESSION['APIprofileID'] = $vals[0];


	}



	function registerFromWebpage() {

		
		$this->strUseremail = isset($_POST['signup_email']) ? $_POST['signup_email'] : '';
		$this->strPassword = isset($_POST['signup_password']) ? $_POST['signup_password'] : '';
		$this->strUsername = isset($_POST['signup_username']) ? $_POST['signup_username'] : '';
		$this->strSublocality = isset($_POST['sublocality']) ? $_POST['sublocality'] : '';
		$this->referalCode = isset($_POST['referalCode']) ? $_POST['referalCode'] : '';


		do {

			if($this->strUseremail == '' || (filter_var($this->strUseremail, FILTER_VALIDATE_EMAIL) === false)){
				$this->strErrorMessage = "Please enter a valid email address";
				break;
			}

			if($this->strUseremail == ''){
				$this->strErrorMessage = "Please enter an email address";
				break;
			} else {	
				$res = $this->checkForUser($this->strUseremail);
				if(!empty($res)){
					$this->strErrorMessage = "That email address is already in our system";
					break;
				}
			}

			if($this->strPassword == ''){
				$this->strErrorMessage = "Please enter a password";
				break;
			}

			if($this->strSublocality == '0'){
				$this->strErrorMessage = "Please enter a food bank";
				break;
			} else {

				$objSub = new SubLocalities;
				$sublocality = $objSub->verifySubLocalityId($this->strSublocality);
				if($sublocality === false){
					$this->strErrorMessage = "Please enter a valid food bank";
					break;
				}
			}
			break;
		} while ($this->strErrorMessage == "");



		//handle the referal code
		$validCode = false;

		if(!empty($this->referalCode) && $this->referalCode != ''){
			

			$res = $this->getUserByCode($this->referalCode);
			if(!empty($res[0])){
				//valid code, this user gets 500 points
				$subquery = "UPDATE $this->strTableName SET user_points = (user_points+500) WHERE refer_code ='$this->referalCode'";
				if($this->short_query( $subquery )){
					//we can just be quiet		
				}
				$validCode = true;
			}

			$res2 = $this->getSponsorByCode($this->referalCode);
			if(!empty($res2[0])){
				//valid code, this user gets 500 points
				$validCode = true;
			}

		}

		if(!$validCode){

			$this->referalCode = null;

		}

		if($this->strErrorMessage == "") {

			$referralCode = '';

			$keys = array("sublocality_id", "name", "password", "email", "refer_code_used");
			$vals = array($sublocality, $this->strUsername, $this->strPassword, $this->strUseremail, $this->referalCode);

			$this->mysqliinsert($keys,$vals);

			$_SESSION['userID'] = $this->insert_id;
			$_SESSION['name'] = $this->strUsername;
			$_SESSION['email'] = $this->strUseremail;
			$_SESSION['user_points'] = 0;
			$_SESSION['refer_code'] = '';
			$_SESSION['sublocality_id'] = $sublocality;
			$_SESSION['APIprofileID'] = "";

			if(!empty($this->referalCode) && $this->referalCode != ''){
				$res2 = $this->getSponsorByCode($this->referalCode);
				if(!empty($res2[0])){
					//valid code, this user gets 500 points
					$validCode = true;
					$keys = array("user_id", "sponsor_id", "referal_code");
					$vals = array($_SESSION['userID'], $res2[0]['id'], $this->referalCode);
					$this->mysqliinsert($keys,$vals,"sponsor_code_redeem");
				}		
			}

			echo "<script>window.location.href='/main/'</script>";

		}
	}

	function loginFromWebpage() {
	
		//http://localhost:83/login/?doLogin=true

		$this->strUseremail = isset($_POST['signin_email']) ? $_POST['signin_email'] : '';
		$this->strPassword = isset($_POST['signin_password']) ? $_POST['signin_password'] : '';

    	if ($this->strUseremail != '' && $this->strPassword != '') {


    		$this->strQuery = "SELECT id, `name`, first_name, last_name, email, picture, gender, sublocality_id, user_points, refer_code, APIprofileID 
				FROM user_profiles p
				WHERE email = '" . $this->getCleanVar($this->strUseremail) . "' and password = '" . $this->getCleanVar($this->strPassword) . "' LIMIT 0,1";

				//echo $this->strQuery;

				$this->intColumns = $this->getMysqliResults( $this->strQuery, true );

			
				if($this->intColumns == false) {

					$this->strLoginErrorMessage = "Invalid Login";
					return ('invalid login');

				} else {

					$results = $this->getMysqliResults( $this->strQuery, true );
					$results = $results[0];

					$_SESSION['userID'] = $results['id'];
					$_SESSION['name'] = $results['name'];
					$_SESSION['email'] = $results['email'];
					$_SESSION['user_points'] = $results['user_points'];
					$_SESSION['refer_code'] = $results['refer_code'];
					$_SESSION['sublocality_id'] = $results['sublocality_id'];
					$_SESSION['APIprofileID'] = $results['APIprofileID'];

					echo "<script>window.location.href='/main/'</script>";
					//return ('Valid login');

				}


			//return json_encode($this->getUserLogin());

		} else {

			$this->strLoginErrorMessage = "No e-mail or password";
			return "no email or password";


		}


	}











/*******************

these are for the rest api only


*/




	function register() {
		//http://restapidemo.clubappetite.com/api.php?controller=api&action=register&username=test&password=1234&sublocality=1&email=test@test.com&referralCode=IuLuM0Lg
		//http://restapi.clubappetite.com/api.php?controller=api&action=register&username=&password=&sublocality=&email=

		$data = json_decode(file_get_contents("php://input"));
		$arrData = array('result' => "error");

		if (!empty($data)) {
			$username = isset($data->username) ? $data->username : '';
			$password = isset($data->password) ? $data->password : '';
			$email = isset($data->email) ? $data->email : '';
			$sublocality = $data->sublocality;
			$referralCode = $data->referralCode;
		} else {
			$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
			$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
			$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
			$sublocality = isset($_REQUEST['sublocality']) ? $_REQUEST['sublocality'] : '';
			$referralCode = isset($_REQUEST['referralCode']) ? $_REQUEST['referralCode'] : '';
		}

		$validCode = false;

		if(!empty($referralCode) && $referralCode != ''){
			

			$res = $this->getUserByCode($referralCode);
			if(!empty($res[0])){
				//valid code, this user gets 500 points
				$subquery = "UPDATE $this->strTableName SET user_points = (user_points+500) WHERE refer_code ='$referralCode'";
				if($this->short_query( $subquery )){
					//we can just be quiet		
				}
				$validCode = true;
			}

			$res2 = $this->getSponsorByCode($referralCode);
			if(!empty($res2[0])){
				//valid code, this user gets 500 points
				$validCode = true;
			}

		}

		if(!$validCode){

			$referralCode = null;

		}


		//$this->mysqliinsert($keys,$vals, $table = '')
		$res = $this->checkForUser($email);
		if(empty($res) && $email != ''  && $password != '' ){

			$keys = array("sublocality_id", "name", "password", "email", "refer_code_used");
			$vals = array($sublocality, $username, $password, $email, $referralCode);

			$this->mysqliinsert($keys,$vals);

			$token = Util::generateToken($this->intTokenLength);
			$userID = $this->insert_id;

			$stmt = $this->updateToken($userID,$token);

			$arrData = array('result' => "success",  
				'token' => $token, 
				'userid' => $userID, 
				'name' => $username, 
				'first_name' => '', 
				'last_name' => '', 
				'email' => $email,
				'picture' => '',
				'gender' => '',
				'sublocality_id' => $sublocality,
				'user_points' => '0',
				);

			if(!empty($referralCode) && $referralCode != ''){
				$res2 = $this->getSponsorByCode($referralCode);
				if(!empty($res2[0])){
					//valid code, this user gets 500 points
					$validCode = true;
					$keys = array("user_id", "sponsor_id", "referal_code");
					$vals = array($userID, $res2[0]['id'], $referralCode);
					$this->mysqliinsert($keys,$vals,"sponsor_code_redeem");
				}		
			}


		} else {
			$arrData += array('code' => "1000", 'details' => "Email address already in system");
		}
			
		return json_encode($arrData);

	}


	function getUserByCode($refer_code){

		$this->strQuery = "SELECT id FROM $this->strTableName WHERE refer_code='".$this->getCleanVar($refer_code)."'";
		if($this->short_query( $this->strQuery )){
			$r = $this->getMysqliResults( $this->strQuery, true );
		} else {

			$r = false;
		}
		return $r;
	}

	function getSponsorByCode($refer_code){

		$this->strQuery = "SELECT id FROM sponsors WHERE referal_code='".$this->getCleanVar($refer_code)."'";
		if($this->short_query( $this->strQuery )){
			$r = $this->getMysqliResults( $this->strQuery, true );
		} else {

			$r = false;
		}
		return $r;
	}



	function checkForUser($email) {

		$this->strQuery = "SELECT id FROM user_profiles WHERE `email` ='$email'";
		if($this->query( $this->strQuery )) {
			$r = $this->getMysqliResults( $this->strQuery, true );
		} else {
			$r = null;
		}

		return $r;

	}




	function getUserLogin(){

		//$this->strPassword = Util::bcryptString($this->strPassword);

		$this->strQuery = "SELECT id, `name`, first_name, last_name, email, picture, gender, sublocality_id, user_points, refer_code 
				FROM user_profiles p
				WHERE LENGTH(name) > 0 And
				(name='" . $this->getCleanVar($this->strUsername) . "'";


		if($this->strUseremail != ''){
		
		$this->strQuery .= "OR email='" . $this->getCleanVar($this->strUseremail) . "'	";		
		
		}

		$this->strQuery .= " ) and password='" . $this->getCleanVar($this->strPassword) . "' LIMIT 0,1";

//echo $this->strQuery;

		
		$this->intColumns = $this->getMysqliResults( $this->strQuery, true );

	
		if($this->intColumns == false) {
			// if the email and password is not found:
			$arrData = array('result' => "error",
				"user" => $this->strUsername,
				"email" => $this->strUseremail,
				"pass" => $this->strPassword
				);

			$arrData = array('result' => "error");

			if($this->strUseremail != ''){
				return $arrData;
			} else {
				return json_encode($arrData); //bug in the username version
			}

		} else {

			$token = Util::generateToken($this->intTokenLength);

			$details = $this->intColumns[0];

			$stmt = $this->updateToken($details['id'],$token);

			$data = array('result' => "success",  
				'token' => $token, 
				'userid' => $details['id'], 
				'name' => $details['name'], 
				'first_name' => $details['first_name'], 
				'last_name' => $details['last_name'], 
				'email' => $details['email'],
				'picture' => $details['picture'],
				'gender' => $details['gender'],
				'sublocality_id' => $details['sublocality_id'],
				'user_points' => $details['user_points'],
				'refer_code' => $details['refer_code'],
				);

			if($this->strUseremail != ''){
				return $data;
			} else {
				return json_encode($data); //bug in the username version
			}
		}


	}

	function login() {
	
		//http://restapi.clubappetite.com/api.php?controller=api&action=login&email=kirk.walker@clubappetite.com&password=1234
		

		$data = json_decode(file_get_contents("php://input"));
		if (!empty($data)) {
			$this->strUsername = isset($data->username) ? $data->username : ''; //to be removed
			$this->strUseremail = isset($data->email) ? $data->email : '';
			$this->strPassword = isset($data->password) ? $data->password : '';
		} else {
			$this->strUsername = isset($_REQUEST['username']) ? $_REQUEST['username'] : ''; //to be removed
			$this->strUseremail = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
			$this->strPassword = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
		}

    	if (($this->strUsername != '' || $this->strUseremail != '') && $this->strPassword != '') {

			return json_encode($this->getUserLogin());

		} else {
			$arrData = array('result' => "error");

			return json_encode($arrData);

		}


	}




	function updateUser() {
	
		//http://restapi.clubappetite.com/api.php?controller=api&action=updateuser&token=0CszyPdfoWrIVRNMSPBGadfyToB4XZMg1u7&first_name=Kirk&last_name=Walker&gender=Male&link=https://www.facebook.com/app_scoped_user_id/969927779769085/&picture=https://scontent.xx.fbcdn.net/hprofile-xat1/v/t1.0-1/p50x50/12096097_902299173198613_3741974917058965816_n.jpg?oh=4dd1197d06cbec4372adab59c7551dc6&oe=5789E32F&locale=en_US&timezone=-7
			
		$data = json_decode(file_get_contents("php://input"));
		//$data = $_GET['token'];

		if (!empty($data)) {
			$token = isset($data->token) ? $data->token : '';
			$first_name = isset($data->first_name) ? $data->first_name : '';
			$last_name = isset($data->last_name) ? $data->last_name : '';
			$gender = isset($data->gender) ? $data->gender : '';
			$link = isset($data->link) ? $data->link : '';
			$picture = isset($data->picture) ? $data->picture : '';
			$locale = isset($data->locale) ? $data->locale : '';
			$timezone = isset($data->timezone) ? $data->timezone : '';
		} else {
			$token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
			$first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : '';
			$last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : '';
			$gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : '';
			$link = isset($_REQUEST['link']) ? $_REQUEST['link'] : '';
			$picture = isset($_REQUEST['picture']) ? $_REQUEST['picture'] : '';
			$locale = isset($_REQUEST['locale']) ? $_REQUEST['locale'] : '';
			$timezone = isset($_REQUEST['timezone']) ? $_REQUEST['timezone'] : '';
		}

		$arrResult = array('result' => "error");

		$res = $this->blnValidToken($token);
		if(empty($res)){

			$arrResult += array('details' => "Invalid token for this id",'token' => $token);
		
		} else {

			
			$res = $res[0];
			$sublocality_id = $res['sublocality_id'];
			$user_id = $res['userID'];
		
				
			$keys = array('first_name','last_name','gender','link','picture','locale','timezone');
			$vals = array($first_name,$last_name,$gender,$link,$picture,$locale,$timezone);

			$error_message = $this->mysqliupdate('user_profiles',$keys,$vals,$user_id,'id');

			if($error_message != '') {
				$arrResult = array('result' => "error",'code' => "update-fail","details" => $error_message);
			} else {
				$arrResult = array('result' => "success",'code' => "record updated", "details" => array("vals" => $vals));
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

		$res = $this->blnValidToken($token);
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




				
			$keys = array('amount','deal_id','user_id','sublocality_id');
			$vals = array($amount,$deal_id,$user_id,$sublocality_id);


			$error_message = $this->mysqliinsert($keys,$vals,'sponsor_deal_trans');

			if($error_message != '') {
				$arrResult += array('code2' => "update-fail","details" => $error_message);
			} else {
				$arrResult = array('result' => "success",'code' => "record updated", "details" => array("vals" => $vals) );
			}



		}

		return json_encode($arrResult);

	}






	function validateToken() {
	
		//http://restapi.clubappetite.com/api.php?controller=api&action=token&token=bWcwqy06Hrc1SiQaYZ2bk8BmvJNPnudFCsh&id=1
			
		$data = json_decode(file_get_contents("php://input"));

		if (!empty($data)) {
			$token = $data->token;
			$userID = $data->id;
			
		} else {
			$token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
			$userID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
		}

		$arrData = array('result' => "error");

		$res = $this->getTokenLastMod($token,$userID);
		if(empty($res)){
			$arrData += array('details' => "Invalid token for this id");
		} else {

			if(strtotime($res[0]['last_mod']) > strtotime($this->strTimeout)) {
		 	
			 	$this->updateToken($userID,$token);

				$arrData = array('result' => "success", 'token' => $token, "remaining" => strtotime($res[0]['last_mod']) - strtotime($this->strTimeout));
			
			 	
			} else {

				//create new token
				$token = Util::generateToken($this->intTokenLength);
				$this->updateToken($userID,$token);
				$arrData = array('result' => "success", 'token' => $token, 'last_mod' => strtotime($res[0]['last_mod']));
			}

		}

		return json_encode($arrData);

	}




	function getTokenLastMod($token,$ID) {

		$this->strQuery = "SELECT last_mod FROM tokens WHERE token ='$token' AND userID=$ID";
		if($this->query( $this->strQuery )) {
			$r = $this->getMysqliResults( $this->strQuery, true );
		} else {

			$r = null;
		}

		return $r;

	}



	function getTokenById($ID){

		$details = $this->getFieldByID($ID, 'tokens', 'token');
		return $details;

	}



	function blnValidToken($token){

		$this->strQuery = "SELECT t.userID, u.sublocality_id, u.user_points, u.refer_code    
		FROM tokens t 
		Left Join $this->strTableName u on u.id=t.userID 
		WHERE t.token ='".$this->getCleanVar($token)."'";

		if($this->query( $this->strQuery )) {
			$r = $this->getMysqliResults( $this->strQuery, true );
			
			$subquery = "UPDATE tokens set last_mod = now() WHERE token ='$token'";
			if($this->short_query( $subquery )){
				//we can just be quiet
				//echo 'token updated:'.$token;
			}

		} else {

			$r = false;
		}

		return $r;

	}





	function updateToken($ID,$token) {

		$q = "INSERT INTO tokens (last_mod, token, userID) VALUES (now(), '$token', $ID) ON DUPLICATE KEY UPDATE last_mod=now(), token='$token'";
		return $this->short_query( $q );

	}





	function showUserById($ID) {

		$details = $this->getByID($ID, $this->strTableName);
		return json_encode($details);

	}



	function showUsers() {

		$details = $this->getAll();
        
        if(!is_null($details)){
            $arrData = array('result' => "success","details" => $details);
        } else {
        	$arrData = array('result' => "error");	
        }

        return json_encode($arrData);

	}


    function getReferralCode() {


		//http://restapi.clubappetite.com/api.php?controller=api&action=getreferralcode&token=LqKWeD2oi3YKFzr5HM26BdTs6CqGohPav2q
		$data = json_decode(file_get_contents("php://input"));

		if (!empty($data)) {
			$token = $data->token;
		} else {
			$token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
		}
		
		/*
		this should be called whenever we ask for data from the api
		This confirms the user is loged into the app and requesting from there
		If the token is valid, it updates its last mod time
		*/
		$res = $this->blnValidToken($token);

		if(!$res){
			
			$arrResult = array('result' => "error", 'code' => "no-token", 'details' => "Invalid token", 'token' => $token);
		
		} else {

			$res = $res[0];
			$sublocality_id = $res['sublocality_id'];
			$user_id = $res['userID'];
			$refer_code = $res['refer_code'];


			if($refer_code == null){

				$refer_code = Util::generateToken(8);
				$keys = array('refer_code');
				$vals = array($refer_code);

				$error_message = $this->mysqliupdate('user_profiles',$keys,$vals,$user_id,'id');

				if($error_message != '') {
					$arrResult = array('result' => "error",'code' => "update-fail","details" => $error_message);
				}

			}

			$arrResult = array('result' => "success",'code' => "exists", "details" => array("refer_code" => $refer_code));

	    }

        return json_encode($arrResult);

	}


	function checkReferralCode() {


		//http://restapi.clubappetite.com/api.php?controller=api&action=checkreferralcode&code=
		$data = json_decode(file_get_contents("php://input"));

		if (!empty($data)) {
			$refer_code = $data->code;

		} else {
			$refer_code = isset($_REQUEST['code']) ? $_REQUEST['code'] : '';

		}

		$arrResult = array('result' => "error", 'code' => "no-code", 'details' => "Invalid code", 'refer_code' => $refer_code);

		$this->strQuery = "SELECT u.refer_code, u.id     
		FROM user_profiles u 
		WHERE u.refer_code ='" . $this->getCleanVar($refer_code) . "'";


		if($this->query( $this->strQuery )) {

			$r = $this->getMysqliResults( $this->strQuery, true );
			if (!empty($r)) {
				$res = $r[0];
				$refer_code = $res['refer_code'];
				$user_id = $res['id'];	

				//$arrResult = array('result' => "success",'code' => "exists", "details" => array("refer_code" => $refer_code,"user_id" => $user_id));
				$arrResult = array('result' => "success",'code' => "Code is valid!");
			}

		}


        return json_encode($arrResult);

	}


	function generateReferralCode() {


		$refer_code = Util::generateToken(8);
		$arrResult = array('result' => "success",'refer_code' => $refer_code);

		return json_encode($arrResult);

	}


}



?>
