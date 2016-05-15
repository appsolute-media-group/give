<body class="page shop">
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
        <div class="row pre-redeem-header-container">
          <div class="background-wrapper">
            <img src="<?php echo $this->objDeal['deal_image'];?>" alt="" />
          </div>
        </div>
        <div class="row pre-redeem-title-container">
          <div class="col-xs-12 text-left">
            <h3 class="business-name"><?php echo $this->objDeal['deal_title'];?></h3>
            <h5 class="business-category"><?php echo $this->objDeal['sponsor_'];?></h5>

          </div>
        </div>
        <div class="row pre-redeem-redemption-container">
          <div class="col-xs-12 text-left">
            <h6 class="product-value"><?php echo $this->objDeal['deal_price'];?> points</h6>
            <button type="button" name="pre-redeem_redeem" class="btn btn-redeem" onclick="window.location.href='/shop/redeem/<?php echo $this->objDeal['id'];?>/';">Redeem</button>
            <button type="button" name="pre-redeem_redeem" class="btn btn-redeem" onclick="window.location.href='/directory/details/<?php echo $this->objDeal['sponsor_id'];?>/';">View Business</button>
          </div>
        </div>
        <div class="row pre-redeem-info-container">
          <div class="col-xs-12 text-left">
            <p class="business-description">
            	<?php echo $this->objDeal['deal_desc'];?>
            </p>



<?php //Util::dump($this->objDeal);?>

          </div>
        </div>
      </div>
    </div>

    <div class="row ad-footer">
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


</body>