<?php
include("includes/includedFiles.php");
?>


<div class="playlistContainer">
    <div class="grid-view-container">

        <h2 class="yourPlaylist">Your Playlists</h2>
		<hr>

	<div class='containter'>
		<div class='row'>

			<div class="col-md-12">
				<div class="buttonItemsMusic">
					<button class="btn btn-primary inner-btn" onclick="createPlaylist()">New Playlist</button>
				</div>
			</div>

				<?php
					$username = $userLoggedIn->getUsername();

					$playlistsQuery = mysqli_query($conn, "SELECT * FROM playlists WHERE owner='$username'");

					if(mysqli_num_rows($playlistsQuery) == 0) {
						echo "<span class='noResults'>You don't have any playlists yet.</span>";
					}

					while($row = mysqli_fetch_array($playlistsQuery)) {

						$playlist = new Playlist($conn, $row);

						echo "
						
							<div class='col-md-3'>
								<div class='gridViewItem' role='link' tabindex='0' onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\")'>

									<div class='playlistImage'>
										<img src='images/img-icons/music-icons-04.png'>
									</div>
								
									<div class='gridViewInfo'>"
										. $playlist->getName() .
									"</div>

									
								</div>
							</div>";

					}
				?>
			</div>
		</div>

    </div>
</div>