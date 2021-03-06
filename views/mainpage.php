

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
        <div class="col-xs-10 col-xs-offset-1  col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 item">
          <div class="item-inner">
            <div class="item-detail text-center">
              <div class="item-detail-contents">
                <div class="row hero">
                  <div class="col-xs-12">
                    <h5>Your Account</h5>
                    <h3 class="points"><?=$_SESSION['user_points'];?></h3>
                    <p>points</p>
         
                  </div>
                </div>
                <!--
                <div class="row stats">
                  <div class="col-xs-6">
                    <h4>You've Attended</h3>
                    <h2 class="user-stat">14</h2>
                    <p>events</p>
                  </div>
                  <div class="col-xs-6">
                    <h4>You've Recieved</h3>
                    <h2 class="user-stat">$500.00</h2>
                    <p>in local sales</p>
                  </div>
                </div>
              -->

                <div class="row basic-navigation">
                  <div class="col-xs-4 needed-now text-center">
                    <a href="/cart/">
                      <img src="/images/cart-hex.png" class="center-block img-responsive"  />
                      <h4>Needed Now</h4>
                    </a>
                  </div>
                  <div class="col-xs-4 shop-appetite text-center">
                    <a href="/shop/">
                      <img src="/images/comb-hex.png" class="center-block img-responsive" />
                      <h4>Shop Appetite</h4>
                    </a>
                  </div>
                  <div class="col-xs-4 messages text-center">
                    <a href="/messages/">
                      <img src="/images/mail-hex.png" class="center-block img-responsive" />
                      <h4>Messages</h4>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>
    </div>   <!-- view-container  -->
  </div>     <!-- container-fluid -->
</div>       <!-- main-wrapper -->


<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>

</body>
