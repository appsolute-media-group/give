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

}



?>