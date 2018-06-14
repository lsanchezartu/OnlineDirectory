<html>
<head>
<!-- 
   IG Member Directory
   Author: Luis Sanchez-Artu
   Date:   3/25/2018
   Filename: regulardir.php
   Supporting files: index.css; dir.php
-->

	<title>Iota Gamma Member Directory</title>
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
	<link rel="stylesheet" href="index.css" type="text/css" />

      <script>
          function refresh(){
            window.location = 'http://akaiotagamma.org/regulardir.php';
          }
      </script>
	
 </head>
 <body>
    
	<div class="navbar">
      <ul class="navbar-container">
        <li><a href="#" class="nav-button brand-logo">Welcome, MemberName!</a></li>
        <li class="nav-item"><a href="#section-4" class="left-underline nav-button" data-scroll>Logout</a></li>
        <li class="nav-item"><a href="#section-3" class="left-underline nav-button" data-scroll>Change Password</a></li>
        <li class="nav-item"><a href="#section-2" class="left-underline nav-button" data-scroll>Profile</a></li>
      </ul>
    </div>
    
	<div id="logo"></div>
	<br></br>
	<div class="wrap">
   <div class="search">
      <form method="get">
          <input name="searchTerm" type="text" class="searchTerm" placeholder="Type your search here">
      <button type="submit" class="searchButton">
       <i class="fa fa-search"></i> 
     </button>
     <button name="reset" type="reset" onClick="refresh();">reset</button>
     </form>
   </div>
</div><br></br>

<div class="table-title"></div>
<?php 
        include 'dir.php';
        
        if(isset($_GET['searchTerm'])){
            directory('search',$_GET['searchTerm']);
        }
        else {
            directory(NULL, NULL);
        }
    ?>

	
<footer>
<div class="footer-copyright">
        <div class="container">
          � 2018 Iota Gamma Member Directory
        </div>
      </div>
    </footer>
</body>


</html>