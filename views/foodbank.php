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
          <div class="row ">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
              <div class="my-food-bank-header-container">
                <div class="text-center">
                  <h1>my food bank</h1>
                </div>
              </div>
            </div>
          </div> 

          <div class="row food-bank-logo-container">
            <div class="food-bank-logo-wrapper text-center">
              <img src="<?php echo $objCurrent['logo'] ?>" class="center-block img-responsive" alt="" />
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 food-bank-title-container text-center">
              <h3 class="food-bank-title"><?php echo ($objCurrent['page_title']) ? $objCurrent['page_title'] : "Your Local Foodbank" ?></h3>
              <h6 class="food-bank-category"><?php echo $objCurrent['address'] ?></h6>
            </div>
          </div>
          <div class="row" onclick="nextView();initialize_map();">
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
      </div>      <!-- data-view=1 -->
    
      <div class="view" data-view="2">
        <div class="view-container">
          <div class="row ">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
              <div class="my-food-bank-header-container">
                <div class="text-center">
                  <h1>my food bank</h1>
                </div>
              </div>
            </div>
          </div>
          <div class="row food-bank-logo-container">
            <div class="food-bank-logo-wrapper text-center">
              <img src="<?php echo $objCurrent['logo'] ?>" class="center-block img-responsive" alt="" />
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
                  <h4>
<?php
     // In case some or all fields are blank, we won't have random commas
  $address = ($objCurrent['address']) ? $objCurrent['address'] . '<br />' : "";
  $city = ($objCurrent['city']) ? $objCurrent['city'] . ', ' : "";
  $prov = ($objCurrent['prov']) ? $objCurrent['prov']: "";
  $postalCode = ($objCurrent['pc']) ? '<br/>' . $objCurrent['pc'] : "";
  echo $address . $city . $prov . $postalCode;
?>                </h4>
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
                  <a href="<?php echo ($objCurrent['email']) ? 'mailto:' . $objCurrent['email'] : "#" ?>"><h5><?php echo ($objCurrent['email']) ? $objCurrent['email'] : "" ?></h5></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 contact-option-container">
                <div class="col-xs-2 text-center">
                  <i class="fa fa-phone fa-2x"></i>
                </div>
                <div class="col-xs-10 text-left">
                  <a href="<?php echo ($objCurrent['tel']) ? 'tel:' . $objCurrent['tel'] : "#" ?>"><h5><?php echo ($objCurrent['tel']) ? $objCurrent['tel'] : "" ?></h5></a>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 contact-option-container">
                <div class="col-xs-2 text-center">
                  <i class="fa fa-globe fa-2x"></i>
                </div>
                <div class="col-xs-10 text-left">
                  <a href="<?php echo ($objCurrent['url']) ? $objCurrent['url'] : "#" ?>"><h5><?php echo ($objCurrent['url']) ? $objCurrent['url'] : "" ?></h5>
                </div>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-xs-12 address-container">
              <div class="address-inner">
                <div class="col-xs-12 text-center">
                  <div class="map-container" style="width:100%;height:280px;">
                    <div id="map_div" class="div_maps" style="width:100%;height:100%;"></div>
                    <script>

                      function initialize_map() {
                        //49.8996081,-119.5947451

                        <?php if($objCurrent['lat'] != '' && $objCurrent['lng'] != '') { ?>
                        center = new google.maps.LatLng(<?php echo $objCurrent['lat'];?>,<?php echo $objCurrent['lng'];?>);

                        var mapOptions = {
                              center: center,
                              zoom: 12,
                              mapTypeId: google.maps.MapTypeId.ROADMAP
                            };
                          
                        fb_map = new google.maps.Map(document.getElementById('map_div'), mapOptions);

                        var title = '<?php echo $objCurrent["page_title"];?>';
                        var address ='<?php echo $address . $city . $prov . $postalCode;?>';



                        var marker = new google.maps.Marker({
                          position: center,
                          map: fb_map,
                          title: title
                        });

                        var contentString = '<div id="content" style="min-width:150px;" class="text-left"><p><b>'+title+'</b></p><p>'+address+'</p></div>';

                        var infowindow = new google.maps.InfoWindow({
                          content: contentString
                        });

                        marker.addListener('click', function() {
                          infowindow.open(fb_map, marker);
                        });

                        <?php } ?>

                      }

                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-EPcLFXAWERH5h1zqw4grjXCPWtD1-FM&callback=initialize_map" type="text/javascript"></script>
                  

                  </div>  <!-- map-container -->
                </div>
              </div>      <!-- address-inner -->
            </div>        <!-- address-container -->
          </div>          <!-- row -->
        </div>            <!-- view-container -->
      </div>              <!-- data-view=2 -->

<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>
    </div>     <!-- container-fluid -->
  </div>       <!-- main-wrapper -->

<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>

</body>