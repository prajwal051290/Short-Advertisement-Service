<?php
require_once("session.php");
require_once("db.php");
define('VDAEMON_PARSE', false);
include('vdaemon/vdaemon.php');
require_once("metaphone/DoubleMetaPhone.php3");

$id=base64_decode($_SESSION['Id']);
$keyword = $_POST['keyword'];
$amountband = $_POST['option_choice'];

$low = $_POST['low'];
$medium = $_POST['medium'];
$high = $_POST['high'];
$adstring = $_POST['ad'];

$metastring = new DoubleMetaPhone($keyword);
$meta1 = $metastring->primary;
$meta2 = $metastring->secondary;



//echo $keyword." ".$amountband." ".$low." ".$medium." ".$high." ".$adstring;
/*echo $keyword;
echo $amountband;*/
if(!strcmp($amountband,"Low Band"))
	$rate=$low;
else if(!strcmp($amountband,"Medium Band"))
	$rate=$medium;
else if(!strcmp($amountband,"High Band"))
	$rate=$high;
/*echo $adstring;
*/	

$rate=explode("$",$rate);

$globalrate = $rate[1]/100;




$qry ="select * from Hash where Keyword ='".$keyword."'";
$result = @mysql_query($qry);
echo $qry;
if(!@mysql_num_rows($result))
{
	$query ="insert into Hash (Keyword,Meta_id_1,Meta_id_2) values('".$keyword."','".$meta1."','".$meta2."')";
	
	mysql_query($query) or die ('Error Updating  Hash Database');
}



	$query ="insert into Ad_Node (Keyword,User_id,Amount,Global_rating,
	Current_rating,Ad_string) values('".$keyword."','".$id."',
	'".$rate[1]."','".$globalrate."','".$globalrate."','".$adstring."')";

	
	mysql_query($query) or die ('Error Updating Database');
	
	
	$query = "select No_keywords from Advertiser where User_id=".$id;
      	$result=mysql_query($query) ;
      	$record = mysql_fetch_assoc($result);
      	$nokeywords = $record['No_keywords'];
      	$nokeywords=$nokeywords + 1;
      	
      	
	$query ="update Advertiser set No_keywords =".$nokeywords." where User_id=".$id;
	
	mysql_query($query) or die ('Error Updating Database');


	
	header("location:managekeywords.php?submit=true");


?>
