<?php

class SocialFeedSiteTree extends DataExtension {
	
	
	function init(){
	
		parent::init;
	
		// include default CSS styles
		Requirements::css(SOCIAL_FEED_DIRECTORY . '/css/social-feed.css');
		
	}
	
	
}