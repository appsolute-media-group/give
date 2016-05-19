<?php


class api_controller {

	public $strQuery;
	public $arrResult;
	public $intAffectedRows;
	public $strErrorMessage = "";
	public $strSuccessMessage = "";
	public $strAction = "";
	public $strExtra = "";
	public $strVar1 = "";
	public $strPassword = "";
	public $intId = "";
	public $objUsers = "";
	public $blnDebug = "";

	public function __construct() {

		$this->strAction = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
		if($this->strAction == '' && isset($_REQUEST['method'])){
			$this->strAction = $_REQUEST['method'];
		}
		$this->intId = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
		$this->strExtra = isset($_REQUEST['extra']) ? str_replace("/","",$_REQUEST['extra']) : '';
		$this->strVar1 = isset($_REQUEST['var1']) ? str_replace("/","",$_REQUEST['var1']) : '';
		$this->objUsers = new Users;
		$this->blnDebug = true;



		if($this->strAction == 'sublocalities') {
			//http://restapi.clubappetite.com/api.php?controller=api&action=sublocalities
			//Needs to be accessed by non-authenticated users. This method is not validated with a token by design.
			echo $this->showSubLocalities();


		} elseif($this->strAction == 'users' && $this->blnDebug) { //this is only available while in debug mode
			/*
			These are plain text and not authenticated against a token. DO NOT ALLOW ON PUBLIC SERVER!!
			Do not use these inside the app itself, meant for testing in browser
			*/
			if($this->intId != ''){
				//http://restapi.clubappetite.com/api.php?controller=api&action=users&id=1
				echo $this->utf8ize($this->objUsers->showUserById($this->intId));
			} else {
				//http://restapi.clubappetite.com/api.php?controller=api&action=users
				echo $this->objUsers->showUsers();
			}

		} elseif($this->strAction == 'updateuser') {	
			//http://restapi.clubappetite.com/api.php?controller=api&action=updateuser&token=&first_name=&last_name=&gender=&link=&picture=&locale=
			echo $this->objUsers->updateUser();

		} elseif($this->strAction == 'getreferralcode') {	
			//http://restapi.clubappetite.com/api.php?controller=api&action=getreferralcode&token=QKuZsw8gOeeMpz6SE1C1apDA2oXv41iUt6e
			echo $this->objUsers->getReferralCode();	
		
		} elseif($this->strAction == 'generatereferralcode') {	
			//http://restapi.clubappetite.com/api.php?controller=api&action=generatereferralcode

			echo $this->objUsers->generateReferralCode();	
		

		} elseif($this->strAction == 'checkreferralcode') {	
			//http://restapi.clubappetite.com/api.php?controller=api&action=checkreferralcode&token=
			echo $this->objUsers->checkReferralCode();	

		} elseif($this->strAction == 'confirmdeal') {	
			//http://restapi.clubappetite.com/api.php?controller=api&action=confirmdeal&token=1mLguaCQ04s3Jhf4WfVZBgvcvq7OuPk4OEp&amount=5000
			echo $this->confirmDeal();	

		} elseif($this->strAction == 'confirmwebdeal') {	
			//http://givedemo.clubappetite.com/api.php?controller=api&action=confirmdeal&amount=5000&deal_id=1
			echo $this->confirmWebDeal();

		} elseif($this->strAction == 'sponsors') {
			//http://restapi.clubappetite.com/api.php?controller=api&action=sponsors
			echo $this->showSponsors();

		} elseif($this->strAction == 'sharefacebook') {
			//http://restapi.clubappetite.com/api.php?controller=api&action=sharefacebook
			echo $this->shareFacebook();

		} elseif($this->strAction == 'sponsordeals') {
			//http://restapi.clubappetite.com/api.php?controller=api&action=sponsorsdeals

			echo $this->showSponsorDeals();

		} elseif($this->strAction == 'sponsordealcats') {
			//http://restapi.clubappetite.com/api.php?controller=api&action=sponsorsdealcats

			echo $this->showSponsorDealCats();

		} elseif($this->strAction == 'infopage') {	
			//http://restapi.clubappetite.com/api.php?controller=api&action=infopage&name=foodbank&token=Vwmdr3FM75jRPjZO7g01dFc6H2fNgidZpZk&last_mod=1900-01-01 12:00:00
			echo $this->utf8ize($this->getInfopage());	

		} elseif($this->strAction == 'token') {	

			echo $this->objUsers->validateToken();

		} elseif($this->strAction == 'login') {
			
			echo $this->objUsers->login();

		} elseif($this->strAction == 'register') {
			
			echo $this->objUsers->register();

		} elseif($this->strAction == 'messages') {
			
			echo $this->showMessages();

		} elseif($this->strAction == 'products') {
			
			echo $this->showProducts();

	    } elseif($this->strAction == 'transaction') {
			
			echo $this->processTransaction();

	    } elseif($this->strAction == 'banners') {
			
			echo $this->getAllBannerAds();	

	    } elseif($this->strAction == 'trackbannerclick') {
			
			echo $this->trackBannerClick();	

	    } elseif($this->strAction == 'trackwebclick') {
			
			echo $this->trackWebBannerClick();	

	    } elseif($this->strAction == 'trackimpression') {
			
			echo $this->trackImpression();	

	    } elseif($this->strAction == 'validatecode') {
			
			echo $this->objUsers->validateCode();

	    } elseif($this->strAction == 'deletedonation') {
			
			echo $this->deleteDonation();

		} else {

			echo json_encode(array('result' => "error",'code' => "404",'details' => "Not found"));
		}





	}

