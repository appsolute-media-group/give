<?php


class BannerAd extends Database  {

	public $strQuery;
	public $arrResult;

	public function __construct() {

		parent::__construct();
	


	}


	public function trackImpression() {

		///api/trackimpression/1/
		$data = json_decode(file_get_contents("php://input"));

		if (!empty($data)) {
			$ad_id = isset($data->var1) ? $data->var1 : '';
		} else {
			$ad_id = isset($_REQUEST['var1']) ? $_REQUEST['var1'] : '';
		}

		$sublocality_id = $_SESSION['sublocality_id'];
		$user_id = $_SESSION['userID'];


		$this->strQuery = "UPDATE ads_impress set views=views+1 WHERE ad_id=$ad_id";
		$error_message = $this->short_query($this->strQuery);


		if(!$error_message) {
			$arrResult = array('result' => "error",'code' => "update-fail","details" => $error_message);
		} else {
			$arrResult = array('result' => "success",'code' => "impression has been tracked", "details" => $error_message);
		}

		return json_encode($arrResult);

	}






	public function trackWebClick() {

		///api/trackwebclick/1/
		$data = json_decode(file_get_contents("php://input"));

		if (!empty($data)) {
			$ad_id = isset($data->var1) ? $data->var1 : '';
		} else {
			$ad_id = isset($_REQUEST['var1']) ? $_REQUEST['var1'] : '';
		}

		$sublocality_id = $_SESSION['sublocality_id'];
		$user_id = $_SESSION['userID'];


		$this->strQuery = "UPDATE ads_impress set clicks=clicks+1 WHERE ad_id=$ad_id";
		$error_message = $this->short_query($this->strQuery);

		$this->strQuery = "INSERT INTO ads_clicks ( user_id, ad_id) VALUES ( $user_id, $ad_id )";
		$error_message = $this->short_query($this->strQuery);


		if(!$error_message) {
			$arrResult = array('result' => "error",'code' => "update-fail","details" => $error_message);
		} else {
			$arrResult = array('result' => "success",'code' => "click has been tracked", "details" => $error_message);
		}

		return json_encode($arrResult);


	}






/*****************


API methds


*/


	public function getAllBannerAds() {

		//http://restapi.clubappetite.com/api.php?controller=api&action=banners&sub_id=1&last_mod=2016-03-30%2000:00:00&page=MainPage

		$arrResult = array('result' => "error");

		$data = json_decode(file_get_contents("php://input"));

		if (!empty($data)) {
			$sub_id = isset($data->sub_id) ? $data->sub_id : '';
			$last_mod = isset($data->last_mod) ? $data->last_mod : '';
			$pageName = isset($data->page) ? $data->page : '';
			$adViewPayload = isset($data->adViewPayload) ? $data->adViewPayload : '';
			$debug = false;
		} else {
			$sub_id = isset($_REQUEST['sub_id']) ? $_REQUEST['sub_id'] : '';
			$last_mod = isset($_REQUEST['last_mod']) ? $_REQUEST['last_mod'] : '';
			$pageName = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
			$adViewPayload = isset($_REQUEST['adViewPayload']) ? $_REQUEST['adViewPayload'] : '';
			$debug = isset($_REQUEST['debug']) ? true : false;
		}



		if($pageName == 'all' || $this->blnValidPage($pageName)){

			//$user = $this->getByID($userID, $this->strTableName);
			//$sub_id = $user['sublocality_id'];


			//detect impression data in the post
			if($adViewPayload != ''){

				$arrResult += array('payload' => $adViewPayload);

				$barray = json_decode($adViewPayload, true);

			
				for($i=0;$i<count($barray);$i++){


					$id=$barray[$i]['id'];
					$views=$barray[$i]['views'];
					$strSubQueryX="INSERT INTO ads_impress (ad_id,views,clicks) 
					VALUES ($id,$views,0)
					ON DUPLICATE KEY UPDATE views=views+$views";


					$this->short_query($strSubQueryX);

					
				}


			}
		
		}




		$this->strQuery = "SELECT max(max_mod) As max_mod 
		FROM (
				SELECT max(a.last_mod) AS max_mod 
					FROM ads a 
					LEFT JOIN sponsors s on s.id=a.sponsor_id 
					WHERE (s.sublocality_id='$sub_id' OR s.sponsor_type>1) 
					AND s.blnActive=1
					AND a.blnActive=1 
				UNION ALL
				SELECT max(c.last_mod) AS max_mod 
					FROM campaigns c 
					LEFT JOIN sponsors s on s.id=c.sponsor_id 
					WHERE (s.sublocality_id='$sub_id' OR s.sponsor_type>1) 
					AND s.blnActive=1
					AND c.is_active=1 

	 	) As t_union ";
	
	
		if($this->query( $this->strQuery )) {

			$max_mod = $this->getMysqliResults( $this->strQuery, true );

			if(count($max_mod) >0) {
				$max_mod = $max_mod[0];
				$m = $max_mod['max_mod'];

				$arrResult = array('result' => "success",'code' => "no-refresh", "details" => 'No new banners for this user', 'max_mod' => $m, 'last_mod' => $last_mod); //this is the most likely response.
				if($adViewPayload != ''){
					$arrResult += array('payload' => $adViewPayload);
				}

				

				if($m > $last_mod) {
					$r = $this->getSubBannerAds($sub_id, 'all', $last_mod);
					if(!empty($r)){
						$arrResult = array('result' => "success",'code' => "refresh") + $max_mod + array('last_mod' => $last_mod, "details" => $r);
					} else {
						$arrResult += array("details" => 'no results');
					}
				}
			}

		}

		return json_encode($arrResult);

	}



