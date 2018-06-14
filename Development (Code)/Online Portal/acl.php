<?php 
@ob_start();
session_start();
?>

<html>
<head>
<!-- 
   IG Member Directory
   Author: Luis Sanchez-Artu
   Date:   04/14/2018
   Filename: acl.php
   Supporting files: index.css
-->

	<title>Admin Control Panel - Iota Gamma</title>
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="index.css" type="text/css" />

	 <script>
          function refresh(){
            window.location = 'acl.php';
          }
        function go(location){
            window.location = location;
        }
        function confirmPass(loc){
            var pass = confirm("Are you sure?");
                if (pass == true){
                    window.location = loc;
                }
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
        <li class="nav-item"><a href="login.php" class="left-underline nav-button" data-scroll>Main Directory</a></li>
        </ul>
    </div>
    
	<div id="logo"></div>
	<br></br>
	
	<div class="wrap1">
	<div class="tooltip">
	<button class="adduser" onclick="go('addUser.php');">
	      <i class="fas fa-user-plus"></i> 
		  <span class="tooltiptext">Add New User</span>
		  </button>
     </div>   
 </div> 	 
		 
	<div class="wrap">
   <div class="search">
	<form method="get">
      <input type="text" name="searchTerm" class="searchTerm" placeholder="Type your search here">
      <button type="submit" class="searchButton">
       <i class="fa fa-search"></i> 
     </button>
	 <button type="submit" class="searchResetButton">
      	   <i class="fas fa-times"></i>
     </button>
   </form>
   </div>
</div>
	<br></br>
	    	
<div class="table-title"></div>

<?php 
        include 'aclValue.php';
        if(!isset($_SESSION['MemberId']) || $_SESSION['Permission'] != 1){
            go('login.php');
        }
        
        if(isset($_GET['id'])){
            if($_GET['id'] == $_SESSION['MemberId']){
                echo "<script>alert('You cannot edit your own User Account.')</script>";
                dirAcl(null);
            }
            else {
                editAcl($_GET['id']);
            }
        }
        elseif(isset($_GET['searchTerm'])){
            dirAcl(search($_GET['searchTerm']));
        }
        elseif(isset($_GET['idDel'])){
            delAcl($_GET['idDel']);
        }
        else {
            dirAcl(null);
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