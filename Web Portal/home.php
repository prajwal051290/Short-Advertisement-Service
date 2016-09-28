<?php 

session_start();

require_once("db.php");


function validate(&$values)
{

	$query= "select * from Advertiser where Username='".$values['username']."'";
	$result=mysql_query($query) ;
	$record = mysql_fetch_assoc($result);
	
	$count=mysql_num_rows($result);
	
	
	
// If result matched $myusername and $mypassword, table row must be 1 row

	if($count==1){
			
		//correct username  and password
		if($record['Password']==md5($values['password']))
		return 1;
		else
		return 0;
	}
	else {

		return 0;
		
	}

}
	


function DisplayForm($values)
{

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


	<head>

	<title>SAS</title>

	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
	<meta name="author" content="Erwin Aligam - styleshout.com" />
	<meta name="description" content="Site Description Here" />
	<meta name="keywords" content="keywords, here" />
	<meta name="robots" content="index, follow, noarchive" />
	<meta name="googlebot" content="noarchive" />

	<link rel="stylesheet" type="text/css" media="screen" href="Template1/css/coolblue.css" />

	<style>

	body { font-family: "Times New Roman", Times, serif; }
	.td {color: #004040;
	}
	p{ font-size: 16px; } 
	h2 { font-size: 24px; 
		font-style: italic;
	}

	h5 { font-size: 12px; }
	ul { font-weight: bolder; }

	h6{ font-size: 13px;}

	</style>
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
				 	<li><a href="profile.php">Profile</a></li>
					
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

	      		<!--div class="right"-->


		 <img src="images/mob_ad.jpg" alt="image post" height="350" width="500"/></h2>
		<p><font size= "5"><b>SAS(Short Advertising Service)<b> is really a cool and innovative idea in 
		the field of Mobile Advertising.</font></font></p>
		
		</br>
		<p align="left">Come and be a part of this new 
		<b>ADVERTISING REVOLUTION .....</b></h5></p>

		<p align="right"><a class="more" href="about.php">More</a></p>
			  
			  <!--/div>

			    <!--div class="left">

			    	<p class="dateinfo"><?php $mon=date("M"); echo $mon; ?><span><?php $day=date("d"); echo ($day);?></span></p>

			       	<div class="post-meta">
				  	<h4>Post Info</h4>
				     	<ul>
				           <li class="user"><a href="#">VDreamZ</a></li>
				           <li class="time"><a href="#"><?php 

		$timezone_offset = 5.5; // us central time (gmt-6) for me

		$date = gmdate('M d Y H:i:s', time()+$timezone_offset*60*60);

		echo $date;
		//$stamp=date("r"); echo $stamp;?></a></li>
		</ul>
								</div>

			    </div-->

		</div>



		<form id="Register" action="<?php $_SERVER['PHP_SELF'] ?>" method="post"  > 

	      	<!-- /main -->
		</div>
		

	      <!-- sidebar -->
		<div id="sidebar">	

	      	<div class="about-me">

	      
		  <h5 align="left"><strong class="td">UserName: </strong>
		     <input type="text" name="username" height="2" size="20"  value="<?php htmlentities($values['username'])?>" />
	       	  </h5>
		    <h5 align="centre"><strong class="td"> Password: &nbsp;</strong>
		      <input type="password" name="password" size="20" height="2" value="<?php htmlentities($values['password']) ?>"  />
		    </h5>

		  

		    <h5 align="center">
			 <button type="submit" name="submit"> LOGIN </button>	<br/>


	
			 	

		

	<font color="#FF0000">
<?php
//function Validate_Form()
{
	if (isset($_POST['submit'])) { 

		$formvalues = $_POST;

		if(!Validate($formValues))
		echo "Wrong Username or Password";
	}
}
?>
</font>



</form>
            </h5>
            <h6 align="center"><u><a href="signup.php">Sign Up Now..!!</a></u></h6>
            	
            <img src="images/iphone_using.jpg" alt="image post" height="200" width="200"/>   
</div>

		</div>


    <!-- content -->
	</div>

<!-- /content-out -->
</div>
		
<!-- footer-bottom -->
<div id="footer-bottom">

	<h5 class="bottom-left">
		&copy; 2011 <strong>Copyright Info</strong>&nbsp; &nbsp; &nbsp;
		website by Vipin, Prajwal, Ajinkya

	&nbsp; &nbsp; &nbsp;<align="right"><a href="home.php">Home</a> |
      <strong><a href="#top">Back to Top</a></strong>
   </h5>

<!-- /footer-bottom-->
	</div>

	

</body>
</html>
<?php 
}

function ProcessForm($values)
{
    	
	
	
	$query= "select * from Advertiser where Username='".$values['username']."'";
	$result=mysql_query($query);
	$record = mysql_fetch_assoc($result);

		
	$_SESSION['Id']=base64_encode($record['User_id']);
	$_SESSION['username']=base64_encode($values['username']);
	$_SESSION['password']=base64_encode($values['password']);
	
	$_SESSION['fname']=base64_encode($record['First_name']);
	$_SESSION['lname']=base64_encode($record['Last_name']);
	$_SESSION['cname']=base64_encode($record['Company_name']);
	
	$_SESSION['address']=base64_encode($record['Address']);
	//$_SESSION['contact']=base64_encode($record['contact']);
	$_SESSION['email']=base64_encode($record['Email_id']);
	
	
  	header("Location:profile.php");
 		

}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $formValues = $_POST;
   // $formErrors = array();
 	
    if (!Validate($formValues))
	DisplayForm($formValues);
    else
	ProcessForm($formValues);
}
else
    DisplayForm(null);
?>




