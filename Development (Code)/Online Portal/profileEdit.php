<?php 
@ob_start();
session_start();

  include 'profileValue.php'; 
  if(!isset($_SESSION['MemberId'])){
            go("login.php");
        }
        

  setProfile($_GET['id']);
?>
<html>
<head>
<!-- 
   IG Member Directory
   Author: Luis Sanchez
   Date:   4/15/2018
   Filename: profileEdit.php
   Supporting files: index.css
-->

	<title>Iota Gamma Member Directory - Update Profile</title>
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="index.css" type="text/css" />
		 <!--Auto select current state options-->
		  <script>
                function selectOption(valueP,valueM,valueW){
                    //Value comes from "<body onload='value'>"
                    if (valueP == "" || valueP === undefined){
                        var optionP = 'select#selectP option[value=selectstate]';
                    }
                    else {var optionP = 'select#selectP option[value='+valueP+']';}
                    console.log(valueP);
                    console.log(optionP);
                    
                    if (valueM == "" || valueM === undefined){
                        var optionM = 'select#selectM option[value=selectstate]';
                    }
                    else {var optionM = 'select#selectM option[value='+valueM+']';}
                    console.log(valueM);
                    console.log(optionM);
                     
                    if (valueW == "" || valueW === undefined){
                        var optionW = 'select#selectW option[value=selectstate]';
                    }
                    else {var optionW = 'select#selectW option[value='+valueW+']';}
                    console.log(valueW);
                    console.log(optionW);
                    
                    var e = [document.querySelector(optionP),document.querySelector(optionM),document.querySelector(optionW)];
                    console.log(e);
                    
                   e.forEach(function(i){
                        i.selected = true;
                    });
                }
            </script>


 </head>
 <body onload="selectOption('<?php echo $State ?>','<?php echo $MailState ?>','<?php echo $WorkState ?>')">
    
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
  


  <div class="userprofile">
  
