<?php


class profile_controller {

	public $strMethod = "";
	public $intUserId = "";

	public function __construct() {

		//$this->strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
		//no need to create a method for this view, we can just do the work here in the constructor


			
		//we need an object for the current user
		//this will be a session variable when the login page is done, for now hard code your own userID from the database
		$this->objUsers = new Users;

		$this->intUserId= 1; //kirk walker
		$objUsers = json_decode($this->objUsers->showUserById($this->intUserId)); //don't forget to convert from json to a php object

		//use this to see all the data being passed to the view
		//var_dump($objUsers);


		include_once(ROOT_DIR.'/views/profile.php'); 

		

	}



}