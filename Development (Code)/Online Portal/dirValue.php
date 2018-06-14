<!-- 
   IG Member Directory
   Author: Luis Sanchez-Artu
   Date:   3/25/2018
   Filename: dir.php
   Supporting files: database.php
-->

<?php

include 'database.php';

function dirDirectory($query){
    if ($query == null){
        $sql = "Select up.MemberId, up.LastName, up.FirstName, l.InitiationYear, l.Name, up.Email From UserProfile up Join UserLine l on l.Id = up.UserLine_Id Order by up.LastName";
    }
    else {
        $sql = "Select up.MemberId, up.LastName, up.FirstName, l.InitiationYear, l.Name, up.Email From UserProfile up Join UserLine l on l.Id = up.UserLine_Id ";
        if (mysqli_num_rows($query) != 0){
            $sql = $sql." Where ";
            while($row = mysqli_fetch_assoc($query)) { 
                $sql = $sql."up.MemberId = '{$row['MemberId']}' OR ";
            }        
            $sql = substr($sql,0,strlen($sql)-3)." Order by up.LastName";
        }
        else $sql = $sql."Where up.MemberId = '0' Order by up.LastName";
    }

    $query = query($sql);

    echo "<table class=\"table-fill\">";

    echo "<tr>";
    echo "<thead>";
        echo "<th>Profile</th>";
        echo "<th>Last Name</th>";
        echo "<th>First Name</th>";
        echo "<th>Initation Year</th>";
        echo "<th>Line</th>";
        echo "<th>Email</th>";
    echo "</thead>";
    echo "</tr>";

    echo "<tbody class=\"table-hover\"";
    while($row = mysqli_fetch_assoc($query)) {   
    echo "<tr>";
    echo"<td><a href = \"profile.php?id={$row['MemberId']}\"><i class=\"fas fa-user-circle\"></i></td>";   
    echo "<td>{$row['LastName']}</td>";
    echo "<td>{$row['FirstName']}";
    echo "<td>{$row['InitiationYear']}";
    echo "<td>{$row['Name']}";
    echo "<td>{$row['Email']}";
    echo "</tr>";
    }
    echo "</tbody>";

    echo"</table>";
}



/*function directory($type,$string){
    if ($type == NULL) {
        $sql = "Select up.MemberId, up.LastName, up.FirstName, l.InitiationYear, l.Name, up.Email From UserProfile up Join UserLine l on l.Id = up.UserLine_Id";
        dirDirectory($sql);
    }
    elseif ($type = 'search') {
        $field = array("up.LastName", "up.FirstName", "l.InitiationYear", "l.Name", "up.Email");
        $lastField = end($field);

        $sql = "Select ";
        
        foreach ($field as $col){
            if ($col != $lastField){
                $sql = $sql.$col.", ";
            }
            else {
                $sql = $sql.$col." ";
            }
        }
        $sql = 
        
        $sql = $sql."From UserProfile up Join UserLine l on l.Id = up.UserLine_Id Where ";

        foreach ($field as $col){
            if ($col != $lastField){
                $sql = $sql."lower(".$col.") like lower('%".$string."%') OR ";
            }
            else {
                $sql = $sql."lower(".$col.") like lower('%".$string."%')";
            }
        }
        dirDirectory($sql);
    }
    else {
        echo "This function doesn't exist yet; sorry!";
    }
}
*/
?>