<!-- MAIN CONTAINER -->
		<div id="main_container">
      <!-- HEADER -->
      <div id="header">
    <!-- FORM start -->
      <form method="post" class="editprofile-form" action="profileValue.php?idEdit=<?php echo $_GET['id']; ?>">
        <!-- LOGOTYPE/NAME -->
        <div class="header_logotype_container">
          <h1 class="logotype_name"><?php echo $FirstName; ?> <input type="text" class="enterlastname" name="LastName" <?php if ($LastName == null || $LastName == "") {echo "placeholder=\"Enter your last name\"";} else {echo "value = \"$LastName\"";} ?>/></h1>
          <h2 class="logotype_occupation"><span class="pink"><?php echo $LineYear; ?></span></h2>
		    
        </div>	
		<div class="tooltip">
		
		 <a href="profile.php?id=<?php echo $_GET['id']; ?>" class="cancelChangesButton" style=\"text-decoration:none; color:inherit; font-size:inherit;\"><i class="far fa-times-circle"></i>
      	   <span class="tooltiptext">Cancel Changes</span></a>
				</div>
		<div class="tooltip">		
     	<button class="saveChangesButton"><i class="far fa-save"></i>
      	   <span class="tooltiptext">Save Changes</span>
		        </button>
				
				 </div>
      </div>
	  
	  
        
		
		
        <!-- MAIN MENU -->     
		
      <!-- LEFT COL -->
      <div id="left_col">
        <div class="profile_frame">
          <div class="profile_picture"></div>
          
        </div>
		
			
        <div class="contact_details_content">
          <h2>Contact</h2>
          <p class="pink">Home:</p>
          <input type="text" class="enterhomeadd" name="Street" <?php if ($Street == null || $Street == "") {echo "placeholder=\"Enter your street number and name\"";} else {echo "value=\"$Street\"";} ?>>
		  <input type="text" class="enterhomeadd "name="City" <?php if ($City == null || $City == "") {echo "placeholder=\"Enter your city\"";} else {echo "value=\"$City\"";} ?>/>
		  <select class="state" id="selectP" name="State">
		  <option value="selectstate">Select Your State</option>
    <option value="AL">AL</option>
	<option value="AK">AK</option>
	<option value="AR">AR</option>	
	<option value="AZ">AZ</option>
	<option value="CA">CA</option>
	<option value="CO">CO</option>
	<option value="CT">CT</option>
	<option value="DC">DC</option>
	<option value="DE">DE</option>
	<option value="FL">FL</option>
	<option value="GA">GA</option>
	<option value="HI">HI</option>
	<option value="IA">IA</option>	
	<option value="ID">ID</option>
	<option value="IL">IL</option>
	<option value="IN">IN</option>
	<option value="KS">KS</option>
	<option value="KY">KY</option>
	<option value="LA">LA</option>
	<option value="MA">MA</option>
	<option value="MD">MD</option>
	<option value="ME">ME</option>
	<option value="MI">MI</option>
	<option value="MN">MN</option>
	<option value="MO">MO</option>	
	<option value="MS">MS</option>
	<option value="MT">MT</option>
	<option value="NC">NC</option>	
	<option value="NE">NE</option>
	<option value="NH">NH</option>
	<option value="NJ">NJ</option>
	<option value="NM">NM</option>			
	<option value="NV">NV</option>
	<option value="NY">NY</option>
	<option value="ND">ND</option>
	<option value="OH">OH</option>
	<option value="OK">OK</option>
	<option value="OR">OR</option>
	<option value="PA">PA</option>
	<option value="RI">RI</option>
	<option value="SC">SC</option>
	<option value="SD">SD</option>
	<option value="TN">TN</option>
	<option value="TX">TX</option>
	<option value="UT">UT</option>
	<option value="VT">VT</option>
	<option value="VA">VA</option>
	<option value="WA">WA</option>
	<option value="WI">WI</option>	
	<option value="WV">WV</option>
	<option value="WY">WY</option>
    </select>
	<input type="text" class="enterhomeadd" name="Zipcode" <?php if ($Zipcode == null || $Zipcode == "") {echo "placeholder=\"Enter your zipcode\"";} else {echo "value=\"$Zipcode\"";} ?>  maxlength="10">
          <p class="pink">Primary Phone:</p>
          <input type="text" class="enterhomephone" name="PhonePrimary" title="e.g (123) 456-7890" pattern="^\([0-9]{3}\)\s[0-9]{3}-[0-9]{4}$" <?php if ($Phone == null || $Phone == "") {echo "placeholder=\"Enter your primary phone number\"";} else {echo "value = \"$Phone\"";} ?> >
          <p class="pink">Secondary Phone:</p>
          <input type="text" class="entercell" name="PhoneSecondary" title="e.g (123) 456-7890" pattern="^\([0-9]{3}\)\s[0-9]{3}-[0-9]{4}$" <?php if ($Cell == null || $Cell == "") {echo "placeholder=\"Enter your secondary phone number\"";} else {echo "value=\"$Cell\"";} ?>>
		  <p class="pink">Mailing Address:</p>
          <input type="text" class="entermailingadd" name="MailingStreet" <?php if ($MailStreet == null || $MailStreet == "") {echo "placeholder=\"Enter street number and name\"";} else {echo "value=\"$MailStreet\"";} ?>>
		  <input type="text" class="entermailingadd" name="MailingCity" <?php if ($MailCity == null || $MailCity == "") {echo "placeholder=\"Enter city\"";} else {echo "value=\"$MailCity\"";} ?>>
		  <select class="state" id="selectM" name="MailingState">
		  <option value="selectstate">Select State</option>
    <option value="AL">AL</option>
	<option value="AK">AK</option>
	<option value="AR">AR</option>	
	<option value="AZ">AZ</option>
	<option value="CA">CA</option>
	<option value="CO">CO</option>
	<option value="CT">CT</option>
	<option value="DC">DC</option>
	<option value="DE">DE</option>
	<option value="FL">FL</option>
	<option value="GA">GA</option>
	<option value="HI">HI</option>
	<option value="IA">IA</option>	
	<option value="ID">ID</option>
	<option value="IL">IL</option>
	<option value="IN">IN</option>
	<option value="KS">KS</option>
	<option value="KY">KY</option>
	<option value="LA">LA</option>
	<option value="MA">MA</option>
	<option value="MD">MD</option>
	<option value="ME">ME</option>
	<option value="MI">MI</option>
	<option value="MN">MN</option>
	<option value="MO">MO</option>	
	<option value="MS">MS</option>
	<option value="MT">MT</option>
	<option value="NC">NC</option>	
	<option value="NE">NE</option>
	<option value="NH">NH</option>
	<option value="NJ">NJ</option>
	<option value="NM">NM</option>			
	<option value="NV">NV</option>
	<option value="NY">NY</option>
	<option value="ND">ND</option>
	<option value="OH">OH</option>
	<option value="OK">OK</option>
	<option value="OR">OR</option>
	<option value="PA">PA</option>
	<option value="RI">RI</option>
	<option value="SC">SC</option>
	<option value="SD">SD</option>
	<option value="TN">TN</option>
	<option value="TX">TX</option>
	<option value="UT">UT</option>
	<option value="VT">VT</option>
	<option value="VA">VA</option>
	<option value="WA">WA</option>
	<option value="WI">WI</option>	
	<option value="WV">WV</option>
	<option value="WY">WY</option>
    </select>
	<input type="text" class="entermailingadd" name="MailingZipcode" <?php if ($MailZipcode == null || $MailZipcode == "") {echo "placeholder=\"Enter zipcode\"";} else {echo "value=\"$MailZipcode\"";} ?> maxlength="10">
          <p class="pink">Email:</p>
          <input type="email" class="enteremail" name="Email" <?php if ($Email == null || $Email == "") {echo "placeholder=\"Enter your email address\"";} else {echo "value=\"$Email\"";} ?>>
          <p class="pink">Website:</p>
          <input type="url" class="enterwebsite" name="Website" <?php if ($Website == null || $Website == "") {echo "placeholder=\"Enter your website\"";} else {echo "value=\"$Website\"";} ?>>
	<p class="pink">Facebook:</p>
        <input type="url" class="enterFacebook" name="Facebook" <?php if ($Facebook == null || $Facebook == "") {echo "placeholder=\"Enter your Facebook URL\"";} else {echo "value=\"$Facebook\"";} ?>>
		<p class="pink">Twitter:</p>
        <input type="url" class="enterTwitter" name="Twitter" <?php if ($Twitter == null || $Twitter == "") {echo "placeholder=\"Enter your Twitter URL\"";} else {echo "value=\"$Twitter\"";} ?>>
		<p class="pink">LinkedIn:</p>
        <input type="url" class="enterLinkedin" name="LinkedIn" <?php if ($Linkedin == null || $Linkedin == "") {echo "placeholder=\"Enter your LinkedIn URL\"";} else {echo "value=\"$Linkedin\"";} ?>>
       <!-- <p class="pink">Instagram:</p>
        <input type="url" class="enterInstagram" name="Instagram" <?php //if ($Instagram == null || $Instagram == "") {echo "placeholder=\"Enter your Instagram URL\"";} else {echo value=\"$Instagram\"";} ?>>-->
		<p class="pink">Google:</p>
        <input type="url" class="enterGoogleplus" name="Google" <?php if ($Google == null || $Google == "") {echo "placeholder=\"Enter your Google Plus URL\"";} else {echo "value=\"$Google\"";} ?>>
		<p class="pink">Youtube:</p>
        <input type="url" class="enterYoutube" name="Youtube" <?php if ($Youtube == null || $Youtube == "") {echo "placeholder=\"Enter your Youtube URL\"";} else {echo "value=\"$Youtube\"";} ?>>	 
		  
		</div>
		
      </div>
	  
	 
		
      <!-- PROFILE CONTENT -->
      <div id="content_container">				
        
         
        <div class="block">
           <div class="contact_details_content">
           <p class="pink">Birthday:</p>
          <input type="date" class="enterbirthday" name="Birthday" <?php if ($DOBedit == null || $DOBedit == ""); else {echo "value=\"".$DOBedit."\"";} ?>>
          <p class="pink">Major:</p>
          <input type="text" class="entermajor" name="Major" <?php if ($Major == null || $Major == "") {echo "placeholder=\"Enter your college major\"";} else {echo "value=\"$Major\"";} ?>>
		  <p class="pink">Degree:</p>
		  
          <!--<input type="text" class="enterdegree" name="Degree" <?php //if ($Degree == null || $Degree == "") {echo "placeholder=\"Enter your college degree\"";} else {echo "value=\"$Degree\"";} ?>>-->
          
          <?php
                echo "<select class=\"state\" name=\"Degree\" style=\"height:40px;\" required>";
                 // <option value="newlinename">Select Line Name</option>  include 'database.php';
              
                $sql="SELECT * FROM DegreeType";
                $query =query($sql);
                while ($row = mysqli_fetch_array($query)) { 
                    if($row['Abbreviation'] == $Degree){
                        echo "<option value='".$row['Id']."' selected=\"selected\">".$row['Name']."</option>"; 
                    }
                    else {echo "<option value='".$row['Id']."'>".$row['Name']."</option>"; }
                }
             
                echo "</select>";
            ?>
          
           <p class="pink">Current Chapter:</p>
          <input type="text" class="enterchapter" name="CurrentChapter" <?php if ($Chapter == null || $Chapter == "") {echo "placeholder=\"Enter your current chapter\"";} else {echo "value=\"$Chapter\"";} ?>>
          <p class="pink">Honey-Do:</p>
          <?php if (!empty($Honey)) {
              foreach ($Honey as $honey) {
                if ($honey == ""){$echo = "placeholder=\"Enter missing Honey-Do's name\"";} 
                else {$echo = "value=\"$honey\"";}
                
                echo "<input type=\"text\" class=\"enterspouse\" name=\"Honey-Do$x\" $echo>";
                }
            }
            echo "<input type=\"text\" class=\"enterspouse\" name=\"insertHoney-Do\" placeholder=\"Add a new Honey-Do's name\"/>";
          ?>
         <p class="pink">Child (Gender):</p>
          <?php if (!empty($Child)) {
              $x = 1;
              foreach ($Child as $child) {
                if ($child == ""){
                    $echo = array("placeholder=\"Missing child$x name\"","placeholder=\"Missing child$x gender\"");
                } 
                else {
                    $echo = array("value=\"".$ChildName[$x-1]."\"", "value=\"".$ChildGender[$x-1]."\"");
                }
                
                echo "<ul style=\"display:contents; list-style:none;\">";
                echo "<li style=\"display:inline-block; width:40%;\" ><input type=\"text\" name=\"ChildName$x\" class=\"enterchild\" ".$echo[0]."></li>";
                echo "<li style=\"display:inline-block; width:40%;\"><input type=\"text\" name=\"ChildGender$x\" class=\"enterchild\" ".$echo[1]."></li>";
                echo "</ul>";
                echo "<ul style=\"display:none;\">";
                echo "<li style=\"display:none;\" ><input type=\"text\" name=\"ChildCName$x\" class=\"enterchild\"".$echo[0]."></li>";
                echo "<li style=\"display:none;\"><input type=\"text\" name=\"ChildCGender$x\" class=\"enterchild\"".$echo[1]."></li>";
                echo "</ul>";
                $x++;
                }
            }
            echo "<ul style=\"display:contents; list-style:none;\">";
            echo "<li style=\"display:inline-block; width:40%;\" ><input type=\"text\" name=\"insertChildName\" class=\"enterchild\" placeholder=\"New child$x name\"></li>";
            echo "<li style=\"display:inline-block; width:40%;\" ><input type=\"text\" name=\"insertChildGender\" class=\"enterchild\" placeholder=\"New child$x gender\"></li>";
            echo "</ul>";
          ?>
        
       
          <h2>Business Contact</h2>
           <p class="pink">Work:</p>
          <input type="text" class="enterwork" name="WorkName" <?php if ($WorkName == null || $WorkName == "") {echo "placeholder=\"Where do you work?\"";} else {echo "value=\"$WorkName\"";} ?>>
          <p class="pink">Title:</p>
          <input type="text" class="enterjobtitle" name="WorkPosition" <?php if ($Title == null || $Title == "") {echo "placeholder=\"What is your job title?\"";} else {echo "value=\"$Title\"";} ?>>
           <p class="pink">Address:</p>
          <input type="text" class="enterworkadd" name="WorkStreet" <?php if ($WorkStreet == null || $WorkStreet == "") {echo "placeholder=\"Enter work street number and name\"";} else {echo "value=\"$WorkStreet\"";} ?>>
		  <input type="text" class="enterworkadd" name="WorkCity" <?php if ($WorkCity == null || $WorkCity == "") {echo "placeholder=\"Enter work city\"";} else {echo "value=\"$WorkCity\"";} ?>>
		  <select class="state" id="selectW" name="WorkState">
		  <option value="selectstate">Select State</option>
    <option value="AL">AL</option>
	<option value="AK">AK</option>
	<option value="AR">AR</option>	
	<option value="AZ">AZ</option>
	<option value="CA">CA</option>
	<option value="CO">CO</option>
	<option value="CT">CT</option>
	<option value="DC">DC</option>
	<option value="DE">DE</option>
	<option value="FL">FL</option>
	<option value="GA">GA</option>
	<option value="HI">HI</option>
	<option value="IA">IA</option>	
	<option value="ID">ID</option>
	<option value="IL">IL</option>
	<option value="IN">IN</option>
	<option value="KS">KS</option>
	<option value="KY">KY</option>
	<option value="LA">LA</option>
	<option value="MA">MA</option>
	<option value="MD">MD</option>
	<option value="ME">ME</option>
	<option value="MI">MI</option>
	<option value="MN">MN</option>
	<option value="MO">MO</option>	
	<option value="MS">MS</option>
	<option value="MT">MT</option>
	<option value="NC">NC</option>	
	<option value="NE">NE</option>
	<option value="NH">NH</option>
	<option value="NJ">NJ</option>
	<option value="NM">NM</option>			
	<option value="NV">NV</option>
	<option value="NY">NY</option>
	<option value="ND">ND</option>
	<option value="OH">OH</option>
	<option value="OK">OK</option>
	<option value="OR">OR</option>
	<option value="PA">PA</option>
	<option value="RI">RI</option>
	<option value="SC">SC</option>
	<option value="SD">SD</option>
	<option value="TN">TN</option>
	<option value="TX">TX</option>
	<option value="UT">UT</option>
	<option value="VT">VT</option>
	<option value="VA">VA</option>
	<option value="WA">WA</option>
	<option value="WI">WI</option>	
	<option value="WV">WV</option>
	<option value="WY">WY</option>
    </select>
	<input type="text" class="enterworkadd" name="WorkZipcode" <?php if ($WorkZipcode == null || $WorkZipcode == "") {echo "placeholder=\"Enter work zipcode\"";} else {echo "value=\"$WorkZipcode\"";} ?> maxlength="10">
          <p class="pink">Phone:</p>
          <input type="text" class="enterworkphone" name="WorkPhone" title="e.g (123) 456-7890" pattern="^\([0-9]{3}\)\s[0-9]{3}-[0-9]{4}$" <?php if ($WorkPhone == null || $WorkPhone == "") {echo "placeholder=\"Enter work phone number\"";} else {echo "value=\"$WorkPhone\"";} ?>>
           <h2>Emergency Contact</h2>
           <p class="pink">Name:</p>
          <input type="text" class="enterERname" name="EmergencyName" <?php if ($EmergName == null || $EmergName == "") {echo "placeholder=\"Enter your emergency contact name\"";} else {echo "value=\"$EmergName\"";} ?>>
          <p class="pink">Relation:</p>
          <input type="text" class="enterERrelation" name="EmergencyRelation" <?php if ($Relation == null || $Relation == "") {echo "placeholder=\"Enter emergency contact relation\"";} else {echo "value=\"$Relation\"";} ?>>
          <p class="pink">Phone:</p>
          <input type="text" class="enterERphone" name="EmergencyPhone" title="e.g (123) 456-7890" pattern="^\([0-9]{3}\)\s[0-9]{3}-[0-9]{4}$" <?php if ($EmergPhone == null || $EmergPhone == "") {echo "placeholder=\"Enter emergency contact phone number\"";} else {echo "value=\"$EmergPhone\"";} ?>>
          <p class="pink">Email:</p>
          <input type="email" class="enterERemail" name="EmergencyEmail" <?php if ($EmergEmail == null || $EmergEmail == "") {echo "placeholder=\"Enter emergency contact email address\"";} else {echo "value=\"$EmergEmail\"";} ?>>
         </div>
        <div class="clear"></div>  
			
        </div>
       
	     
			</form>
    </div>
</div>    
   </div>
     
 
  
<footer>
<div class="footer-copyright">
        <div class="container">
          &copy; Working Group 4 - ITC4850 Spring 2018
        </div>
      </div>
    </footer>
</body>


</html>