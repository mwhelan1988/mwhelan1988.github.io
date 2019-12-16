<?php
	include("includes/conn.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($conn);

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

<header id="topHeader" class="text-white">


    <nav class="navbar navbar-expand-lg navbar-light" id="homeNav">
        <div class="container">

            <a class="navbar-brand" id="topLogo" href="#"><img src="/images/site-images/soundwave-logo.png" alt="Soundwave logo, on transparent background"></a>

            <button class="navbar-toggler navbar-dark ml-auto mr-auto" type="button" data-toggle="collapse"
                data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link top-link" href="#">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog.html">Membership</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact.html">Our Music</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about.html">Contact</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-md-5">
				<h1 class="homepage-heading">The best music <br> in the world, <br> all in one place.</h1>
				  <div class="home-btn">
                 	<a href="/register.php"><button class="btn btn-primary">Sign Up</button></a>
				 	<a href="/login.php"><button class="btn btn-primary">Log In</button></a>
				 </div>
            </div>
            <div class="col-md-7"></div>
        </div>
    </div>

</header>

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

		<div class="col-md-3 my-4">
				<form action="login.php" method="POST">

						<?php echo $account->getError(Constants::$loginFailed); ?>
					
					<div class="form-group">
						<div class="input-icons">
							    <i class="fas fa-envelope icons"></i>
							<input class="form-control" id="loginEmail" name="loginEmail" type="text" placeholder="Enter Email" required>
						</div>
					</div>
		
					<div class="form-group">
						<div class="input-icons">
						    	<i class="fas fa-lock icons"></i>
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
