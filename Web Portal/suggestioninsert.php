<?php 


require_once("session.php");
require_once("db.php");

$subject=$_POST['Subject'];
$message=$_POST['message'];
$message=mysql_real_escape_string($message);

$id=base64_decode($_SESSION['Id']);


$query="insert into forum(userid,subject,message) values (".$id.",'".$subject."','".$message."')";
//echo $query;
mysql_query($query)  or die ('Error Updating Database');


header("location:profile.php");

?>
