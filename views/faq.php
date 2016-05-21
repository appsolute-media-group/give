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
	        <div class="col-xs-12 logo-shop-wrapper text-center">
	          <img src="/images/CA_Logo_Platform_green_557.png" class="center-block img-responsive" alt="" />
	        </div>
	      </div>
	      <div id="top" class="row">
	        <div class="col-xs-12 title-container text-center">
	          <h2>FAQs</h2>
	        </div>
	      </div>
	      <div class="info-container">
	        <div class="row">
	          <div class="col-xs-12 info-wrapper">
	            <div class="info-inner">

<?php if (count($objFaq) > 0) { 
        foreach ($objFaq As $info) { 
          echo "<strong>".$info['question']."</strong><br><br>"; 
          echo $info['answer']."<br><br>";
        }
      } else { ?>
       
                <div style="height:150px">
                  <p>Sorry, no FAQs to display.</p>
                </div>
<?php }  ?>
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