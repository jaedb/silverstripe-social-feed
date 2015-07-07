<?php
/**
 * Social feed content controller
 *
 * This class provides the bulk of our social feed behavior and delivers
 * content and markup to the page controllers for display
 **/
class SocialFeedController extends DataExtension {
		
	public function index(){
		$this->getFacebookFeed();
	}
	
	/**
	 * Get Facebook feed
	 * 
	 * Performs a lookup for each of the specified PageIds, and gets the latest 50 posts
	 * @return Array
	 **/
	public function getFacebookFeed(){
		
		$config = SiteConfig::current_site_config();
		
		if( !$config->SocialFeedFacebookPageID ){
			echo 'You need to set your Facebook Page ID (comma-separated list)';
			die();
		}
		
		if( !$config->SocialFeedFacebookAppID ){
			echo 'You need to set your Facebook Application ID';
			die();
		}
		
		if( !$config->SocialFeedFacebookAppSecret ){
			echo 'You need to set your Facebook Application Secret';
			die();
		}
		
		if( !$config->SocialFeedFacebookToken ){
			echo 'You need to set your Facebook Long-living access token';
			die();
		}
		
		// create our session
		Facebook\FacebookSession::setDefaultApplication($config->SocialFeedFacebookAppID, $config->SocialFeedFacebookAppSecret);	
		$session = new Facebook\FacebookSession( $config->SocialFeedFacebookToken );
				
		$posts = ArrayList::create();
		
		// loop all our page ids (comma-separated list)
		$pageIds = explode(',', $config->SocialFeedFacebookPageID);
		foreach( $pageIds as $pageId ){
			
			// create a request to Facebook for the page's posts
			$request = new Facebook\FacebookRequest( $session, 'GET', '/'.$pageId.'/posts' );
			$response = $request->execute();

			// fetch as a graph object
			$graphObject = $response->getGraphObject();
			$graphArray = $graphObject->asArray();
			
			// and parse our posts into the main container
			foreach( $graphArray['data'] as $post ){
				$feedItem = SocialFeedFacebookItem::create();
				$feedItem->loadFromSource( $post );
				$posts->push( $feedItem );
			}
		}
		
		Debug::show($posts);
		
		return $posts;
	}
}