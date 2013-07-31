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
		
		// load site config (contains API keys etc)
		$siteConfig = SiteConfig::current_site_config();

		//Retrieve auth token
		$authToken = $this->fetchUrl('https://graph.facebook.com/oauth/access_token?grant_type=client_credentials&client_id='.$siteConfig->SocialFeedFacebookAppID.'&client_secret='.$siteConfig->SocialFeedFacebookAppSecret);

		$json_object = $this->fetchUrl('https://graph.facebook.com/'.$siteConfig->SocialFeedFacebookPageID.'/feed?'.$authToken);
				
		return $json_object;
	}
	
}
