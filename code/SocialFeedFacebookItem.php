<?php
/**
 * Social feed item
 *
 * All posts, tweets and entries extend this class. It forms the basis for all standardized
 * item behavior and data. If you have any functions (links, photos, etc) that you want to have
 * available to all item types, then set them in here.
 **/
class SocialFeedFacebookItem extends SocialFeedItem{
	
	
	/**
	 * Load the source data into this object
	 **/
	public function loadFromSource( $source ){
		
		$this->ID = ( isset($source->object_id) ) ? $source->object_id : null;
		$this->Title = null;
		$this->Message = $source->message;
		$this->Type = $source->type;
		$this->Likes = ( isset($source->likes) ) ? count($source->likes->data) : 0;
		$this->Picture = ( isset($source->picture) ) ? $source->picture : null;
		$this->Link = ( isset($source->link) ) ? $source->link : null;
		
		// author
		if( isset($source->from) ){
			$this->Author = array(
						'ID' => $source->from->id,
						'Name' => $source->from->name,
						'Link' => $source->from->name
					);
		}else{
			$this->Author = null;	
		}
		
		// comments
		if( isset($source->comments) ){
			$comments = ArrayList::create();
			foreach( $source->comments->data as $comment ){
				$comments->push( ArrayData::create(array(
					'ID' => $comment->id,
					'Content' => $comment->message
				)));
			};
			$this->Comments = $comments;
		}else{
			$this->Comments = null;	
		}
	}
}