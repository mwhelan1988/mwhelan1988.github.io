<?php
include("../../conn.php");

if(isset($_POST['name']) && isset($_POST['username'])) {

	$name = $_POST['name'];
	$username = $_POST['username'];
	$date = date("Y-m-d");

	$query = mysqli_query($conn, "INSERT INTO playlists

										
	
											 VALUES(NULL, '$name', '$username', '$date')");

}
else {
	echo "Name or email not passed into file";
}

?>