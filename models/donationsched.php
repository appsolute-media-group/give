<?php


class DonationSched extends Database  {

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
		$this->strTableName = "donation_schedules";



	}


	public function deleteSched() {
		
		$userID = $_SESSION['userID'];
		$res = $this->delete($userID,$this->strTableName);
		if($res) {

			$arrResult = array('result' => "success",'code' => "deleted");

		} else {

			$arrResult = array('result' => "error",'code' => "??", "details" => $res);
		}

        return json_encode($arrResult);

	}


	public function updateSched() {

		




	}



	public function insertDonationSchedule($payID,$amount,$freq){

		//$keys = array('PaymentProfileID', 'userID', 'amount', 'freq');
		//$vals = array($payID, $_SESSION['userID'], $amount, $freq);

		//$r = $this->mysqliinsert($keys,$vals);
		$this->sql = "INSERT INTO $this->strTableName 
		(PaymentProfileID, userID, amount, freq) 
		VALUES 
		($payID, ".$_SESSION['userID'].", $amount, $freq) 
		ON DUPLICATE KEY UPDATE amount=$amount,freq=$freq,PaymentProfileID=$payID";


		//echo $this->sql;

		return $this->short_query($this->sql);


	}


}



