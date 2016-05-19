

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
                <h1>Account Overview - mainpage</h1>
              </div>
            </div>
            <div class="item-detail text-center">
              <div class="item-detail-contents">
                <div class="row hero">
                  <div class="col-xs-12">
                    <h3>Your Account</h3>
                    <h2 class="points"><?=$_SESSION['user_points'];?></h2>
                    <p>points</p>
                    <h5 class="name"><?=$_SESSION['name'];?></h5>
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
                      <img src="/images/cart-hex.png" />
                      <h4>Needed Now</h4>
                    </a>
                  </div>
                  <div class="col-xs-4 shop-appetite text-center">
                    <a href="/shop/">
                      <img src="/images/comb-hex.png" />
                      <h4>Shop Appetite</h4>
                    </a>
                  </div>
                  <div class="col-xs-4 messages text-center">
                    <a href="/messages/">
                      <img src="/images/mail-hex.png" />
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



<script src="/scripts/vendor.js"></script>
<script src="/scripts/plugins.js"></script>
<script src="/scripts/main.js"></script>

</body>
