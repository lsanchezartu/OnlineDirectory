
<html>
<head>
<!-- 
   IG Member Directory
   Author: Sue Argentieri
   Date:   2/20/2018
   Filename: login.html
   Supporting files: index.css
-->

	<title>Iota Gamma Member Directory</title>
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

	<link rel="stylesheet" href="index.css" type="text/css" />

 </head>
 <body>

<?php
include "database.php";
	$Id = $_POST["MemberId"];
	$Pw = $_POST["Password"];

	echo $Id;
	echo $Pw;

    
	$Pw2 = query("select Password from UserAccount where MemberId = '$Id';");
	if( $Pw == $Pw2){
		echo "hurray";
	}
	else {
		echo $Pw;
		//echo $Pw2;
		echo "<br>They don't match";

	}
?>
	 
	 <?php
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname= "userstest_db";

// Create connection
//W3schools for mysql... 
$con = new mysqli($servername, $username, $password, $dbname);



// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
else 
{
	
	$escapedPassword= mysql_real_escape_string($db,$password);
	//now check user and password verification */
	
	
	/*$query = "select Password from UserAccount where MemberId = '$MemberId';";
		$resultset = mysql_query($db, $query); 
								if (@mysql_num_rows($resultset) > 0){ 
								// check noraml user salt and pass
								//echo "noraml";
	$saltQuery = "select salt from user where username = "usernameval"; ";
	$result=mysql_query( $db,$saltQuery);
	$row = mysql_fetch_assoc ($result); 
	$salt = $row( 'salt'); 
	$saltedpassword = $escapedPassword . $salt; 
	$hashedpassword = hash('sha256', $saltedpassword);
		
		$query = " select * from user where username = '$userneme and password = '$hashedpassword';";
			$resetset = mysql_query($db,$query);
			if (@mysql_num_rows($resultset) >0){
			header("location . index .php"); } 
			else 
			echo "your username or password is incorrect";

		
	*/	
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
