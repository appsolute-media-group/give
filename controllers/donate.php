<?php


class donate_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $strErrorMessage = "";
	public $decAmount = "";
	public $strCCnum = "";
	public $strCCexpire = "";
	public $strCCcode = "";

	public function __construct() {

		$this->strMethod = isset($_GET['method']) ? $_GET['method'] : '';
	

		if($this->strMethod == ''){ //main view

			include_once(ROOT_DIR.'/views/donate.php'); 

		} elseif($this->strMethod == 'form'){

			 $this->handleForm();

		} elseif($this->strMethod == 'thankyou'){

			include_once(ROOT_DIR.'/views/thankyou.php'); 

		}
	
	}



	function handleForm() {

		
		$this->decAmount = isset($_POST['amount']) ? $_POST['amount'] : '';
		$this->strCCnum = isset($_POST['cc_num']) ? $_POST['cc_num'] : '';
		$this->strCCexpire = isset($_POST['cc_expiry']) ? $_POST['cc_expiry'] : '';
		$this->strCCcode = isset($_POST['cc_code']) ? $_POST['cc_code'] : '';

		
		if(isset($_POST['submit'])){

			do {

				if($this->strCCnum == ''){
					$this->strErrorMessage = "Please enter a cc num<br />";
					break;
				}

				if($this->decAmount == ''){
					$this->strErrorMessage = "Amount is missing, please try again<br />";
					break;
				}

				if($this->strCCexpire == ''){
					$this->strErrorMessage = "Please enter a cc expiry<br />";
					break;
				}

				if($this->strCCcode == ''){
					$this->strErrorMessage = "Please enter a cc card code<br />";
					break;
				}

				$transactionDetails = array("Description" => "Web Portal Test", 
					"Amount" => $this->decAmount,
					'Type' => 1);//to seperate donation page(1) from product page(2) transactions

				$objTrans = new Transactions();
				$objTransDetails = $objTrans->processWebTransaction(
					$this->strCCnum,
					$this->strCCexpire,
					$this->strCCcode,
					$transactionDetails);

				if($objTransDetails['result']=="error"){

					$this->strErrorMessage = $objTransDetails['error']."<br />";
					break;

				} 

				break;
			} while ($this->strErrorMessage == "");

			if($this->strErrorMessage == ''){

				//Util::dump($objTransDetails);
				include_once(ROOT_DIR.'/views/thankyou.php');

			} else {

				
				include_once(ROOT_DIR.'/views/ccform.php');

			}

		} else {

			include_once(ROOT_DIR.'/views/ccform.php');


		}


		


	}





}