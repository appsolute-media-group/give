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
                  <h1>Naked In Vegas!</h1>
                </div>
              </div>
            </div>
	        <div class=" text-center" style="width:310px;margin:50px auto 0 auto;">
	        	<br />
				<script type="text/javascript" src="/scripts/videoplayer/assets/js/jquery.video-ui.js"></script>
				<div class="videoUiWrapper thumbnail col-xs-12 col-sm-12 col-md-12 col-lg-12 " style="width:310px;margin:50px auto 0 auto;">
				  <video width="300" height="200" id="demo1">
				    <!--<source src="pathtovideo/video.ogv" type="video/ogg"> -->
				    <source src="/images/Fruit basket.m4v" type="video/mp4">
				    Your browser does not support the video tag.
				  </video>
				</div>
				<script>
				$('#demo1').videoUI({
					'autoPlay':true,
					'autoHide':true,
					'progressMedia':false,
					'timerMedia':false,
					'playMedia':false,
					'volumeMedia':false,
					'fullscreenMedia':false});

				</script>
	        </div>
	      </div>

		</div>  
		<div class="text-center button-container">
          <span class="link_button text-center" ><a href="/faq/" >Back to faq's</a></span>
        </div>

		<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>

	  </div>     <!-- container-fluid -->
	</div>       <!-- main-wrapper -->
	
<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>

</body>
