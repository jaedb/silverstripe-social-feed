<?php

class FacebookAuth extends Extension {

	public $profile_id;
	public $app_id;
	public $app_secret;
	
	function __construct() {}
	
	function fetchUrl($url){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);

		$feedData = curl_exec($ch);
		curl_close($ch); 

		return $feedData;
	}  

	function get() {
		
		// load keys and secrets from config
		$siteConfig = SiteConfig::current_site_config();
		$profile_id = $siteConfig->SocialFeedFacebookPageID;
		$app_id = $siteConfig->SocialFeedFacebookAppID;
		$app_secret = $siteConfig->SocialFeedFacebookAppSecret;

		//Retrieve auth token
		$authToken = $this->fetchUrl('https://graph.facebook.com/oauth/access_token?grant_type=client_credentials&client_id='.$app_id.'&client_secret='.$app_secret);

		$json_object = $this->fetchUrl('https://graph.facebook.com/'.$profile_id.'/feed?'.$authToken);
				
		return $json_object;
	}
	
}
