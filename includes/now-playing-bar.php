<?php
$songQuery = mysqli_query($conn, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");

$resultArray = array();

while($row = mysqli_fetch_array($songQuery)) {
    array_push($resultArray, $row['id']);
}
$jsonArray = json_encode($resultArray);
?>

<!-- Below converts php into json -->
<script>

$(document).ready(function() {
	var newPlaylist = <?php echo $jsonArray; ?>;
	audioElement = new Audio();
    setTrack(newPlaylist[0], newPlaylist, false);
    updateVolumeProgressBar(audioElement.audio);

    $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e){
        e.preventDefault();
    });


	$(".playbackBar .progressBar").mousedown(function() {
		mouseDown = true;
	});

	$(".playbackBar .progressBar").mousemove(function(e) {
		if(mouseDown == true) {
			//Set time of song, depending on position of mouse
			timeFromOffset(e, this);
		}
	});

	$(".playbackBar .progressBar").mouseup(function(e) {
		timeFromOffset(e, this);
	});


	$(".volumeBar .progressBar").mousedown(function() {
		mouseDown = true;
	});

	$(".volumeBar .progressBar").mousemove(function(e) {
		if(mouseDown == true) {

			var percentage = e.offsetX / $(this).width();

			if(percentage >= 0 && percentage <= 1) {
				audioElement.audio.volume = percentage;
			}
		}
	});

	$(".volumeBar .progressBar").mouseup(function(e) {
		var percentage = e.offsetX / $(this).width();

		if(percentage >= 0 && percentage <= 1) {
			audioElement.audio.volume = percentage;
		}
	});

	$(document).mouseup(function() {
		mouseDown = false;
	});

});

function timeFromOffset(mouse, progressBar) {
	var percentage = mouse.offsetX / $(progressBar).width() * 100;
	var seconds = audioElement.audio.duration * (percentage / 100);
	audioElement.setTime(seconds);
}

//go back a song
//if more than 3 seconds has been played replay song
//else, go back a song
// WARNING!!! if you are on first song it will keep repeating it (maybe change later to loop through???)
function prevSong() {
    if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
        audioElement.setTime(0);
    } else {
        currentIndex = currentIndex - 1;
        setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
    }
}

//skip to next song
function nextSong() {

    if(repeat == true) {
        audioElement.setTime(0);
        playSong();
        return;
    }

    if(currentIndex == currentPlaylist.length - 1) {
        currentIndex = 0;
    } else {
        currentIndex ++;
    }
    var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
    //below element calls on "currentIndex (see below)
    setTrack(trackToPlay, currentPlaylist, true);
}

//set repeat button
function setRepeat() {
	repeat = !repeat;
	var imageName = repeat ? "music-icons-07.png" : "music-icons-02.png";
	$(".controlButton.repeat img").attr("src", "images/img-icons/" + imageName);
}
//set mute button
function setMute() {
	audioElement.audio.muted = !audioElement.audio.muted;
	var imageName = audioElement.audio.muted ? "music-icons-06.png" : "music-icons-05.png";
	$(".controlButton.volume img").attr("src", "images/img-icons/" + imageName);
}

//set shuffle
//on click add shuffle, change icon
function setShuffle() {
	shuffle = !shuffle;
	var imageName = shuffle ? "music-icons-04.png" : "music-icons-09.png";
    $(".controlButton.shuffle img").attr("src", "images/img-icons/" + imageName);
    
	if(shuffle == true) {
		//Randomize playlist
		shuffleArray(shufflePlaylist);
		currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
	}
	else {
		//shuffle has been deactivated
		//go back to regular playlist
		currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
	}

}

//Got this off google, (shuffle array, sets shuffle function)
function shuffleArray(a) {
    var j, x, i;
    for (i = a.length; i; i--) {
        j = Math.floor(Math.random() * i);
        x = a[i - 1];
        a[i - 1] = a[j];
        a[j] = x;
    }
}


