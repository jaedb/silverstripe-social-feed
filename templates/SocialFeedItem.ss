<h2>Social Feed:</h2>
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
		
		<p>$Text</p>
		
		<p><em>$Date</em></p>
		
	</div>
	
	--
	
<% end_loop %>