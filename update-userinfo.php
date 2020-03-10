<?php
include 'functions.php';
setSessionPath();
startHTML('Users','Update user info');
makeNav();
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a><br>";
echo "<h1>Users</h1>";
$userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : null;
$getUsersQuery = "SELECT userID, forename, surname, username, role, emailm dob, membershipEXP, postcode, addrL2, addrL1
FROM ncl_users INNER JOIN ncl_account_type ON ncl_users.userType = ncl_account_type.accountTypeID
WHERE userID = '$userID'";
$dbConn = getConnection();
$queryResult = $dbConn->query($getUsersQuery);
/*
<form action='update-member.php' method='POST' enctype='multipart/form-data' id='update_member'>
  <div class='col-1-width'>
  <label for='title' class='event-label'>Title</label>
  <input placeholder='Title' type='text' name='title'/>
  <label for='description' class='event-label'>Description</label>
  <input placeholder='Description' type='text' name='description'/>
  <label for='date' class='event-label'>Membership Ends</label>
  <input type='date' name='date'/>
  <input class='addEventSubmit' type='submit'/>


*/

echo "<p>$userID</p>";


echo "</div>";
makeFooter();
endHTML();
?>
