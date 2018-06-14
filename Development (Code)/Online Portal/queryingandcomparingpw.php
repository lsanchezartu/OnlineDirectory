<?php
    Session_start();

    $_session ['M_un'] = $username; 
    header ('Location: database.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
//Session_start ();
include "database.php";

 $servername = "akaiotagamma.org.mysql";
$username = "akaiotagamma_org";
$password = "5qwzovpdMQzriEoWkCsYvroH";
$database = "akaiotagamma_org";

$con = mysqli_connect($servername, $username, $password, $database);

$result = mysqli_connect($servername, $username, $password, $database);
        

foreach($result as $row){
    $success = true;
} 
 // end for loop
 $PwFROMDB = $row ['password'];
 if ($pwFROMDB == $password) {
    echo '<div> Success! </div>';
 }
 
 if ( $username == "Sean" && $password == "secret") { 
    echo '<div> Success! </div>';
    // login success
}

?>
</body>



</html>