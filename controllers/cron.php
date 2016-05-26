<?php


class cron_controller {

	public $strQuery;
	public $arrResult;
	public $intAffectedRows;
	public $strErrorMessage = "";
	public $strSuccessMessage = "";
	public $strMethod = "";
	public $strExtra = "";
	public $strVar1 = "";
	public $strDonationSched = "";
	public $intId = "";
	public $objUsers = "";
	public $blnDebug = "";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		///cron/processds/
		$this->strDonationSched = new DonationSched;


		if($this->strMethod == 'processds') {

			echo $this->processDonationSchedule();


		}


	}



	public function processDonationSchedule() {


		$date = date('Y-m-d', strtotime('-7 days'));
		$objCurrent = $this->strDonationSched->getAllByDate($date);

		if(!$objCurrent){
			return 'No records';
		} else {

			foreach($objCurrent As $item){

				//echo "<br />".print_r($item);
				Util::dump($item);

				//this will reset the lastrun, marking the item as completed
				//$this->strDonationSched->updateLastRun($item['id']);

			}

			//return "<br />".count($objCurrent) . " records found";


		}


	}



}


