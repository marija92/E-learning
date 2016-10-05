<?php
include_once 'database.php';

include_once 'navBar.php';

if (isset($_POST['submit'])) {
	if (!empty($_POST['email']) && !empty($_POST['pass'])){
		
		$email=$_POST['email'];
		$pass=md5($_POST['pass']);		
		
		$user= mysqli_query ( $link, "SELECT * FROM user where email LIKE '$email' AND password LIKE '$pass'" );
		if($user){	
			$_SESSION['user']=$email;
			header("Location: index.php");
		}
	}
}


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		  <title>E-learning</title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- Add custom CSS here -->
		<link href="css/modern-business.css" rel="stylesheet">
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	</head>

	<body>
	
	<?php ?>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><small>Log In into E-learning!</small></h1>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<img class="img-responsive" src="http://wp-unit4-uk.s3.amazonaws.com/wp-content/uploads/sites/6/2013/06/Mobile-working.jpg">
				</div>
				<div class="col-md-6">

					<form method="post" role="form">
						<div class="form-group">
							<label for="username1">E-mail</label>
							<input type="user" class="form-control" name="email" id="email" placeholder="">
						</div>
						<div class="form-group">
							<label for="Password1">Password:</label>
							<input type="password" class="form-control" name="pass" id="pass" placeholder="">
						</div>

						<button type="submit" name="submit" class="btn btn-info">
							Log In!
						</button>
					</form>

				</div>

			</div>
			
			
			<div class="container">

				<hr>

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