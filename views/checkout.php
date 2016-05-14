
<body class="page needed-now">
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
	        <div class="receipt-container">
	          <div class="receipt-wrapper">
	              <div class="row receipt-header">
	                <div class="col-xs-8 text-left">
	                  <h2>YOUR CART</h2>
	                </div>
	                <div class="col-xs-4 text-center">
	                  <i class="fa fa-shopping-cart fa-4x"></i>
	                </div>
	              </div>
	              <div class="cart-list-wrapper">

	                <div class="row item-row">
	                  <div class="col-xs-8">
	                    <p>Beans and Bread</p>
	                  </div>
	                  <div class="col-xs-2 quantity-wrapper">
	                    <p>x3 @</p>
	                  </div>
	                  <div class="col-xs-2 cost-wrapper">
	                    <p>$6.00</p>
	                  </div>
	                </div>
<!--
	                <div class="row item-row">
	                  <div class="col-xs-8">
	                    <p>Beans and Bread</p>
	                  </div>
	                  <div class="col-xs-2 quantity-wrapper">
	                    <p>x3 @</p>
	                  </div>
	                  <div class="col-xs-2 cost-wrapper">
	                    <p>$6.00</p>
	                  </div>
	                </div>
	                <div class="row item-row">
	                  <div class="col-xs-8">
	                    <p>Beans and Bread</p>
	                  </div>
	                  <div class="col-xs-2 quantity-wrapper">
	                    <p>x3 @</p>
	                  </div>
	                  <div class="col-xs-2 cost-wrapper">
	                    <p>$6.00</p>
	                  </div>
	                </div>
	                <div class="row item-row">
	                  <div class="col-xs-8">
	                    <p>Beans and Bread</p>
	                  </div>
	                  <div class="col-xs-2 quantity-wrapper">
	                    <p>x3 @</p>
	                  </div>
	                  <div class="col-xs-2 cost-wrapper">
	                    <p>$6.00</p>
	                  </div>
	                </div>
-->
	              </div>
	              <div class="row receipt-total-container">
	                <div class="col-xs-8 text-center">
	                  <h4>
	                    YOUR TOTAL:
	                  </h4>
	                </div>
	                <div class="col-xs-4 text-center">
	                  <h4>
	                    $44.00
	                  </h4>
	                </div>
	              </div>
	              <div class="row receipt-tagline-container">
	                <div class="col-xs-12 text-center receipt-tagline">
	                  <p>
	                    Your donation puts the buying power in the hands of the Food Bank who can take the funds and purchase more for their dollar. Thank you for feeding your community!
	                  </p>
	                </div>
	              </div>
	          </div>
	        </div>
	        <div class="bottom-container">
	          <div class="row checkout-button-container">
	            <div class="col-xs-12 text-center">
	              <button type="button" name="needed-now-checkout" class="btn btn-checkout" onclick="nextView()">CHECKOUT</button>
	            </div>
	          </div>
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
<script src="/scripts/cart.js"></script>
</body>