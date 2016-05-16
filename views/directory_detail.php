
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
		      <div class="row business-header-container">
		        <div class="background-wrapper text-center">
		          <img src="<?php echo $this->objSponsor['sponsor_img2'];?>" alt="" style="height:150px;" />
		        </div>
		      </div>
		      <div class="row business-title-container">
		        <div class="col-xs-12 text-left">
		          <h3 class="business-name"><?php echo $this->objSponsor['sponsor_name'];?></h3>
		          <h5 class="business-category"><?php echo $this->objSponsor['sponsor_slogan'];?></h5>
		        </div>
		      </div>
		      <div class="row business-info-container">
		        <div class="col-xs-12 text-left">
		          <p class="business-description">
		          	<!--
		            This small town feel, big service establishment is proud to offer coffee and baked goods made from all local food and roasting sources. We are located downtown and offer a spacious inside and outside sitting-in experience.
		          	-->
		          </p>
		        </div>
		      </div>
		      <div class="row business-links-container">
		        <div class="col-xs-12 text-left">
		          <button type="button" name="business_website" class="btn btn-shop-link" onclick="window.location.href='http://<?php echo $this->objSponsor['sponsor_url'];?>';">Website</button>
		          <button type="button" name="business_offers" class="btn btn-shop-link" onclick="window.location.href='/shop/sponsors/<?php echo $this->objSponsor['id'];?>/';">View Offers</button>
		        </div>
		      </div>
		      <div class="row" onclick="goToView(2)">
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
		              <h6><?php 

		              	  $address = ($this->objSponsor['sponsor_address']) ? $this->objSponsor['sponsor_address'] . '<br />' : "";
		                  $city = ($this->objSponsor['sponsor_city']) ? $this->objSponsor['sponsor_city'] . ', ' : "";
		                  $prov = ($this->objSponsor['sponsor_province']) ? $this->objSponsor['sponsor_province']: "";
		                  $postalCode = ($this->objSponsor['sponsor_postal_code']) ? '<br/>' . $this->objSponsor['sponsor_postal_code'] : "";
		                  echo $address . $city . $prov . $postalCode;
		                  ?></h6>
		              <div class="map-container" style="width:100%;height:280px;">
		                <div id="map_div" class="div_maps" style="width:100%;height:100%;"></div>
						<script>

							function initialize_map() {
								//49.8996081,-119.5947451
								center = new google.maps.LatLng(<?php echo $this->objSponsor['centerLat'];?>,<?php echo $this->objSponsor['centerLng'];?>);

								var mapOptions = {
						          center: center,
						          zoom: 10,
						          mapTypeId: google.maps.MapTypeId.ROADMAP
						        };
						      
						        fb_map = new google.maps.Map(document.getElementById('map_div'), mapOptions);

						        var title = '<?php echo $this->objSponsor["sponsor_name"];?>';
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



							}

						</script>
						<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-EPcLFXAWERH5h1zqw4grjXCPWtD1-FM&callback=initialize_map" type="text/javascript"></script>
		              </div>

		              <?php //Util::dump($this->objSponsor); ?>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>






		  <div class="view" data-view="2">
		    <div class="view-container">
		      <div class="row business-logo-container">
		        <div class="logo-shop-wrapper text-center">
		          <img src="<?php echo $this->objSponsor['sponsor_img2'];?>" alt="" style="height:150px;" />
		        </div>
		      </div>
		      <div class="row">
		        <div class="col-xs-12 business-title-container text-center">
		          <h3 class="business-title"><?php echo $this->objSponsor['sponsor_name'];?></h3>
		          <h6 class="business-category"><?php echo $this->objSponsor['sponsor_slogan'];?></h6>
		        </div>
		      </div>
		      <div class="row">
		        <div class="col-xs-12 contact-address-container">
		          <div class="contact-address-inner">
		            <div class="col-xs-12 text-center">
		              <h4><?php $address = ($this->objSponsor['sponsor_address']) ? $this->objSponsor['sponsor_address'] . '<br />' : "";
		                  $city = ($this->objSponsor['sponsor_city']) ? $this->objSponsor['sponsor_city'] . ', ' : "";
		                  $prov = ($this->objSponsor['sponsor_province']) ? $this->objSponsor['sponsor_province']: "";
		                  $postalCode = ($this->objSponsor['sponsor_postal_code']) ? '<br/>' . $this->objSponsor['sponsor_postal_code'] : "";
		                  echo $address . $city . $prov . $postalCode; ?></h4>
		            </div>
		          </div>
		        </div>
		      </div>
		      <div class="row contact-business-links-container">
		        <div class="col-xs-12 text-center">
		          <button type="button" name="business_offers" class="btn btn-shop-link" onclick="goToView(1)">Go Back</button>
		        </div>
		      </div>
		      <div class="contact-options-container">
		      	<?php if($this->objContact['email'] != '') {?>
		        <div class="row">
		          <div class="col-xs-12 contact-option-container">
		            <div class="col-xs-2 text-center">
		              <i class="fa fa-envelope fa-2x"></i>
		            </div>
		            <div class="col-xs-10 text-left">
		              <a href="mailto:<?php echo $this->objContact['email'];?>"><h4><?php echo $this->objContact['email'];?></h4></a>
		            </div>
		          </div>
		        </div>
		        <?php } 
				if($this->objContact['tel'] != '') {
		        ?>
		        <div class="row">
		          <div class="col-xs-12 contact-option-container">
		            <div class="col-xs-2 text-center">
		              <i class="fa fa-phone fa-2x"></i>
		            </div>
		            <div class="col-xs-10 text-left">
		              <a href="tel:250555555"><h4><?php echo $this->objContact['tel'];?></h4></a>
		            </div>
		          </div>
		        </div>
		        <?php } 
				if($this->objSponsor['sponsor_url'] != '') {
		        ?>
		        <div class="row">
		          <div class="col-xs-12 contact-option-container">
		            <div class="col-xs-2 text-center">
		              <i class="fa fa-globe fa-2x"></i>
		            </div>
		            <div class="col-xs-10 text-left">
		              <a href="http://<?php echo $this->objSponsor['sponsor_url'];?>"><h4><?php echo $this->objSponsor['sponsor_url'];?></h4></a>
		            </div>
		          </div>
		        </div>
		        <?php } ?>
		      </div>
		      <div class="row">
		        <div class="col-xs-12 address-container">
		          <div class="address-inner">
		            <div class="col-xs-12 text-center">
		              <div class="map-container">
		                
						
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>


	    <div class="row ad-footer2">
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
<script src="/scripts/checkout.js"></script>

</body>