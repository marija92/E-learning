<?php
$link=mysqli_connect("localhost" , "root" ,  "" , "elearning");
$link->set_charset("utf8");
if(!$link) die("Error:" .mysql_connect_error() );
?>