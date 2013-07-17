<% if Error %>
	<p class="message bad">$Error</p>
<% else %>
	
	<% if Items %>
		
		<% loop Items %>
			
			<div class="social-feed-item $Source">
				
				<% if $UserPicture %>
					<a href="$UserLink" class="user-picture" target="_blank">
						<img src="$UserPicture" alt="$UserName $Source user" />
					</a>
				<% end_if %>
				
				<% if $Picture %>
					<a href="$Link" class="post-picture" target="_blank">
						<img src="$Picture" alt="Picture from post" />
					</a>
				<% end_if %>
				
				<p class="text">$Text</p>
				
				<p class="date"><img class="source-icon" src="$SourceIcon" /> $Date</p>
				
			</div>
			
		<% end_loop %>
		
	<% else %>
	
		<p class="message bad">
			You need to setup the feeds from the admin <a href="/admin/settings/social-feed">Social Feed</a> area.
		</p>
		
	<% end_if %>
	
<% end_if %>	