<?php


class directory_controller {

	public $strMethod = "";
	public $intUserId = "";
	public $objSponsors;
	public $arrDeals;
	public $intId;
	public $strSearchTerm;
	public $strPageName = "Club Appetite - Directory";

	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		$this->intId = isset($_REQUEST['var1']) ? $_REQUEST['var1'] : '';

		$this->objSponsors = new Sponsors;
		if($this->strMethod == '' ){ //shop view

			$this->arrSponsors = $this->objSponsors->getWebSponsors();

		} else if($this->strMethod == 'search'){ //shop view

			$this->strSearchTerm = isset($_REQUEST['var1']) ? $_REQUEST['var1'] : '';
			$this->strSearchTerm = str_replace("_"," ",$this->strSearchTerm);
			$this->arrSponsors = $this->objSponsors->getWebSponsors($this->strSearchTerm);
	
		} else if($this->strMethod == 'details'){ //details view

			$this->objSponsor = $this->objSponsors->getWebSponsorById($this->intId);
			$this->objContact = $this->objSponsors->getWebSponsorContacts($this->intId);
			$this->strPageName = $this->objSponsor['sponsor_name'];

		}

	
	}



	function showView() {

		if($this->strMethod == '' ){ //shop view

			include_once(ROOT_DIR.'/views/directory.php'); 

		} else if($this->strMethod == 'search'){ //shop view

			include_once(ROOT_DIR.'/views/directory.php');

		} else if($this->strMethod == 'details'){ //details view

			include_once(ROOT_DIR.'/views/directory_detail.php'); 

		}

	}






}