<?php
include 'functions.php';
setSessionPath();
startHTML('Events','Update event info');
makeNav();
makeTitle('Manage Events');
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a><br>";
if (isset($_SESSION['user']) && $_SESSION['userType'] >= 3){
$currentDate = date("yy/m/d");
$getEventQuery = "SELECT eventID, eventTitle, className, eventDescription, eventDate, eventTime, eventDuration, description, eventBookingLimit
FROM ncl_events INNER JOIN ncl_facilities ON ncl_events.facilityID = ncl_facilities.facilityID
INNER JOIN ncl_classes ON ncl_events.eventTitle = ncl_classes.classID
WHERE eventDate >= '$currentDate'
ORDER BY eventDate, eventTime ASC";
$dbConn = getConnection();
$queryResult = $dbConn->query($getEventQuery);

echo "<table id='table-basic'>
<tr>
<th>Date</th>
<th>Time</th>
<th>Event</th>
<th>Duration</th>
<th>Location</th>
<th>Edit</th>
<th>Cancel</th>
</tr>";
  while ($rowObj = $queryResult->fetchObject()){
    $ukDate = date("d/m/Y", strtotime($rowObj->eventDate));
    echo "<tr>";
    echo "<td>$ukDate</td>";
    echo "<td>{$rowObj->eventTime}</td>";
    echo "<td><a href='view-classlist.php?eventID={$rowObj->eventID}'>{$rowObj->className}</a></td>";
    echo "<td>{$rowObj->eventDuration}</td>";
    echo "<td>{$rowObj->description}</td>";
    echo "<td><a href='updateevent-form.php?eventID={$rowObj->eventID}'>Edit</a></td>";
    echo "<td><a href='cancel-event.php?eventID={$rowObj->eventID}'>Cancel</a></td>";
    echo "</tr>";
  }
echo "</table>";
echo "<a href='newevent-form.php' class='big-button'>New Event</a>";

}else{
  header('Location: login-form.php');
  exit;
}
echo "</div>";
makeFooter();
endHTML();
?>
