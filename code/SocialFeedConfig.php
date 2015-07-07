<?php

class SocialFeedConfig extends DataExtension {
	
	// configuration options
	static $db = array(
		'SocialFeedTitle' 					=> 'Text',
		'SocialFeedLimit' 					=> 'Int',		
		
		'SocialFeedFacebookActive'			=> 'Boolean',
		'SocialFeedFacebookPageID'			=> 'Varchar(1000)',
		'SocialFeedFacebookAppID'			=> 'Varchar(100)',
		'SocialFeedFacebookAppSecret'		=> 'Varchar(100)',	
		'SocialFeedFacebookToken'			=> 'Varchar(1000)',	
		
		'SocialFeedTwitterActive'			=> 'Boolean',
		'SocialFeedTwitterConsumerKey'		=> 'Varchar(100)',
		'SocialFeedTwitterConsumerSecret'	=> 'Varchar(100)',
		'SocialFeedTwitterAccessToken'		=> 'Varchar(100)',
		'SocialFeedTwitterAccessSecret'		=> 'Varchar(100)',
		
		'SocialFeedLinkedInActive'			=> 'Boolean',
		'SocialFeedLinkedInAPIKey'			=> 'Varchar(100)',
		'SocialFeedLinkedInSecretKey'		=> 'Varchar(100)',
		'SocialFeedLinkedInUserToken'		=> 'Varchar(100)',
		'SocialFeedLinkedInUserSecret'		=> 'Varchar(100)'
	);
	
	public function updateCMSFields(FieldList $fields) {
	
		$fields->addFieldsToTab( 'Root.SocialFeed.Main', new TextField('SocialFeedTitle', 'Feed title' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Main', new TextField('SocialFeedLimit', 'Feed items to display' ) );
		
		$fields->addFieldsToTab( 'Root.SocialFeed.Facebook', new LiteralField('html_1', '<h2>Facebook</h2>' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Facebook', new CheckboxField('SocialFeedFacebookActive', 'Show Facebook Feed?' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Facebook', new TextField('SocialFeedFacebookPageID', 'Facebook Page ID (comma-separated list)' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Facebook', new TextField('SocialFeedFacebookAppID', 'App ID' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Facebook', new TextField('SocialFeedFacebookAppSecret', 'App Secret' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Facebook', new TextField('SocialFeedFacebookToken', 'Long-living access token' ) );
		
		$fields->addFieldsToTab( 'Root.SocialFeed.Twitter', new LiteralField('html_2', '<h2>Twitter</h2>' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Twitter', new CheckboxField('SocialFeedTwitterActive', 'Show Twitter Feed?' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Twitter', new TextField('SocialFeedTwitterConsumerKey', 'Consumer Key' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Twitter', new TextField('SocialFeedTwitterConsumerSecret', 'Consumer Secret' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Twitter', new TextField('SocialFeedTwitterAccessToken', 'Access Token' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Twitter', new TextField('SocialFeedTwitterAccessSecret', 'Access Secret' ) );
	}

}
