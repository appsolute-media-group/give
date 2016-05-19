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
		$this->strTableName = "";



	}


	public function deleteSched() {


		$arrResult = array('result' => "success",'code' => "deleted");
		

        return json_encode($arrResult);




	}

}



?>