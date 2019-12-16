<?php
include("../../conn.php");


if(isset($_POST['playlistId'] ) && isset($_POST['songId'] ) ) {
    $playlistId = $_POST['playlistId'];
    $songId = $_POST['songId'];

    $query = mysqli_query($conn, "DELETE FROM playlistSongs WHERE playlistId='$playlistId' AND songId='$songId' ");
} else {
   echo "Warning PlaylistId or songId was not passed to removeFromPlaylist.php";
}

?>