<?php

class SocialFeedConfig extends DataExtension {
	
	// configuration options
	static $db = array(
		'SocialFeedTitle' 					=> 'Text',
		'SocialFeedLimit' 					=> 'Int',		
		
		'SocialFeedFacebookActive'			=> 'Boolean',
		'SocialFeedFacebookPageID'			=> 'Varchar(100)',
		'SocialFeedFacebookAppID'			=> 'Varchar(100)',
		'SocialFeedFacebookAppSecret'		=> 'Varchar(100)',	
		
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
	
	function extraStatics($class = NULL, $extension = NULL) { 
		return array(
			'defaults' => array( 
					'SocialFeedLimit' => '10' 
				)
			); 
	}
	
	public function updateCMSFields(FieldList $fields) {
	
		$fields->addFieldsToTab( 'Root.SocialFeed.Main', new TextField('SocialFeedTitle', 'Feed title' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Main', new TextField('SocialFeedLimit', 'Feed items to display' ) );
		
		$fields->addFieldsToTab( 'Root.SocialFeed.Facebook', new LiteralField('html_1', '<h2>Facebook</h2>' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Facebook', new CheckboxField('SocialFeedFacebookActive', 'Show Facebook Feed?' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Facebook', new TextField('SocialFeedFacebookPageID', 'Facebook Page ID' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Facebook', new TextField('SocialFeedFacebookAppID', 'App ID' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Facebook', new TextField('SocialFeedFacebookAppSecret', 'App Secret' ) );
		
		$fields->addFieldsToTab( 'Root.SocialFeed.Twitter', new LiteralField('html_2', '<h2>Twitter</h2>' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Twitter', new CheckboxField('SocialFeedTwitterActive', 'Show Twitter Feed?' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Twitter', new TextField('SocialFeedTwitterConsumerKey', 'Consumer Key' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Twitter', new TextField('SocialFeedTwitterConsumerSecret', 'Consumer Secret' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Twitter', new TextField('SocialFeedTwitterAccessToken', 'Access Token' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.Twitter', new TextField('SocialFeedTwitterAccessSecret', 'Access Secret' ) );
		
		/*
		$fields->addFieldsToTab( 'Root.SocialFeed.LinkedIn', new LiteralField('html_2', '<h2>LinkedIn</h2>' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.LinkedIn', new CheckboxField('SocialFeedLinkedInActive', 'Show LinkedIn Feed?' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.LinkedIn', new TextField('SocialFeedLinkedInAPIKey', 'API Key' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.LinkedIn', new TextField('SocialFeedLinkedInSecretKey', 'Secret Key' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.LinkedIn', new TextField('SocialFeedLinkedInUserToken', 'User Token' ) );
		$fields->addFieldsToTab( 'Root.SocialFeed.LinkedIn', new TextField('SocialFeedLinkedInUserSecret', 'User Secret' ) );
		*/
	}

}
