<?php


class donate_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $strErrorMessage = "";
	public $decAmount = "";
	public $intFreq = "";
	public $intAwardAmount = 0;
	public $strCCnum =  "";
	public $strCCmonth = "";
	public $strCCyear = "";
	public $strCCcode = "";
	public $strFirstName = "";
	public $strLastName = "";
	public $strAddress = "";
	public $strCity = "";
	public $strProvince = "";
	public $strCountry = "";
	public $strPostal = "";
	private $objPayProfile;
	public $intPayProfileId;
	public $strPageName = "Club Appetite - Donations";

	public function __construct() {

		$this->strMethod = isset($_GET['method']) ? $_GET['method'] : '';
	
	}



	

	function showView() {


		if($this->strMethod == ''){ //main view

			include_once(ROOT_DIR.'/views/donate.php'); 

		} elseif($this->strMethod == 'form'){

			$this->decAmount = isset($_POST['amount']) ? $_POST['amount'] : '';
			$this->intAwardAmount = $this->decAmount*100;
			$this->intFreq = isset($_POST['freq']) ? $_POST['freq'] : '1';

			if($_SESSION['APIprofileID'] == ''){
				$this->handleForm();
			} else {
				$this->handleProfile();
			}

		} elseif($this->strMethod == 'thankyou'){

			include_once(ROOT_DIR.'/views/thankyou.php'); 

		}

	}




	function handleProfile(){

		$objTrans = new Transactions();
		$this->objPayProfile = $objTrans->getPaymentProfiles();

		$this->intPayProfileId = $this->objPayProfile['paymentprofileid'];



		if(isset($_POST['doPost'])){

			//$this->intPayProfileId = isset($_POST['paymentprofileid']) ? $_POST['paymentprofileid'] : '';

			if($this->decAmount == ''){

				$this->strErrorMessage = "Please choose an amount";
				include_once(ROOT_DIR.'/views/donate.php');

			} else {

				$transactionDetails = array("Description" => $this->getFequencyString($this->intFreq) . " Club Appetite donation", 
						"Amount" => $this->decAmount,
						'Type' => 1);//to seperate donation page(1) from product page(2) transactions

				$objTransDetails = $objTrans->ProcessProfileTransaction($_SESSION['APIprofileID'], $this->intPayProfileId, $transactionDetails);
				if($objTransDetails['result']=="error"){

					$this->strErrorMessage = $objTransDetails['error']."<br />";
					include_once(ROOT_DIR.'/views/ccform.php');

				} else {
					if($this->intFreq > 1) {
						//insert a schedual record
						$this->objDS = new DonationSched;
						$this->objDS->insertDonationSchedule($this->intPayProfileId,$this->decAmount,$this->intFreq);
					}
					include_once(ROOT_DIR.'/views/thankyou.php');

				}

			}


		} else {

			

			if($this->decAmount == ''){

				$this->strErrorMessage = "Please choose an amount";
				include_once(ROOT_DIR.'/views/donate.php');

			} else {

				

				//Util::dump($objProfile);
				if($this->objPayProfile['result']=="error"){

					$this->strErrorMessage = $this->objPayProfile['error']."<br />";

				}

				include_once(ROOT_DIR.'/views/ccform.php'); 
			}
		}



	}




	function handleForm() {




		if(isset($_POST['doPost'])){



			$this->strCCnum = isset($_POST['cc_num']) ? $_POST['cc_num'] : '';
			$this->strCCmonth = isset($_POST['expMonth']) ? $_POST['expMonth'] : '';
			$this->strCCyear = isset($_POST['expYear']) ? $_POST['expYear'] : '';
			$this->strCCcode = isset($_POST['cc_code']) ? $_POST['cc_code'] : '';
			$this->strFirstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
			$this->strLastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
			$this->strAddress = isset($_POST['address']) ? $_POST['address'] : '';
			$this->strCity = isset($_POST['city']) ? $_POST['city'] : '';
			$this->strProvince = isset($_POST['province']) ? $_POST['province'] : '';
			$this->strCountry = isset($_POST['country']) ? $_POST['country'] : '';
			$this->strPostal = isset($_POST['postal']) ? $_POST['postal'] : '';

			do {

				
				if($this->decAmount == ''){
					$this->strErrorMessage = "Amount is missing, please try again<br />";
					break;
				}
				if($this->strFirstName == ''){
					$this->strErrorMessage = "Please enter a first name<br />";
					break;
				}
				if($this->strLastName == ''){
					$this->strErrorMessage = "Please enter a last name<br />";
					break;
				}
				if($this->strAddress == ''){
					$this->strErrorMessage = "Please enter a address<br />";
					break;
				}
				if($this->strCity == ''){
					$this->strErrorMessage = "Please enter a city<br />";
					break;
				}
				if($this->strProvince == ''){
					$this->strErrorMessage = "Please enter a province<br />";
					break;
				}
				if($this->strCountry == ''){
					$this->strErrorMessage = "Please enter a country<br />";
					break;
				}
				if($this->strPostal == ''){
					$this->strErrorMessage = "Please enter a postal code<br />";
					break;
				}

				if($this->strCCnum == ''){
					$this->strErrorMessage = "Please enter a cc num<br />";
					break;
				}
				if($this->strCCmonth == ''){
					$this->strErrorMessage = "Please enter a cc expiry month<br />";
					break;
				}else {
					$this->strCCmonth = sprintf("%02.2d", $this->strCCmonth);
				}
				if($this->strCCyear == ''){
					$this->strErrorMessage = "Please enter a cc expiry year<br />";
					break;
				}else {
/*
					$today = date("Y-m-d H:i:s");
					$date = "$this->strCCyear-$this->strCCmonth-01 00:00:00";

					if ($date < $today) {
						$this->strErrorMessage = "Your Credit Card is not valid (expired).<br />";
						break;
					}
*/
					$this->strCCyear = substr($this->strCCyear,-2);
				}
				if($this->strCCcode == ''){
					$this->strErrorMessage = "Please enter a cc card code<br />";
					break;
				}

				$objTrans = new Transactions();

				
				$customerDetails = array(
					"first_name" => $this->strFirstName,
					"last_name" => $this->strLastName,
					"address" => $this->strAddress,
					"city" => $this->strCity,
					"state" => $this->strProvince,
					"postal" => $this->strPostal,
					"country" => $this->strCountry
				);


				$transactionDetails = array("Description" => $this->getFequencyString($this->intFreq) . " website donation", 
					"Amount" => $this->decAmount,
					'Type' => 1);//to seperate donation page(1) from product page(2) transactions

				//proccess the transaction
				
				$objTransDetails = $objTrans->processWebTransaction(
					$this->strCCnum,
					$this->strCCmonth.$this->strCCyear,
					$this->strCCcode,
					$transactionDetails,
					$customerDetails);

				if($objTransDetails['result']=="error"){

					$this->strErrorMessage = $objTransDetails['error']."<br />";
					break;

				} else {

					//this means a new profile was created. We need to get the payment profile id
					$this->objPayProfile = $objTrans->getPaymentProfiles();
					$this->intPayProfileId = $this->objPayProfile['paymentprofileid'];

				}


				break;
			} while ($this->strErrorMessage == "");

			if($this->strErrorMessage == ""){

				//insert a schedual record
				if($this->intFreq > 1) {
					$this->objDS = new DonationSched;
					$this->objDS->insertDonationSchedule($this->intPayProfileId,$this->decAmount,$this->intFreq);
				}

				include_once(ROOT_DIR.'/views/thankyou.php');

			} else {

				if($this->decAmount == ''){
					$this->strErrorMessage = "Please choose an amount<br />";
					include_once(ROOT_DIR.'/views/donate.php');

				} else {
					include_once(ROOT_DIR.'/views/ccform.php');

				}
			}

		} else {

			if($this->decAmount == ''){
				$this->strErrorMessage = "Please choose an amount<br />";
				include_once(ROOT_DIR.'/views/donate.php');

			} else {


				$this->objUser = new Users;
				$r = json_decode($this->objUser->showUserById($_SESSION['userID']));

				//var_dump($r);
				$this->strFirstName = isset($r->first_name) ? $r->first_name : '';
				$this->strLastName = isset($r->last_name) ? $r->last_name : '';
				$this->strAddress = isset($r->tax_address) ? $r->tax_address : '';
				$this->strCity = isset($r->tax_city) ? $r->tax_city : '';
				$this->strProvince = isset($r->tax_prov) ? $r->tax_prov : '';
				$this->strCountry = isset($r->tax_country) ? $r->tax_country : '';
				$this->strPostal = isset($r->tax_pc) ? $r->tax_pc : '';


				include_once(ROOT_DIR.'/views/ccform.php');

			}
		}

		

	}


	public function getFequencyString($freq){

		switch($freq){
			case 1:
				return "one time";
				break;
			case 2:
				return "bi-weekly";
				break;	
			case 3:
				return "monthly";
				break;
			case 4:
				return "annual";
				break;
		}


	}




}