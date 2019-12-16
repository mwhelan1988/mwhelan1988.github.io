<?php include("includes/includedFiles.php"); 

if(isset($_GET['id'])) {
	$albumId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$album = new Album($conn, $albumId);

$artist = $album->getArtist();

?>

<div class="entity-info">
	<div class="left-section">
		<img src="<?php echo $album->getArtworkPath(); ?>" alt="">
	</div>

	<div class="right-section">
		<h2><?php echo $album->getTitle(); ?></h2>
		<p>By <?php echo $artist ->getName();?></p>
		<p> <?php echo $album ->getNumberOfSongs();?> Songs</p>
	</div>
</div>

<div class="track-list-container">
	<ul class="track-list">
		<?php
		 //gets list of song ids for album
		$songIdArray = $album->getSongIds();


		$i=1;
		foreach($songIdArray as $songId){
			$albumSong = new Song($conn, $songId);
			$albumArtist = $albumSong->getArtist();
			echo "<li class='track-list-row'>

					<div class='container'>
						<div class='row'>
							<div class='col-md-2'>
					
								<div class='track-count'>
									<img class='play' src='images/img-icons/tiny-play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
										<span class='track-number'>$i</span>
								</div>
							</div>
								

								<div class='col-md-6'>

								<div class='track-info'>
									<span class='track-name'>" . $albumSong->getTitle() . " </span>
									<span class='artist-name'>" . $albumArtist->getName() . "</span>
								</div>

								</div>

								<div class='col-md-2'>
									<div class=''track-options> 
										<input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
										<img class='optionsButton' src='images/img-icons/more-icon-13.png' onclick='showOptionsMenu(this)'>						
									</div>
								</div>

								<div class='col-md-2'>
									<div class='track-duration'>
										<span class='duration'>" . $albumSong->getDuration() . "</span>
									</div>
								</div>
							
						</div>
					</div>
			</li>
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
</nav>