	public function getSubBannerAds($sub_id,$page,$last_mod) {

		//http://restapi.clubappetite.com/api.php?controller=api&action=banners&sub_id=1&last_mod=2016-03-30%2000:00:00

		$arrResult = array('result' => "error");

		$date = Date('Y-m-d');



		//returns 1 random result for this sub
		$this->strQuery = "SELECT 
		c.ad_id, c.start_time, c.end_time, s.sponsor_name, a.ad_text, concat((SELECT img_root FROM config WHERE id=1),a.media_file) As media_file, a.url, a.ad_disp_zone_id, a.last_mod, 0 As views    
		FROM campaigns c 
		LEFT JOIN sponsors s on s.id=c.sponsor_id 
		LEFT JOIN ads a ON a.id=c.ad_id 
		WHERE (s.sublocality_id=$sub_id OR s.sponsor_type>1)
		AND ad_id>0
		AND a.blnActive=1 
		AND c.is_active=1 
		AND s.blnActive=1 
		AND ('$date' BETWEEN c.start_date AND c.end_date OR c.end_date IS NULL)";
		//ORDER BY RAND()";

		if($page <> 'all') {

			//$this->strQuery .= " LIMIT 1";

		}

//echo $this->strQuery;

		if($this->query( $this->strQuery )) {
			$r = $this->getMysqliResults( $this->strQuery, true );
			$number_entries = count($r);
      if ($number_entries > 0) {
        for ($i=0; $i < $number_entries; $i++) {
          $r[$i]['sponsor_name']  = trim(stripslashes($r[$i]['sponsor_name']));  
          $r[$i]['ad_text']       = trim(stripslashes($r[$i]['ad_text']));  
          $r[$i]['media_file']    = trim(stripslashes($r[$i]['media_file']));  
          $r[$i]['url']           = trim(stripslashes($r[$i]['url']));  
        }
      }
		} else {
			$r = null;
		}

		return $r;


	}

	public function trackClick() {

		//http://restapi.clubappetite.com/api.php?controller=api&action=trackbannerclick&ad_id=1&token=

		$arrResult = array('result' => "error");
		$this->objUsers = new Users;
		

		$data = json_decode(file_get_contents("php://input"));

		if (!empty($data)) {
			$ad_id = isset($data->ad_id) ? $data->ad_id : '';
			$token = isset($data->token) ? $data->token : '';
		} else {
			$ad_id = isset($_REQUEST['ad_id']) ? $_REQUEST['ad_id'] : '';
			$token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
		}

		$res = $this->objUsers->blnValidToken($token);
		if(empty($res)){

			$arrResult += array('details' => "Invalid token",'token' => $token);
		
		} else {

			$res = $res[0];
			$sublocality_id = $res['sublocality_id'];
			$user_id = $res['userID'];


			$this->strQuery = "UPDATE ads_impress set clicks=clicks+1 WHERE ad_id=$ad_id";
			$error_message = $this->short_query($this->strQuery);

			$this->strQuery = "INSERT INTO ads_clicks ( user_id, ad_id) VALUES ( $user_id, $ad_id )";
			$error_message = $this->short_query($this->strQuery);


			if(!$error_message) {
				$arrResult = array('result' => "error",'code' => "update-fail","details" => $error_message);
			} else {
				$arrResult = array('result' => "success",'code' => "click has been tracked", "details" => $error_message);
			}

		}


		return json_encode($arrResult);



	}


	function blnValidPage($page){

		$this->strQuery = "SELECT id    
		FROM banner_page 
		WHERE page_name ='".$this->getCleanVar($page)."'";



		if($this->query( $this->strQuery )) {
			$r = $this->getMysqliResults( $this->strQuery, true );
		} else {
			$r = false;
		}

		return $r;

	}




}