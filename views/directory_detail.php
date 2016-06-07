<?php
//  $this->objContact might be null, if there are no contacts setup for this sponsor
//  set up variables for the email & tel

$email  = '';
$tel    = '';

if (isset($this->objContact['email'])) {
	$email  = $this->objContact['email'];
}

if (isset($this->objContact['tel'])) {
	$tel    = $this->objContact['tel'];
}


// do a second check to see if no data in contact record, but some in the main sponsor record, in future will always be in the contact record
if ($email == '' and $this->objSponsor['sponsor_email'] != '') {
	$email = $this->objSponsor['sponsor_email'];
}

if ($tel == '' and $this->objSponsor['sponsor_tel'] != '') {
	$tel = $this->objSponsor['sponsor_tel'];
}

?>
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
		        <div class="text-center" style="position:relative;">
		          <img src="<?php echo $this->objSponsor['sponsor_img2'];?>" class="center-block img-responsive" alt="" style="max-height:300px;"  />
		          <!--<img src="<?php echo $this->objSponsor['sponsor_img'];?>" class="center-block img-responsive" alt="" style="width:25%;margin-top:-35px;max-width:100px;" />-->
		        </div>
		      </div>
		      <div class="row" style="margin-top:15px;">
		        <div class="col-xs-12 business-title-container text-center">
		          <h3 class="business-title"><?php echo $this->objSponsor['sponsor_name'];?></h3>
		          <h6 class="business-category"><?php echo $this->objSponsor['sponsor_slogan'];?></h6>
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
		        <div class="col-xs-12 text-center">
		          
		          <button type="button" name="business_website" class="btn btn-shop-link" onclick="window.location.href='http://<?php echo $this->objSponsor['sponsor_url'];?>';">Website</button>
		          
		          <button type="button" name="business_offers" class="btn btn-shop-link" onclick="goToView(2);">Contact</button>

				  <button type="button" name="business_offers" class="btn btn-shop-link" onclick="window.location.href='/shop/sponsors/<?php echo $this->objSponsor['id'];?>/';">Deals</button>
		        

		        </div>
		      </div>



		
		      <div class="row">
		        <div class="col-xs-12 address-container">
		          <div class="address-inner">
		            <div class="col-xs-12">
		              <h6><?php 

		              	  $address = ($this->objSponsor['sponsor_address']) ? $this->objSponsor['sponsor_address'] . ' ' : "";
		                  $city = ($this->objSponsor['sponsor_city']) ? $this->objSponsor['sponsor_city'] . ', ' : "";
		                  $prov = ($this->objSponsor['sponsor_province']) ? $this->objSponsor['sponsor_province'] . " | " : " ";
		                  $postalCode = ($this->objSponsor['sponsor_postal_code']) ? '' . $this->objSponsor['sponsor_postal_code'] : "";
		                  echo $address . $city . $prov . $postalCode;
		                  ?></h6>
		            </div>
		          </div>
		        </div> 
		      </div>     
		      <div class="row">
		        <div class="col-xs-12">
		          <div class="map-container" style="width:100%;height:280px;">
		            <div id="map_div" class="div_maps" style="width:100%;height:100%;"></div>
						<script>
 						<?php 
                          $title = htmlspecialchars(str_replace("'","\'",$this->objSponsor["sponsor_name"]));
                          $address = htmlspecialchars(str_replace("'","''",$address . $city . $prov . $postalCode));
                          ?>
							function initialize_map() {
								//49.8996081,-119.5947451
								center = new google.maps.LatLng(<?php echo $this->objSponsor['centerLat'];?>,<?php echo $this->objSponsor['centerLng'];?>);

								var mapOptions = {
						          center: center,
						          zoom: 10,
						          mapTypeId: google.maps.MapTypeId.ROADMAP
						        };
						      
							    fb_map = new google.maps.Map(document.getElementById('map_div'), mapOptions);

							    var title = '<?php echo $title;?>';
					            var address ='<?php echo $address;?>';

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
		          </div>  <!--  map-container  -->

		          <?php //Util::dump($this->objSponsor); ?>
		        </div>    <!--  col-xs-12  -->
		      </div>      <!--  row  -->
		    </div>        <!-- view-container -->
		  </div>          <!-- data view 1 -->

		  <div class="view" data-view="2">
		    <div class="view-container">
		      <div class="row business-logo-container">
		        <div class="logo-shop-wrapper text-center">
		          <img src="<?php echo $this->objSponsor['sponsor_img2'];?>" class="center-block img-responsive" alt="" style="max-height:350px;width:auto;" />
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
		      	<?php if($email != '') {?>
		        <div class="row">
		          <div class="col-xs-12 contact-option-container">
		            <div class="col-xs-2 text-center">
		              <i class="fa fa-envelope fa-2x"></i>
		            </div>
		            <div class="col-xs-10 text-left">
		              <a href="mailto:<?php echo $email;?>"><h4><?php echo $email;?></h4></a>
		            </div>
		          </div>
		        </div>
		        <?php } 
				if($tel != '') {
		        ?>
		        <div class="row">
		          <div class="col-xs-12 contact-option-container">
		            <div class="col-xs-2 text-center">
		              <i class="fa fa-phone fa-2x"></i>
		            </div>
		            <div class="col-xs-10 text-left">
		              <a href="tel:<?php echo $tel;?>"><h4><?php echo $tel;?></h4></a>
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
		              <a href="<?php echo $this->objSponsor['sponsor_url'];?>" target="_new"><h4><?php echo $this->objSponsor['sponsor_url'];?></h4></a>
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
		      </div>   <!-- row -->
		    </div>
		  </div>

<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>

	</div>  

</div>

<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>

</body>