<!DOCTYPE html>
<?php

include_once 'database.php';

$provider = 0;
$category = 0;
$word = "";
$keyword = "";
$providerCourses=array();
$categoryCourses=array();
$wordCourses=array();
$keyCourses=array();
$duplicates=array();

if (isset ( $_GET ['provider'] )) {
	$provider = $_GET ['provider'];
	$providers = mysqli_query ( $link, "SELECT * FROM course where provder LIKE '$provider'" );
	while ( $prov = mysqli_fetch_assoc ( $providers ) ) {
		array_push($providerCourses, $prov['id']);
		
	}
	$duplicates=$providerCourses;
}
if (isset ( $_GET ['category'] )) {
	$category = $_GET ['category'];
	$categories = mysqli_query ( $link, "SELECT * FROM keyword where value LIKE '$category'" );
	while ( $cat = mysqli_fetch_assoc ( $categories ) ) {
		array_push($categoryCourses, $cat['course']);
	}
	$duplicates=$categoryCourses;
}
if (isset ( $_GET ['word'] )) {
	$word = $_GET ['word'];
	$categories = mysqli_query ( $link, "SELECT * FROM course where title LIKE '%$word%'" );
	while ( $cat = mysqli_fetch_assoc ( $categories ) ) {
		array_push($wordCourses, $cat['id']);
	}
	$duplicates=$wordCourses;
}
if (isset ( $_GET ['generalSearch'] )) {
	$keyword = $_GET ['generalSearch'];
	$categories = mysqli_query ( $link, "SELECT * FROM course where title LIKE '%$keyword%'" );
	while ( $cat = mysqli_fetch_assoc ( $categories ) ) {
		array_push($keyCourses, $cat['id']);
	}
	$duplicates=$wordCourses;
}

$wrkArray = array();
if (!empty($providerCourses)){
	array_push($wrkArray, $providerCourses);
}
if (!empty($categoryCourses)){
	array_push($wrkArray, $categoryCourses);
}
if (!empty($wordCourses)){
	array_push($wrkArray, $wordCourses);
}
if (!empty($keyCourses)){
	array_push($wrkArray, $keyCourses);
}
if(sizeof($wrkArray)>1){
$duplicates = call_user_func_array('array_intersect',$wrkArray);
}

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
	<?php include_once 'navBar.php';?>

	<!-- Header -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">


				<!-- Search fields -->
				<form class="form-horizontal" role="form" action="getCourses.php">
					<div class="row">

						<div class="form-group col-md-3">
							<label for="provider">Provider</label> <select
								class="form-control" name="provider">
								<option value="0" <?php if ($provider=="0") echo "selected";?>>All
									providers</option>
										<?php
										$providers = mysqli_query ( $link, "SELECT * FROM provder" );
										while ( $prov = mysqli_fetch_assoc ( $providers ) ) {
											$value = $prov ['id'];
											?>	
								<option value='<?php echo $value;?>'
									<?php if ($value == $provider) echo "selected";?>><?php echo $prov['name']; ?></option>
											<?php }?>
																		
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="category">Category</label> <select
								class="form-control" name="category">
								<option value="0" <?php if ($category=="0") echo "selected";?>>All
									categories</option>
										<?php
										$keywords = mysqli_query ( $link, "SELECT * FROM keyword group by value" );
										while ( $key = mysqli_fetch_assoc ( $keywords ) ) {
											$value = $key ['value'];
											?>	
								<option value='<?php echo $value;?>'
									<?php if ($value == $category) echo "selected";?>><?php echo $value; ?></option>
										<?php }?>
																			
						 </select>
						</div>
						<div class="form-group col-md-3">
							<label for="contain">Contains the word</label> <input
								class="form-control" type="text" name="word"
								value='<?php echo $word;?>' />
						</div>


						<label> &nbsp; </label>
						<button type="submit" class="btn btn-primary col-md-3">
							<span class="glyphicon glyphicon-search" aria-hidden="true">
								Search</span>
						</button>
					</div>
				</form>






				<!-- Page Content -->

				<div class="row">
							<?php
							// da se prikazuvaat 9 nastani po strana
							
							$num_rec_per_page = 15;
							if (isset ( $_GET ["page"] )) {
								$page = $_GET ["page"];
							} else {
								$page = 1;
							}
							$start_from = ($page - 1) * $num_rec_per_page; // selekcija na site aktivni nastani od odbranata kategorija
							
							$ids=join("','",$duplicates);
							$courses = mysqli_query ( $link, "SELECT * FROM course WHERE id IN ('$ids') LIMIT $start_from, $num_rec_per_page");
							
							while ( $course = mysqli_fetch_assoc ( $courses ) ) {
								
								$id=$course['id'];
								$id=urlencode($id);
								$title = strip_tags(substr($course['title'],0,30));
								$courseProv=$course['provder'];
								$description=strip_tags(substr($course ['description'],0,200));
								$price=$course['price'];
								//echo $course['title']."<br />";
								//echo $course['id']."<br />";
													
						?>
						<div class="col-sm-4 col-lg-4 col-md-4">
						<div id="thumb" class="thumbnail">
							<div class="caption">  
								<h4 class="pull-right"><?php
									if($price=="0") echo "FREE";
									else echo "$".$price;?></h4>		
								<h4>
									<a href='<?php echo "courseDetails.php?courseID=$id"?>' title='<?php echo $course['title'];?>'><?php echo $title."..."; ?></a>
								</h4>
								<h5>Provider: <?php echo $courseProv; ?></h5>
				
							</div>	
								<p class="text-muted">
										<?php echo $description."...";?>
								</p>
						</div>
						
					</div>
				<?php  } ?>		
						
					</div>
					

				<div class="pull-right">

					<ul class="pagination">										
						
						<?php
						// izbroj kolku zapisi ima vkupno vo tabelata
						
						$rs_result = mysqli_query($link, "SELECT * FROM course WHERE id IN ('$ids')"); 
						//run the query 
						$total_records = mysqli_num_rows($rs_result); 
						//count number of records 
						$total_pages = ceil($total_records / $num_rec_per_page);
						
						$provider=urlencode($provider);
						$category=urlencode($category);						 
						?>
					<!-- prva strana -->
						<li><a href='<?php echo "getCourses.php?page=1&generalSearch=$keyword&provider=$provider&category=$category&word=$word"?>'>&laquo;</a></li>
					  <?php
							for($i=1;$i<=$total_pages;$i++){
							?>
					  <li><a href='<?php echo "getCourses.php?page=$i&generalSearch=$keyword&provider=$provider&category=$category&word=$word"?>'   ><?php echo $i; ?></a></li>
					  <?php  } ?>
					  <!-- posledna strana -->
						<li><a
							href='<?php echo "getCourses.php?page=$total_pages&generalSearch=$keyword&provider=$provider&category=$category&word=$word"?>'>&raquo;</a></li>
							
							
					</ul>
				</div>
	








			</div>

		</div>

	</div>
	<!-- /.container -->
	<!-- /.container -->


	<!-- /.intro-header -->

	<!-- Page Content -->

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
