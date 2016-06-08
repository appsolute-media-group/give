<?php include_once('system/config.php'); ?>
<?php include_once('system/security.php'); ?>
<?php include_once('system/core.php'); ?>
<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo isset($objController->strPageName) ? $objController->strPageName : 'Welcome To Club Appetite';?></title>

  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <!-- Place favicon.ico in the root directory -->

  <!-- css files -->
  <link href='https://fonts.googleapis.com/css?family=Fira+Sans:400,500,700,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="/styles/font-awesome-4.6.3/css/font-awesome.min.css">
  <link rel="stylesheet" href="/styles/jquery-ui.1.11.4.css">
  <link rel="stylesheet" href="/styles/smoothness/jquery-ui.theme.1.11.4.css">
  <link rel="stylesheet" href="/styles/normalize.css">
  <link rel="stylesheet" href="/styles/bootstrap.min.css">
  <link rel="stylesheet" href="/styles/bootstrap-theme.min.css">
  <link rel="stylesheet" href="/styles/main.css">


  

  <!-- javascript libraries -->
  <script src="/scripts/vendor/modernizr.js"></script>
  <script src="/scripts/jquery-1.12.2.js"></script>
  <script src="/scripts/jquery-ui.1.11.4.js"></script>
  
  <script src='/scripts/rotator.js'></script>

  <?php if(method_exists($objController,'showMetaData')) {

    $objController->showMetaData();

  } ?>



</head>


<?php $objController->showView();?>

</html>