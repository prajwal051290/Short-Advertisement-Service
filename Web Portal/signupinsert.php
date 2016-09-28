<?php

require_once("db.php");
define('VDAEMON_PARSE', false);
include('vdaemon/vdaemon.php');


$username = $_POST['username'];
$password = $_POST['password'];

$fname = $_POST['Fname'];
$lname = $_POST['Lname'];
$cname = $_POST['Cname'];
$address = $_POST['address'];

$email = $_POST['Email'];

//Put validation to check both passwords

	$query ="insert into Advertiser (Username,Password,First_name,Last_name,
	Company_name,Email_id,Address) values('".$username."','".md5($password)."',
	'".$fname."','".$lname."','".$cname."','".$email."','".$address."')";

	mysql_query($query) or die ('Error Updating Database');



header("location:home.php");


?>
