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
            <img src="/images/kelowna_food-bank.png" alt="" />
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 food-bank-title-container text-center">
            <h3 class="food-bank-title">Kelowna Food Bank</h3>
            <h6 class="food-bank-category">1234 Street Road</h6>
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
                  <div class="col-xs-12 rep-container">
                    <div class="rep-inner">
                      <div class="col-xs-4">
                        <div class="rep-photo-container">
                          <div class="rep-photo-wrapper text-center">
                            <img src="/images/bill.jpg" alt="" />
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-8 text-left event-info">
                        <h4 class="foodbank-rep">John Doe</h4>
                        <h6 class="rep-position">Excecutive Manager</h6>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="message-text-container">
                  <p class="message-text">In 1983, the Kelowna Community Food Bank Society set up operation in a church basement to meet emergency food needs for the community.<br /> <br />

                  Over the next two decades, the Kelowna Food Bank great from serving 600 people per year to nearly 2,500 individuals per month, with nearly a third of them under age 16.<br /> <br />

                  Thank you for all your support.<br /> <br />

                  Food Bank Phone: (250) 763-7161<br />
                  Website: www.cofoodbank.com
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
            <img src="/images/kelowna_food-bank.png" alt="" />
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 food-bank-title-container text-center">
            <h3 class="food-bank-title">Kelowna Food Bank</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 contact-address-container">
            <div class="contact-address-inner">
              <div class="col-xs-12 text-center">
                <h4>1234 South Street, Kelowna, BC<br />V1Y 0B5</h4>
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
                <a href="mailto:name@example.com"><h5>hello@kelownafood.com</h5></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 contact-option-container">
              <div class="col-xs-2 text-center">
                <i class="fa fa-phone fa-2x"></i>
              </div>
              <div class="col-xs-10 text-left">
                <a href="tel:250555555"><h5>+1 (250) 766-1234</h5></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 contact-option-container">
              <div class="col-xs-2 text-center">
                <i class="fa fa-globe fa-2x"></i>
              </div>
              <div class="col-xs-10 text-left">
                <a href="https://website.com"><h5>www.kelownafoodbank.org</h5></a>
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