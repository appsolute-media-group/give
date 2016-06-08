<?php 


if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])) {
	
	//user is logged in
	//we can look at the user sessin variable
	//var_dump($_SESSION);

} else {

	//this isnt very good, need a better solution

	if(strpos($_SERVER['REQUEST_URI'],'/login/') === false 
		&& strpos($_SERVER['REQUEST_URI'],'/terms/') === false
		&& strpos($_SERVER['REQUEST_URI'],'/forgotpassword/') === false ){
		header('Location: /login/');
	}


}

?>