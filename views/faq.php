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
        <div class="row ">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
            <div class="info-header-container">
              <div class="text-center">
               <h1>FAQs</h1>
              </div>
            </div>
          </div>
        </div> 

	      <div class="info-container">
	        <div class="row">
	          <div class="col-xs-12 info-wrapper">
	            <div class="info-inner">

<?php if (count($this->objFaq) > 0) { 
        foreach ($this->objFaq As $info) { 
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

    </div>     <!-- container-fluid -->
  </div>       <!-- main-wrapper -->
<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>

</body>