<?php

// include required library
Object::add_extension('SocialFeedSiteTreeExtension', 'TwitterOAuth');

// enable social feed SiteTree extension
Object::add_extension('SiteTree', 'SocialFeedSiteTreeExtension');

// enable social feed SiteConfig extension
Object::add_extension('SiteConfig', 'SocialFeedSiteConfigExtension');

// enable social feed controller
Object::add_extension('ContentController', 'SocialFeedContentControllerExtension');