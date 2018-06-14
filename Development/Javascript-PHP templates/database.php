<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <?php
        
    /*
    SAMPLE QUERY PHP

    $query = query("Select * From UserAccount;");
    echo mysqli_num_rows($query);
    
    echo "<table border=1>";
    echo "<tr><td>MemberId</td><td>AccountPermission_Id</td></tr>";
    while($row = mysqli_fetch_assoc($query)) {                    
            echo "<tr><td>{$row['MemberId']}</td><td>{$row['AccountPermission_Id']}</td></tr>";
        }
    */

    function connect(){
        $servername = "akaiotagamma.org.mysql";
        $username = "akaiotagamma_org";
        $password = "5qwzovpdMQzriEoWkCsYvroH";
        $database = "akaiotagamma_org";
        
        // Make connection
        $con = mysqli_connect($servername, $username, $password, $database);
        
        // Check connection and return output
        if (!$con){
            return mysqli_connect_error();
        }
        else return $con;
    }

    function query($sql){
        $con = connect();
            /* Testing for connection
            if (is_string($con)) {
                echo $con;
            }
            else {
                echo "Connected</br>";
            }*/

        echo "$sql</br>";
        if(!mysqli_query($con,$sql)){
            echo mysqli_error();
        }
        else {            
            //echo "I got to else</br>";
            return mysqli_query($con,$sql);
        }
    }

    
    ?>

</body>
</html>