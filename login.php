<?php
require_once("header.php");
include("includes/conn.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");

$account = new Account($conn);


include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name) {
	if(isset($_POST[$name])) {
		echo $_POST[$name];
	}
}
?>

<header id="loginBanner">
		<nav class="navbar navbar-expand-lg navbar-light" id="homeNav">
			<div class="container">

				<a class="navbar-brand" id="topLogo" href="/homepage.php"><img src="/images/site-images/soundwave-logo.png" alt="Soundwave logo, on transparent background"></a>

				<button class="navbar-toggler navbar-dark ml-auto mr-auto" type="button" data-toggle="collapse"
					data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>


				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="/homepage.php">Home<span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Membership</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Our Music</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Contact</a>
						</li>
					</ul>
				</div>

			</div>
		</nav>



	<div class="container">
		<div class="row">
			<div class="col-md-3"><!--Leave Empty--></div>
				<div class="col-md-6">
			
					<form id="loginForm" class="" action="login.php" method="POST">
						<div class="text-center">
							<img class="login-icon" src="/images/site-images/soundwave-icon.png" alt="Soundwave Symbol mark, on transparent background">
						</div>
						
						<h2 class="my-3 login-info">Login to your account</h2>
						
						<div class="form-group">
						<?php echo $account->getError(Constants::$loginFailed); ?>
						<div class="input-icons">
							<i class="fab fa-napster"></i>
							<input class="form-control" id="loginUsername" name="loginUsername" type="text" placeholder="Enter username" value="<?php getInputValue ('loginUsername')?>" required>
						  </div>
						</div>

							<br>

						<div class="form-group">
						  <div class="input-icons">
						    <i class="fas fa-lock icons"></i>
							<input class="form-control" id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required>
						  </div>
						</div>

						<button class="btn btn-primary mt-1" type="submit" name="loginButton">LOG IN</button>

						<p class="register-link float-right"><a href="/register.php">I want to sign up.</a></p>
				
					</form>
				</div>
			<div class="col-md-3"><!--Leave Empty--></div>
		</div>
	</div>

</header>

<!-- FOOTER -->

<footer class="footer">
<div class="container">
	<div class="row">
		<div class="col-md-1"><!--Stays Empty--></div>
		<div class="col-md-2">
			<ul class="footer-list">
				<li>
					<a class="nav-link" href="/homepage.php">Home</a>
				</li>
				<li>
					<a class="nav-link" href="#">Membership</a>
				</li>
				<li>
					<a class="nav-link" href="#">Our Music</a>
				</li>
				<li>
					<a class="nav-link" href="#">Contact</a>
				</li>
			</ul>
		</div>

		<div class="col-md-1"><!--Stays Empty--></div>

		<div class="col-md-3">
			<ul class="footer-icons">
				<li><a href="https://www.facebook.com/"><i class="fab fa-facebook-square fa-2x"></i></a></li>
				<li><a href="https://www.instagram.com/"><i class="fab fa-instagram fa-2x"></i></a></li>
			</ul>
		</div>

		<div class="col-md-1"><!--Leave Empty--></div>

		<div class="col-md-3 footer-image">
				<a href="/homepage.php"><img src="/images/site-images/soundwave-logo.png" alt="Soundwave combination mark, transparent background."></a>
				</form>
			
			</div> <!--end col-4-->

		<div class="col-md-1"><!--Stays Empty--></div>
	</div>
</div>

</footer>


<?php
require_once("footer.php");
?>