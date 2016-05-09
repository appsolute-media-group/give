<?php


class main_controller {

	public $strMethod = "";
	public $intUserId = "";


	public function __construct() {

		$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';

		if($this->strMethod == 'sublocalities') {
			//http://localhost:83/main/sublocalities/
			$this->showSubLocalities();

		} else if($this->strMethod == 'logout') {

			session_unset();
		    session_destroy();
		    session_write_close();
			echo "<script>window.location.href='/login/'</script>";
			
		} else {

			$this->showMainPage();

		}

	}





	function showMainPage() {

		//we need an object for the current user
		//this will be a session variable when the login page is done, for now hard code your own userID from the database

		$this->objUsers = new Users;

		$this->intUserId= 1; //kirk walker
		$objUsers = json_decode($this->objUsers->showUserById($this->intUserId)); //don't forget to convert from json to a php object

		//use this to see all the data being passed to the view
		//var_dump($objUsers);


		include_once(ROOT_DIR.'/views/mainpage.php'); 



	}







	/***************************
	

	This is just an example of pulling data with no view.
	Its not actually used anwhere but will display a list of sublocalities in your browser by going to http://localhost/main/sublocalities


	*/

	function showSubLocalities() {



		//this creates a ref to the data model, this model is in the models folder and will have the same name as the class
		//in this case , the model is  /models/sublocalities.php
		$this->objSubLocalities = new SubLocalities;

		//we call a method in the datamodel to populate a local php object
		$objSublocalities = json_decode($this->objSubLocalities->getSubLocalities());
		$objSublocalities = $objSublocalities->details;//we only need the details, we can ignore the success and code calls.


		//a simple for loop to read all the objects in the main result object
		foreach($objSublocalities As $sub){

			echo "<br />Name: " . $sub->sub_name;
			echo "<br />Desc: " . str_replace('\r\n',"<br />",$sub->sub_desc);

		}

		//use this to show all data in the object
 		//var_dump($objSublocalities);


	}




}