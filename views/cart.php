
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
            <div class="row ">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
                <div class="item-inner">
                  <div class="item-header">
                    <div class="text-center">
                      <h1>Needed Now</h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>    

            
            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
              <div class="item-inner">
                <div class="item-detail text-center dragon" id="scroll_view">

<?php 
if(count($arrProducts) ==0){ ?>


  <div style="height:150px" class="row text-center"><h5>There are no products assigned to this food bank</h5></div>

<?php
} else {


$grand_total = 0;


  foreach($arrProducts As $p) { 

    $qty = 0;
    $price = $p['product_price'];
    $usr_price = 0;

    if(isset($_SESSION['arrProducts']) && is_array($_SESSION['arrProducts'])){
      for($i=0;$i < count($_SESSION['arrProducts']);$i++){
        if($_SESSION['arrProducts'][$i]['id'] == $p['id']){
            $qty = $_SESSION['arrQtys'][$i];
            $usr_price = $qty*$price;
            $grand_total+=$usr_price;
            //die($qty);
        }

      }

    }
    



    ?>
                  <div class="item-detail-contents">
                    <div class="row needed-item-container">
                      <div class="needed-item-inner">
                        <div class="row needed-item-top">
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 points-hex-container">
                            <div class="points-hex text-center">
                              <p><?php echo $p['product_price']*100;?></p>
                            </div>
                            <p class="points-hex-desc">POINTS</p>
                          </div>
                        </div>
                        <div class="row needed-item-middle">
                          <div class="col-xs-2">
                            <button type="button" name="needed-now-item-minus" class="btn btn-item" onclick="decreaseProductAmount(<?php echo $p['id'];?>, <?php echo $p['product_price'];?>);">-</button>
                          </div>
                          <div class="col-xs-8">
                            <img src="<?php echo $p['product_img'];?>" class="center-block img-responsive" alt="<?php echo $p['product_name'];?>" />
                          </div>
                          <div class="col-xs-2">
                            <button type="button" name="needed-now-item-plus" class="btn btn-item" onclick="increaseProductAmount(<?php echo $p['id'];?>, <?php echo $p['product_price'];?>);">+</button>
                          </div>
                        </div>
                        <p class="points-hex-desc"><?php echo $p['product_name'];?></p>
                        <div class="row needed-item-bottom">
                          <div class="col-xs-12">
                            <span class="btn btn-item-amount">$<span class="user_qty_display" id="user_qty_display_<?php echo $p['id'];?>"><?php echo number_format($usr_price,2);?></span>
                              <input type="hidden" value="<?php echo $qty;?>" name="user_qty[]" id="user_qty_<?php echo $p['id'];?>" class="user_qty" style="color:#000000"/>
                              <input type="hidden" value="<?php echo $p['id'];?>" name="product_id[]" style="color:#000000" />
                            </span>
                            <p class="needed-now-item-cost">$<?php echo $p['product_price'];?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>     <!-- item-detail-contents -->

<?php 
  }

} ?>

                </div>       <!-- item-detail -->

        <script type='text/javascript'>

            new DragDivScroll( 'scroll_view', ["noXBarHide","mouseWheelX"] );

        </script>

              </div>         <!-- row -->

              <div class="row total-container">
                <div class="text-center">
                  <p class="total">
                    TOTAL = $<span id="grand_total_display"><?php echo number_format($grand_total,2); ?></span><input type="hidden" value="<?php echo $grand_total; ?>" id="grand_total" />
                  </p>
                </div>
                <div class="text-center">
                  <!--<button type="button" name="needed-now-checkout" class="btn btn-checkout" onclick="validateCheckout();">VALIDATE</button> -->
                  <button type="button" name="needed-now-checkout" class="btn btn-checkout" onclick="Clear();">CLEAR CART</button>
                  <button type="button" name="needed-now-checkout" class="btn btn-checkout" onclick="Checkout();">CHECKOUT</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      

<?php 

$blnLockBanner = false;
include_once(ROOT_DIR.'/includes/banners.php'); ?>

    </div>     <!-- container-fluid -->
  </div>       <!-- main-wrapper -->

<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>
<script src="/scripts/cart.js"></script>
</body>