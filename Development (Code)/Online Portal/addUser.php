<?php 
@ob_start();
session_start();

include 'database.php';
if(!isset($_SESSION['MemberId']) || $_SESSION['Permission'] != 1){
            go('login.php');
        }
        
if($_GET['newLine'] == 1){
    $Name = $_POST['Name'];
    $Semester = $_POST['Semester'];
    $InitiationYear = $_POST['InitiationYear'];
    $sql = "Insert into UserLine(Name, Semester, InitiationYear) Values('$Name','$Semester',$InitiationYear);";
    query($sql);
}

if(isset($_POST['FirstName'])){
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $LinePosition = $_POST['LinePosition'];
    $LineName = $_POST['LineName'];
    $Password = $_POST['Password'];
    $AccountPermission_Id = $_POST['AccountPermission_Id'];
    //echo $AccountPermission_Id;
    
    $sql = "Select Id From UserLine Where Name = '$LineName';";
    //echo $sql;
    $query = query($sql);
    while($row = mysqli_fetch_array($query)) {                    
        $UserLine_Id = $row['Id'];
    }
    
    //echo $UserLine_Id;
    $sql = "Insert Into UserProfile(FirstName,LastNamePledge,UserLine_Id,LinePosition) Values('$FirstName','$LastName',$UserLine_Id,'$LinePosition');";
    //echo $sql;
    query($sql);
    
    $sql = "Select MemberId From UserProfile Where UserLine_Id = $UserLine_Id and LinePosition = '$LinePosition';";
    //echo $sql;
    $query=query($sql);
    
    while($row = mysqli_fetch_array($query)) {                    
        $MemberId = $row['MemberId'];
    }
    
    $sql = "Insert Into UserAccount(MemberId,Password, AccountPermission_Id) Values('$MemberId','$Password', $AccountPermission_Id);";
    //echo $sql;
    query($sql);
}

?>

<html>
<head>
<!-- 
   IG Member Directory
   Author: Sue Argentieri
   Date:   3/14/2018
   Filename: adduser.html
   Supporting files: index.css
   Contributing Authors: Ingrid Henricksen, Luis Sanchez-Artu
-->

	<title>Iota Gamma Member Directory - Add Member</title>
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="index.css" type="text/css" />

	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
	
	<script>
	    function display(hide, show){
	        var eHide = document.getElementById(hide);
	        var eShow = document.getElementById(show);
	        console.log(eHide);
	        console.log(eShow);
	        
	        eHide.style.display = "none";
	        eShow.style.display = "block";
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
	<br></br>
	
	<div id="addUser" class="adduserform">
<h3>Add New Member</h3>

<div class="containernewmember">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
       <form method="post" action="test.php?new=1">
      
    <label for="fname">First Name</label>
    <input type="text" name="FirstName" class="fname" placeholder="Member first name..." required>

    <label for="lname">Last Name</label>
    <input type="text" name="LastName" class="lname" placeholder="Member last name..." required>

	<label for="position">Position</label>
    <input type="text" name="LinePosition" class="position" placeholder="Member line position..." pattern="[0-9]{2}" title="Only numbers, max 2." required>
    
    <label for="linename">Line</label><br>
    
    
<a href="#" style="
    border: 1px solid #e7adad;
    background-color: white;
    border-radius: 5px;
    padding: 1vh;" onclick="display('addUser','addLine');"><i style="color:#e7adad; width: 2%;" class="fas fa-plus"></i></a>
<?php
    echo "<select class=\"linename\" name=\"LineName\" style=\"width:90%; height:42px;\" required>";
     // <option value="newlinename">Select Line Name</option>  include 'database.php';
  
    $sql="SELECT * FROM UserLine";
    $query =query($sql);
    while ($row = mysqli_fetch_array($query)) { 
        echo "<option value='".$row['Name']."'>".$row['Name']."</option>"; 
    }
 
    echo "</select>";
 ?>


<!--	//<option value="linejewels">Line Jewels</option>
    //  <option value="eightshades">Eight Shades of Jade</option>
    //  <option value="pinkladies">Pink Ladies and Creme</option>  -->
  
<label for="permission">Permission</label><br>
<?php
    echo "<select class=\"linename\" name=\"AccountPermission_Id\" style=\"height:42px;\" required>";
     // <option value="newlinename">Select Line Name</option>  include 'database.php';
  
    $sql="SELECT * FROM AccountPermission";
    $query =query($sql);
    
    while ($row = mysqli_fetch_array($query)) { 
        echo "<option value='".$row['Id']."'>".$row['Name']."</option>";
    }
 
    echo "</select>";
 ?>
 
       <br><br>
    <label for="password">Member Password</label>
    <input type="text" class="memberpassword" name="Password" placeholder="Member password" required>
	<br></br>

    <button type="submit">submit</button>   
        <br><br>
		<input type="reset" class="button" value="clear">
        <br><br>
		<a href="acl.php"><input class="button" value="Cancel"></input></a>
    
    
  </form>
</div>
</div>

<div class="adduserform" id="addLine" style="display:none;">
<h3>Congratulations on A New Line! </h3>

<div class="containernewmember">	
	<form method="post" action="addUser.php?newLine=1">		
				<label>Line Name</label>
				    <input type="text" name="Name" class="fname" placeholder="Enter the new Line Name" required><br/>
				<label>Semester</label>
				    <input type="text" name="Semester" class="fname" placeholder="Enter only the Semester (e.g. 'Spring')" required><br/>
				<label>Year</label>
				    <input type="number" min="1974" step="1" name="InitiationYear" class="fname" placeholder="Enter the Year" required><br/>

        <button type="submit">Add</button>   
        <br><br>
		<input type="reset" class="button" value="clear">
        <br><br>
		<a href="#" onclick="display('addLine','addUser');"><input class="button" value="Cancel"></input></a>
		</div></div>
	
<footer>
<div class="footer-copyright">
        <div class="container">
          &copy; Working Group 4 - ITC4850 Spring 2018
        </div>
      </div>
    </footer>
</body>


</html>