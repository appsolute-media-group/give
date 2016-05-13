<body class="page faq-terms">
	<!--[if lt IE 10]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<div class="main-wrapper">

	  <div class="container-fluid">
	    
	    <div class="row header">
	      
	      <?php include_once(ROOT_DIR.'/includes/menu.php'); ?>

	    </div>

	    <div class="view-container">
	      <div class="row info-header-container">
	        <div class="logo-shop-wrapper text-center">
	          <img src="/images/CA-Logo-lg.png" alt="" />
	        </div>
	      </div>
	      <div id="top" class="row">
	        <div class="col-xs-12 title-container text-center">
	          <h2><?=$objTerms['page_title']?></h2>
	        </div>
	      </div>
	      <div class="info-container">
	        <div class="row">
	          <div class="col-xs-12 info-wrapper">
	            <div class="info-inner">

              			<?=$objTerms['text'];?>
              	</div>
              </div>	
	        </div>
	      </div>

	    </div>

	      <div class="row">
	        <div class="ad-container">
	          <div class="col-xs-12 ad-contents text-center">
	            <?php include_once(ROOT_DIR.'/includes/banners.php'); ?>
	          </div>
	        </div>
	      </div>

	    </div>

	  </div>

	</div>
	<script src="/scripts/vendor.js"></script>
<script src="/scripts/plugins.js"></script>
<script src="/scripts/main.js"></script>

</body>