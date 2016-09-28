<?php

require_once("session.php");
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

$id = base64_decode($_SESSION['Id']);

	$query ="update Advertiser set Username='".$username."',Password='".md5($password)."',
	First_name='".$fname."',Last_name='".$lname."',Company_name='".$cname."',
	Email_id='".$email."',Address='".$address."' where User_id=".$id;
	
	mysql_query($query) or die ('Error Updating Database');


	header("location:profile.php");


?>
