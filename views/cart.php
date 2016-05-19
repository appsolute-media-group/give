
<body class="page needed-now">
	<!--[if lt IE 10]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<div class="main-wrapper">

	  <div class="container-fluid">
	    
	    <div class="row header">
	      
	      <?php include_once(ROOT_DIR.'/includes/menu.php'); ?>

	    </div>
<?php //Util::dump($arrProducts); ?>

<form action="/cart/checkout/" method="post" id="cart_form">
	    <div class="view initial" data-view="1">
      <div class="view-container">
        <div class="row">
          <div class="col-md-6 item">
            <div class="item-inner">
              <div class="item-header">
                <div class="text-center">
                  <h1>Needed Now</h1>
                </div>
              </div>

              <div class="item-detail text-center dragon" id="scroll_view">




<?php foreach($arrProducts As $p) { ?>
                <div class="item-detail-contents">
                  <div class="row needed-item-container">
                    <div class="needed-item-inner">
                      <div class="row needed-item-top">
                        <div class="col-xs-12 points-hex-container">
                          <div class="points-hex text-center">
                            <p><?php echo $p['product_price']*1000;?></p>
                          </div>
                          <p class="points-hex-desc">POINTS</p>
                        </div>
                      </div>
                      <div class="row needed-item-middle">
                        <div class="col-xs-2">
                          <button type="button" name="needed-now-item-minus" class="btn btn-item" onclick="decreaseProductAmount(<?php echo $p['id'];?>, <?php echo $p['product_price'];?>);">-</button>
                        </div>
                        <div class="col-xs-8">
                          <img src="<?php echo $p['product_img'];?>" alt="<?php echo $p['product_title'];?>" />
                        </div>
                        <div class="col-xs-2">
                          <button type="button" name="needed-now-item-plus" class="btn btn-item" onclick="increaseProductAmount(<?php echo $p['id'];?>, <?php echo $p['product_price'];?>);">+</button>
                        </div>
                      </div>
                      <div class="row needed-item-bottom">
                        <div class="col-xs-12">
                          <span class="btn btn-item-amount">$<span id="user_qty_display_<?php echo $p['id'];?>"><?php echo number_format($p['user_qty'],2);?></span>
                            <input type="hidden" value="<?php echo $p['user_qty'];?>" name="user_qty[]" id="user_qty_<?php echo $p['id'];?>" class="user_qty"/>
                            <input type="hidden" value="<?php echo $p['id'];?>" name="product_id[]" />
                          </span>
                          <p class="needed-now-item-cost">$<?php echo $p['product_price'];?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

<?php } ?>


              </div>

              <script type='text/javascript'>

                new DragDivScroll( 'scroll_view', ["noXBarHide","mouseWheelX"] );

              </script>

            </div>
          </div>
        </div>
        <div class="row total-container">
          <div class="col-xs-6 text-center">
            <p class="total">
              TOTAL = $<span id="grand_total_display">0.00</span><input type="hidden" value="0" id="grand_total" />
            </p>
          </div>
          <div class="col-xs-6 text-center">
            <!--<button type="button" name="needed-now-checkout" class="btn btn-checkout" onclick="validateCheckout();">VALIDATE</button> -->
            <button type="button" name="needed-now-checkout" class="btn btn-checkout" onclick="Checkout();">CHECKOUT</button>
          </div>
        </div>
      </div>

</form>


    </div>

<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>



		</div>  

	  </div>

	<script src="/scripts/vendor.js"></script>
	<script src="/scripts/plugins.js"></script>
<script src="/scripts/main.js"></script>
<script src="/scripts/cart.js"></script>
</body>