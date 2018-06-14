<html>
<head>
<!-- 
   IG Member Directory
   Author: Luis Sanchez-Artu
   Date:   4/9/2018
   Filename: login.html
   Supporting files: index.css
-->

	<title>Forgot Password - Iota Gamma</title>
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="index.css" type="text/css" />


 </head>
 <body>
    <?php
    include 'database.php';
    if (isset($_POST['input'])){
        forgotPassword($_POST['input']);
    }
    ?>
    
    <div class="navbar">
	<ul class="navbar-container">
	<li class="nav-item"><a href="login.php" class="left-underline nav-button" data-scroll>Go Back</a></li>
	</ul>
	</div>
  
  <div id="logo"></div>
  
<div class="login-page">
  <div class="form">
    
    
    <form class="login-form" method="post">
      <input type="text" name="input" placeholder="Enter MemberID or Email"/>
      <button type="submit">Submit</button><br/>
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