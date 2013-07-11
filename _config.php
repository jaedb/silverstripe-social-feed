<?php

// set module directory (in case installer didn't install in proper social-feed folder!)
define('SOCIAL_FEED_DIRECTORY', basename(dirname(__FILE__)));

// enable social feed SiteTree extension
Object::add_extension('SiteTree', 'SocialFeedSiteTree');

// enable social feed SiteConfig extension
Object::add_extension('SiteConfig', 'SocialFeedConfig');

// enable social feed controller
Object::add_extension('ContentController', 'SocialFeedController');

// include required OAuth library
Object::add_extension('SocialFeedController', 'TwitterOAuth');