<?php
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

<?php
require_once("header.php");
?>



<header id="registerBanner">
	<video autoplay muted loop id="myVideo">
		<source src="/images/site-images/vinyl-video.mp4" type="video/mp4">
	</video>

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
			<div class="col-md-2"><!--LEAVE EMPTY--></div>
				<div class="col-md-8">

					<div id="inputContainer">
						
						<form id="registerForm" action="register.php" method="POST">
							<h2 class="mb-5 text-center">Create your account <br>
							and start listening</h2>


							<div class="form-group">
								<?php echo $account->getError(Constants::$usernameCharacters); ?>
								<?php echo $account->getError(Constants::$usernameTaken); ?>
									<div class="input-icons">
									   <i class="fab fa-napster"></i>
									   <input class="form-control" id="userName" name="username" type="text" placeholder="Enter Username" value="<?php getInputValue('username') ?>" required>
							  	</div>
							</div>

						
	
							<div class="form-group">
									<div class="row">
										<div class="col-md-6 input-pad">
											<?php echo $account->getError(Constants::$firstNameCharacters); ?>
										  <div class="input-icons">
											<i class="fas fa-user icons"></i>
											<input class="form-control" id="firstName" name="firstName" type="text" placeholder="First Name" value="<?php getInputValue('firstName') ?>" required>
										  </div>
										</div>

									<div class="col-md-6">
										<?php echo $account->getError(Constants::$lastNameCharacters); ?>
									  <div class="input-icons">
										<i class="fas fa-user icons"></i>
										<input class="form-control" id="lastName" name="lastName" type="text" placeholder="Last Name" value="<?php getInputValue('lastName') ?>" required>
									  </div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
								<?php echo $account->getError(Constants::$emailInvalid); ?>
								<?php echo $account->getError(Constants::$emailTaken); ?>
							  <div class="input-icons">
							    <i class="fas fa-envelope icons"></i>
								<input class="form-control" id="email" name="email" type="email" placeholder="Email" value="<?php getInputValue('email') ?>" required>
							  </div>
							</div>

				
							<div class="form-group">
							  <div class="input-icons">
							    <i class="fas fa-envelope icons"></i>
								<input class="form-control" id="email2" name="email2" type="email" placeholder="Confirm Email" value="<?php getInputValue('email2') ?>" required>
							  </div>
							</div>

							<div class="form-group">
								<?php echo $account->getError(Constants::$passwordRules); ?>
								<?php echo $account->getError(Constants::$passwordCharacters); ?>
							  <div class="input-icons">
							  	<i class="fas fa-lock icons"></i>
								<input class="form-control" id="password" name="password" type="password" placeholder="Password" required>
							  </div>
							</div>

							<div class="form-group">
							  <div class="input-icons">
							 	<i class="fas fa-lock icons"></i>
								<input class="form-control" id="password2" name="password2" type="password" placeholder="Confirm password" required>
							  </div>
							</div>

							<button class="btn btn-primary" type="submit" name="registerButton">SIGN UP</button>
							
							<p class="register-link"><a href="/login.php">I already have an account.</a></p>
							
						</form>

					</div>
				</div>
			<div class="col-md-2"><!--LEAVE EMPTY--></div>
		</div>
	</div>
</header>

<!-- Footer -->
<footer class="footer footer-vinyl">
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
					<li><a href="https://www.instagram.com/"><i class="fab fa-facebook-square fa-2x"></i></a></li>
					<li><a href="https://www.facebook.com/"><i class="fab fa-instagram fa-2x"></i></a></li>
				</ul>
			</div>

			<div class="col-md-1"><!--Leave Empty--></div>

		<div class="col-md-3 my-4">
				<form id="footerLoginForm" action="login.php" method="POST">

						<?php echo $account->getError(Constants::$loginFailed); ?>

					<div class="input-icons">
						<i class="fab fa-napster"></i>
						<div class="form-group">
							<input class="form-control" id="loginUsername" name="loginUsername" type="text" placeholder="Enter Username" required>
						</div>
					</div>

					<div class="input-icons">
						<i class="fas fa-lock icons"></i>
						<div class="form-group">
							<input class="form-control" id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required>
						</div>
					</div>

					
					<p class="float-left footer-button"><a href="/register.php">Register here.</a></p>
					<button class="btn btn-primary float-right" type="submit" name="loginButton">LOG IN</button>
					
				</form>
			
			</div> <!--end col-4-->


			<div class="col-md-1"><!--Stays Empty--></div>
		</div>
	</div>
</footer>


<?php
require_once("footer.php");
?>