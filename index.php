<!DOCTYPE html>
<?php include_once 'database.php'; 
 include_once 'navBar.php'; ?>
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




	<!-- Header -->
	<a name="about"></a>
	<div class="intro-header">
		<div class="container">

			<div class="row">
				<div class="col-lg-12">
					<div class="intro-message">
						<h1>E-learning</h1>
						<h3>
							Find the best course for you
							<h3>
								<div class="container">
									<div class="row">
										<div class="col-md-12">
											<form class="form-horizontal" role="form"
												action="getCourses.php">

												<div class="input-group" id="adv-search">

													<input id="search" type="text" class="form-control"
														placeholder="Search for courses" name="generalSearch" />
													<div class="input-group-btn">
														<div class="btn-group" role="group">
															<div class="dropdown dropdown-lg">
																<button type="button"
																	class="btn btn-default dropdown-toggle"
																	data-toggle="dropdown" aria-expanded="false">
																	<span class="caret"></span>
																</button>
															
																<div class="dropdown-menu dropdown-menu-right"
																	role="menu">
																	<div class="form-group">
																		<label for="provider">Provider</label> <select
																			class="form-control" name="provider">
																			<option value="0" selected>All providers</option>
																		<?php
																		
																		$providers = mysqli_query ( $link, "SELECT * FROM provder" );
																		while ( $prov = mysqli_fetch_assoc ( $providers ) ) {
																			$value = $prov ['id'];
																			
																			?>	
																			<option value='<?php echo $value;?>'><?php echo $prov['name']; ?></option>
																			<?php }?>
																		<!-- 	<option value="1">Coursera</option>
																			<option value="2">Udacity</option>
																			<option value="3">Udemy</option>
																			<option value="4">...</option>  -->
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="category">Category</label> <select
																			class="form-control" name="category">
																			<option value="0" selected>All categories</option>
																				<?php
																				
																				$keywords = mysqli_query ( $link, "SELECT * FROM keyword group by value" );
																				while ( $key = mysqli_fetch_assoc ( $keywords ) ) {
																					$value = $key ['value'];
																					
																					?>	
																			<option value='<?php echo $value;?>'><?php echo $value; ?></option>
																			<?php }?>
																			
																			</select>
																	</div>
																	<div class="form-group">
																		<label for="contain">Contains the word</label> <input
																			class="form-control" type="text" name="word" />
																	</div>
																</div>
																
															</div>
															<button type="submit" class="btn btn-primary">
																<span class="glyphicon glyphicon-search"
																	aria-hidden="true"> Search</span>
															</button>

														</div>
													</div>

												</div>
											</form>
										</div>
									</div>
								</div>
					
					</div>








				</div>
			</div>
		</div>

	</div>
	<!-- /.container -->

	</div>
	<!-- /.intro-header -->

	<!-- Page Content -->

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

	<!-- jQuery -->
	<script src="js/jquery.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

</body>

</html>
