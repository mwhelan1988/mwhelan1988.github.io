<?php include("includes/includedFiles.php"); 

if(isset($_GET['id'])) {
	$playlistId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$playlist= new playlist($conn, $playlistId);
$owner = new User($conn, $playlist->getOwner());

?>

<div class="entity-info">
	<div class="left-section">
        <!--replace later!!!-->
		<img src="images/img-icons/music-icons-02.png" alt="">
	</div>

	<div class="right-section">
    <h2><?php echo $playlist->getName(); ?></h2>
		<p>By <?php echo $playlist->getOwner(); ?></p>
		<p><?php echo $playlist->getNumberOfSongs(); ?> songs</p>
        <button class="btn btn-danger" onclick="deletePlaylist('<?php echo $playlistId; ?>')">Delete</button>
	</div>
</div>

<div class="track-list-container">
	<ul class="track-list">
		<?php
		 //gets list of song ids for album
		$songIdArray = $playlist->getSongIds(); //$album->getSongIds();

		$i=1;
		foreach($songIdArray as $songId){
			$playlistSong = new Song($conn, $songId);
			$songArtist = $playlistSong->getArtist();
			echo "<li class='track-list-row'>

				<div class='container'>
					<div class='row'>

						<div class='col-md-2'>
							<div class='track-count'>
							<img class='play' src='images/img-icons/tiny-play-white.png' onclick='setTrack(\"" . $playlistSong->getId() . "\", tempPlaylist, true)'>
									<span class='track-number'>$i</span>
							</div>
						</div>
							
							<div class='col-md-6'>
								<div class='track-info'>
									<span class='track-name'>" . $playlistSong->getTitle() . " </span>
									<span class='artist-name'>" . $songArtist->getName() . "</span>
								</div>
							</div>
							
							<div class='col-md-2'>
								<div class=''track-options> 
									<input type='hidden' class='songId' value='" . $playlistSong->getId() . "'>
									<img class='optionsButton' src='images/img-icons/more-icon-13.png' onclick='showOptionsMenu(this)'>						
								</div>
							</div>

							<div class='col-md-2'>
								<div class='track-duration'>
								<span class='duration'>" . $playlistSong->getDuration() . "</span>
							</div>
						</div>

					</div>
				</div>
		</li>
		<hr class='track-seperator'>
		";
			$i = $i+1;
		}
		?>

		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray);?>';
			tempPlaylist = JSON.parse(tempSongIds);
		</script>

	</ul>
</div>


<nav class="optionsMenu">
		<input type="hidden" class="songId">

		<?php echo Playlist::getPlaylistsDropdown($conn, $userLoggedIn->getUsername()); ?>	
		<div class="item" onclick="removeFromPlaylist(this,'<?php echo $playlistId; ?>')">Remove from playlist.</div>
</nav>
