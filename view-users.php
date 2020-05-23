<?php
include 'functions.php';
setSessionPath();
startHTML('Users','Update user info');
makeNav();
makeTitle('Users');
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a><br>";
$getUsersQuery = "SELECT userID, forename, surname, username, role
FROM ncl_users INNER JOIN ncl_account_type ON ncl_users.userType = ncl_account_type.accountTypeID
ORDER BY surname asc";
$dbConn = getConnection();
$queryResult = $dbConn->query($getUsersQuery);

echo "<table id='table-basic'>
<tr>
<th>Forename</th>
<th>Surname</th>
<th>Username</th>
<th>User Type</th>
<th>Update Membership</th>
<th>Update Record</th>
</tr>";

while ($rowObj = $queryResult->fetchObject()){
    echo "<tr>";
    echo "<td>{$rowObj->forename}</td>";
    echo "<td>{$rowObj->surname}</td>";
    echo "<td>{$rowObj->username}</td>";
    echo "<td>{$rowObj->role}</td>";
    echo "<td><a href='update-usertype.php?userID={$rowObj->userID}'>Update Membership</a></td>";
    echo "<td><a href='update-userinfo.php?userID={$rowObj->userID}'>Update Info</a></td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";
makeFooter();
endHTML();
?>
