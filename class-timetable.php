<?php
include 'functions.php';
setSessionPath();
startHTML('Timetable','View classes and book classes to attend');
makeNav();
echo "<div class='mainBody'>";
echo "<h1>Class Timetable</h1>";
$currentDate = date("yy/m/d");
$weekdays = 7;
echo "<div class='timetable'>";
while ($weekdays > 0){
  //get todays events
  $getEventQuery = "SELECT eventID, eventTitle, eventDescription, eventDate, eventTime, eventDuration, description, eventBookingLimit
  FROM ncl_events INNER JOIN ncl_facilities ON ncl_events.facilityID = ncl_facilities.facilityID
  WHERE eventDate = '$currentDate'
  ORDER BY eventTime asc";
  $dbConn = getConnection();
  $queryResult = $dbConn->query($getEventQuery);
  if ($queryResult == NULL){
    //if no events today display blank col
    echo "<div class='timetable-column'>";
    echo "<div class='timetable-heading'>";
    echo "<h2>$currentDate</h2>";
    echo "</div>";
    echo "</div>";
  }else{
    echo "<div class='timetable-column'>";
    //column heading
    echo "<div class='timetable-heading'>";
    echo "<h2>$currentDate</h2>";
    echo "</div>";
    //display events in col
    while ($rowObj = $queryResult->fetchObject()){
        //attempt to calculate end time
        $startTime = $rowObj->eventTime;
        $duration = $rowObj->eventDuration;
        $endTime = $startTime + $duration;

        //display events
        echo "<div class='timetable-event'>";
        echo "<h3>{$rowObj->eventTitle}</h3>";
        echo "<p>{$rowObj->eventDescription}</p>";
        echo "<p>{$rowObj->eventTime}</p>";
        echo "<p>{$rowObj->eventDuration}</p>";
        echo "<p>{$rowObj->description}</p>";
        echo "</div>";
    }
    echo "</div>";//end column
  }
$weekdays = $weekdays - 1;
$currentDate = date('Y-m-d', strtotime($currentDate. ' + 1 days'));
}

$nextPageStartDate = $currentDate;
echo "</div>";//timetable
echo "<a href='class-timetable.php?weekStart=$nextPageStartDate' class='week-button'>Next Week</a><br>";

echo "</div>";//main body
makeFooter();
endHTML();
?>
