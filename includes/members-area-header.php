<?php
include("includes/conn.php");
include("includes/classes/User.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");
include("includes/classes/Playlist.php");


//Remove once you set up logout button and correct index!!!
// session_destroy();
//this will log out until you add logout button

if(isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = new User($conn, $_SESSION['userLoggedIn']);
	$username = $userLoggedIn->getUsername();
	echo "<script>userLoggedIn = '$username';</script>";
}
else {
	header("Location: homepage.php");
}

?>
?>



<?php
require_once("header.php");
?>

<div id="mainContainer">

	<div id="topContainer">

		<?php include("includes/side-nav.php");?>

		<div id="mainViewContainer">
			<div id="mainContent">