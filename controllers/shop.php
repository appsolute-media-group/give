<?php


class shop_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $objSponsorDeals;
	public $arrDeals;
	public $intId;
	public $strSearchTerm = "";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		$this->intId = isset($_REQUEST['var1']) ? $_REQUEST['var1'] : '';

		$this->objSponsorDeals = new SponsorDeals;

		if($this->strMethod == '' || $this->strMethod == 'sponsors'){ //shop view

			$this->arrDeals = $this->objSponsorDeals->getSponsorWebDeals('',$this->intId);
			include_once(ROOT_DIR.'/views/shop.php'); 

		} else if($this->strMethod == 'search'){ //shop view

			$this->strSearchTerm = isset($_REQUEST['var1']) ? $_REQUEST['var1'] : '';
			$this->strSearchTerm = str_replace("_"," ",$this->strSearchTerm);
			$this->arrDeals = $this->objSponsorDeals->getSponsorWebDeals($this->strSearchTerm,'');
			include_once(ROOT_DIR.'/views/shop.php'); 

		} else if($this->strMethod == 'details'){ //details view

			$this->objDeal = $this->objSponsorDeals->getSponsorWebDealById($this->intId);
			include_once(ROOT_DIR.'/views/shop_detail.php'); 

		} else if($this->strMethod == 'redeem'){ //redeem view

			$this->objDeal = $this->objSponsorDeals->getSponsorWebDealById($this->intId);
			include_once(ROOT_DIR.'/views/redeem.php'); 

		}
	
	}

}