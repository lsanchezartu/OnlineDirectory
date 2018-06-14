<?php 
@ob_start();
session_start();

  include 'profileValue.php'; 

  if(!isset($_SESSION['MemberId'])){
            go("login.php");
        }
  setProfile($_GET['id']);
?>

<html>
<head>
<!-- 
   IG Member Directory
   Author: Luis Sanchez-Artu
   Date:   3/25/2018
   Filename: profile.php
   Supporting files: regulardir.php index.css
-->

<title>Profile - Iota Gamma</title>
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="index.css" type="text/css" />
<?php 
?>
 </head>
 <body>
    
	<div class="navbar">
      <ul class="navbar-container">
        <li><a href="#" class="nav-button brand-logo">Welcome, <?php echo $_SESSION['Name']; ?>!</a></li>
        <li class="nav-item"><a href="logout.php" class="left-underline nav-button" data-scroll>Logout</a></li>
        <li class="nav-item"><a href="forgotPassword.php" class="left-underline nav-button" data-scroll>Change Password</a></li>
        <li class="nav-item"><a href="profile.php?id=<?php echo $_SESSION['MemberId']; ?>" class="left-underline nav-button" data-scroll>Profile</a></li>
        <li class="nav-item"><a href="acl.php" class="left-underline nav-button" data-scroll>Update Directory</a></li>
        <li class="nav-item"><a href="login.php" class="left-underline nav-button" data-scroll>Main Directory</a></li>
      </ul>
    </div>

  <div id="logo"></div> 
  


  <div class="userprofile">
  
<!-- MAIN CONTAINER -->
		<div id="main_container">
      <!-- HEADER -->
      <div id="header">
        <!-- LOGOTYPE/NAME -->
        <div class="header_logotype_container">
          <h1 class="logotype_name"><?php echo $Name ?></h1>
          <h2 class="logotype_occupation"><span class="pink"><?php echo $LineYear ?></span></h2>
		    
        </div>	
		
    <?php 
    if ($_SESSION['MemberId'] == $_GET['id'] || $_SESSION['Permission'] == 1) {
        $id = $_GET['id'];
      echo "<div class=\"tooltip\">
        <a href=\"profileEdit.php?id=$id\" style=\"text-decoration:none; color:inherit; font-size:inherit;\"><button class=\"editProfileButton\"><i class=\"far fa-edit\"></i></a>
            <span class=\"tooltiptext\">Edit Profile</span>
              </button>
          </div>";
    }
	  ?>
	  </div>
        
		
		
        <!-- MAIN MENU -->     
		
      <!-- LEFT COL -->
      <div id="left_col">
        <div class="profile_frame">
          <div class="profile_picture"></div>
          
        </div>
        <div class="contact_details_content">
          <h2>Contact</h2>
          <p class="pink">Home:</p>
          <p><?php echo $Address?></p>
          <p class="pink">Primary Phone:</p>
          <p><?php echo $Phone?></p>
          <p class="pink">Secondary Phone:</p>
          <p><?php echo $Cell?></p>
		  <p class="pink">Mailing Address:</p>
          <p><?php echo $MailAddress?></p>
          <p class="pink">Email:</p>
          <p><?php echo $Email ?></p>
          <p class="pink">Website:</p>
          <p><a href="https://<?php echo $Website?>"><?php echo $Website?></a></p>
        </div>
		
		<div class="footer-social-icons">
    
    <ul class="social-icons">
        <li><a href="https://<?php echo $Facebook?>" class="social-icon"> <i class="fab fa-facebook-f"></i></a></li>
        <li><a href="https://<?php echo $Twitter?>" class="social-icon"> <i class="fab fa-twitter"></i></a></li>
        <li><a href="https://<?php echo $Linkedin?>" class="social-icon"> <i class="fab fa-linkedin-in"></i></a></li>
        <!--<li><a href="https://<?php //echo $Instagram?>" class="social-icon"> <i class="fab fa-instagram-square"></i></a></li>-->
        <li><a href="https://<?php echo $Google?>" class="social-icon"> <i class="fab fa-google-plus-g"></i></a></li>
		<li><a href="https://<?php echo $Youtube?>" class="social-icon"> <i class="fab fa-youtube"></i></a></li>
    </ul>
</div>
		
      </div>
	  
	 
		
      <!-- PROFILE CONTENT -->
      <div id="content_container">				
        
         
        <div class="block">
           <div class="contact_details_content">
           <p class="pink">Birthday:</p>
          <p><?php echo $DOB?></p>
          <p class="pink">Major:</p>
          <p><?php echo $Major?></p>
		  <p class="pink">Degree:</p>
          <p><?php echo $Degree?></p>
           <p class="pink">Current Chapter:</p>
          <p><?php echo $Chapter?></p>
          <p class="pink">Honey-Do:</p>
          <p><?php if (!empty($Honey)) {foreach ($Honey as $honey) {echo $honey."<br>";};} ?></p>
          <p class="pink">Child (Gender):</p>
          <p><?php if (!empty($Child)) {
            foreach ($Child as $child) {
                echo $child."<br>";
                };
            }?></p>
        
       
          <h2>Business Contact</h2>
           <p class="pink">Work:</p>
          <p><?php echo $WorkName ?></p>
          <p class="pink">Title:</p>
          <p><?php echo $Title ?></p>
           <p class="pink">Address:</p>
          <p><?php echo $WorkAddress ?></p>
          <p class="pink">Phone:</p>
          <p><?php echo $WorkPhone ?></p>
          
           <h2>Emergency Contact</h2>
           <p class="pink">Name:</p>
          <p><?php echo $EmergName?></p>
          <p class="pink">Relation:</p>
          <p><?php echo $Relation?></p>
          <p class="pink">Phone:</p>
          <p><?php echo $EmergPhone?></p>
          <p class="pink">Email:</p>
          <p><?php echo $EmergEmail?></p>
         </div>
        <div class="clear"></div>  		
        </div>
       
	     
    </div>
</div>    
   </div>
     
 
  
<footer>
<div class="footer-copyright">
        <div class="container">
          &copy; Working Group 4 - ITC4850 Spring 2018
        </div>
      </div>
    </footer>
</body>


</html>