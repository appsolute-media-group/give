<?php


	$objBanners = new BannerAd;
	$arrBanners = $objBanners->getSubBannerAds($_SESSION['sublocality_id'],'','1/1/1900');


	echo '<div id="rotator">';

	foreach($arrBanners As $b){

		echo '<img src="'.$b['media_file'].'" />';

	}

	echo '</div>';

//Util::dump($arrBanners); 


?>