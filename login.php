<!doctype html>
<html>

<head>

	<meta charset="utf-8">
	<title>FreshBasket</title>

	<link rel="stylesheet" href="CSS/login.css" type="text/css">
	<link rel="shortcut icon" href="img/mylogo3.png" type="image/x-icon">

</head>

<body style="background-image: url('img/dot-grid.webp');">
	
    <!-- <h2>Welcome to FreshBasket</h2> -->
	<img src="img/sitelogo.png" style="width: 15%; padding-bottom: 30px; padding-top: 20px;">
	

	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="AccountHandler.php" method="post">
				<h1>Create Account</h1>

				<input type="text" placeholder="Name" name="txtName" id = "txtName"/>
				<input type="email" placeholder="Email" required name="txtEmail" id="txtEmail"/>
				<input type="number" placeholder="Contact number" name="txtContactNo" id="txtContactNo" pattern="[0-9]{10}" required />
				<input type="address" placeholder="Address" required name="txtAddress" id="txtAddress"/>
				<input type="password" placeholder="Password" id="txtPassword" name="txtPassword" required/>
				<input type="submit" name="btnRegister" value="Sign Up">
			</form>

		</div>
		
		<div class="form-container sign-in-container">
			<form action="AccountHandler.php" method="post">
				<h1>Sign in</h1>

				<input type="email" name="txtEmail" placeholder="Email" />
				<input type="password" name="txtPassword" placeholder="Password" />
				<a href="#">Forgot password?</a>
				<input type="submit" value="Sign In" name="btnSubmit">
				<br>
				<a href="index.php">Back to FreshBasket</a>
			</form>

		</div>

		<div class="overlay-container">
			<div class="overlay">

				<div class="overlay-panel overlay-left">
					<!-- <img src="img/mylogo10.png" style="position: absolute; top: 80px; left: 165px; width: 12%;"> -->
					<h1>Welcome Back!</h1>
					<p style="font-weight: 450;">Already have an account? Login with your current account</p>

					<input type="submit" class="ghost" id="signIn" value="Sign In">
				</div>

				<div class="overlay-panel overlay-right">
					<!-- <img src="img/mylogo10.png" style="position: absolute; top: 80px; left: 165px; width: 12%;"> -->
					<h1>Hello, There!</h1>
					<p style="font-weight: 450;">Don't have an account? Create your account with us</p>

					<input type="submit" class="ghost" id="signUp" value="Sign Up"> 
				</div>
				
			</div>
		</div>
		
	</div>

	<script>

		const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const container = document.getElementById('container');

		signUpButton.addEventListener('click', () => {
			container.classList.add("right-panel-active");
		});

		signInButton.addEventListener('click', () => {
			container.classList.remove("right-panel-active");
		});

	</script>
	
</body>
	
</html>
