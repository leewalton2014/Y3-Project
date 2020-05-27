<?php
include 'functions.php';
setSessionPath();
startHTML('Newcastle Sport','Booking System');
makeNav();
makeTitle('Update User Membership');
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a>";
echo "<a href='view-users.php' class='big-button'>Back to Users</a><br>";

//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$userID = sanitise_input('userID');
$acctype = sanitise_input('acctype');
$expdate = sanitise_input('expdate');
$dbConn = getConnection();

if (isset($_SESSION['user']) && $_SESSION['userType'] >= 3){

$errors = array();
//check required values
if(empty($acctype)||empty($userID)){
  array_push($errors,"ERROR: Please select an account type.");
}
//prevents null membership date when member role is being granted
if($acctype == 2 && empty($expdate)){
  array_push($errors,"ERROR: Please enter a membership experation date.");
}
//date checks
if (!empty($expdate)){
  list($y, $m, $d) = explode("-", $expdate);
  if(!checkdate($m, $d, $y)){
    array_push($errors,"ERROR: Please enter a valid date.");
  }

  $today = date("Y-m-d");
  if ($expdate <= $today){
    array_push($errors,"ERROR: Membership expiration date must be in the future.");
  }
}
//prevents non staff users upgrading account types
if ($_SESSION['userType'] < 3){
  array_push($errors,"ERROR: You do not have permissions to make these changes.");
}
//prevents staff from updating user roles to staff or admin (only admins have permission)
if ($_SESSION['userType'] < 4 && $acctype > 2){
  array_push($errors,"ERROR: You do not have permissions to make these changes.");
}


if (empty($errors)){
  //INSERT QUERY
  $updateQuery = "UPDATE ncl_users SET
  userType = :userType,
  membershipEXP = :membershipEXP
  WHERE userID = :userID";

  $queryResult = $dbConn->prepare($updateQuery);
  $queryResult->execute(array(':userType' => $acctype,
  ':membershipEXP' => $expdate,
  ':userID' => $userID
  ));

        if ($queryResult === false) {
          echo "<p>Please try again! <a href='update-usertype.php'>Try again.</a></p>\n";
          exit;
        }else{
          header("Location: view-users.php");
          die();
        }
}else{
  echo "<div class='errors-pane'>";
  echo "<h2>Please correct the following errors</h2>";
  foreach ($errors as $error){
    echo "<p>$error</p>";
  }

  //display form
  $getUsersQuery = "SELECT userID, forename, surname, username, userType, email, dob, membershipEXP, postcode, addrL2, addrL1
  FROM ncl_users INNER JOIN ncl_account_type ON ncl_users.userType = ncl_account_type.accountTypeID
  WHERE userID = '$userID'";
  $getUserTypes = "SELECT accountTypeID, role
  FROM ncl_account_type";

  $queryResult = $dbConn->query($getUsersQuery);
  $userTypes = $dbConn->query($getUserTypes);
  $user = $queryResult->fetchObject();
  echo "<h2>{$user->username}</h2>";
  echo "<form action='updateroles-process.php' method='POST' enctype='multipart/form-data' id='update_member'>
  <div class='col-2-width'>
  <input type='hidden' name='userID' value='{$user->userID}'/>
  <label for='acctype' class='signup-label'>Account Type</label>
  <select id='acctype' name='acctype'>";
  while ($userType = $userTypes->fetchObject()){
    if ($user->userType == $userType->accountTypeID){
      echo "<option value='{$userType->accountTypeID}' selected='selected'>{$userType->role}</option>";
    }else{
      echo "<option value='{$userType->accountTypeID}'>{$userType->role}</option>";
    }
  }


  echo "</select>
  <label for='expdate' class='signup-label'>Membership Expiration</label>
  <input type='date' value='{$user->membershipEXP}' name='expdate'/>
  <input class='updateUser' value='Update' type='submit'/>
  </div>
  </form>";
}


}else{
  header('Location: login-form.php');
  exit;
}
echo "</div>";
makeFooter();
endHTML();
?>
