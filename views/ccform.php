
<body class="page my-account">
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
	      	<div class="col-md-6 item">
	          <div class="item-inner">
	            <div class="item-header">
	              <div class="text-center">
	                <h1>Your CC details</h1>
	              </div>
	            </div>
	            <div class="item-detail text-center">
              		<div class="item-detail-contents">

              			<form action="/donate/form/" method="post" />

              				<?php echo $this->strErrorMessage; ?>
							amount <input type="text" value=".01" name="amount" /> <br /><br />
              				num <input type="text" value="4111111111111111" name="cc_num" /> <br /><br />
              				exp <input type="text" value="1226" name="cc_expiry" /> <br /><br />
              				code <input type="text" value="123" name="cc_code" /> <br /><br />

              				<input type="submit" value="Submit" name="submit" /> 


              			</form>

              		</div>
                </div>	
	          </div>
	        </div>

	      </div>

	      <div class="row">
	        <div class="ad-container">
	          <div class="col-xs-12 ad-contents text-center">
	            <img src="/images/spot.png" />
	          </div>
	        </div>
	      </div>

	    </div>

	  </div>

	</div>