<?php
@ob_start();
session_start();

include 'database.php';
  if(!isset($_SESSION['MemberId'])){
            go("login.php");
        }
//Function for updating profile
    if(isset($_GET['idEdit'])){
    
        $x = 0;
        $xP = 0;
        $xD = 0;
        $xDT = 0;
        $xF = 0;
        $xInsertF = 0;
        foreach ($_POST as $field => $value){
            if (htmlspecialchars($value) == "" || htmlspecialchars($value) == "selectstate");
            else {
                $fieldX[$x] = htmlspecialchars($field);
                $valueX[$x] = htmlspecialchars($value);
                
                if (substr($field,0,strlen($field)-1) == "ChildName" || substr($field,0,strlen($field)-1) == "ChildGender"){
                    $fieldFIndex[$x] = substr($field,strlen(htmlspecialchars($field))-1);
                    $fieldFName[$fieldFIndex[$x]] = $_POST['ChildName'.$fieldFIndex[$x]];
                    $fieldFGender[$fieldFIndex[$x]] = $_POST['ChildGender'.$fieldFIndex[$x]];
                    $fieldFId[$fieldFIndex[$x]] = 1;
                    
                    //echo $fieldFIndex[$x]."<br>";
                    //echo $fieldFName[$fieldFIndex[$x]]."<br>";
                    //echo $fieldFGender[$fieldFIndex[$x]]."<br>";
                }
                else if (substr($field,0,strlen($field)-1) == "ChildCName" || substr($field,0,strlen($field)-1) == "ChildCGender"){
                    $fieldFCIndex[$x] = substr($field,strlen(htmlspecialchars($field))-1);
                    $fieldFCName[$fieldFCIndex[$x]] = $_POST['ChildName'.$fieldFCIndex[$x]];
                    $fieldFCGender[$fieldFCIndex[$x]] = $_POST['ChildGender'.$fieldFCIndex[$x]];
                    
                    //echo $fieldFCIndex[$x]."<br>";
                    //echo $fieldFCName[$fieldFCIndex[$x]]."<br>";
                    //echo $fieldFCGender[$fieldFCIndex[$x]]."<br>";
                }
                else{
                    //echo "post field $x is ".$fieldX[$x]."<br>";
                    //echo "post value $x is ".$valueX[$x]."<br>";
                    //echo "post index $x is ".$fieldXIndex[$x]."<br>";
                }
                $x++;
            }
        }
        
        $x = 0;
        foreach ($fieldX as $field){
            if ($field == "Major"){
                $fieldD[$xD] = $field;
                $valueD[$xD] = $valueX[$x];
                
                //echo "normal field $x is ".$fieldD[$xD]."<br>";
                //echo "normal value $x is ".$valueD[$xD]."<br>";
                
                $xD++;
                $x++;
            }
            else if ($field == "Degree"){
                $fieldDT[$xDT] = "Abbreviation";
                $valueDT[$xDT] = $valueX[$x];
                
                //echo "normal field $x is ".$fieldDT[$xDT]."<br>";
                //echo "normal value $x is ".$valueDT[$xDT]."<br>";
                
                $xDT++;
                $x++;
            }
            else if (substr($field,0,6) == "insert"){
                //echo substr($field,6,5);
                if (substr($field,6,5) == "Child"){
                    if ($field == "insertChildName"){
                        $fieldInsertChildName = $_POST[$field];
                        echo $fieldInsertChildName;
                    };
                    if ($field == "insertChildGender"){
                        $fieldInsertChildGender = $_POST[$field];
                        echo $fieldInsertChildGender;
                    };
                }
                if (substr($field,6,5) == "Honey"){
                    $fieldInsertHoney = $_POST[$field];
                    echo $fieldInsertHoney;
                }
                $x++;
            }
            else if (substr($field,0,5) == "Child" || substr($field,0,5) == "Honey"){$x++;}
            else {
                $fieldP[$xP] = $field;
                $valueP[$xP] = $valueX[$x];
                
                //echo "normal field $x is ".$field."<br>";
                //echo "normal value $x is ".$valueX[$x]."<br>";
                
                $xP++;
                $x++;
            }
        }
        
        if (!empty($fieldP)){ 
            $x = 0;
            $table = "UserProfile";
            foreach ($fieldP as $field){
                if ($field == "Birthday"){
                            $sql = "Select Birthday From UserProfile Where MemberId = '".$_GET['idEdit']."'";
                            $query = query($sql);
                            //echo mysqli_num_rows($query);
                            while($row = mysqli_fetch_assoc($query)) {
                                $Birthday = $row['Birthday'];
                            }
                            
                            //echo $Birthday."<br>";
                            $BirthdayString = (string) date('m-d',strtotime($Birthday));
                            //echo $BirthdayString;
                    
                    if ($valueP[$x] == $BirthdayString){
                        $valueP[$x] = (string) $Birthday;
                    }
                    else { 
                        $valueP[$x] = strtotime($valueP[$x]);
                        $valueP[$x] = date('Y-m-d',$valueP[$x]);
                    }
                }
                $type[$x] = "string";
                //echo "For id ".$_GET['idEdit']." I will update the table $table, whose $field will be value ".$valueP[$x]." of type string.<br>";
                $x++;
            }
            update($_GET['idEdit'],$table,$fieldP,$valueP, $type);
        }
        if (!empty($fieldD)){ 
            
            $x = 0;
            $table = "UserDegree";
            $sql = "Select * From UserDegree Where MemberId = '".$_GET['idEdit']."';";
            //echo $sql;
            $query = query($sql);
            
            if (mysqli_num_rows($query) < 1){
                $sql = "Insert Into $table(MemberId,DegreeType_Id,Major) Values('".$_GET['idEdit']."', ".$_POST['Degree'].", '".$_POST['Major']."');";
                //echo $sql;
            }
            else{
                if ($_POST['Major'] == ''){
                    $sql = "Update $table Set DegreeType_Id = ".$_POST['Degree']." Where MemberId = '".$_GET['idEdit']."';";
                }
                else {
                    $sql = "Update $table Set ".$fieldD[$x]." = '".$valueD[$x]."' Where MemberId = '".$_GET['idEdit']."'"." and DegreeType_Id = ".$_POST['Degree'].";";
                }
            }
            
            //echo  $sql;
            query($sql);
            $x++;
            
        }        
        if (!empty($fieldFIndex)){
            
            $table = "UserFamily";
            foreach ($fieldFIndex as $index){
                //echo "I must compare the input ".$fieldFName[$index]." with the value in database ".$fieldFCName[$index]."<br>";
               if ($fieldFName[$index] == $fieldFCName[$index]);
               else {
                    if ($fieldFGender[$index] == "" || $fieldFGender[$index] == null){
                        $sql = "Update $table Set FirstName = '".$fieldFName[$index]."' Where MemberId = '".$_GET['idEdit']."';";
                        //echo $sql;
                        query($sql);
                    }
                    else {
                        $sql = "Update $table Set FirstName = '".$fieldFName[$index]."', Gender = '".$fieldFGender[$index]."' Where MemberId = '".$_GET['idEdit']."' and FirstName = '".$fieldFCName[$index]."';";
                        //echo $sql;
                        query($sql);
                    }
               }
            }
        }
        if (!empty($fieldInsertChildName)){
            echo "I insert Child <br>";
            if ($fieldInsertChildGender == "" || $fieldInsertChildGender == null || !isset($fieldInsertChildGender)){
                    $sql = "Insert Into UserFamily (MemberId,FamilyType_Id, FirstName) Values ('".$_GET['idEdit']."',1,'$fieldInsertChildName');";
                    //echo $sql;
                    query($sql);
            }
            else {
                $sql = "Insert Into UserFamily (MemberId,FamilyType_Id,FirstName, Gender) Values ('".$_GET['idEdit']."',1,'$fieldInsertChildName', '$fieldInsertChildGender');";
                //echo $sql;
                query($sql);
            }
        }
        if (!empty($fieldInsertHoney)){ 
            //echo "I insert Honey <br>";
            $sql = "Insert Into UserFamily (MemberId,FamilyType_Id,FirstName) Values ('".$_GET['idEdit']."',2,'$fieldInsertHoney');";
            //echo $sql;
            query($sql);
        }
        
        go('profile.php?id='.$_GET[idEdit]);
        
    }

