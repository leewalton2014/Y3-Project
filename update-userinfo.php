<?php
include 'functions.php';
setSessionPath();
startHTML('Users','Update user info');
makeNav();
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a><br>";
echo "<h1>Users</h1>";
$userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : null;
$getUsersQuery = "SELECT userID, forename, surname, username, role, email, dob, membershipEXP, postcode, addrL2, addrL1
FROM ncl_users INNER JOIN ncl_account_type ON ncl_users.userType = ncl_account_type.accountTypeID
WHERE userID = '$userID'";
$dbConn = getConnection();
$queryResult = $dbConn->query($getUsersQuery);
$user = $queryResult->fetchObject();

echo "<form action='update-userprocess.php' method='POST' enctype='multipart/form-data' id='update_member'>
<div class='col-2-width'>
<label for='forname' class='signup-label'>Forname</label>
<input value='{$user->forename}' type='text' name='forname'/>
<label for='surname' class='signup-label'>Surname</label>
<input value='{$user->surname}' type='text' name='surname'/>
<label for='email' class='signup-label'>Email</label>
<input value='Email' type='text' name='email'/>
<label for='username' class='signup-label'>Username</label>
<input value='Username' type='text' name='username'/>
<label for='password' class='signup-label'>Password</label>
<input value='Password' type='password' name='password'/>
<label for='passwordchk' class='signup-label'>Confirm Password</label>
<input value='Confirm Password' type='password' name='passwordchk'/>
</div>
<div class='col-2-width'>
<label for='dob' class='signup-label'>Date Of Birth</label>
<input type='date' name='dob'/>
<label for='gender' class='signup-label'>Gender</label>
<select id='gender' name='gender'>
<option value='Male'>Male</option>
<option value='Female'>Female</option>
</select>
<input type='hidden' name='userType' value='2'/>
<label for='addr1' class='signup-label'>Address Line 1</label>
<input value='Address Line 1' type='text' name='addr1'/>
<label for='addr2' class='signup-label'>Address Line 2</label>
<input value='Address Line 2' type='text' name='addr2'/>
<label for='postcode' class='signup-label'>Postcode</label>
<input value='Postcode' type='text' name='postcode'/>
</div>
<input class='updateUser' value='Update' type='submit'/>";


echo "<p>$userID</p>";


echo "</div>";
makeFooter();
endHTML();
?>
