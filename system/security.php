<?php 


if(isset($_SESSION['userID']) && !empty($_SESSION['userID'])) {
	
	//user is logged in
	//we can look at the user sessin variable
	//var_dump($_SESSION);

} else {

	if(strpos($_SERVER['REQUEST_URI'],'/login/') === false){
		header('Location: /login/');
	}


}

?>