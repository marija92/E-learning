<?php
include_once 'database.php';
include_once 'navBar.php';

if (isset($_POST['submit'])) {
	if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['pass2'])){

		$name=$_POST['name'];
		$surname=$_POST['surname'];
		$email=$_POST['email'];
		$pass=md5($_POST['pass']);
		
		$userInsert = mysqli_query ( $link, "INSERT INTO user (name, surname, email, password, isAdmin)
					VALUES ('$name','$surname','$email','$pass',0)");
		
		session_start();	
		$_SESSION['user'] = $email;
		header("Location: myProfile.php?email=".$email);
		
	}
	else{
		header("Location: signup.php");
	}
}

?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>E-learning¸</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- Add custom CSS here -->
		<link href="css/modern-business.css" rel="stylesheet">
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	</head>

	<body>

	
		<div class="container">

			<div class="row">

				<div class="col-lg-12">
					<h1 class="page-header"><small>Create your account</small></h1>

				</div>

			</div>

			<div class="row">

				<div class="col-md-6">
					<img class="img-responsive" src="http://www.a2z-support.com/wp-content/uploads/2015/01/Sign-Up-680x365_c.jpg" alt="e-tickets"  width="507" height="338">
				</div>

				<div class="col-md-6">
					
					<form method="post" action=# role="form">
						<div class="form-group">
							<label for="User1">Name:</label>
							<input type="text" class="form-control" name="name" id="name">
						</div>
						<div class="form-group">
							<label for="User1">Surname:</label>
							<input type="text" class="form-control" name="surname" id="surname" >
						</div>
						<div class="form-group">
							<label for="Email1">E-mail:</label>
							<input type="text" class="form-control" name="email" id="email">
						</div>
						<div class="form-group">
							<label for="Password1">Password:</label>
							<input type="password" class="form-control" name="pass" id="pass">
						</div>
						<div class="form-group">
							<label for="Password1">Confirm your password:</label>
							<input type="password" class="form-control" name="pass2" id="pass2">
						</div>

						<button type="submit" name="submit" class="btn btn-info">
							Sign up!
						</button>
					</form>

				</div>

			</div>

			<!-- Team Member Profiles -->

			<div class="container">

				<hr>

					<!-- Footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<p class="copyright text-muted small">Copyright &copy; 2016 All Rights Reserved</p>
				</div>
			</div>
		</div>
	</footer>
				
			</div><!-- /.container -->

			<!-- Bootstrap core JavaScript -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="js/jquery.js"></script>
			<script src="js/bootstrap.js"></script>
			<script src="js/modern-business.js"></script>
	</body>
</html>