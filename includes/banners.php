<?php


	$objBanners = new BannerAd;
	$arrBanners = $objBanners->getSubBannerAds($_SESSION['sublocality_id'],'','1/1/1900');


  if(isset($page) && ($page == 'cart' || $page == 'faq')) {

    $style = 'ad-container2';

  } else {

    $style = 'ad-container';
  }


  $s = '<div class="row">
         <div class="'.$style.'">
          <div class="ad-contents text-center">
           <div id="rotator">';

	echo $s;

	foreach($arrBanners As $b){

		echo '<img src="'.$b['media_file'].'" class="center-block banner_image"  data-id="'.$b['ad_id'].'" data-url="'.$b['url'].'" />';

	}

  $s = '   </div>
          </div>
         </div>
        </div>';
	echo $s;

//Util::dump($arrBanners); 


?>