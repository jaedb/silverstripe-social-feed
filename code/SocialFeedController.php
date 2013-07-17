<?php

class SocialFeedController extends DataExtension {
		
	// setup error message container
	public $error;	
	
	// allow this custom action
	public static $allowed_actions = array(
		'SocialFeedGetter' );		
		
		
		
		
	/* ======================================================= CONTAINER IN TEMPLATE ====== */
	/* ==================================================================================== */
	
	// construct the social feed
	function SocialFeed() {
		
		// include default styles
		Requirements::css("social-feed/css/social-feed.css");
		
		// include required javascript
		Requirements::javascript("social-feed/js/jquery.js");
		Requirements::javascript("social-feed/js/social-feed.js");
		
		// return rendered HTML container
		return $this->owner->renderWith('SocialFeed');
    }
	
	
	
	
	/* ================================================ RENDER FEED (called by Ajax) ====== */
	/* ==================================================================================== */
	
	// construct the social feed
	function SocialFeedGetter( $request ) {	
		
		// run the social feed getter
		$output = $this->CompileSocialFeed();
		
		// return rendered HTML
		return $this->owner->Customise( $output )->renderWith('SocialFeedItem');		
	
    }
	
	
	
	
	/* ================================================================ TWITTER FEED ====== */
	/* ==================================================================================== */
	
	function TwitterFeed(){
		
		// get configuration
		$siteConfig = SiteConfig::current_site_config();
		
		// create new connection
		$connection = new TwitterOAuth( 
									$siteConfig->SocialFeedTwitterConsumerKey,
									$siteConfig->SocialFeedTwitterConsumerSecret,
									$siteConfig->SocialFeedTwitterAccessToken,
									$siteConfig->SocialFeedTwitterAccessSecret
								);

		// using connection, get the user timeline
		$tweets = $connection->get("statuses/user_timeline");
		
		
		// check if tweet getter failed
		if( isset($tweets->errors) ){
			$this->error = 'Could not connect to Twitter. Check your API keys.';
			return false;
		}
		
		// construct array list from twitter feed
		$items = new ArrayList(); 
		
		// loop each tweet
		foreach( $tweets as $tweet){
				
			// insert into our ArrayList
			$items->push( 
				new ArrayData( 
					array(
							'Source'		=> 'twitter',
							'Text'			=> $tweet->text,
							'Date'			=> date('d M, Y', strtotime( $tweet->created_at ) ),
							'SortableDate'	=> date('Y-m-d', strtotime( $tweet->created_at ) ),
							'UserName'		=> $tweet->user->screen_name,
							'UserLink'		=> 'http://twitter.com/'.$tweet->user->screen_name,
							'UserPicture'	=> $tweet->user->profile_image_url,
							'SourceIcon'	=> SOCIAL_FEED_DIRECTORY . '/images/source-twitter.gif'
						) 
					)
				); 
		}
		
		return $items;
	}
	
	
	/* =============================================================== FACEBOOK FEED ====== */
	/* ==================================================================================== */
		
	function FacebookPhoto( $url ){
					
		// get json facebook feed as php array
		$photos = json_decode( file_get_contents($url), true );
		$photos = $photos['images'];
		
		return $photos[0]['source'];
	}
	
	function FacebookFeed(){
		
		// create new connection
		$connection = new FacebookAuth();
		
		// get the Facebook feed
		$feed = $connection->get();	
		$posts = json_decode( $feed, true );
		
		// check if feed getter failed
		if( isset( $posts['error'] ) ){
			$this->error = 'Could not connect to Facebook. Check your API keys.';
			return false;
		}
		
		// parse feed into array
		$posts = $posts['data'];
		
		// construct array list from twitter feed
		$items = new ArrayList(); 
		
		// loop each post
		foreach( $posts as $post){
			
			// insert into our ArrayList
			$items->push( 
				new ArrayData( 
					array(
							'Source'		=> 'facebook',
							'Text'			=> isset($post['message']) ? $post['message'] : null,
							'Picture'		=> isset($post['picture']) ? $post['picture'] : null,
							'Link'			=> isset($post['link']) ? $post['link'] : null,
							'Date'			=> date('d M, Y', strtotime( $post['created_time'] ) ),
							'SortableDate'	=> date('Y-m-d', strtotime( $post['created_time'] ) ),
							'UserName'		=> $post['from']['name'],
							'UserLink'		=> 'http://facebook.com/'.$post['from']['id'],
							'UserPicture'	=> '',
							'SourceIcon'	=> SOCIAL_FEED_DIRECTORY . '/images/source-facebook.gif'
						) 
					)
				); 
		}
		
		return $items;
		
	}
	
	
	/* ======================================================== SOCIAL FEED COMPILER ====== */
	/* ==================================================================================== */
	
	function CompileSocialFeed(){
		
		// grab the module config (in Admin > Settings > Social Feed)
		$siteConfig = SiteConfig::current_site_config();
		
		// create compiled feed
		$items = new ArrayList();
		
		// fetch twitter and merge into feed
		if( $siteConfig->SocialFeedTwitterActive ){
			$tweets = $this->TwitterFeed();
			
			// make sure we got tweets
			if( $tweets ){
				$items->merge( $tweets );
			}
		}
		
		// fetch facebook and merge into feed
		if( $siteConfig->SocialFeedFacebookActive ){
			$facebook = $this->FacebookFeed();
			
			// make sure we got posts
			if( $facebook ){
				$items->merge( $facebook );	
			}
		}
		
		// sort by date
		$items->sort( 'SortableDate', 'DESC' );
		
		// apply limit (set in the CMS with SocialFeedSiteConfigExtension)
		$items = $items->limit( $siteConfig->SocialFeedLimit );
		
		// store them in a template array (for template loop)
		$feed = array(
			'Items' => $items,
			'Error' => $this->error
		);
		
		return $feed;
	}
	
	
}