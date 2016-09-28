<?php 


require_once("session.php");
require_once("db.php");
include('vdaemon/vdaemon.php'); 

	
	$fname= base64_decode($_SESSION['fname']);
	$lname= base64_decode($_SESSION['lname']);
	$name = $fname." ".$lname;
		
	
	$id=base64_decode($_SESSION['Id']);
	$username=base64_decode($_SESSION['username']);
	$password=base64_decode($_SESSION['password']);
	$address=base64_decode($_SESSION['address']);
	$compname=base64_decode($_SESSION['cname']);
	
	$email = base64_decode($_SESSION['email']);
	
	
		
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>Add Keywords</title>

<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<meta name="author" content="Erwin Aligam - styleshout.com" />
<meta name="description" content="Site Description Here" />
<meta name="keywords" content="keywords, here" />
<meta name="robots" content="index, follow, noarchive" />
<meta name="googlebot" content="noarchive" />

<link rel="stylesheet" type="text/css" media="screen" href="Template1/css/screen.css" />

<style type="text/css">
.td {color: #004040;
}

#Fname,#Lname,#username,#password,#password1,#cell,#Email,#address,#Cname
{
	//margin-left:100px;
	float:right;
	margin-right:230px;

}

</style>
<script src="Template2/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="Template2/SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<script src="Template2/SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="Template2/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="Template2/SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
<link href="Template2/SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />



</head>

<body>


<!--header -->
<div id="header-wrap"><div id="header">

	<a name="top"></a>

	<h1 id="logo-text"><a href="home.php">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp SAS</a></h1>
		<p id="slogan"><font size="2">Connect your customers with the Right Ad at the<br/> Right Time 
		as they exchange information on the go.....!!!</font></p>

	<div  id="nav">
	  <ul>
	    <li id="current"><a href="home.php">Home</a></li>
		                <li><a href ="profile.php">Profile</a></li>
				
				<li><a href="managekeywords.php">Keywords</a></li>
				<li><a href="about.php">About us</a></li>
      </ul>
    </div>
	<!--/header-->
</div></div>
	
<!-- content-outer -->
<div id="content-wrap" class="clear" >

	<!-- content -->
   <div id="content">

   	<!-- main -->
	   <div id="main">

      	<div class="post">

      		
	       <h3 align="center"><u>Keyword Details</u></h3>
	<form id="Register" action="addkeyinsert.php" method="post" runat="vdaemon" disablebuttons="all">



	      <h5> <font color="#FF0000">* </font>(* Indicates Mandatory Fields)</h5>


      	      		<h4>Keyword Information:</h4>
      		<?php
      		$query = "select * from Ad_Node where User_id=".$id;
      		$result=mysql_query($query) ;
      		$count=mysql_num_rows($result);
		
      		echo '<label>Enter keyword : </label>';

     		echo'<input type="text" name="keyword" value=""/>&nbsp&nbsp&nbsp&nbsp';
      		
      		echo '<br/><br/><label>Select The Amount Band : </label> <br/>';
      		
      		/*Option button for Rate*/
	  echo '<input type="radio" name="option_choice" 
	  value="Low Band" /><label>Low Band</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	  echo '<select name="low">
	  <option value="$100">$100</option>
	  <option value="$200">$200</option>
	  <option value="$300">$300</option>
	  <option value="$400">$400</option>
	  <option value="$500">$500</option>
	  <option value="$600">$600</option>
	  <option value="$700">$700</option>
	  <option value="$800">$800</option>
	  <option value="$900">$900</option>
	  <option value="$1000">$1000</option>
	  </select>
	  <br/>';
	 
      	  echo '<input type="radio" name="option_choice" 
	  value="Medium Band" /><label>Medium Band</label> &nbsp;';
	  echo '<select name="medium">
	 
	  <option value="$2000">$2000</option>
	  <option value="$3000">$3000</option>
	  <option value="$4000">$4000</option>
	  <option value="$5000">$5000</option>
	  <option value="$6000">$6000</option>
	  <option value="$7000">$7000</option>
	  <option value="$8000">$8000</option>
	  <option value="$9000">$9000</option>
	  <option value="$10000">$10000</option>
	  </select>
	  <br/>';
	  
	  echo '<input type="radio" name="option_choice" 
	  value="High Band" /><label>High Band</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';	
      	  echo '<select name="high">
	  
	  <option value="$20000">$20000</option>
	  <option value="$30000">$30000</option>
	  <option value="$40000">$40000</option>
	  <option value="$50000">$50000</option>
	  <option value="$60000">$60000</option>
	  <option value="$70000">$70000</option>
	  <option value="$80000">$80000</option>
	  <option value="$90000">$90000</option>
	  <option value="$100000">$100000</option>
	  </select>
	  <br/>';	
      		
      		
      		echo	'<label>AD-String</label>&nbsp&nbsp&nbsp&nbsp';
      		echo	'<input type="text" name="ad"/>&nbsp&nbsp&nbsp&nbsp';
      		
      		
      		
      		echo	'<br/><br/>';
      		
      		
      		
      	
      		?>

	
<br/>
        <br/>
        
        <button type="submit"  class="control" name="formSubmit" value="submit">Add Keyword</button>&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
        <button type="reset" class="control" name="formReset" value="reset">Reset</button>
      &nbsp;&nbsp;&nbsp;&nbsp; 



</form>



       </div>

      	<!-- /main -->
		</div>

      <!-- sidebar -->
		<div id="sidebar">
		  <div id="sidebar2">
		    <div class="sidemenu">
		      <h3>Sidebar Menu</h3>
              <ul>
                <li><a href="home.php">Home</a></li>
               				<li><a href ="profile.php">Profile</a></li>
					
					<li><a href="managekeywords.php">Keywords</a></li>
					<li><a href="about.php">About us</a></li>
              </ul>
            </div>
		    <!-- /sidebar -->
	      </div>

		  <!-- /sidebar -->
		</div>

    <!-- content -->
	</div>

<!-- /content-out -->
</div>
		
<!-- footer-outer -->
<div id="footer-outer" class="clear"></div>

<!-- footer-bottom -->
<div id="footer-bottom">
 
  <p class="bottom-right"> <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a href="http://validator.w3.org/check/referer">XHTML</a> | <a href="home.html">Home</a> | <strong><a href="#top">Back to Top</a></strong> </p>
  <!-- /footer-bottom-->
</div>
<script type="text/javascript">

var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");

</script>
<?php VDEnd(); ?>
</body>
</html>



