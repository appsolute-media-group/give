<?php


class Faq extends Database  {

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
		$this->strTableName = "faqs";

	}

	public function getFaqQuestions() {

		$result = array('result' => "error");

		$this->strQuery = "SELECT question, answer, category, id From $this->strTableName order by question ";
	  if ($this->query($this->strQuery)) {
	    $result = $this->getMysqliResults($this->strQuery,true);
	    $number_entries = count($result);
      if ($number_entries > 0) {
        for ($i=0; $i < $number_entries; $i++) {
          $result[$i]['question']  = trim(stripslashes($result[$i]['question']));  
          $result[$i]['answer']    = trim(stripslashes($result[$i]['answer']));  
        }
      }
	  }
		return $result;

  }


}

?>