<?php

include("../../conn.php");

if(isset($_POST['playlistId'] ) ) {
    $playlistId = $_POST['playlistId'];

    $playlistQuery = mysqli_query($conn, "DELETE FROM playlists WHERE id ='$playlistId'");
    $songsQuery = mysqli_query($conn, "DELETE FROM playlistSongs WHERE playlistId ='$playlistId'");
} else {
   echo "Warning!!! Playlist was not passed to deletePlaylist.php"; 
}

?>