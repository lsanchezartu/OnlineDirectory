<?php
include 'database.php';

function dirAcl($query){
    if ($query == null) {
       // echo "sql is null<br>";
        $sql = "Select a.MemberId, p.LastName, p.FirstName, a.AccountPermission_Id From UserProfile p Join UserAccount a On a.MemberId = p.MemberId Order by p.LastName;";
    }
    else {
        //echo $sql;
        //$sql = "Select a.MemberId, p.LastName, p.FirstName, a.AccountPermission_Id From UserProfile p Join UserAccount a On a.MemberId = p.MemberId Where MemberId = '$id' Order by p.LastName";
  
        $sql = "Select a.MemberId, p.LastName, p.FirstName, a.AccountPermission_Id From UserProfile p Join UserAccount a On a.MemberId = p.MemberId ";
        if (mysqli_num_rows($query) != 0){
            $sql = $sql."Where ";
            while($row = mysqli_fetch_assoc($query)) { 
                $sql = $sql."a.MemberId = '".$row['MemberId']."' OR ";
            }        
            $sql = substr($sql,0,strlen($sql)-3)." Order by p.LastName";
        }
        else $sql = $sql."Where a.MemberId = '0' Order by p.LastName";

       //echo $sql;
        
    }
    //echo $sql;
    
    $query = query($sql);
    $x = 0;

    echo "<table class=\"table-fill\">";
    echo "<tr>";
    echo "<thead>";
        echo "<th>MemberID</th>";
        echo "<th>Password</th>";
        echo "<th>Pledged Last Name</th>";
        echo "<th>First Name</th>";
        echo "<th>Permission</th>";
        echo "<th id=\"headerEdit\">Edit</th>";
        echo "<th id=\"headerDelete\">Delete</th>";
    echo "</thead>";
    echo "</tr>";

    echo "<tbody class=\"table-hover\">";
        while($row = mysqli_fetch_assoc($query)) {   
        echo "<tr id=\"$x"."00\">";
        echo "<td>{$row['MemberId']}</td>";   
        echo "<td id=\"$x"."0\">*****</td>";
        echo "<td id=\"$x"."1\">{$row['LastName']}</td>";
        echo "<td id=\"$x"."2\">{$row['FirstName']}";
        if ($row['AccountPermission_Id'] == 1){
            echo "<td class=\"text-left\"><span id=\"$x"."3\" class=\"icon-admin\"><i class=\"fas fa-shield-alt\"></i></span></td>";
        }
            elseif ($row['AccountPermission_Id'] == 2){
                echo "<td id=\"$x"."3\"></td>";
            }
            elseif ($row['AccountPermission_Id'] == 3){
                echo "<td class=\"text-left\"><span id=\"$x"."3\" class=\"icon-disable\"><i class=\"fas fa-ban\"></i></span></td>";
            }
            elseif ($row['AccountPermission_Id'] == 4){
                echo "<td id=\"$x"."3\" >IBTW</td>";
            }
        echo "<td class=\"text-left\"><a href=\"acl.php?id={$row['MemberId']}\" id=\"$x"."4\" class=\"icon-edit\" onclick=\"edit($x);\"><i class=\"fas fa-pencil-alt\"></i></a></td>";
        echo "<td class=\"text-left\"><a href=\"#\" id=\"$x"."5\" class=\"icon-delete\" onclick=\"confirmPass('acl.php?idDel={$row['MemberId']}');\"><i class=\"fas fa-times\"></i></a></td>";
        echo "</form></tr>";

        $x++;
        }
    echo "</tbody>";

    echo"</table>";
}

