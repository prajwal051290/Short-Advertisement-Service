<?php 
session_start();

if(!isset($_SESSION['Id']))
{
	header("Location:home.php");
}
?>
