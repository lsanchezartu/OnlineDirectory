<?php 
@ob_start();
session_start();
?>
<html>
<head>
<!-- 
   IG Member Directory
   Author: Luis Sanchez-Artu
   Date:   4/9/2018
   Filename: login.html
   Supporting files: index.css
-->

	<title>Log In - Iota Gamma</title>
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="index.css" type="text/css" />

 </head>
 
 <body>
     
    <?php
    include 'database.php';
    if (isset($_SESSION['MemberId']) && $_SESSION['Permission'] == 1){
        go("admindir.php");
      }
      else if (!isset($_SESSION['MemberId']));
      else {
        go("regulardir.php");
      }
    if (isset($_POST['MemberId'])){
      sessionStart($_POST['MemberId'],$_POST['Password']);
    }
    ?>
    
    <div class="navbar">
	<ul class="navbar-container">
	<li class="nav-item"><a href="IGMain.html" class="left-underline nav-button" data-scroll>Go Back</a></li>
	</ul>
	</div>
  
  <div id="logo"></div>
  
<div class="login-page">
  <div class="form">
    
    
    <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <input type="text" name="MemberId" placeholder="Enter MemberID"/>
      <input type="password" name="Password" placeholder="Enter Password"/>
      <button>login</button>
      <p class="message"><a href="forgotPassword.php">Forgot your password?</a></p>
    </form>
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