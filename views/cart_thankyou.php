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
          <div class="row">  
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
              <div class="item-inner">
                <div class="item-header">
                  <div class="text-center">
                    <h1>your cart&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-shopping-cart fa-1x"></i></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="receipt-container">
            <div class="receipt-wrapper">
              <div class="row">
                <div class="col-xs-12 text-center">
                  <h2>Thank you for your donation</h2>
                </div>
              </div>
              
              <div class="row receipt-points">
                <div class="col-xs-12 points-hex-container text-center">
                  <p class="points-hex-desc">YOU'VE EARNED</p>
                  <div class="points-hex text-center">
                    <p><?php echo $this->intAwardAmount; ?></p>
                  </div>
                  <p class="points-hex-desc">POINTS</p>
                </div>
              </div>
              
              <div class="row checkout-complete-button-container">
                <div class="col-xs-12 text-center">
                  <button type="button" name="needed-now-checkout" class="btn btn-shop" onclick="window.location.href='/shop/'">Shop Appetite</button>
                </div>
              </div>
            </div>
          </div>
          <div class="bottom-container">

          </div>
        </div> <!-- view-container -->
      </div>   <!-- data-view="1" -->
        		    
<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>

    </div>     <!-- container-fluid -->
  </div>       <!-- main-wrapper -->

<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>
</body>