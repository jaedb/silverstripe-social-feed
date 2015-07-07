<?php
/**
 * Social feed item
 *
 * All posts, tweets and entries extend this class. It forms the basis for all standardized
 * item behavior and data. If you have any functions (links, photos, etc) that you want to have
 * available to all item types, then set them in here.
 **/
class SocialFeedItem extends Object{
	
	/**
	 * Load the source data into this object
	 **/
	public function loadFromSource( $source ){
	}	
}