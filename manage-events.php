<?php
include 'functions.php';
setSessionPath();
startHTML('Events','Update event info');
makeNav();
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a><br>";
echo "<h1>Manage Events</h1>";
$currentDate = date("yy/m/d");
$getEventQuery = "SELECT eventID, eventTitle, eventDescription, eventDate, eventTime, eventDuration, description, eventBookingLimit
FROM ncl_events INNER JOIN ncl_facilities ON ncl_events.facilityID = ncl_facilities.facilityID
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
</tr>";
  while ($rowObj = $queryResult->fetchObject()){
    echo "<tr>";
    echo "<td>{$rowObj->eventDate}</td>";
    echo "<td>{$rowObj->eventTime}</td>";
    echo "<td>{$rowObj->eventTitle}</td>";
    echo "<td>{$rowObj->eventDuration}</td>";
    echo "<td><a href='updateevent-form.php?eventID={$rowObj->eventID}'>Edit</a></td>";
    echo "</tr>";
  }
echo "</table>";
echo "<a href='newevent-form.php' class='big-button'>New Event</a>";
echo "</div>";
makeFooter();
endHTML();
?>
