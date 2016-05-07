<?php


//choose controller
$strController = isset($_REQUEST['controller']) ? $_REQUEST['controller'] : 'main';
$strMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';
//echo '<br />strController='.$strController;
//echo '<br />strMethod='.$strMethod;

// This will automatically include all classes inside the classes folder
// all classes automatically extend the database class
$pattern = ROOT_DIR.'/helpers/*.php';
foreach (glob($pattern) as $filename) {
    include_once($filename);
}



$pattern = ROOT_DIR.'/models/*.php';
foreach (glob($pattern) as $filename) {
    include_once($filename);
}

// Create our Settings object, that holds generic site parameters
//$objSettings = new Settings;
//include_once(ROOT_DIR.'/controllers/default.php');
// Include the class that will extend the home class. This makes SEO so much easier
if(file_exists(ROOT_DIR.'/controllers/'.$strController.'.php')) {

    // Include the default controller and extended controller
    
    include_once(ROOT_DIR.'/controllers/'.$strController.'.php');
    $strController .= '_controller';
    $objController = new $strController();


} else {
    header('content-type: application/json; charset=utf-8');
    echo json_encode(array('result' => "error",'code' => "404",'details' => "Not found."));
    die();
    //include_once(ROOT_DIR.'/controllers/404.php');
    //$strController = 'notfound_controller';
    //$objController = new $strController();

}

//echo ROOT_DIR.'/controllers/'.$strController.'.php';






?>

