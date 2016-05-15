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
      <div class="row business-header-container">
        <div class="background-wrapper">
          <img src="/images/beans.jpg" alt="" />
        </div>
      </div>
      <div class="row business-title-container">
        <div class="col-xs-12 text-left">
          <h3 class="business-name">Calli's Coffee</h3>
          <h5 class="business-category">Cafe/Bakery</h5>
        </div>
      </div>
      <div class="row business-info-container">
        <div class="col-xs-12 text-left">
          <p class="business-description">
            This small town feel, big service establishment is proud to offer coffee and baked goods made from all local food and roasting sources. We are located downtown and offer a spacious inside and outside sitting-in experience.
          </p>
        </div>
      </div>
      <div class="row business-links-container">
        <div class="col-xs-12 text-left">
          <button type="button" name="business_website" class="btn btn-shop-link" onclick="">Website</button>
          <button type="button" name="business_offers" class="btn btn-shop-link" onclick="nextView()">View Offers</button>
        </div>
      </div>
      <div class="row" onclick="goToView(6)">
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
      <div class="row">
        <div class="col-xs-12 address-container">
          <div class="address-inner">
            <div class="col-xs-12 text-center">
              <h6>1234 South Street, Kelowna, BC | V1Y 0B5</h6>
              <div class="map-container">
                <img src="/images/map.jpg" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="view" data-view="5">
    <div class="view-container">
      <div class="row business-logo-container">
        <div class="business-logo-wrapper text-center">
          <img src="/images/calli_logo.png" alt="" />
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 business-title-container text-center">
          <h3 class="business-title">Calli's Coffee</h3>
          <h6 class="business-category">Cafe/Bakery</h6>
        </div>
      </div>
      <div class="row">
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
      <div class="row products-container">
        <div class="product-wrapper" onclick="goToView(2)">
          <div class="background-wrapper">
            <img src="/images/beans.jpg" alt="" />
          </div>
          <div class="product-top">
            <div class="col-xs-12 points-hex-container">
              <div class="points-hex text-center">
                <p>1000</p>
              </div>
            </div>
          </div>
          <div class="product-middle">
          </div>
          <div class="product-bottom text-center">
            <div class="col-xs-12 points-hex-container">
              <div class="text-center">
                <p>Large Coffee</p>
              </div>
            </div>
          </div>
        </div>
        <div class="product-wrapper" onclick="goToView(2)">
          <div class="background-wrapper">
            <img src="/images/beans.jpg" alt="" />
          </div>
          <div class="product-top">
            <div class="col-xs-12 points-hex-container">
              <div class="points-hex text-center">
                <p>700</p>
              </div>
            </div>
          </div>
          <div class="product-middle">
          </div>
          <div class="product-bottom text-center">
            <div class="col-xs-12 points-hex-container">
              <div class="text-center">
                <p>Medium Cofee</p>
              </div>
            </div>
          </div>
        </div>
        <div class="product-wrapper" onclick="goToView(2)">
          <div class="background-wrapper">
            <img src="/images/beans.jpg" alt="" />
          </div>
          <div class="product-top">
            <div class="col-xs-12 points-hex-container">
              <div class="points-hex text-center">
                <p>500</p>
              </div>
            </div>
          </div>
          <div class="product-middle">
          </div>
          <div class="product-bottom text-center">
            <div class="col-xs-12 points-hex-container">
              <div class="text-center">
                <p>Small Coffee</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="view" data-view="6">
    <div class="view-container">
      <div class="row business-logo-container">
        <div class="logo-shop-wrapper text-center">
          <img src="/images/calli_logo.png" alt="" />
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 business-title-container text-center">
          <h3 class="business-title">Calli's Coffee</h3>
          <h6 class="business-category">Cafe/Bakery</h6>
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
      <div class="row contact-business-links-container">
        <div class="col-xs-12 text-center">
          <button type="button" name="business_offers" class="btn btn-shop-link" onclick="goToView(4)">Go Back</button>
        </div>
      </div>
      <div class="contact-options-container">
        <div class="row">
          <div class="col-xs-12 contact-option-container">
            <div class="col-xs-2 text-center">
              <i class="fa fa-envelope fa-2x"></i>
            </div>
            <div class="col-xs-10 text-left">
              <a href="mailto:name@example.com"><h4>hello@calliscoffee.com</h4></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 contact-option-container">
            <div class="col-xs-2 text-center">
              <i class="fa fa-phone fa-2x"></i>
            </div>
            <div class="col-xs-10 text-left">
              <a href="tel:250555555"><h4>+1 (250) 766-1234</h4></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 contact-option-container">
            <div class="col-xs-2 text-center">
              <i class="fa fa-globe fa-2x"></i>
            </div>
            <div class="col-xs-10 text-left">
              <a href="https://website.com"><h4>www.calliscoffee.com</h4></a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 address-container">
          <div class="address-inner">
            <div class="col-xs-12 text-center">
              <div class="map-container">
                <img src="/images/map.jpg" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>





  <div class="view" data-view="7">
    <div class="view-container">
      <div class="row">
        <div class="col-xs-12 directory-header-container text-center">
          <h2>Business Directory</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 directory-input-container text-center">
          <div class="input-inner">
            <input type="text" name="directory_search" value="" placeholder="Search">
          </div>
        </div>
      </div>
      <div class="directory-list">
        <div class="row" onclick="goToView(4)">
          <div class="col-xs-12 directory-item-container">
            <div class="directory-item-inner">
              <div class="col-xs-4">
                <div class="business-logo-container">
                  <div class="business-logo-wrapper text-center">
                    <img src="/images/dell_logo.jpg" alt="" />
                  </div>
                </div>
              </div>
              <div class="col-xs-8 text-left business-info">
                <h4 class="business-title">Dell</h4>
                <h6 class="business-category">Computers</h6>
              </div>
            </div>
          </div>
        </div>
        <div class="row" onclick="goToView(4)">
          <div class="col-xs-12 directory-item-container">
            <div class="directory-item-inner">
              <div class="col-xs-4">
                <div class="business-logo-container">
                  <div class="business-logo-wrapper text-center">
                    <img src="/images/calli_logo.png" alt="" />
                  </div>
                </div>
              </div>
              <div class="col-xs-8 text-left business-info">
                <h4 class="business-title">Calli's Coffee</h4>
                <h6 class="business-category">Cafe/Bakery</h6>
              </div>
            </div>
          </div>
        </div>
        <div class="row" onclick="goToView(4)">
          <div class="col-xs-12 directory-item-container">
            <div class="directory-item-inner">
              <div class="col-xs-4">
                <div class="business-logo-container">
                  <div class="business-logo-wrapper text-center">
                    <img src="/images/dog.jpg" alt="" />
                  </div>
                </div>
              </div>
              <div class="col-xs-8 text-left business-info">
                <h4 class="business-title">Bob's Dogs</h4>
                <h6 class="business-category">Pet Grooming</h6>
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