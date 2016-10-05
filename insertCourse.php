<!DOCTYPE html>
<?php
include_once 'database.php';
include_once 'navBar.php';
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
	

<div class="col-lg-2"></div>
<div class="col-lg-8">

<h3 style="color:gray">Insert new course</h3>
<br />

<form action="insertIntoDB.php" method="post"  enctype="multipart/form-data" >
<div class="form-group">
<label for="title">Course title </label>
<input type="text" class="form-control" name="title" id="title" />
<label for="category">Categories <span class="text-muted">separate categories with ',' - (Ex: web-development,bootstrap)</span></label>
<input type="text" class="form-control" name="category" id="category" />
<label for="institution">Institution</label>
<br/>
<input type="text" class="form-control" name="institution" id="institution" />
<label for="price">Price in $</label><br />
<input type="text" class="form-control"  name="price" id="price" />
<label for="description"> Description </label>
<br/>
<textarea rows="5" cols="20" class="form-control" name="description" id="description"></textarea>
<br/>
<label for="upload">Upload course material</label><br />
<input type="file" name="upload" class="text-center  well">
<div class="center-block">
<button type="submit" class="btn btn-primary btn-lg pull-right">
	<span class="glyphicon glyphicon-education"	aria-hidden="true"> Submit</span>
</button>
</div>
</div>
</form>
</div>


	</div>
	</div>









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