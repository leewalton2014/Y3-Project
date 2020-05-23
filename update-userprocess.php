<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
makeTitle('Update User Info');
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a>";
$usertype = $_SESSION['userType'];
if ($usertype >= 3){
echo "<a href='view-users.php' class='big-button'>Back to Users</a>";
}
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$userID = sanitise_input('userID');
$forename = sanitise_input('forename');
$surname = sanitise_input('surname');
$email = sanitise_input('email');
$username = sanitise_input('username');
$dob = sanitise_input('dob');
$gender = sanitise_input('gender');
$addr1 = sanitise_input('addr1');
$addr2 = sanitise_input('addr2');
$postcode = sanitise_input('postcode');
$dbConn = getConnection();

//error checking
$errors = array();
if (empty($forename)||empty($surname)||empty($username)||empty($email)||empty($userID)||empty($dob)||
empty($gender)||empty($addr1)||empty($addr2)||empty($postcode)){
  array_push($errors,"ERROR: Please ensure all fields are populated.");
}

$checkusername = "SELECT username FROM ncl_users WHERE username = '$username'";
$checkResult = $dbConn->query($checkusername);

if ($checkResult->rowCount() !== 0){
  //check username of userID
  $getUsername = "SELECT username FROM ncl_users WHERE userID = '$userID'";
  $usernameObj = $dbConn->query($getUsername);
  $dbusername = $usernameObj->fetchObject();
  if ($dbusername->username !== $username){
    array_push($errors,"ERROR: Username allready in use please try again.");
  }
}

$genders = array("Male", "Female", "Other");
if (!in_array($gender, $genders)){
  array_push($errors,"ERROR: Please select a gender from the list.");
}


if (empty($errors)){
  //Update db reccord
  //UPDATE QUERY
  $updateQuery = "UPDATE ncl_users SET
  username = '$username',
  forename = '$forename',
  surname = '$surname',
  dob = '$dob',
  email = '$email',
  gender = '$gender',
  addrL1 = '$addr1',
  addrL2 = '$addr2',
  postcode = '$postcode'
  WHERE userID = '$userID'";

  $queryResult = $dbConn->query($updateQuery);
        if ($queryResult === false) {
          echo "<p>Please try again! <a href='updateevent-form.php'>Try again.</a></p>\n";
          exit;
        }else{
          header("Location: dashboard.php");
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
  $getUsersQuery = "SELECT userID, forename, surname, username, role, email, gender, dob, membershipEXP, postcode, addrL2, addrL1
  FROM ncl_users INNER JOIN ncl_account_type ON ncl_users.userType = ncl_account_type.accountTypeID
  WHERE userID = '$userID'";
  $userInfo = $dbConn->query($getUsersQuery);
  $user = $userInfo->fetchObject();
  echo "<form action='update-userprocess.php' method='POST' enctype='multipart/form-data' id='update_member'>
  <div class='col-2-width'>
  <input type='hidden' name='userID' value='{$user->userID}'/>
  <label for='forname' class='signup-label'>Forname</label>
  <input value='{$user->forename}' type='text' name='forename'/>
  <label for='surname' class='signup-label'>Surname</label>
  <input value='{$user->surname}' type='text' name='surname'/>
  <label for='email' class='signup-label'>Email</label>
  <input value='{$user->email}' type='text' name='email'/>
  <label for='username' class='signup-label'>Username</label>
  <input value='{$user->username}' type='text' name='username'/>
  <label for='dob' class='signup-label'>Date Of Birth</label>
  <input type='date' value='{$user->dob}' name='dob'/>
  </div>
  <div class='col-2-width'>
  <label for='gender' class='signup-label'>Gender</label>
  <select id='gender' name='gender'>
  <option value='{$user->gender}' selected='selected'>{$user->gender}</option>
  <option value='Male'>Male</option>
  <option value='Female'>Female</option>
  <option value='Other'>Other</option>
  </select>
  <label for='addr1' class='signup-label'>Address Line 1</label>
  <input value='{$user->addrL1}' type='text' name='addr1'/>
  <label for='addr2' class='signup-label'>Address Line 2</label>
  <input value='{$user->addrL2}' type='text' name='addr2'/>
  <label for='postcode' class='signup-label'>Postcode</label>
  <input value='{$user->postcode}' type='text' name='postcode'/>
  </div>
  <input class='updateUser' value='Update' type='submit'/>
  </form>";
}




echo "</div>";
makeFooter();
endHTML();
?>
