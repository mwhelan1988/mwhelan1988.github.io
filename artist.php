<?php
include("includes/includedFiles.php");

if(isset($_GET['id'] ) ) {
    $artistId = $_GET['id'];
} else {
    //change this later to an error page (artits could not be found)
    header("Location: index.php");
}

$artist = new Artist($conn, $artistId);
?>

<div class="entity-info borderBottom">
    <div class="centerSection">
        <div class="artistInfo">
            <h1 class="artistName"><?php echo $artist->getName();?></h1>

            <div class="headerButtons">
                <button class="btn btn-primary" onClick="playFirstSong()">Play</button>
            </div>
        </div>
    </div>
</div>


<!--
******

TRACK LIST SECTION OF PAGE

******
-->

<h2 class="musicDetailsEdit">Songs</h2>

<div class="track-list-container borderBottom">
	<ul class="track-list">
		<?php
        //gets list of song ids for album
		$songIdArray = $artist->getSongIds();

		$i=1;
		foreach($songIdArray as $songId){
            //only show a max of 5 songs (break will break the loop if there are more)
            if($i > 5) {
                break;
            }

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

<!--
******

ARTIST SECTION OF PAGE

******
-->

<h2 class="musicDetailsEdit">Albums</h2>

<div class="grid-view-container container">
    <div class="row">

        <?php
            $albumQuery = mysqli_query($conn, "SELECT * FROM albums WHERE artist='$artistId'");

            while($row = mysqli_fetch_array($albumQuery)) {

                

                echo "<div class='grid-view-item'>
                <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
                        <img src='" . $row['artworkPath'] . "'>
                  
                        <div class='griv-view-info'>"
                            . $row['title'] . 
                        "</div>
                    </span>
                </div>";
            }
        ?>

    </div>
</div>

<nav class="optionsMenu">
		<input type="hidden" class="songId">

		<?php echo Playlist::getPlaylistsDropdown($conn, $userLoggedIn->getUsername()); ?>	
</nav>
