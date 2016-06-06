<?php


	$objBanners = new BannerAd;
	$arrBanners = $objBanners->getSubBannerAds($_SESSION['sublocality_id'],'','1/1/1900');

  $s = '<div class="row">
         <div class="ad-container">
          <div class="ad-contents text-center">
           <div id="rotator">';

	echo $s;

	foreach($arrBanners As $b){

		echo '<a href="'.$b['url'].'" data-id="'.$b['ad_id'].'" target="_blank"><img src="'.$b['media_file'].'" data-id="'.$b['ad_id'].'" class="center-block banner_image" /></a>';

	}

  $s = '   </div>
          </div>
         </div>
        </div>';
	echo $s;

//Util::dump($arrBanners); 


?>