SilverStripe Social Feed
========================

Compile your social media feeds into one, easy-to-style and customisable block.

**Overview**
- Loads your Twitter and Facebook feeds
- Hook can be placed anywhere in your templates with `$SocialFeed` string.
- Configure the module from within the CMS Settings / Social Feed tab

**Installation**
- Drop `master` branch into a top-level folder called 'social-feed'
- Insert `$SocialFeed` into your template where you wish your feed to appear
- Run a `/dev/build?flush=all`
- Login to the admin and configure your API keys from Settings > Social Feed

**Customising**
- Standard template loops mean you can change the appearance quickly and easily
- Basic styles are built into the module, but these are overwritten by your theme's stylesheets as you deem appropriate

**To-do**
- Load feed using ajax to avoid delaying page load
- Cache individual feed sources for further page load efficiency
- Add consideration for personal Facebook feeds (currently only grabs Pages)

**Support**
- Please email me (james _at_ jamesbarnsley co.nz)
