<?php


	$objBanners = new BannerAd;
	$arrBanners = $objBanners->getSubBannerAds($_SESSION['sublocality_id'],'','1/1/1900');


	echo '<div id="rotator">';

	foreach($arrBanners As $b){

		echo '<img src="'.$b['media_file'].'" data-id="'.$b['ad_id'].'" onclick="clickaction('.$b['ad_id'].',\''.$b['url'].'\');" />';

	}

	echo '</div>';

//Util::dump($arrBanners); 


?>