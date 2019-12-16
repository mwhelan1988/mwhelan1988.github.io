<?php
include("includes/includedFiles.php");

if(isset($_GET['term'] ) ) {
    //urldecode will remove the url string created and make it into a string without the url code (% woudl he bused instead of spaces in url)
    $term  = urldecode($_GET['term']);
  
} else {
    $term = "";
}

?>

<div class="searchContainer">
    <h4 class="search-area">Search For Artist, Album, or Song.</h4>
    <input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="What are you looking for?" onfocus="this.selectionStart = this.selectionEnd = this.value.length;">
</div>



<script>
//shouldnt this stop the cursor from moving back???
$(".searchInput").focus();

$(function() {
	

	$(".searchInput").keyup(function() {
		clearTimeout(timer);

		timer = setTimeout(function() {
			var val = $(".searchInput").val();
			openPage("search.php?term=" + val);
		}, 2000);

	})
})

</script>

<?php
	//if search term is not set, do nothing
	if($term == "") exit();
?>

<div class="track-list-container borderBottom">
<h2>Songs</h2>
	<ul class="track-list">
    <?php
		$songsQuery = mysqli_query($conn, "SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10");

		if(mysqli_num_rows($songsQuery) == 0) {
			echo "<span class='noResults'>No songs found matching " . $term . "</span>";
		}

		$songIdArray = array();

		$i = 1;
		while($row = mysqli_fetch_array($songsQuery)) {

			if($i > 15) {
				break;
			}

			array_push($songIdArray, $row['id']);

			$albumSong = new Song($conn, $row['id']);
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


<div class="artist-container borderBottom">
        <h2>Artists</h2>

        <?php
            $artistsQuery = mysqli_query($conn, "SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10");

            if(mysqli_num_rows($artistsQuery) == 0) {
                echo "<span class='noResults'>No artists found matching " . $term . "</span>";
            } while($row = mysqli_fetch_array($artistsQuery) ) {
                $artistFound = new Artist($conn, $row['id']);

                echo "<div class='searchResultRow'> 
                        <div class='artistName'>
                            <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artistFound->getId() . "\")' >
                                "
                                . $artistFound->getName() .
                                "
                            </span>
                        </div>
                    </div>";
            }
        ?>
</div>


<!--
*
*
* ALBUMS SEARCH
*
*
-->


<div class="grid-view-container container">
    <div class="row">

		<?php

			$albumQuery = mysqli_query($conn, "SELECT * FROM albums WHERE TITLE LIKE '$term%' LIMIT 10");
			
			if(mysqli_num_rows($albumQuery) == 0) {
                echo "<span class='noResults'>No albums found matching " . $term . "</span>";
            }

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