function setTrack(trackId, newPlaylist, play) {

	if(newPlaylist != currentPlaylist) {
		currentPlaylist = newPlaylist;
		shufflePlaylist = currentPlaylist.slice();
		shuffleArray(shufflePlaylist);
	}

	if(shuffle == true) {
		currentIndex = shufflePlaylist.indexOf(trackId);
	}
	else {
		currentIndex = currentPlaylist.indexOf(trackId);
	}
	pauseSong();


   $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {

    //get track name, show in now playing footer
    var track = JSON.parse(data);
    $(".track-name span").text(track.title);

    //get artist name, put in now playing footer
    $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(data) {
        var artist = JSON.parse(data);
        $(".track-info .artist-name span").text(artist.name);
        //make onclick in footer artist name
        $(".track-info .artist-name span").attr("onclick", "openPage('artist.php?id=" + artist.id + "')");
    });

    //get album image, put in now playing footer
    $.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(data) {
        var album = JSON.parse(data);
        $(".content .album-link img").attr("src", album.artworkPath);
        //make onclick in footer album icon
        $(".content .album-link img").attr("onclick", "openPage('album.php?id=" + album.id + "')");
        //make onlcik in footer for album name 
        $(".track-info .track-name span").attr("onclick", "openPage('album.php?id=" + album.id + "')");
    });

    //set track
    //play song
    audioElement.setTrack(track);
        if(play == true) {
           playSong();
        }   
   });

   
}

//click play button, music plays
//hide play button
//show pause button
function playSong() {

    if(audioElement.audio.currentTime == 0) {
        $.post("includes/handlers/ajax/updatePlays.php", {songId: audioElement.currentlyPlaying.id});
    }

    $(".controlButton.play").hide();
	$(".controlButton.pause").show();
    audioElement.play();
}
// click pause button, music stops
//hide pause button
//show play button
function pauseSong() {
    $(".controlButton.play").show();
	$(".controlButton.pause").hide();
    audioElement.pause();
}

</script>



<div id="nowPlayingBarContainer">

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div id="nowPlayingBar">

                <div id="nowPlayingLeft">
                    <div class="content">
                        <span class="album-link">
                            <img role="link" tabindex="0" class="album-artwork" src="">
                        </span>

                        <div class="track-info">
                            <span class="track-name">
                                <span role="link" tabindex="0"></span>
                            </span>

                            <span class="artist-name">
                                <span role="link" tabindex="0">Artist Name</span>
                            </span>
                        </div>
                    </div>
                </div>

    <br class="br-on-mobile">

                <div id="nowPlayingCenter">

                        <div class="content player-controls">
                        

                            <div class="buttons">

                                <button class="controlButton shuffle" title="Shuffle Button" onclick="setShuffle()">
                                    <img src="images/img-icons/music-icons-04.png" alt="shuffle">
                                </button>
                                                    
                            
                                <button class="controlButton previous" title="Previous Track" onclick="prevSong()"><i class="fas fa-step-backward fa-lg" alt="Previous"></i></button>
                            

                                <button class="controlButton play" title="Play Button" onclick="playSong()"><i class="far fa-play-circle fa-3x" alt="Play"></i></button>

                                <button class="controlButton pause" title="Pause Button" style="display: none;" onclick="pauseSong()"><i class="far fa-pause-circle fa-3x" alt="Pause"></i></button>
                                <!-- Reminder! You have display none on the pause BUTTON!!! -->

                                <button class="controlButton next" title="Next Track" onclick="nextSong()"><i class="fas fa-step-forward fa-lg" alt="Next"></i></button>
                            
                                <button class="controlButton repeat" title="Repeat Song" onclick="setRepeat()">
                                <img src="images/img-icons/music-icons-02.png" alt="Repeat">
                                </button>
                            
                            </div>

                            <div class="playbackBar">
                                <span class="progressTime current">0.00</span>

                                <div class="progressBar">
                                    <div class="progressBarBg">
                                        <div class="progress"><!--Keep Empty--></div>
                                    </div>
                                </div>

                                <span class="progressTime remaining">0.00</span>
                            </div>
                            
                        </div>
                    </div>

    <br class="br-on-mobile">

                <div id="nowPlayingRight">

                    <div class="volumeBar">
                        <button class="controlButton volume" title="Volume Button" onclick="setMute()">
                            <img src="images/img-icons/music-icons-05.png" alt="volume button">
                        </button>

                        <div class="progressBar">
                            <div class="progressBarBg">
                                <div class="progress"><!--Keep Empty--></div>
                            </div>
                        </div>  <!--End progressBar-->

                    </div>
                </div>

            </div>
        
        </div>
    </div>
</div>

</div>  <!--End #NowPlayingBarContainer-->



