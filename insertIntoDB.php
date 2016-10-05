<?php
include_once 'database.php';

$flag=false;

if (isset ( $_POST ['title'] )) {
	$title = $_POST ['title'];
	$words = explode ( " ", $title );
	print_r ( $words );
	$acronym = "";
	
	foreach ( $words as $w ) {
		$acronym .= substr ( $w, 0, 1 );
	}
	$id = "ELEARN" . $acronym;
}
if (isset ( $_POST ['category'] )) {
	$categories = $_POST ['category'];
}
if (isset ( $_POST ['institution'] )) {
	$institution = $_POST ['institution'];
	$words = explode ( " ", $institution );
	print_r ( $words );
	$acronym = "";
	
	foreach ( $words as $w ) {
		$acronym .= substr ( $w, 0, 1 );
	}
	$idIns = "INS" . $acronym;
	
	$insertInsitution = mysqli_query ( $link, "INSERT INTO institution (id, name)
			VALUES ('$idIns','$institution')" );
	if ($insertInsitution) {
		$flag=true;
		echo "SUccess";
	} else {
		echo "INSTITUTION: " . mysqli_error ( $link ) . "<br />";
	}
}
if (isset ( $_POST ['price'] )) {
	$price = $_POST ['price'];
}
if (isset ( $_POST ['description'] )) {
	$description = $_POST ['description'];
}

if($flag){
$courseInsert = mysqli_query ( $link, "INSERT INTO course (id, title, description, provder, institution, price)
		 VALUES ('$id','$title','$description','ELEARNING','$idIns','$price')" );
}
else{
	$courseInsert = mysqli_query ( $link, "INSERT INTO course (id, title, description, provder,price)
			VALUES ('$id','$title','$description','ELEARNING','$price')" );
}

if ($courseInsert) {
	echo "SUccess";
} else {
	echo "COURSE: " . mysqli_error ( $link ) . "<br />";
}

$categoriesSplit = explode ( ",", $categories );
foreach ( $categoriesSplit as $category ) {
	$categoryInsesrt = mysqli_query ( $link, "INSERT INTO keyword (value, course)
		 VALUES ('$category','$id')" );
}

if ($categoryInsesrt) {
	echo "SUccess";
	header("Location: courseDetails.php?courseID=".$id);
} else {
	echo "CATEGORY: " . mysqli_error ( $link ) . "<br />";
}

?>