	function deleteDonation() {

		$this->DonationSched = new DonationSched;
		$objCurrent = $this->DonationSched->deleteSched();
		return $objCurrent;

	}

	function confirmWebDeal() {

		$this->sponsorDeal = new SponsorDeals;
		$objCurrent = $this->sponsorDeal->confirmWebDeal();
		return $objCurrent;

	}

	function confirmDeal() {

		$this->sponsorDeal = new SponsorDeals;
		$objCurrent = $this->sponsorDeal->confirmDeal();
		return $objCurrent;

	}

	function getAllBannerAds() {

		$this->BannerAd = new BannerAd;
		$objCurrent = $this->BannerAd->getAllBannerAds();
		return $objCurrent;

	}

	function trackBannerClick() {

		$this->BannerAd = new BannerAd;
		$objCurrent = $this->BannerAd->trackClick();
		return $objCurrent;

	}

	function trackWebBannerClick() {

		$this->BannerAd = new BannerAd;
		$objCurrent = $this->BannerAd->trackWebClick();
		return $objCurrent;

	}	

	function trackImpression() {

		$this->BannerAd = new BannerAd;
		$objCurrent = $this->BannerAd->trackImpression();
		return $objCurrent;

	}

	function processTransaction() {

		$this->objTransactions = new Transactions;
		$objCurrent = $this->objTransactions->processTransaction();
		return $objCurrent;

	}

	function shareFacebook() {

		$this->objFacebook = new Facebook;
		$objCurrent = $this->objFacebook->shareMessage();
		return $objCurrent;

	}

	
	function showMessages() {

		$this->objMessages = new Messages;
		$objCurrent = $this->objMessages->getMessages();
		return $objCurrent;

	}	

	function showProducts() {

		$this->objProducts = new Products;
		$objCurrent = $this->objProducts->getProducts();
		return $objCurrent;

	}	
	
	function showSubLocalities() {

		$this->objSubLocalities = new SubLocalities;
		$objCurrent = $this->objSubLocalities->getSubLocalities();

		return $objCurrent;

	}	

	function getInfopage() {

		$this->objInfoPages = new InfoPages;
		$objCurrent = $this->objInfoPages->getInfoPages();

		return $objCurrent;

	}


	function showSponsors() {

        $this->objSponsor = new Sponsors;
		$objCurrent = $this->objSponsor->getSponsors();

		return $objCurrent;

	}

	function showSponsorDeals() {

        $this->objSponsorDeals = new SponsorDeals;
		$objCurrent = $this->objSponsorDeals->getSponsorDeals();

		return $objCurrent;

	}

	function showSponsorDealCats() {

        $this->objSponsorDealCats = new SponsorDealCats;
		$objCurrent = $this->objSponsorDealCats->getSponsorDealCats();

		return $objCurrent;

	}

	function utf8ize($d) {
	    if (is_array($d)) {
	        foreach ($d as $k => $v) {
	            $d[$k] = $this->utf8ize($v);
	        }
	    } else if (is_string ($d)) {
	        return utf8_encode($d);
	    }
	    return $d;
	}

}

?>