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
          <div class="row ">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
              <div class="messages-header-container">
                <div class="text-center">
                  <h1>messages</h1>
                </div>
              </div>
            </div>
          </div> 

          <div class="message-list">
<?php if (count($this->arrMessages) > 0) {
  
        foreach($this->arrMessages As $m) { 
          $msg_content = $m['message_content'];
          if (strlen($msg_content) >= 80) {
            $msg_content = substr($msg_content, 0, 77). " ... ";
          }
          $msg_expires = 'Message Expires: never';
          if ($m['end_date'] > '') {
            $msg_expires = 'Message Expires on '.$m['end_date'];
          } ?>
            <div class="row" onclick="window.location.href='/messages/<?php echo $m['id']; ?>/';">
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
                    <h4 class="message-title"><?php echo $m['message_title']; ?></h4>
                    <p class="message-text"><?php echo $msg_content; ?></p><br>
                    <p class="message-text"><?php echo $msg_expires; ?></p>
                  </div>
                </div>
              </div>
            </div>

<?php   } 
      } else { ?>

            <div class="row text-center">
              <br clear="all" />
              <div style="height:150px">
                <p>Sorry, no messages to display.</p>
              </div>
            </div>

<?php } ?>

          </div>
        </div>
      </div>

<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>
    </div>     <!-- container-fluid -->
  </div>       <!-- main-wrapper -->

<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>

</body>

