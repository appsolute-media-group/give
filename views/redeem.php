<body class="page shop">
  <!--[if lt IE 10]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
<div class="main-wrapper">
  <div class="container-fluid">
    <div class="row header">
      <?php include_once(ROOT_DIR.'/includes/menu.php'); ?>
    </div>


    <div class="view initial redeem" data-view="1">
      <div class="view-container">
        <div class="row redeem-header-container">
          <div class="logo-shop-wrapper text-center">
            <img src="/images/shop-logo-white.png" alt="" />
          </div>
        </div>
        <div class="row redeem-slip-container">
          <div class="row">
            <div class="col-xs-12 text-left">
              <h3 class="business-name"><?php echo $this->objDeal['deal_title'];?></h3>
              <h5 class="business-category"><?php echo $this->objDeal['sponsor_name'];?></h5>
            </div>
          </div>
          <div class="row redeem-redemption-container">
            <div class="col-xs-12 text-left">
              <h6 class="product-value"><?php echo $this->objDeal['deal_price'];?> points</h6>
              <h6 class="product-value text-center" style="color:red;" id="error_message"></h6>
              <div id="redeem_placeholder" class="text-center">
                <?php if($this->objDeal['barcode_image'] != '') {?>
                  <img src="<?php echo $this->objDeal['barcode_image'];?>" alt="" onclick="redeem(<?php echo $this->objDeal['id'];?>)" />
                <?php } else {?>
                  <div class="col-xs-12 button-container text-center">
                    <div class="button-inner">
                        <button type="button" name="cancel" class="btn btn-cancel" onclick="redeem(<?php echo $this->objDeal['id'];?>)">Redeem</button>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

        <div class="row redeem-info-container">
          <div class="col-xs-12 text-left">
            
            <p class="business-description">
              <!--

              This small town feel, big service establishment is proud to offer coffee and baked goods made from all local food and roasting sources. We are located downtown and offer a spacious inside and outside sitting-in experience.

              Some of our most popular items include our Dark Chocolate Mocha complete with chocolate whip cream, our luxurious chai latte and of course, our signature Calli Cappuccino.

              Our menu is an array of breakfast, tea treats, lunch and dinner dishes. We pride ourselves on having personal and working relationships with local farmers, both produce and animal products. These loyal relationships mean the best ingredients and, furthermore, the best flavour to enjoy.
            
 -->
            </p>
           
          </div>
        </div>


      </div>

      <?php //Util::dump($this->objDeal);?>

    </div> 
  </div>
</div>

<script src="/scripts/vendor.js"></script>
<script src="/scripts/plugins.js"></script>
<script src="/scripts/main.js"></script>
<script src="/scripts/redeem.js"></script>

</body>
