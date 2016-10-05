<?php
include_once 'database.php';
include_once 'navBar.php';

if(isset($_SESSION['user'])){

	$logedIn=true;
	//proveri dali e admin;
	$email=$_SESSION['user'];
	echo $email;
	$user= mysqli_query ( $link, "SELECT * FROM user where email LIKE '$email'" );
	$userDetails = mysqli_fetch_assoc ( $user );
	$email=$userDetails['email'];
	$name= $userDetails['name'];
	$sur=$userDetails['surname'];
	$admin=$userDetails['isAdmin'];
	$password=$userDetails['password'];	 
	
	$selectedKeys=array();
	
	$keywords=mysqli_query($link, "SELECT * FROM user_keyword WHERE user LIKE '$email'");
	while ( $keys = mysqli_fetch_assoc ( $keywords ) ) {
		array_push($selectedKeys, $keys['keyword']);
	}
	
	
	if (isset($_POST['submit'])) {
		if(isset($_POST['checkbox'])) {
			foreach($_POST['checkbox'] as $check) {
				if(!in_array($check , $selectedKeys)){
					echo "fleva".$check;
					$insertUserKeys = mysqli_query ( $link, "INSERT INTO user_keyword (user, keyword)
							VALUES ('$email','$check')");
					array_push($selectedKeys,$check);
				}
			}			
			
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

	<div class="container" style="padding-top: 10px;">
		<h1 class="page-header">Edit Profile</h1>
		<div class="row">
			<!-- left column -->
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="text-center">
					<img
						src="http://www.aspirehire.co.uk/aspirehire-co-uk/_img/profile.svg"
						class="avatar img-circle img-thumbnail" alt="avatar" height="250"
						width="250">
					<h6>Change your photo...</h6>
					<input type="file" class="text-center center-block well well-sm">
				</div>
			</div>
			<!-- edit form column -->
			<div class="col-md-8 col-sm-6 col-xs-12 personal-info">

				<h3>Personal info</h3>
				<form class="form-horizontal" role="form" method="post">
					<div class="form-group">
						<label class="col-lg-3 control-label">First name:</label>
						<div class="col-lg-8">
							<input class="form-control" type="text" value="<?php echo $name;?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Last name:</label>
						<div class="col-lg-8">
							<input class="form-control" type="text" value="<?php echo $sur;?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Email:</label>
						<div class="col-lg-8">
							<input class="form-control" type="text" value="<?php echo $email;?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Password:</label>
						<div class="col-md-8">
							<input class="form-control" type="password" value="<?php echo $password;?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Confirm password:</label>
						<div class="col-md-8">
							<input class="form-control" type="password" value="<?php echo $password;?>">
						</div>
					</div>

				
			</div>
		</div>


		<div class="row">

			<div class="col-md-4 col-sm-6 col-xs-12">
				<h3>I'm interested in:</h3>


				<div class="blockClass">
					<div class="col-md-2"></div>
					<div class="col-md-10">
  <?php
		$keywords = mysqli_query ( $link, "SELECT * FROM keyword group by value" );
		$i = 1;
		while ( $key = mysqli_fetch_assoc ( $keywords ) ) {
			$value = $key ['value'];
			if(in_array($value , $selectedKeys)){	?>
				<div class="row">
				<input type="checkbox" name="checkbox[]"
				value='<?php echo $value;?>' checked> <?php echo $value;?> </div>		
			<?php } else {?>
	<div class="row">
							<input type="checkbox" name="checkbox[]"
								value="<?php echo $value;?>"> <?php echo $value;?> </div>
 <?php
		
}
}		?>  
   <!-- <ul class="submenu">
				<li><span class="tags glyphicon glyphicon-remove">Adobe Photoshop</span><span class="tags">Corel Draw</span> <span class="tags">CSS</span> <span class="tags">Css 3</span> 
                <span class="tags glyphicon glyphicon-remove">Graphic Design</span> <span class="tags">HTML</span> <span class="tags">HTML5</span> <span class="tags">JavaScript</span> 
                <span class="tags glyphicon glyphicon-remove">Twitter bootstrap</span> <span class="tags">bootstrap</span> <span class="tags">User Interface Design</span> <span class="tags">Wordpress</span>
                <span class="tags glyphicon glyphicon-remove">Graphic Design</span> <span class="tags">HTML</span> <span class="tags">HTML5</span> <span class="tags">JavaScript</span> 
                <span class="tags glyphicon glyphicon-remove">Twitter bootstrap</span> <span class="tags">bootstrap</span> <span class="tags">User Interface Design</span> <span class="tags">Wordpress</span></li></a>
	</ul>  -->
					</div>
				</div>
			</div>

			<div class="col-md-8 col-sm-6 col-xs-12">


				<h3>My completed courses</h3>
				<div class="table-responsive">
					<table id="mytable" class="table table-bordred table-striped">
						<thead>
							<th>Course Name</th>
							<th>Delete</th>
						</thead>
						<tbody>
						<?php 
						$completedCourses=array();
						$courses = mysqli_query ( $link, "SELECT * FROM user_completedcourse WHERE user LIKE '$email'" );
								while ( $c = mysqli_fetch_assoc ( $courses ) ) {
									array_push($completedCourses, $c['course']);							
						}
						$ids=join("','",$completedCourses);
						$coursesInfp = mysqli_query ( $link, "SELECT * FROM course WHERE id IN ('$ids')");							
						while ( $cours = mysqli_fetch_assoc ( $coursesInfp ) ) {						
							$id=$cours['id'];
							$id=urlencode($id);
							$title = $cours['title'];								
						?>
							<tr>
								<td><a href='<?php echo "courseDetails.php?courseID=$id"?>' title='<?php echo $title;?>'><?php echo $title; ?></a></td>
								<td><p data-placement="top" data-toggle="tooltip" title="Delete">
										<button class="btn btn-danger btn-xs" data-title="Delete"
											data-toggle="modal" data-target="#delete">
											<span class="glyphicon glyphicon-trash"></span>
										</button>
									</p></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
					<div class="form-group pull-right">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-8">
							<button type="submit" name="submit" class="btn btn-primary">
							Save Changes
							</button>  
						</div>
					</div>
				</form>
		<div class="container">

			<hr>

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

		</div>
		<!-- /.container -->


		<!-- Bootstrap core JavaScript -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/modern-business.js"></script>

</body>
</html>