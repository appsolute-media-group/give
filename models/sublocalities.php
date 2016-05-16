<?php


class SubLocalities extends Database  {

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
		$this->strTableName = "sublocalities";



	}


    function getSubLocalityIdByName($name) {

        $this->strQuery = "SELECT s.id      
			FROM $this->strTableName s   
			WHERE sub_name='$name'";

		if($this->query( $this->strQuery )) {

			$res = $this->getMysqliResults( $this->strQuery, true );
			if(count($res)>0) {
				return $res[0]['id'];
			} else {
				return false;
			}
			

		} else {

			return false;
		}

	}


	function getSubLocalityList() {

        $this->strQuery = "SELECT s.sub_name, s.id      
			FROM $this->strTableName s   
			WHERE blnActive=1";

		if($this->query( $this->strQuery )) {

			$details = $this->getMysqliResults($this->strQuery,true);
			return $details;

		} else {

			return false;
		}

	}


	function getAPIAuthNetKey($sublocality_id) {

		$this->strQuery = "SELECT 
				API_Login, API_Key      
			FROM $this->strTableName s   
			WHERE id='$sublocality_id'";


		if($this->query( $this->strQuery )) {

			$res = $this->getMysqliResults( $this->strQuery, true );
			return $res[0];

		} else {

			return false;
		}



	}




	/*
	This method is called from within the Infopage model when populating the "My Foodbank" page
	*/
	public function getFoodBankInfo($ID) {

		$r = array('result' => "error");

		if($ID !='') {
	        $this->strQuery = "SELECT sub_name AS `page_title`, sub_desc AS `text`, sub_logo As logo, last_mod, address, city, prov, pc, tel, email, lat, lng   From $this->strTableName WHERE id=$ID";
		    //echo $this->strQuery;
	        if($this->query($this->strQuery)) {
	            $details = $this->getMysqliResults($this->strQuery,true);
	            $details = $details[0];
	            $r = $details;
	        }
	    }

		return $r;

    }

	public function getFoodBankContact($ID) {

		$r = array('result' => "error");

		if($ID !='') {
	        $this->strQuery = "SELECT fname, lname, position   From foodbank_contacts WHERE charity_id=$ID";
		    //echo $this->strQuery;
	        if($this->query($this->strQuery)) {
	            $details = $this->getMysqliResults($this->strQuery,true);
	            $details = isset($details[0]) ? $details[0] : '';
	            $r = $details;
	        }
	    }

		return $r;

    }

	/*
	This method is called from within the app when populating the registration page picker
	*/
    function getSubLocalities() {

        $details = $this->getAll();

        if(!is_null($details)){
        	$arrData = array('result' => "success","details" => $details);
        } else {
        	$arrData = array('result' => "error");	
        }


//Util::dump($arrData);


        return json_encode($arrData);
	}	

}



?>