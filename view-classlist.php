<?php
include 'functions.php';
setSessionPath();
startHTML('Newcastle Sport','Booking System');
makeNav();
makeTitle('Manage Events');
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a>";
echo "<a href='manage-events.php' class='big-button'>Back to Events</a><br>";

if (isset($_SESSION['user']) && $_SESSION['userType'] >= 3){

$eventID = isset($_REQUEST['eventID']) ? $_REQUEST['eventID'] : null;
$getUsersQuery = "SELECT forename, surname
FROM ncl_bookings INNER JOIN ncl_users ON ncl_bookings.userID = ncl_users.userID
INNER JOIN ncl_events ON ncl_bookings.eventID = ncl_events.eventID
WHERE ncl_events.eventID = '$eventID'";
$dbConn = getConnection();
$queryResult = $dbConn->query($getUsersQuery);

echo "<table id='table-basic'>
<tr>
<th>Forename</th>
<th>Surname</th>
</tr>";
  while ($rowObj = $queryResult->fetchObject()){
    echo "<tr>";
    echo "<td>{$rowObj->forename}</td>";
    echo "<td>{$rowObj->surname}</td>";
    echo "</tr>";
  }
echo "</table>";

}else{
  header('Location: login-form.php');
  exit;
}
echo "</div>";
makeFooter();
endHTML();
?>
