<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
makeTitle('Signup Form');
echo "<div class='mainBody'>";
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$forename = sanitise_input('forname');
$surname = sanitise_input('surname');
$username = sanitise_input('username');
$email = sanitise_input('email');
$password = sanitise_input('password');
$passwordCheck = sanitise_input('passwordchk');
$dob = sanitise_input('dob');
$gender = sanitise_input('gender');
$userType = 1;
$addr1 = sanitise_input('addr1');
$addr2 = sanitise_input('addr2');
$postcode = sanitise_input('postcode');
$dbConn = getConnection();

//error checking
$errors = array();
if (empty($forename)||empty($surname)||empty($username)||empty($email)||empty($password)||empty($passwordCheck)||empty($dob)||
empty($gender)||empty($addr1)||empty($addr2)||empty($postcode)){
  array_push($errors,"ERROR: Please ensure all fields are populated.");
}
if ($password != $passwordCheck){
  array_push($errors,"ERROR: Please ensure passwords match.");
}

$checkusername = "SELECT username FROM ncl_users WHERE username = '$username'";
$checkResult = $dbConn->query($checkusername);

if ($checkResult->rowCount() !== 0){
  array_push($errors,"ERROR: Username allready in use please try again.");
}

$genders = array("Male", "Female", "Other");
if (!in_array($gender, $genders)){
  array_push($errors,"ERROR: Please select a gender from the list.");
}


if (empty($errors)){
  //HASH PASSWORD
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);
  //INSERT QUERY
  $signup_query = "INSERT INTO ncl_users (forename, surname, username, email, passwordHash, dob, gender, userType, addrL1, addrL2, postcode)
  VALUES ('$forename','$surname','$username','$email','$passwordHash', '$dob', '$gender', '$userType', '$addr1', '$addr2', '$postcode')";
  $queryResult = $dbConn->query($signup_query);
        if ($queryResult === false) {
          echo "<p>Please try again! <a href='signup-form.php'>Try again.</a></p>\n";
          exit;
        }else{
          header("Location: login-form.php");
          die();
        }
}else{
  //display $errors
  echo "<div class='errors-pane'>";
  echo "<h2>Please correct the following errors</h2>";
  foreach ($errors as $error){
    echo "<p>$error</p>";
  }
  echo "</div>";
  //Autofill form
  echo "<form action='signup-process.php' method='POST' enctype='multipart/form-data' id='signup-form'>
      <div class='col-2-width'>
      <label for='forname' class='signup-label'>Forname</label>
      <input placeholder='Forname' type='text' name='forname' value='$forename'/>
      <label for='surname' class='signup-label'>Surname</label>
      <input placeholder='Surname' type='text' name='surname' value='$surname'/>
      <label for='email' class='signup-label'>Email</label>
      <input placeholder='Email' type='text' name='email' value='$email'/>
      <label for='username' class='signup-label'>Username</label>
      <input placeholder='Username' type='text' name='username' value='$username'/>
      <label for='password' class='signup-label'>Password</label>
      <input placeholder='Password' type='password' name='password'/>
      <label for='passwordchk' class='signup-label'>Confirm Password</label>
      <input placeholder='Confirm Password' type='password' name='passwordchk'/>
      </div>
      <div class='col-2-width'>
      <label for='dob' class='signup-label'>Date Of Birth</label>
      <input type='date' name='dob' value='$dob'/>
      <label for='gender' class='signup-label'>Gender</label>
      <select id='gender' name='gender'>";
      if (!empty($gender)){
        echo "<option value='$gender' selected='selected'>$gender</option>";
      }
      echo "<option value='Male'>Male</option>
      <option value='Female'>Female</option>
      <option value='Other'>Other</option>
      </select>
      <label for='addr1' class='signup-label'>Address Line 1</label>
      <input placeholder='Address Line 1' type='text' name='addr1' value='$addr1'/>
      <label for='addr2' class='signup-label'>Address Line 2</label>
      <input placeholder='Address Line 2' type='text' name='addr2' value='$addr2'/>
      <label for='postcode' class='signup-label'>Postcode</label>
      <input placeholder='Postcode' type='text' name='postcode' value='$postcode'/>
      </div>
      <br>
      <input class='logInSubmit' type='submit'/><br>
      </form>";

}


echo "</div>";
makeFooter();
endHTML();
?>
