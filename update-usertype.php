<?php
include 'functions.php';
setSessionPath();
startHTML('Users','Update user info');
makeNav();
makeTitle('Update User Membership');
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a>";
echo "<a href='view-users.php' class='big-button'>Back to Users</a><br>";

$userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : null;

if (isset($_SESSION['user']) && $_SESSION['userType'] >= 3){

$getUsersQuery = "SELECT userID, forename, surname, username, userType, email, dob, membershipEXP, postcode, addrL2, addrL1
FROM ncl_users INNER JOIN ncl_account_type ON ncl_users.userType = ncl_account_type.accountTypeID
WHERE userID = '$userID'";
$getUserTypes = "SELECT accountTypeID, role
FROM ncl_account_type";


$dbConn = getConnection();
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
    if ($_SESSION['userType'] < 4 && $userType->accountTypeID >= 3){
      echo "<option value='{$userType->accountTypeID}' selected='selected' disabled>{$userType->role}</option>";
    }else{
      echo "<option value='{$userType->accountTypeID}' selected='selected'>{$userType->role}</option>";
    }

  }else{
    if ($_SESSION['userType'] < 4 && $userType->accountTypeID >= 3){
      echo "<option value='{$userType->accountTypeID}' disabled>{$userType->role}</option>";
    }else{
      echo "<option value='{$userType->accountTypeID}'>{$userType->role}</option>";
    }
  }
}


echo "</select>
<label for='expdate' class='signup-label'>Membership Expiration</label>
<input type='date' value='{$user->membershipEXP}' name='expdate'/>
<input class='updateUser' value='Update' type='submit'/>
</div>
</form>";


}else{//no access to page
  header('Location: login-form.php');
}

echo "</div>";
makeFooter();
endHTML();
?>
