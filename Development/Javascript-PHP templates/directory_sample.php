<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
    <title>Iota Gamma Member Directory PHP sample</title>	
</head>
<body>
    <?php
        include 'database.php';

    $query = query("Select up.LastName, up.FirstName, l.InitiationYear, l.Name, up.Email From UserProfile up Join UserLine l on l.Id = up.UserLine_Id;");
    echo "<table border=1>";
    echo "<tr><th id = \"h0\">Profile</th><th id = \"h1\">Last Name</th><th id = \"h2\">First Name</th><th id = \"h3\">Initiation Year</th><th id = \"h4\">Line</th><th id = \"h5\">Email</th></tr>";
    
    $x = 0;
    while($row = mysqli_fetch_assoc($query)) {   
        echo "<tr>";
        echo"<td><a href = \"#\">Link</a></td>";   
        echo "<td id = ".$x."1>{$row['LastName']}</td>";
        echo "<td id = ".$x."2>{$row['FirstName']}";
        echo "<td id = ".$x."3>{$row['InitiationYear']}";
        echo "<td id = ".$x."4>{$row['Name']}";
        echo "<td id = ".$x."5>{$row['Email']}";
        echo "</tr>";

        $x++;
        }

    
    ?>

</body>
</html>
