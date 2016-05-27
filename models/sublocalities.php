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

  function verifySubLocalityId($id) {

    $this->strQuery = "SELECT s.id, s.sub_name      
                       FROM $this->strTableName s   
                       WHERE id ='$id'";

    if($this->query( $this->strQuery )) {

      $res = $this->getMysqliResults( $this->strQuery, true );
      if(count($res)>0) {
        return true;
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

	function getSubLocality_dropdown_List($op) {

      $foodbank_names = array();

      $this->strQuery = "SELECT s.sub_name, s.id      
			                   FROM $this->strTableName s   
			                    WHERE blnActive=1";

		 if ($this->query( $this->strQuery )) {

			   // op = 1, set position 0 = not set
       if ($op == 1) {
         $foodbank_names[0] = 'Not Set';
       }

       $result = $this->getMysqliResults($this->strQuery,true);

       $number_entries = count($result);
       if ($number_entries > 0) {
    
         for ($i=0; $i < $number_entries; $i++) {
           $id           = $result[$i]['id'];    
           $name         = trim(stripslashes($result[$i]['sub_name']));  
           $foodbank_names[$id] = $name;
         }
       }
       return $foodbank_names;
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
	        $this->strQuery = "SELECT sub_name AS `page_title`, sub_desc AS `text`, sub_logo As logo, last_mod, address, city, prov, pc, tel, email, lat, lng, url   
                             From $this->strTableName 
                             WHERE id=$ID";
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
        return json_encode($arrData);
	}	

}



?>