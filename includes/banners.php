<?php


	$objBanners = new BannerAd;
	$arrBanners = $objBanners->getSubBannerAds($_SESSION['sublocality_id'],'','1/1/1900');
  
  shuffle($arrBanners);

if(isset($blnLockBanner) && $blnLockBanner === false) {
  $class="ad-container2";
} else {
  $class="ad-container";
}


  $s = '<div class="row">
         <div class="'.$class.'">
          <div class="ad-contents text-center">
           <div id="rotator">';

	echo $s;

	foreach($arrBanners As $b){
    if($b['media_file'] != ''){
  		echo '<a href="'.$b['url'].'" data-id="'.$b['ad_id'].'" target="_blank">
        <img src="'.$b['media_file'].'" data-id="'.$b['ad_id'].'" class="center-block banner_image" />
      </a>';
    }
	}

  $s = '   </div>
          </div>
         </div>
        </div>';
	echo $s;

//Util::dump($arrBanners); 


?>