<?php

// set module directory (in case installer didn't install in proper social-feed folder!)
define('SOCIAL_FEED_DIRECTORY', basename(dirname(__FILE__)));

// include required library
Object::add_extension('SocialFeedSiteTreeExtension', 'TwitterOAuth');

// enable social feed SiteTree extension
Object::add_extension('SiteTree', 'SocialFeedSiteTreeExtension');

// enable social feed SiteConfig extension
Object::add_extension('SiteConfig', 'SocialFeedSiteConfigExtension');

// enable social feed controller
Object::add_extension('ContentController', 'SocialFeedContentControllerExtension');