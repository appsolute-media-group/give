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

		if ($this->query( $this->strQuery )) {

			$details = $this->getMysqliResults($this->strQuery,true);

      $number_entries = count($details);
      if ($number_entries > 0) {
    
        for ($i=0; $i < $number_entries; $i++) {
          $details[$i]['sub_name'] = trim(stripslashes($details[$i]['sub_name']));  
        }
      }
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
	        $this->strQuery = "SELECT sub_name AS `page_title`, sub_desc AS `text`, concat((SELECT img_root FROM config WHERE id=1),sub_logo) As logo, last_mod, address, city, prov, pc, tel, email, lat, lng, url   
                             From $this->strTableName 
                             WHERE id=$ID";
		    //echo $this->strQuery;
	        if($this->query($this->strQuery)) {
	            $details = $this->getMysqliResults($this->strQuery,true);
              if (count($details) > 0) {
	              $details = $details[0];
              
                $details['page_title'] = stripcslashes($details['page_title']);
                $details['text']       = stripcslashes($details['text']);
                $details['logo']       = stripcslashes($details['logo']);
                $details['address']    = stripcslashes($details['address']);
                $details['city']       = stripcslashes($details['city']);
                $details['email']      = stripcslashes($details['email']);
                $details['url']        = stripcslashes($details['url']);
	              $r = $details;
              } else {
                $r = $details;
              }  
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

              if (isset($details['fname'])) {
                $details['fname']       = stripcslashes($details['fname']);
                $details['lname']       = stripcslashes($details['lname']);
                $details['position']    = stripcslashes($details['position']);
              }
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

        if (!is_null($details)) {
          if (count($details) > 0) {
            $number_entries = count($details);
            for ($i=0; $i < $number_entries; $i++) {
              $details[$i]['sub_name']                = trim(stripslashes($details[$i]['sub_name']));  
              $details[$i]['sub_page_title']          = trim(stripslashes($details[$i]['sub_page_title']));
              $details[$i]['sub_desc']                = trim(stripslashes($details[$i]['sub_desc']));
              $details[$i]['sub_logo']                = trim(stripslashes($details[$i]['sub_logo']));  
              $details[$i]['address']                 = trim(stripslashes($details[$i]['address']));  
              $details[$i]['address2']                = trim(stripslashes($details[$i]['address2']));  
              $details[$i]['city']                    = trim(stripslashes($details[$i]['city']));  

              $details[$i]['contact_nm']              = trim(stripslashes($details[$i]['contact_nm'])); 
              $details[$i]['email']                   = trim(stripslashes($details[$i]['email']));  
              $details[$i]['img_file_name']           = trim(stripslashes($details[$i]['img_file_name']));  
              $details[$i]['tax_charity_name']        = trim(stripslashes($details[$i]['tax_charity_name'])); 
              $details[$i]['tax_charity_address']     = trim(stripslashes($details[$i]['tax_charity_address'])); 
              $details[$i]['tax_charity_address2']    = trim(stripslashes($details[$i]['tax_charity_address2'])); 
              $details[$i]['tax_charity_city']        = trim(stripslashes($details[$i]['tax_charity_city'])); 

              $details[$i]['tax_charity_BN_number']   = trim(stripslashes($details[$i]['tax_charity_BN_number']));
              $details[$i]['tax_charity_location']    = trim(stripslashes($details[$i]['tax_charity_location'])); 
              $details[$i]['tax_charity_signature']   = trim(stripslashes($details[$i]['tax_charity_signature'])); 
              $details[$i]['tax_charity_sig_file_nm'] = trim(stripslashes($details[$i]['tax_charity_sig_file_nm'])); 
              $details[$i]['url']                     = trim(stripslashes($details[$i]['url']));  
            }
          }  
        	$arrData = array('result' => "success","details" => $details);
        } else {
        	$arrData = array('result' => "error");	
        }
        return json_encode($arrData);
	}	

}



?>