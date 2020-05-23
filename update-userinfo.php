<?php
include 'functions.php';
setSessionPath();
startHTML('Users','Update user info');
makeNav();
makeTitle('Update User Info');
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a>";
$usertype = $_SESSION['userType'];
if ($usertype >= 3){
echo "<a href='view-users.php' class='big-button'>Back to Users</a>";
}
$userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : null;
$getUsersQuery = "SELECT userID, forename, surname, username, role, email, gender, dob, membershipEXP, postcode, addrL2, addrL1
FROM ncl_users INNER JOIN ncl_account_type ON ncl_users.userType = ncl_account_type.accountTypeID
WHERE userID = '$userID'";
$dbConn = getConnection();
$queryResult = $dbConn->query($getUsersQuery);
$user = $queryResult->fetchObject();

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


echo "</div>";
makeFooter();
endHTML();
?>
