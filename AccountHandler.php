<?php 
	session_start();

	if(isset($_POST["btnSubmit"])){
		$email = $_POST["txtEmail"];
		$password = $_POST["txtPassword"];
		
		#localhost, root, pw, db name(that u created in phpMyadmin), port(check in wamp icon and mysql)
		$con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
			
		if(!$con){
			die("Sorry, you can't connect to the database.");
		}
		
		// Check in user_tbl
		$sql_user = "SELECT * FROM `user_tbl` WHERE `email` = '$email' AND `password` = '$password'";
		$result_user = mysqli_query($con, $sql_user);

		// Check in admin_tbl
		$sql_admin = "SELECT * FROM `admin_tbl` WHERE `email` = '$email' AND `password` = '$password'";
		$result_admin = mysqli_query($con, $sql_admin);

		// Check in admin_tbl
		$sql_store = "SELECT * FROM `store_tbl` WHERE `email` = '$email' AND `password` = '$password'";
		$result_store = mysqli_query($con, $sql_store);

		
		if(mysqli_num_rows($result_user) > 0){
			$_SESSION["email"] = $email;
			header("Location: profile.php");
		} elseif(mysqli_num_rows($result_store) > 0) {
			$_SESSION["email"] = $email;
			header("Location: stores_owner.php");
		}elseif(mysqli_num_rows($result_admin) > 0) {
			$_SESSION["email"] = $email;
			header("Location: admin.php");
		}else {
			echo "<script>
				window.location.href = 'login.php';
				alert('Invalid login detail');
				</script>";
		}
		
		mysqli_close($con);
	}


	// register handler
	if(isset($_POST["btnRegister"])){
		
		$name = $_POST["txtName"];
		$email = $_POST["txtEmail"];
		$password = $_POST["txtPassword"];
		$contact = $_POST["txtContactNo"];
		$address = $_POST["txtAddress"];
		$imagePath = "img/mylogo3.png";
		
		#localhost, root, pw, db name(that u created in phpMyadmin), port(check in wamp icon and mysql)
		$con = mysqli_connect("localhost", "root", "", "novatech_database", "3306");
		
		if(!$con){
			die("Sorry, you can't connect to the database.");
		}
		
		$sql = "INSERT INTO `user_tbl` (`userID`, `email`, `name`, `contactNumber`, `address`, `password`, `imagePath`) VALUES (NULL, '$email', '$name', '$contact', '$address', '$password', '$imagePath')";
		
		mysqli_query($con, $sql);
		
		echo "<script>
			alert('Success. login to your account');
			window.location.href = 'login.php';
			</script>";
		
	}

?>