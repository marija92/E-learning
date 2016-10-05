<!DOCTYPE html>
<?php
include_once 'database.php';
include_once "navBar.php";

$providerURL = "";
$inst="/";
$logedIn=false;

if(isset($_SESSION['user'])){

	$logedIn=true;
	//proveri dali e admin;
	$email=$_SESSION['user'];
	echo $email;
}

if (isset($_POST['submit'])) {
	$idInsert = $_POST['id'];
	echo $email.$idInsert;
	$insertUserCourses = mysqli_query ($link, "INSERT INTO user_completedcourse (user, course)
			VALUES ('$email','$idInsert')");
		
}

if (isset ( $_GET ['courseID'] )) {
	$id = $_GET ['courseID'];
	$courses = mysqli_query ( $link, "SELECT * FROM course where id LIKE '$id'" );
	$course = mysqli_fetch_assoc ( $courses );
	$title = $course ['title'];
	$courseProv = $course ['provder'];
	$description = $course ['description'];
	$price = $course ['price'];
	$institution = $course ['institution'];
	
	if (! empty ( $institution )) {
		$institutions = mysqli_query ( $link, "SELECT * FROM institution where id LIKE '$institution'" );
		$institution = mysqli_fetch_assoc ( $institutions );
		$inst = $institution ['name'];
	}
	
	$categories = array ();
	$keywords = mysqli_query ( $link, "SELECT * FROM keyword where course LIKE '$id'" );
	while ( $keyword = mysqli_fetch_assoc ( $keywords ) ) {
		array_push ( $categories, $keyword ['value'] );
	}
	$courseCategories = join ( " / ", $categories );
	
	if ($courseProv == "COURSERA")
		$providerURL = "https://www.coursera.org/";
	else if ($courseProv == "UDEMY")
		$providerURL = "https://www.udemy.com";
	else if ($courseProv == "UDACITY")
		$providerURL = "https://www.udacity.com";
	else if ($courseProv == "ELEARNING")
		$providerURL = "/E-learning/index.php";	
	
} else
	header ( "Location: index.php" );
?>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>E-learning</title>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/landing-page.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet"
	type="text/css">
<link
	href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic"
	rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

	<!-- Navigation -->
	

	<!-- Header -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12"></div>
		</div>
	</div>
	<!-- Page Content -->
	<div class="container">

		<div class="row">

			<!-- Blog Post Content Column -->
			<div class="col-lg-8">

				<!-- Blog Post -->

				<!-- Title -->
				<h1><?php echo $title;?></h1>

				<!-- Author -->
				<p class="lead">
					by <a href='<?php echo $providerURL; ?>'><?php echo $courseProv;?></a>
				</p>

				<hr>

				<!-- Date/Time -->
                
                <h4 class="text-muted"><?php echo "Institution: ".$inst; ?></h4>
                 <hr>

				<!-- Date/Time -->

				<h4 class="text-warning"><?php echo "Categories: ".$courseCategories; ?></h4>



				<!-- Preview Image -->
				<!--    <img class="img-responsive" src="http://placehold.it/900x300" alt="">  -->

				<hr>

				<!-- Post Content -->
				<p><?php echo $description; ?></p>
				<hr>

				<!-- Blog Comments -->



			</div>

			<!-- Blog Sidebar Widgets Column -->
			<div class="col-md-4">




				<!-- Side Widget Well -->
				<br /> <br /> <br /> <br /> <br /> 
				<form method="post" role="form">
				<?php if($logedIn){ ?> 
				<button type="submit" name="submit" class="btn btn-lg btn-success">Mark this course as completed</button>
				<?php } else{?>
				<button type="submit" class="btn btn-lg btn-success disabled">Mark this course as completed</button>
				<?php }?>
				 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
				</form>
				<br /> <br /> 					
				<div class="well">
					<h4 class="text-success">Price: <?php echo "$".$price; ?></h4>
				</div>
				<br />
				<div class="well">
					<h4>Related courses</h4>
					<ul>
						<li>Course 1</li>
						<li>Course 2</li>
						<li>Course 3</li>
						<li>Course 4</li>
					</ul>
				</div>

			</div>
		</div>
	</div>
	<!-- /.row -->













	<!-- Footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<p class="copyright text-muted small">Copyright &copy; 2016 All
						Rights Reserved</p>
				</div>
			</div>
		</div>
	</footer>

	<!-- jQuery -->
	<script src="js/jquery.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

</body>

</html>