<?php

require_once("session.php");
require_once("db.php");

$fname= base64_decode($_SESSION['fname']);
$lname= base64_decode($_SESSION['lname']);
$name = $fname." ".$lname;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta name="Description" content="Information architecture, Web Design, Web Standards." />
<meta name="Keywords" content="your, keywords" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Erwin Aligam - ealigam@gmail.com" />
<meta name="Robots" content="index,follow" />

<link rel="stylesheet" href="Template2/images/BrightSide.css" type="text/css" />

<title>Profile</title>
<script src="Template2/SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<script src="Template2/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="Template2/SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<link href="Template2/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />



<style>

#current
{
	float:right;
	margin-right:40px;
	margin-top:50px;
}

</style>


</head>


<body>
<!-- wrap starts here -->
<div id="wrap">
	
	<div id="header">				
			
	  <h1 id="logo">
	


<?php 



echo "Welcome";
 

?>

	
<span class="gray"></span></h1>

		<!-- Menu Tabs -->
 
	<div  id="current">	
            <a href="logout.php" ">LogOut</a></li>
  	</div>
  
  </div>	
				
  <!-- content-wrap starts here -->
	<div id="content-wrap">

		 
	  <div id="sidebar" >							
				
	    

	<h1><a href="editprofile.php">Edit Profile</a></h1>
	<br/>
	
	<h1><a href="viewkeywords.php">View Keywords</a></h1>
	<br/>
	
	<h1><a href="managekeywords.php">Manage Keywords</a></h1>
	<br/>
	
	<br/>
	
	<h1>&nbsp;</h1>

	<p>
	  <label for="textfield"></label>
	</p>
	<p>&nbsp;</p>

	<p>&nbsp;</p>
	</div>
			
		<div id="main">
		  <h1 align="center">Latest Happenings</h1>
	      <div id="CollapsiblePanel1" class="CollapsiblePanel">
	        <div class="CollapsiblePanelTab"><h2>Our Product got a Huge Reception from all Areas.</h2></div>
	        <div class="CollapsiblePanelContent">
	          <p>We are prepared for even more</p>
	          
	          <p>&nbsp;			</p>
	        </div>
          </div>
	      <div id="CollapsiblePanel2" class="CollapsiblePanel">
	        <div class="CollapsiblePanelTab"><h2>We respect our Advertisers and Customers alike</h2></div>
	        <div class="CollapsiblePanelContent">
	          <p>We'll soon start including offers for small and medium businesses</p>
	          <p>More Information will be posted Later</p>
	        </div>
          </div>
	      <div id="CollapsiblePanel3" class="CollapsiblePanel">
	        <div class="CollapsiblePanelTab"><h2>Innovation Counts - EVERYWHERE</h2></div>
	        <div class="CollapsiblePanelContent">
	          <p>Our Product has been designed with Curiosity.
	          The Telecom sector needed a big overhaul since a long time, especially Advertising. We hope the much dynamic market can be used to imbibe this Huge Change. Our Product offers a very unique offer of guaranteed customer reception without abusing the customers.</p>
	          <p>Do Join Us</p>
	        </div>
          </div>
	      <div id="CollapsiblePanel4" class="CollapsiblePanel">
	        <div class="CollapsiblePanelTab"><h2>Development works undertaken</h2></div>
	        <div class="CollapsiblePanelContent">
	          <p>This Product has been designed for Amdocs India.</p>
	          
	        </div>
          </div>
          <br><br><br><hr>
		
							
		</div>	
			
		<div id="rightbar">
			
	<h2></h2>		
	<h4 align="left">LOGGED IN:  &nbsp&nbsp


<?php
//echo " ".$row['fname']." ".$row['lname']  ." &nbsp; &nbsp; <br/>";
echo $name;
?>
</h4>
<br/>
<h1 align="center"><a href="suggestion.php"><img src="images/suggestions.jpg" alt="" width="148" height="147"  style="margin-right:200px;" /></a></h1>


<br/><br/>

	<div id="sidebar2">
		<div class="sidemenu">
		
				<h3>Sidebar Menu</h3>
            			<ul>
					<li><a href="home.php">Home</a></li>
					<li><a href="profile.php">Profile</a></li>
					
					<li><a href="managekeywords.php">Keywords</a></li>
					<li><a href="about.php">About us</a></li>
	    			</ul>

		</div>
            
		  <!-- /sidebar -->
	</div>	
		 
<p>&nbsp;</p>

<p>&nbsp;</p>
      </div>			
			
	<!-- content-wrap ends here -->		
  </div>

<!-- footer starts here -->	
<div id="footer">
	
	<div class="footer-left">
		<p class="align-left">			
		website by Vipin, Prajwal, Ajinkya </a>
		</p>		
	</div>
	

	
</div>
<!-- footer ends here -->
	
<!-- wrap ends here -->
</div>
<script type="text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
var CollapsiblePanel2 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel2");
var CollapsiblePanel3 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel3");
var CollapsiblePanel4 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel4");

</script>
</body>
</html>
