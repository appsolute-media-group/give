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
		$res = $this->short_query("DELETE from $this->strTableName WHERE userID=".$userID);
		
		if($res) {

			$arrResult = array('result' => "success",'code' => "deleted", "details" => $res);

		} else {

			$arrResult = array('result' => "error",'code' => "??", "details" => $res);
		}

        return json_encode($arrResult);

	}

	public function getHistoryByUser() {

		$this->strQuery = "SELECT * FROM app_transactions WHERE userID=".$_SESSION['userID'];

		if($this->short_query( $this->strQuery )){
			$r = $this->getMysqliResults( $this->strQuery, true );
			//if(isset($r[0])){
				//$r=$r[0];
			//} else {
				//$r = false;
			//}
			
		} else {

			$r = false;
		}
		return $r;


	}

	public function getAllByUser() {

		$this->strQuery = "SELECT * FROM $this->strTableName WHERE userID=".$_SESSION['userID'];

		if($this->short_query( $this->strQuery )){
			$r = $this->getMysqliResults( $this->strQuery, true );
			if(isset($r[0])){
				$r=$r[0];
			} else {
				$r = false;
			}
			
		} else {

			$r = false;
		}
		return $r;


	}


	public function getAllByDate($date) {

		$this->strQuery = "SELECT * FROM $this->strTableName WHERE last_run='".$date."'";

		if($this->short_query( $this->strQuery )){
			$r = $this->getMysqliResults( $this->strQuery, true );		
		} else {
			$r = false;
		}
		return $r;

	}


	public function updateDonationSchedule($amount,$freq){


		$this->sql = "UPDATE $this->strTableName 
		SET amount=$amount, freq=$freq WHERE userID=".$_SESSION['userID'];


		return $this->short_query($this->sql);


	}


	public function insertDonationSchedule($payID,$amount,$freq){

		if($freq > 1) {
			$this->sql = "INSERT INTO $this->strTableName 
			(PaymentProfileID, userID, amount, freq) 
			VALUES 
			($payID, ".$_SESSION['userID'].", $amount, $freq) 
			ON DUPLICATE KEY UPDATE amount=$amount,freq=$freq,PaymentProfileID=$payID";



			return $this->short_query($this->sql);
		}

	}


	public function updateLastRun($id) {

		$sql = "UPDATE donation_schedules SET last_run='".date('Y-m-d')."' WHERE id=".$id;
		$this->short_query($sql);
		echo "<br />".$sql;



	}




}



