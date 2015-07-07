<?php

// import our FacebookSession class
use Facebook\FacebookSession;

// enable social feed SiteConfig extension - this handles our config
Object::add_extension('SiteConfig', 'SocialFeedConfig');

// enable social feed controller - this allows us to parse data to the site content
Object::add_extension('ContentController', 'SocialFeedController');