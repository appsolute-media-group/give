<?php


class cart_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $objProducts = "";
	public $strErrorMessage = "";
	public $intPayProfileId;

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		$this->objProducts = new Products;

		if($this->strMethod == ''){ //cart view


			$arrProducts = $this->objProducts->getWebProducts("");

			include_once(ROOT_DIR.'/views/cart.php'); 

		} elseif($this->strMethod == 'checkout'){

			if($_SESSION['APIprofileID'] == ''){
				$this->handleCheckout();
			} else {
				$this->handleProfileCheckout();
			}

			include_once(ROOT_DIR.'/views/checkout.php');


		} elseif($this->strMethod == 'thankyou'){

			include_once(ROOT_DIR.'/views/thankyou.php');
		}
	
	}



	function handleProfileCheckout(){

		$objTrans = new Transactions();
		
		if(isset($_POST['doPost'])){

			$this->intPayProfileId = isset($_POST['paymentprofileid']) ? $_POST['paymentprofileid'] : '';
			$decAmount = isset($_POST['grand_total']) ? $_POST['grand_total'] : '.01';

			//echo 'Processing paymentprofileid:'.$this->intPayProfileId."<br />";

			$transactionDetails = array("Description" => "Web Portal Profile Transaction", 
					"Amount" => $decAmount,
					'Type' => 2);//to seperate donation page(1) from product page(2) transactions


			$objTransDetails = $objTrans->ProcessProfileTransaction($_SESSION['APIprofileID'], $this->intPayProfileId, $transactionDetails);
			if($objTransDetails['result']=="error"){

				$this->strErrorMessage = $objTransDetails['error']."<br />";

			} else {

				echo "<script>window.location.href='/cart/thankyou/'</script>";

			}




		} else {

			$this->objPayProfile = $objTrans->getPaymentProfiles();
			$this->intPayProfileId = $this->objPayProfile['paymentprofileid'];

			//Util::dump($objProfile);
			if($this->objPayProfile['result']=="error"){

				$this->strErrorMessage = $this->objPayProfile['error']."<br />";
				//break;

			} 

		}



	}



	function handleCheckout() {


		//Util::dump($_POST);
		$arrQty = isset($_REQUEST['user_qty']) ? $_REQUEST['user_qty'] : '';
		$arrPid = isset($_REQUEST['product_id']) ? $_REQUEST['product_id'] : '';

		if($arrQty != ''){
			$idx = 0;
			$pids = array();
			$qtys = array();

			foreach($arrQty As $a){
				if($a > 0){
					//echo "Adding product " . $arrPid[$idx] . "x" . $a . "<br />";
					$pids[] = $arrPid[$idx];
					$qtys[] = $arrQty[$idx];
				}
				$idx++;
			}

			//$arrProducts = $this->objProducts->getWebProducts(implode(",", $pids));
			//$this->arrQtys = $qtys;
			$_SESSION['arrProducts'] = $this->objProducts->getWebProducts(implode(",", $pids));
			$_SESSION['arrQtys'] = $qtys;
		}
		//Util::dump($arrProducts);

		$this->decAmount = isset($_POST['grand_total']) ? $_POST['grand_total'] : '.01';
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



		if(isset($_POST['doPost'])){

			do {

				if($this->strCCnum == ''){
					$this->strErrorMessage = "Please enter a cc num<br />";
					break;
				}
				if($this->decAmount == ''){
					$this->strErrorMessage = "Amount is missing, please try again<br />";
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
					$this->strCCyear = substr($this->strCCyear,-2);
				}
				if($this->strCCcode == ''){
					$this->strErrorMessage = "Please enter a cc card code<br />";
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


				$transactionDetails = array("Description" => "Web Portal Test", 
					"Amount" => $this->decAmount,
					'Type' => 2);//to seperate donation page(1) from product page(2) transactions

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

				} 
				
				break;
			} while ($this->strErrorMessage == "");


			if($this->strErrorMessage == ""){
				echo "<script>window.location.href='/cart/thankyou/'</script>";
			}



		}


		

	}




}