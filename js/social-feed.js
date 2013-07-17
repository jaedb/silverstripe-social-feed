/*
--- SOCIAL FEED MODULE
--- By James Barnsley (james@jamesbarnsley.co.nz)
--- All rights reserved
*/



/* ================================================ SETUP THE SOCIAL FEED ============= */

function SetupSocialFeed(){

	// inject temporary loading icon
	$('#social-feed-content').html('LOADING');
	
	// get the feed
	$.ajax({
			url: '/home/SocialFeedGetter/',
			type: 'GET',
			success: function( response ){
				
				// inject feed into feed container
				$('#social-feed-content').html( response );				
			}
		});

}



	
/* ================================================ ON DOCUMENT LOAD ============= */

$(document).ready(function() {
	
	// setup social feed
	if( $('#social-feed-content').length > 0 ){
		SetupSocialFeed();
	}
	
});

