<?php
    
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp    

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

    //echo "$sql</br>";
    //echo $con ? 'true' : 'false';
    if(!mysqli_query($con,$sql)){
        echo mysqli_error($con);
    }
    else {            
        //echo "I got to else</br>";
        $query = mysqli_query($con,$sql);
        mysqli_close($con);
        return $query;
    }
}

function update($id,$table,$field,$value, $type){
    //echo "Im in";
    //echo $id."";
    //echo count($field)."";
    //echo count($value)."";

    if (count($field) == count($value)){
        $sql = "Update ".$table." Set ";
        //echo count($field);
        $x = 0;
        while($field[$x]){
            $sql = $sql.$field[$x]." = ";
            if ($type[$x] == "string"){
                $sql = $sql."'".$value[$x]."', ";
                $x++;
            }
            elseif ($type[$x] == "int"){
                $sql = $sql.$value[$x].", ";
                $x++;
            }
            else {
                echo "The type of value has not been identified in database.php insert();.";
                exit();
            }
        }
        $sql = substr($sql,0,strlen($sql)-2)." Where MemberId = '$id';";
        //echo $sql;
    }
    else {
        echo "the amount of fields and values don't match in aclValue.php aclEdit();";
        exit();
    }

   query($sql);

}

function search($value){
    $field = array(
        "p.LinePosition",
        "p.FirstName",
        "p.MiddleName",
        "p.LastName",
        "p.LastNamePledge",
        "p.Street",
        "p.City",
        "p.State",
        "p.Zipcode",
        "p.PhonePrimary",
        "p.PhoneSecondary",
        "p.Birthday",
        "p.DateofDeath",
        "p.DateofDeathNot",
        "p.Email",
        "p.WorkName",
        "p.WorkPosition",
        "p.WorkStreet",
        "p.WorkState",
        "p.WorkCity",
        "p.WorkZipcode",
        "p.WorkPhone",
        "p.MailingStreet",
        "p.MailingCity",
        "p.MailingState",
        "p.MailingZipcode",
        "p.CurrentChapter",
        "p.EmergencyName",
        "p.EmergencyPhone",
        "p.EmergencyEmail",
        "p.Facebook",
        "p.Twitter",
        "p.Instagram",
        "p.Linkedin",
        "p.Website",
        "ap.Name",
        "f.FirstName",
        "f.MiddleName",
        "f.LastName",
        "f.Gender",
        "ft.Name",
        "l.Name",
        "l.InitiationYear",
        "l.Semester",
        "dt.Name",
        "dt.Abbreviation");
    $lastField = "dt.Abbreviation";    

    $sql = "Select p.MemberId From UserProfile p 
                        Left Join UserLine l on l.Id = p.UserLine_Id 
                        Left Join UserAccount a on a.MemberId = p.MemberId 
                            Left Join AccountPermission ap on a.AccountPermission_Id = ap.Id
                        Left Join UserFamily f on f.MemberId = p.MemberId
                            Left Join FamilyType ft on ft.Id = f.FamilyType_Id
                        Left Join UserDegree d on d.MemberId = p.MemberId
                            Left Join DegreeType dt on dt.Id = d.DegreeType_Id
                        Where ";

        foreach ($field as $col){
            if ($col != $lastField){
                $sql = $sql."lower(".$col.") like lower('%".$value."%') OR ";
            }
            else {
                $sql = $sql."lower(".$col.") like lower('%".$value."%')";
            }
        }
        
       
       // echo $sql."<br>";
    $query = query($sql);
    //echo mysqli_num_rows($query);
    return $query;
    }



function go($url){
    echo "<script>window.location.replace('$url');</script>";
}

function sessionStart($MemberId,$Password){
    $sql = "Select p.FirstName, p.LastName, a.Password, a.Salt, a.AccountPermission_Id From UserAccount a Join UserProfile p on a.MemberId = p.MemberId Where a.MemberId = '$MemberId'";


    $query = query($sql);
    if (mysqli_num_rows($query) < 1) {
        echo "<script type=\"text/javascript\">alert(\"Your MemberId is not in our system.\");</script>";
        go("login.php");
        exit(0);
    }

    while($row = mysqli_fetch_assoc($query)) {        
        $hash = array($row['Password'],hash("sha256",$Password.$row['Salt']));
        $Permission = $row['AccountPermission_Id'];

        $Name = $row['FirstName']." ".$row['LastName'];
    }
    
    if ($hash[0] == $hash[1]){
        // server should keep session data for AT LEAST 1 hour
        ini_set('session.gc_maxlifetime', 3600);
        ini_set('session.cookie_lifetime', 3600);
        // each client should remember their session id for EXACTLY 1 hour
        session_set_cookie_params(3600);
        
        //Create Session Variables";
        $_SESSION['MemberId'] = $MemberId;
        $_SESSION['Password'] = $Password;
        $_SESSION['Permission'] = $Permission;
        $_SESSION['Name'] = $Name;



        //go($_SESSION['MemberId']);

      switch($Permission){
            case 1:
                go('admindir.php');
                break;
            case 2:
                go('regulardir.php');
                break;
            case 3:
                echo "<script>alert('Your account has been disabled. Please email igadmin@akaiotagamma.org.');</script>";
                session_unset();
                session_destroy();
                break;
            case 4:
                echo "<script>alert('Your account has been disabled. Please email igadmin@akaiotagamma.org.');</script>";
                session_unset();
                session_destroy();
                break;
        }
    }
    else {
        echo "<script type=\"text/javascript\">alert(\"Your passwords did not match.\");</script>";
        go("login.php");
    }

}

function logout(){
    session_unset();
    session_destroy();
    go('login.php');
}

function forgotPassword($input){
    //echo "<script>console.log($input)</script>";
    if (strpos($input, '@')){
        $field = 'Email';
    }
    else {
        $field = 'MemberId';
    }

    $sql = "Select FirstName, LastName From UserProfile Where $field = '$input';";
    $query = query($sql);

    if ($query == null || mysqli_num_rows($query) == 0){
        echo "<script>alert(\"The $field $input does not exist in our system. Please try again or email igadmin@akaiotagamma.org\");</script>";
    }
    else{
        while($row = mysqli_fetch_assoc($query)) {                    
            $firstName = $row['FirstName'];
            $lastName = $row['LastName'];
        }

        $msg = "$firstName $lastName has forgotten their password. Please follow up. Sincerely, your IG Directory.";
        $to = "igadmin@akaiotagamma.org";
        $from = "From: ".$to;
        mail($to, "Forgotten Password",$msg,$from);

        

        echo "<script>alert(\"Dear $firstName $lastName, we have let the administrator know you forgot your password. Please wait to be contacted.\");</script>";
    }
}

?>
