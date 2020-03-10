<?php
include 'functions.php';
setSessionPath();
startHTML('Timetable','View classes and book classes to attend');
makeNav();
echo "<div class='mainBody'>";
echo "<h1>Class Timetable</h1>";
$currentDate = date("d/m/y");
$weekdays = 7;
$getEventQuery = "SELECT eventID, eventTitle, eventDescription, eventDate, eventTime, eventDuration, description, eventBookingLimit
FROM ncl_events INNER JOIN ncl_facilities ON ncl_events.facilityID = ncl_facilities.facilityID
WHERE eventDate >= '$currentDate'
GROUP BY eventDate ORDER BY eventDate, eventTime asc";
$dbConn = getConnection();
$queryResult = $dbConn->query($getEventQuery);

/*echo "<table id='eventsTable'>
<tr>
<th>Event</th>
<th>Date</th>
<th>Time</th>
<th>End Time</th>
<th>Duration</th>
<th>Location</th>
</tr>";*/


while ($rowObj = $queryResult->fetchObject()){
  echo "<div class='timetable-column'>";
  while ($weekdays > 0){
    $weekdays = $weekdays - 1;
    $startTime = $rowObj->eventTime;
    $duration = $rowObj->eventDuration;
    $endTime = $startTime + $duration;
    $date = date_create("{$rowObj->eventDate}");
    $date = date_format($date, "d/m/y");
    //Day in words
    //$day = date('', $date);
    //echo "<div class='timetable-heading'>";
    //echo "<h2>'$currentDate'</h2>";
    //echo "</div>";
    if ($currentDate == $date){
    echo "<div class='timetable-event'>";
    echo "<h3>{$rowObj->eventTitle}</h3>";
    echo "<p>$date</p>";
    echo "<p>{$rowObj->eventTime}</p>";
    echo "<p>$endTime</p>";
    echo "<p>{$rowObj->eventDuration}</p>";
    echo "<p>{$rowObj->description}</p>";
    echo "</div>";
  }else {
    echo "";
    echo "";
  }
  }
}





echo "</table>";
echo "</div>";
makeFooter();
endHTML();
?>
