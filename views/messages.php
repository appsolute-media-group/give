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
        <div class="col-xs-12 messages-header-container text-center">
          <i class="fa fa-envelope fa-3x"></i>
          <h2>Messages</h3>
        </div>
      </div>
      <div class="message-list">
<?php   foreach($this->arrMessages As $m) { ?>
        <div class="row" onclick="window.location.href='/messages/<?php echo $m['id']; ?>/';">
          <div class="col-xs-12 message-item-container">
            <div class="message-item-inner">
              <div class="col-xs-2">
                <div class="icon-container">
                  <div class="icon-wrapper">
                    <i class="fa fa-star fa-2x"></i>
                  </div>
                </div>
              </div>
              <div class="col-xs-10 text-left message-info">
                <h4 class="message-title"><?php echo $m['message_title']; ?></h4>
                <p class="message-text"><?php echo substr($m['message_content'],0,35). ' ...'; ?></p>
              </div>
            </div>
          </div>
        </div>

<?php 
}


?>


<!--
        <div class="row" onclick="window.location.href='/messages/2/';">
          <div class="col-xs-12 message-item-container">
            <div class="message-item-inner">
              <div class="col-xs-2">
                <div class="icon-container">
                  <div class="icon-wrapper">
                    <i class="fa fa-envelope fa-2x"></i>
                  </div>
                </div>
              </div>
              <div class="col-xs-10 text-left message-info">
                <h4 class="message-title">Welcome to Club Appetite!</h4>
                <p class="message-text">An accurst ethiopia without proses is truly a sprout of globose geraniums...</p>
              </div>
            </div>
          </div>
        </div>
-->



      </div>
    </div>
  
  </div>


  




  <div class="row ad-footer2">
      <div class="ad-container">
        <div class="col-xs-12 ad-contents text-center">
          <?php include_once(ROOT_DIR.'/includes/banners.php'); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/scripts/vendor.js"></script>
<script src="/scripts/plugins.js"></script>
<script src="/scripts/main.js"></script>

</body>

