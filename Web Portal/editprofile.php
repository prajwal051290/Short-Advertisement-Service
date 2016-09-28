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

<title>Edit Profile</title>

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

<script>
function Passcheck()
{
	
/*/	var temp = document.getElementById('password');
	var temp1 = document.getElementById('password1');
	
	if(temp.value == temp1.value)
	{
		
		return true;
	
	}
	else
	{
	alert("Please Enter the same password twice..!!");
	return false;
	}
*/	
}
</script>


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

      		
	       <h3 align="center"><u>Profile Details</u></h3>
	<form id="Register" action="editprofileinsert.php" method="post" runat="vdaemon" disablebuttons="all">



	      <h5> <font color="#FF0000">* </font>(* Indicates Mandatory Fields)</h5>

	<vlsummary class="error" headertext="Error(s) found:" displaymode="bulletlist">

      	      		<h4>Personal Information:</h4>
      		

		<vllabel errclass="error" validators="NameReq,NameRegExp" for="Fname" 
		cerrclass="controlerror"><font color="#FF0000">*</font>First Name</vllabel> 
               <input name="Fname" type="text"  class="control" id="Fname"
                value="<?php echo base64_decode($_SESSION['fname'])?>"/>
	       <vlvalidator type="required" name="NameReq" control="Fname" errmsg="First Name required">
        	<vlvalidator type="regexp" name="NameRegExp" control="Fname" 
        	regexp="/^[A-Za-z'\s]*$/" errmsg="Invalid Name">
  <br/><br/><br/>

                <vllabel errclass="error" validators="NameReq1,NameRegExp1" for="Lname" 
                cerrclass="controlerror"><font color="#FF0000">*</font>Last Name</vllabel>
                <input name="Lname" type="text"  class="control" id="Lname" 
                value="<?php echo base64_decode($_SESSION['lname'])?>"/>
  		<vlvalidator type="required" name="NameReq1" control="Lname" errmsg="Last Name required">
	        <vlvalidator type="regexp" name="NameRegExp1" control="Lname" 
	        regexp="/^[A-Za-z'\s]*$/" errmsg="Invalid Name">

  <br/><br/><br/>
  
  
    <vllabel errclass="error" validators="NameReq1,NameRegExp1" for="Cname" cerrclass="controlerror"><font color="#FF0000">*</font>Company Name</vllabel>
                <input name="Cname" type="text"  class="control" id="Cname" 
                value="<?php echo base64_decode($_SESSION['cname'])?>"/>
  		<vlvalidator type="required" name="CompReq1" control="Cname" errmsg="Company Name required">
	        <vlvalidator type="regexp" name="CompRegExp1" control="Cname" regexp="/^[A-Za-z'\s]*$/" errmsg="Invalid Company Name">
	        

  <br/><br/><br/>
  
<vllabel errclass="error" validators="AddressReq1,AddressRegExp1" for="address" cerrclass="controlerror"><font color="#FF0000">*</font>Address</vllabel>
                <input name="address" type="text"  class="control" 
                id="address" size="40" value="<?php echo base64_decode($_SESSION['address'])?>"/>
  		<vlvalidator type="required" name="AddressReq1" control="address" errmsg="Address required">
	        <vlvalidator type="regexp" name="AddressRegExp1" control="address" regexp="/^[A-Za-z'\,\s\.]*$/" errmsg="Invalid Address">

<br/><br/><br/>

                <vllabel errclass="error" validators="NameReq,NameRegExp" for="username" cerrclass="controlerror"><font color="#FF0000">*</font>Username</vllabel>
                <input name="username" type="text"  class="control" id="username"
                 value="<?php echo base64_decode($_SESSION['username'])?>"/>
  		<vlvalidator type="required" control="username" errmsg="Username required">
	        <!--vlvalidator type="regexp" name="NameRegExp1" control="Lname" regexp="/^[A-Za-z'\s]*$/" errmsg="Invalid Name"-->
  <br/><br/><br/>

                <vllabel errclass="error" validators="NameReq,NameRegExp" for="password" cerrclass="controlerror"><font color="#FF0000">*</font>Password</vllabel>
                <input name="password" type="password"  class="control" id="password" />
  		<vlvalidator type="required" name="password" control="password" errmsg="Password required">
  		
  		 <vlvalidator name="PassCmp" type="compare" control="password" comparecontrol="password1"
          operator="e" validtype="string" errmsg="Both Password fields must be equal">
  <br/><br/><br/>
		 <vllabel validators="password,PassCmp" errclass="error" for="password1" cerrclass="controlerror"><font color="#FF0000">*</font>Confirm Password:</vllabel>
		                 <input name="password1" type="password"  class="control" id="password1" />

	        <!--vlvalidator type="regexp" name="password1" control="password1" regexp="/^[A-Za-z'\s]*$/" errmsg="Invalid Name"-->

        
  <br/><br/>
 
          <br />
          <br />
          
     

<vllabel errclass="error" validators="EmailReq,Email" for="Email" cerrclass="controlerror"><font color="#FF0000">* </font>Email:</vllabel>
     
        <input name="Email" type="TEXT" class="control" id="Email" size="40" 
        value="<?php echo base64_decode($_SESSION['email'])?>">
        <vlvalidator type="required" name="EmailReq" control="Email" errmsg="E-mail required">
        <vlvalidator type="format" format="email" name="Email" control="Email" errmsg="Invalid E-mail">

	      <span id="sprytextfield6"> &nbsp;</span></p>

	
<br/>
        <br/><button type="submit"  class="control" name="formSubmit" value="submit">Save</button>&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;  <button type="reset" class="control" value="Reset">RESET</button> 




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



