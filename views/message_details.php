
<body class="page events-messages">
	<!--[if lt IE 10]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<div class="main-wrapper">

	  <div class="container-fluid">
	    
	    <div class="row header">
	      
	      <?php include_once(ROOT_DIR.'/includes/menu.php'); ?>

	    </div>



<div class="view initial" data-view="1">
    <div class="view-container">
      <div class="row">
        <div class="col-xs-12 text-left">
          <div class="back-wrapper" onclick="window.location.href='/messages/';">
            <h5><i class="fa fa-arrow-left"></i> Go Back</h5>
          </div>
        </div>
      </div>
      <div class="message-container">
        <div class="row">
          <div class="col-xs-12 text-left">
            <div class="message-inner">
              <h4 class="message-title"><?php echo $this->arrMessages['message_title']; ?></h4>
              <h6 class="message-date"><?php echo $this->arrMessages['last_mod']; ?></h6>
              <p class="message-text"><?php echo str_replace("\n","<br />",$this->arrMessages['message_content']); ?></p>

            </div>

          </div>
        </div>
      </div>
    </div>
</div>


<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>
  </div>
</div>

<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>

</body>