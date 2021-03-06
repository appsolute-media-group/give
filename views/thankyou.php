
<body class="page give">
	<!--[if lt IE 10]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<div class="main-wrapper">
	  <div class="container-fluid">
	    
	    <div class="row header">
	      
	      <?php include_once(ROOT_DIR.'/includes/menu.php'); ?>

	    </div>

	    <div class="view-container">
		      <div class="row">
		        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
              <div class="give-title-container">
                <div class="text-center">
                  <h1>way to go!&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-child fa-1x"></i></h1>
                </div>
              </div>
            </div>

		        <div class="col-xs-12 give-header-container text-center">
		          <h5>donation successful</h5>
		        </div>
		      </div>

		      <div class="thank-you-points-container">
		        <div class="row text-center">
		          <h4>you've earned</h4>
		          <h2><?php echo $this->intAwardAmount;?></h2>
		          <h4>points</h4>
		        </div>
		      </div>

		      <div class="button-container">
		        <div class="row">
		          <div class="col-xs-12 text-center">
		            <button type="button" name="return" class="btn btn-give" onclick="window.location.href='/main/';">return</button>
		          </div>
		        </div>
		      </div>
		  </div>  
<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>

	  </div>     <!-- container-fluid -->
	</div>       <!-- main-wrapper -->
	
<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>

</body>