<?php
include 'functions.php';
setSessionPath();
startHTML('Timetable','View classes and book classes to attend');
makeNav();
echo "<div class='mainBody'>";
echo "<h1>Class Timetable</h1>";
$currentDate = date("Y/m/d");
$weekdays = 7;
$getEventQuery = "SELECT eventID, eventTitle, eventDescription, eventDate, eventTime, eventDuration, description, eventBookingLimit
FROM ncl_events INNER JOIN ncl_facilities ON ncl_events.facilityID = ncl_facilities.facilityID
WHERE eventDate >= '$currentDate'
GROUP BY eventDate ORDER BY eventTime";
$dbConn = getConnection();
$queryResult = $dbConn->query($getEventQuery);

echo "<table id='eventsTable'>
<tr>
<th>Event</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Location</th>
</tr>";
//while ($weekdays >= 7){
$weekdays = $weekdays + 1;
  while ($rowObj = $queryResult->fetchObject()){

    echo "<tr>";
    echo "<td>{$rowObj->eventTitle}</td>";
    echo "<td>{$rowObj->eventDate}</td>";
    echo "<td>{$rowObj->eventTime}</td>";
    echo "<td>{$rowObj->eventDuration}</td>";
    echo "<td>{$rowObj->description}</td>";
    echo "</tr>";
  }
//}





echo "</table>";
echo "</div>";
makeFooter();
endHTML();
?>
