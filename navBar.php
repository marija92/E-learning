	<!-- Navigation -->
<?php 
session_start();
$logedIn=false;
$isAdmin=false;

 if(isset($_SESSION['user'])){
 	 	
 	$logedIn=true;
 	//proveri dali e admin;
 	$email=$_SESSION['user'];
 	$user= mysqli_query ( $link, "SELECT * FROM user where email LIKE '$email'" );
 	$userDetails = mysqli_fetch_assoc ( $user );
 	$email=$userDetails['email'];
 	$name= $userDetails['name'];
 	$sur=$userDetails['surname'];
 	$admin=$userDetails['isAdmin'];
 	if($admin==1) {$isAdmin=true;}
 	$userName=$name." ".$sur;
  	
 }
?>	
	
	<nav class="navbar navbar-default navbar-fixed-top topnav"
		role="navigation">
		<div class="container topnav">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand topnav" href="index.php">E-learning - All
					courses in one place</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li>
					<?php if ($isAdmin){?>
                        <a href="insertCourse.php">Insert new course</a>
                        <?php }?>
                    </li>
                    <?php if ($logedIn){?>
 	               	<li>
                        <a href="myProfile.php?email="<?php echo $email;?>>Welcome <?php echo $userName;?> </a>
                    </li>
                    <li>
                        <a href="logout.php">Log Out</a>
                    </li>
                    <?php } else{?>
                    <li>
                        <a href="login.php">Log In</a>
                    </li>
                    <li>
                        <a href="signup.php">Create account</a>
                    </li> 
                    <?php }?>

				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>
