<?php


class donate_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $strErrorMessage = "";

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

		$amount = "10.00";


		$this->strCCnum = isset($_POST['cc_num']) ? $_POST['cc_num'] : '';
		
		if(isset($_POST['submit'])){

			$this->strErrorMessage = "";
			if($this->strCCnum == ''){
				$this->strErrorMessage = "Please enter a cc num<br />";
			}

			$subID = 1; //this should be a session variable


			$objTrans = new Transactions();
			$this->strErrorMessage = $objTrans->processWebTransaction($subID,$amount);



			if($this->strErrorMessage == ''){

				include_once(ROOT_DIR.'/views/thankyou.php');

			} else {

				include_once(ROOT_DIR.'/views/ccform.php');

			}

		} else {

			include_once(ROOT_DIR.'/views/ccform.php');


		}


		


	}





}