//Global variables for setProfile
$Name;
$FirstName;
$LastName;
$LineYear;
$Street;
$City;
$State;
$Zipcode;
$Address;
$Phone;
$Cell;
$Email;
$Website;
$Facebook;
$Twitter;
$Instagram;
$Linkedin;
$Google;
$Youtube;
$DOBedit;
$DOB;
$DOD;
$DODNot;
$Degree;
$Major;
$MailStreet;
$MailCity;
$MailState;
$MailZipcode;
$MailAddress;
$Chapter;
$Honey;
$Child;
$ChildId;
$ChildName;
$ChildGender;
$WorkName;
$Title;
$WorkStreet;
$WorkCity;
$WorkState;
$WorkZipcode;
$WorkAddress;
$WorkPhone;
$EmergName;
$Relation;
$EmergPhone;
$EmergEmail;


function setProfile($MemberId){
    global $Name;
    global $FirstName;
    global $LastName;
    $FirstName = findProfile(FirstName, $MemberId);
    $LastName = findProfile(LastName,$MemberId);
    $Name = $FirstName." ".$LastName;

    global $LineYear;
    $LineYear = findLine(Name, $MemberId)." ".findLine(InitiationYear, $MemberId);
    
    global $Address;
    global $Street;
    global $City;
    global $State;
    global $Zipcode;
    $Street = findProfile(Street, $MemberId);
    $City = findProfile(City, $MemberId);
    $State = findProfile(State, $MemberId);
    $Zipcode = findProfile(Zipcode, $MemberId);
    $Address = $Street." ".formatCityState($City,$State)." ".$Zipcode;
    
    global $Phone;
    $Phone = formatPhone(findProfile(PhonePrimary, $MemberId));

    global $Cell;
    $Cell = formatPhone(findProfile(PhoneSecondary, $MemberId));

    global $Email;
    $Email = findProfile(Email, $MemberId);

    global $Website;
    $Website = findProfile(Website, $MemberId);
    
    global $Facebook;
    $Facebook = findProfile(Facebook, $MemberId);

    global $Twitter;
    $Twitter = findProfile(Twitter, $MemberId);

    global $Instagram;
    $Instagram = findProfile(Instagram, $MemberId);
    
    global $Linkedin;
    $Linkedin = findProfile(Linkedin, $MemberId);

    global $Google;
    $Google = findProfile(Google, $MemberId);
    
    global $Youtube;
    $Youtube = findProfile(Youtube, $MemberId);
    
    global $DOB;
    $DOB = formatDOB(findProfile(Birthday, $MemberId));
    
    global $DOBedit;
    $DOBedit = findProfile(Birthday, $MemberId);
    
    global $DOD;
    $DOD = findProfile(DateofDeath, $MemberId);
    
    global $DODNot;
    $DODNot = findProfile(DateofDeathNot, $MemberId);
    
    global $Degree;
    $Degree = findDegree(DegreeType_Id,$MemberId);
    
    global $Major;
    $Major = findDegree(Major, $MemberId);

    global $MailAddress;
    global $MailStreet;
    global $MailCity;
    global $MailState;
    global $MailZipcode;
    $MailStreet = findProfile(MailingStreet, $MemberId);
    $MailCity = findProfile(MailingCity, $MemberId);
    $MailState = findProfile(MailingState, $MemberId);
    $MailZipcode = findProfile(MailingZipcode, $MemberId);
    $MailAddress = $MailStreet." ".formatCityState($MailCity,$MailState)." ".$MailZipcode;
    
    global $Chapter;
    $Chapter = findProfile(CurrentChapter, $MemberId);

    global $Honey;
    $Honey = findFamily(Honey, $MemberId);

    global $Child;
    $Child = findFamily(Child, $MemberId);

    global $WorkName;
    $WorkName = findProfile(WorkName, $MemberId);

    global $Title;
    $Title = findProfile(WorkPosition, $MemberId);

    global $WorkAddress;
    global $WorkStreet;
    global $WorkCity;
    global $WorkState;
    global $WorkZipcode;
    $WorkStreet = findProfile(WorkStreet, $MemberId);
    $WorkCity = findProfile(WorkCity, $MemberId);
    $WorkState = findProfile(WorkState, $MemberId);
    $WorkZipcode = findProfile(WorkZipcode, $MemberId);
    $WorkAddress = $WorkStreet." ".formatCityState($WorkCity,$WorkState)." ".$WorkZipcode;
    
    global $WorkPhone;
    $WorkPhone = formatPhone(findProfile(WorkPhone, $MemberId));
    
    global $EmergName;
    $EmergName = findProfile(EmergencyName, $MemberId);

    global $Relation;
    $Relation = findProfile(EmergencyRelation, $MemberId);

    global $EmergPhone;
    $EmergPhone = formatPhone(findProfile(EmergencyPhone, $MemberId));
    
    global $EmergEmail;
    $EmergEmail = findProfile(EmergencyEmail, $MemberId);
}

    function findProfile($field,$MemberId){

        $sql = "Select ".$field." From UserProfile Where MemberId='".$MemberId."'";
        $query = query($sql);

        while($row = mysqli_fetch_array ($query)){
            if ($row[$field] == null){
                return "";
            }
            else {
                return $row[$field];
            };
        }
    }

    function findFamily($type, $MemberId){
        $fam = array();
        //return $fam;
       $x = 0;
        
        if ($type == 'Honey') {
          //  $fam2 = array('honey','Honey');   
        //return $fam2;
            $sql = "Select FirstName From UserFamily Where MemberId='".$MemberId."' and FamilyType_Id = 2";
            $query = query($sql);

           while($row = mysqli_fetch_array ($query)){
                if ($row['FirstName'] == null){
                    return "";
                }
                else {
                    $fam[$x] = $row['FirstName'];
                    $x++;
                };
            }

            return $fam;
       }
       elseif ($type == 'Child'){
        //$fam2 = array('child','Child');   
        //return $fam2;
            $sql = "Select Id, FirstName, Gender From UserFamily Where MemberId='".$MemberId."' and FamilyType_Id = 1";
            $query = query($sql);

            while($row = mysqli_fetch_array ($query)){
                if ($row['FirstName']  == null){
                    $fam[$x] = "";
                }
                else {
                    if ($row['Gender'] == ""){
                        global $ChildId;
                        $ChildId[$x] = $row['Id'];
                        
                        global $ChildGender;
                        $ChildGender[$x] = "";
                        
                        global $ChildName;
                        $ChildName[$x] = $row['FirstName'];
                        
                        $fam[$x] = $row['FirstName'];
                    }
                    else {
                        global $ChildId;
                        $ChildId[$x] = $row['Id'];
                        global $ChildGender;
                        $ChildGender[$x] = $row['Gender'];
                        global $ChildName;
                        $ChildName[$x] = $row['FirstName'];
                        $fam[$x] = $row['FirstName']." (".$row['Gender'].")";
                    }
                    $x++;
                }
            }

            return $fam;
       }


    }

    function findLine($field,$MemberId){

        $sql = "Select l.".$field." From UserLine l Join UserProfile p on p.UserLine_Id = l.Id Where p.MemberId='".$MemberId."'";
        $query = query($sql);

        while($row = mysqli_fetch_array ($query)){
            if ($row[$field] == NULL){
                return "";
            }
            else {
                return $row[$field];
            };
        }
    }
    
    function findDegree($field,$MemberId){
        $sql = "Select $field From UserDegree Where MemberId = '$MemberId'";
        $query = query($sql);
        while($row = mysqli_fetch_array($query)){
            if($row[$field] == null){
               return ""; 
            }
            else if ($field == "DegreeType_Id"){
                 $sql = "Select Abbreviation From DegreeType Where Id = ".$row[$field];
                 //echo $row[$field];
                 //echo $sql;
                 $query = query($sql);
                while($row = mysqli_fetch_array($query)){
                    if($row['Abbreviation'] == null){
                        return ""; 
                    }
                    else { return $row['Abbreviation'];}
                }
            }
            else {
                return $row[$field];
            };
        }
    }

    function formatPhone($value){
        if ($value == ""){
            return "";
        }
        else if (substr($value,0,1) == "(") {
            //echo $value;
            return $value;
        }
        else {
            $right = substr($value, -4);
            $middle = substr($value, -7, 3);
            $left = substr($value, 0, strlen($value)-7);

            return "(".$left.")"." ".$middle."-".$right;
        }
    }

    function formatCityState($city, $state){
        if ($city == ""){
            return "";
        }
        elseif ($state == ""){
            return $city;
        }
        else{
            return $city.", ".$state;
        }
    }

    function formatDOB($value){
        if ($value == ""){
            return "";
        }
        else {
            return substr($value, -5);
        }
    }

?>