function editAcl($id){
    $sql = "Select a.MemberId, p.LastName, p.FirstName, a.AccountPermission_Id From UserProfile p Join UserAccount a On a.MemberId = p.MemberId Where a.MemberId = '$id' Order by p.LastName";
    $query = query($sql);

    echo "<table class=\"table-fill\">";
    echo "<tr>";
    echo "<thead>";
        echo "<th>MemberID</th>";
        echo "<th>Password</th>";
        echo "<th>Pledged Last Name</th>";
        echo "<th>First Name</th>";
        echo "<th>Permission</th>";
        echo "<th id=\"headerEdit\">Save</th>";
        echo "<th id=\"headerDelete\">Cancel</th>";
    echo "</thead>";
    echo "</tr>";

    echo "<tbody class=\"table-hover\">";
    while($row = mysqli_fetch_assoc($query)){
        switch($row['AccountPermission_Id']){
            case 1:
                $permission = "<select name=\"AccountPermission_Id\"><option value=\"1\" selected=\"true\">Administrator</option><option value=\"2\">Regular</option><option value=\"3\">Disabled</option><option value=\"4\">Ivy Beyond the Wall</option></select>";
                break;
            case 3:
                $permission  = "<select name=\"AccountPermission_Id\"><option value=\"1\">Administrator</option><option value=\"2\">Regular</option><option value=\"3\" selected=\"true\">Disabled</option><option value=\"4\">Ivy Beyond the Wall</option></select>";
                break;
            case 2:
                $permission  = "<select name=\"AccountPermission_Id\"><option value=\"1\">Administrator</option><option value=\"2\" selected=\"true\">Regular</option><option value=\"3\">Disabled</option><option value=\"4\">Ivy Beyond the Wall</option></select>";
                break;
            case 4:
                $permission  = "<select name=\"AccountPermission_Id\"><option value=\"1\">Administrator</option><option value=\"2\">Regular</option><option value=\"3\">Disabled</option><option value=\"4\" selected=\"true\">Ivy Beyond the Wall</option></select>";
                break;
            default:
                $permission  = "<select name=\"AccountPermission_Id\"><option value=\"1\">Administrator</option><option value=\"2\">Regular</option><option value=\"3\">Disabled</option><option value=\"4\">Ivy Beyond the Wall</option></select>";
        }

        echo "<form action=\"aclValue.php?idEdit={$_GET['id']}\" method=\"post\" onsubmit=\"return confirm('Are you sure you want to submit?');\">";
        echo "<tr>";

        echo "<td>{$row['MemberId']}</td>";
        echo "<td><input name=\"Password\" type=\"text\" value=\"*****\"></td>";
        echo "<td><input name=\"LastNamePledge\" type=\"text\" value=\"{$row['LastName']}\"></td>";
        echo "<td><input name=\"FirstName\" type=\"text\" value=\"{$row['FirstName']}\"></td>";
        echo "<td>$permission</td>";
        echo "<td><input type=\"submit\" value=\"Save\"></td>";
        echo "<td class=\"text-left\"><a href=\"acl.php\" class=\"icon-delete\"><i class=\"fas fa-times\"></i></a></td>";
    }
    echo "</tr>";
    echo "</form";
    echo "</tbody>";

    echo"</table>";
}

function delAcl($id){

    $sql = "Select * From UserDegree Where MemberId='$id';";
    $query = query($sql);
    if(mysqli_num_rows($query) > 0){
        query("Delete From UserDegree Where MemberId = '$id';");
    }

    $sql = "Select * From UserFamily Where MemberId='$id';";
    $query = query($sql);
    if(mysqli_num_rows($query) > 0){
        query("Delete From UserFamily Where MemberId = '$id';");
    }

    $sql = "Select * From UserAccount Where MemberId='$id';";
    $query = query($sql);
    if(mysqli_num_rows($query) > 0){
        query("Delete From UserAccount Where MemberId = '$id';");
    }

    $sql = "Select * From UserProfile Where MemberId='$id';";
    $query = query($sql);
    if(mysqli_num_rows($query) > 0){
        query("Delete From UserProfile Where MemberId = '$id';");
    }

    go('acl.php');

}

if (isset($_GET['idEdit'])){
    $id = $_GET['idEdit'];

    if ($_POST['Password'] == "*****" || $_POST['Password'] == ""){
        //echo "password stays";

        $table = "UserProfile";
        $field = array("LastNamePledge","FirstName");
        $value = array($_POST['LastNamePledge'],$_POST['FirstName']);
        $type = array("string","string");
        update($id, $table, $field, $value, $type);

        $table = "UserAccount";
        $field = array("AccountPermission_Id");
        $value = array($_POST['AccountPermission_Id']);
        $type = array("int");
        update($id, $table, $field, $value, $type);
    }
    
    else {
        //echo $_POST['Password']."<br>";         
        $table = "UserProfile";
        $field = array("LastNamePledge","FirstName");
        $value = array($_POST['LastNamePledge'],$_POST['FirstName']);
        $type = array("string","string");
        update($id, $table, $field, $value, $type);

        $table = "UserAccount";
        $field = array("AccountPermission_Id", "Password");
        $value = array($_POST['AccountPermission_Id'],$_POST['Password']);
        $type = array("int", "string");
        update($id, $table, $field, $value, $type);
    }

    go("acl.php");

}

if (isset($_GET['new'])){
    if($_GET['new'] == 1){
        $sql = "Insert Into UserProfile(FirstName, LastNamePledge, LinePosition)";
    }
}
?>