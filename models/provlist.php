<?php


class ProvList extends Database  {

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
	public $country_arr;
  public $prov_arr;


	public function __construct() {

		parent::__construct();
		$this->strErrorMessage = "";
		$this->strTableName = "provinces";

	}

	public function getCountry_dd_List() {

      // load the country list
    $this->country_arr['CA'] = 'Canada';
    //  $this->country_arr['US'] = 'United States';
    
    return $this->country_arr;
  }

  public function getProv_dd_List($this_country) {

      // load the provinces list
    if ($this_country == 'CA') {  
      $this->strQuery = "select code, name
                from provinces
                where prov_sort = '1' 
                order by name";
    } else {
      $this->strQuery = "select code, name
                from provinces
                where prov_sort = '2' 
                order by name";
    }
    
	  if ($this->query($this->strQuery)) {
      $result = $this->getMysqliResults($this->strQuery,true);
  
      $rows = count($result); 
      if ($rows > 0) {
        for ($i=0; $i < $rows; $i++) {    
          $code = trim($result[$i]['code']);
          $name = trim($result[$i]['name']);
          $this->prov_arr[$code] = $name;
        }
        $result = array('result' => "success");
      }
    }
    return $this->prov_arr;
  }


}



?>