<?php  
include("includes/includedFiles.php");
?>

<div class="entityInfo">

	<div class="centerSection">
		<div class="userInfo">
			<h1><?php echo $userLoggedIn->getUserName(); ?> Settings</h1>
		</div>
	</div>

	<div class="buttonItems">
		<button class="btn btn-primary button top-button" onclick="openPage('updateDetails.php')">USER DETAILS</button>
		<button class="btn btn-primary button" onclick="logout()">LOGOUT</button>
	</div>


</div>
