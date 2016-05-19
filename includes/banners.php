<?php


	$objBanners = new BannerAd;
	$arrBanners = $objBanners->getSubBannerAds($_SESSION['sublocality_id'],'','1/1/1900');


  $s = '<div class="row">
         <div class="ad-container">
          <div class="col-xs-10 col-xs-offset-1 ad-contents text-center">
           <div id="rotator">';

	echo $s;

	foreach($arrBanners As $b){

		echo '<img src="'.$b['media_file'].'" class="center-block img-responsive"  data-id="'.$b['ad_id'].'" onclick="clickaction('.$b['ad_id'].',\''.$b['url'].'\');" />';

	}

  $s = '   </div>
          </div>
         </div>
        </div>';
	echo $s;

//Util::dump($arrBanners); 


?>