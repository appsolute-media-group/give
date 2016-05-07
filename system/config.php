<?php
/*

Authorize.net api credentials


API Login ID: 93pWcL9c

TRANSACTION KEY: 222Ng7B7Zp8jP2Zh

Secret Key: Simon


*/
date_default_timezone_set('America/Los_Angeles');
//header('content-type: application/json; charset=utf-8');

// Set our constants for the site
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT']);
define('ROOT_URL', isset($_SERVER['HTTPS']) ? 'https://'.$_SERVER['HTTP_HOST'] : 'http://'.$_SERVER['HTTP_HOST']);
define('SALT', 'h4xeF72754Uzm05187IzkP0Ga5PGt08E'); // Generated using https://strongpasswordgenerator.com/
define('DEBUG', true);

error_reporting(-1);
ini_set('display_errors', 'On');

session_start();


//define('FACEBOOK_SDK_V4_SRC_DIR', ROOT_DIR . '/facebookSDK/');
//require_once ROOT_DIR . '/facebookSDK/autoload.php';

define('MYSQL_BOTH',MYSQLI_BOTH);
define('MYSQL_NUM',MYSQLI_NUM);
define('MYSQL_ASSOC',MYSQLI_ASSOC);

// DB Connection variables
if(strpos(ROOT_URL,"localhost") > 0) {
    define('DB_HOST', "localhost");
    define('DB_USER', "root");
    define('DB_PASSWORD', "root");
    define('DB_NAME', "clubappetite");
} else {
    define('DB_HOST', "");
    define('DB_USER', "");
    define('DB_PASSWORD', "");
    define('DB_NAME', "clubappetite");
}

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$insert_id = 0;
// Check connection
if ($mysqli->connect_error) {
    die(json_encode(array("error" => "Connection failed: " . $mysqli->connect_error)));
}


$page_name = 'Welcome To Club Appetite';
//normally I build a layer here to get the meta data for the head 
//need to come back to this





?>