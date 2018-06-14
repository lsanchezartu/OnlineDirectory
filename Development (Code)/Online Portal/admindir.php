<?php 
@ob_start();
session_start();
?>

<html>
<head>
<!-- 
   IG Member Directory
   Author: Sue Argentieri
   Date:   2/28/2018
   Filename: admindir.php
   Supporting files: index.css, dirValue.php
-->

<title>Admin Directory - Iota Gamma</title>
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="index.css" type="text/css" />

	 <script>
          function refresh(){
            window.location = 'admindir.php';
          }
      </script>
	
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
	<br></br>
	<div class="wrap">
	<form class="search-bar">
   <div class="search">
   
   <form method="get">
          <input name="searchTerm" type="text" class="searchTerm" placeholder="Type your search here">
      <button type="submit" class="searchButton">
       <i class="fas fa-search"></i> 
     </button>
     <button name="reset" type="submit" class="searchResetButton" onClick="refresh();">
	 <i class="fas fa-times"></i>
	 </button>
     </form>
   
      
   </div>
   </form>
</div>
	<br></br>

	
<div class="table-title">

</div>


<?php 
        include 'dirValue.php';
        if(!isset($_SESSION['MemberId'])){
            go("login.php");
        }
        else if ($_SESSION['Permission'] != 1){
            go("regulardir.php");
        }
        
        if(isset($_GET['searchTerm'])){
            dirDirectory(search($_GET['searchTerm']));
        }
        else {
            dirDirectory(null);
        }
    ?>
	
<footer>
<div class="footer-copyright">
        <div class="container">
          &copy; Working Group 4 - ITC4850 Spring 2018
        </div>
      </div>
    </footer>
</body>


</html>