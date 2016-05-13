<body class="page food-bank">
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
        <div class="row food-bank-logo-container">
          <div class="food-bank-logo-wrapper text-center">
            <img src="<?php echo $objCurrent['logo'] ?>" alt="" />
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 food-bank-title-container text-center">
            <h3 class="food-bank-title"><?php echo ($objCurrent['page_title']) ? $objCurrent['page_title'] : "Your Local Foodbank" ?></h3>
            <h6 class="food-bank-category"><?php echo $objCurrent['address'] ?></h6>
          </div>
        </div>
        <div class="row" onclick="nextView()">
          <div class="col-xs-12 contact-button-container">
            <div class="contact-button-inner">
              <div class="col-xs-10 text-left">
                <h4>Contact</h4>
              </div>
              <div class="col-xs-2 text-right">
                <i class="fa fa-arrow-right "></i>
              </div>
            </div>
          </div>
        </div>
        <div class="description-container">
          <div class="row">
            <div class="col-xs-12 text-left">
              <div class="message-inner">
                <div class="row">
                </div>
                <div class="message-text-container">
                  <p class="message-text">
                  <?php echo $objCurrent['text'] ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="view" data-view="2">
      <div class="view-container">
        <div class="row food-bank-logo-container">
          <div class="food-bank-logo-wrapper text-center">
            <img src="<?php echo $objCurrent['logo'] ?>" alt="" />
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 food-bank-title-container text-center">
            <h3 class="food-bank-title"><?php echo ($objCurrent['page_title']) ? $objCurrent['page_title'] : "Your Local Foodbank" ?></h3>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 contact-address-container">
            <div class="contact-address-inner">
              <div class="col-xs-12 text-center">
                <h4><?php
                  // In case some or all fields are blank, we won't have random commas
                  $address = ($objCurrent['address']) ? $objCurrent['address'] . ', ' : "";
                  $city = ($objCurrent['city']) ? $objCurrent['city'] . ', ' : "";
                  $prov = ($objCurrent['prov']) ? $objCurrent['prov']: "";
                  $postalCode = ($objCurrent['pc']) ? '<br/>' . $objCurrent['pc'] : "";
                  echo $address . $city . $prov . $postalCode;
                ?></h4>
              </div>
            </div>
          </div>
        </div>
        <div class="row contact-food-bank-links-container">
          <div class="col-xs-12 text-center">
            <button type="button" name="return" class="btn btn-shop-link" onclick="prevView()">Go Back</button>
          </div>
        </div>
        <div class="contact-options-container">
          <div class="row">
            <div class="col-xs-12 contact-option-container">
              <div class="col-xs-2 text-center">
                <i class="fa fa-envelope fa-2x"></i>
              </div>
              <div class="col-xs-10 text-left">
                <a href="<?php echo ($objCurrent['email']) ? 'mailto:' . $objCurrent['email'] : "#" ?>"><h5><?php echo ($objCurrent['email']) ? $objCurrent['email'] : "N/A" ?></h5></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 contact-option-container">
              <div class="col-xs-2 text-center">
                <i class="fa fa-phone fa-2x"></i>
              </div>
              <div class="col-xs-10 text-left">
                <a href="<?php echo ($objCurrent['tel']) ? 'tel:' . $objCurrent['tel'] : "#" ?>"><h5><?php echo ($objCurrent['tel']) ? $objCurrent['tel'] : "N/A" ?></h5></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 contact-option-container">
              <div class="col-xs-2 text-center">
                <i class="fa fa-globe fa-2x"></i>
              </div>
              <div class="col-xs-10 text-left">
                <a href="https://website.com"><h5>www.website.com</h5></a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 address-container">
            <div class="address-inner">
              <div class="col-xs-12 text-center">
                <div class="map-container">
                  <img src="../images/map.jpg" alt="" />
                </div>
              </div>
            </div>
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