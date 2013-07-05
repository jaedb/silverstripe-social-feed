<?php

class SocialFeedSiteTreeExtension extends DataExtension {
}

class SocialFeedContentControllerExtension extends Extension {
	
	
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
							'Text'			=> $post['message'],
							'Picture'		=> $post['picture'],
							'Link'			=> $post['link'],
							'Date'			=> date('d M, Y', strtotime( $post['created_time'] ) ),
							'SortableDate'	=> date('Y-m-d', strtotime( $post['created_time'] ) ),
							'UserName'		=> $post['from']['name'],
							'UserLink'		=> 'http://facebook.com/'.$post['from']['id'],
							'UserPicture'	=> '',
						) 
					)
				); 
		}
		
		return $items;
		
	}
	
	
	/* ======================================================== SOCIAL FEED COMPILER ====== */
	/* ==================================================================================== */
	
	function SocialFeed(){
		
		// fetch the feeds
		$tweets = $this->TwitterFeed();
		$facebook = $this->FacebookFeed();
		// $linkedin = $this->LinkedInFeed();
		
		// create compiled feed
		$items = new ArrayList();
		
		// merge feed sources
		$items->merge( $tweets );
		$items->merge( $facebook );
		//$items->merge( $linkedin );				
		
		// sort by date
		$items->sort( 'SortableDate', 'DESC' );
		
		// apply limit (set in the CMS with SocialFeedSiteConfigExtension)
		$siteConfig = SiteConfig::current_site_config();
		$items = $items->limit( $siteConfig->SocialFeedLimit );
		
		// store them in a template array (for template loop)
		$feed = array(
			'Items' => $items
		);
		
		return $feed;
	}
	
	
	/* ----------------- RENDERER --- */
	
	function Content(){
		
		// get compiled social feed
		$output = $this->SocialFeed();
		
		// return rendered HTML
		return $this->owner->Customise( $output )->renderWith('SocialFeedItem');
	}
}