<?php
include 'functions.php';
setSessionPath();
startHTML('Timetable','View classes and book classes to attend');
makeNav();
makeTitle('Class Timetable');
echo "<div class='mainBody'>";
if (isset($_REQUEST['weekStart'])){
  $currentDate = isset($_REQUEST['weekStart']) ? $_REQUEST['weekStart'] : null;
}else{
  $currentDate = date("yy/m/d");
}

$weekdays = 7;
echo "<div class='timetable' id='accordion'>";
while ($weekdays > 0){
  //get todays events
  $getEventQuery = "SELECT eventID, className, eventTitle, eventDescription, eventDate, eventTime, eventDuration, description, eventBookingLimit
  FROM ncl_events INNER JOIN ncl_facilities ON ncl_events.facilityID = ncl_facilities.facilityID
  INNER JOIN ncl_classes ON ncl_events.eventTitle = ncl_classes.classID
  WHERE eventDate = '$currentDate'
  ORDER BY eventTime asc";
  $dbConn = getConnection();
  $queryResult = $dbConn->query($getEventQuery);
  if ($queryResult->rowCount() == 0){
    //if no events today display blank col
    echo "<div class='timetable-column'>";
    echo "<div class='timetable-heading'>";
    $dayOfWeek = date("l", strtotime($currentDate));
    echo "<h2>$dayOfWeek</h2>";
    $ukDate = date("d/m/Y", strtotime($currentDate));
    echo "<h3>$ukDate</h3>";
    echo "</div>";
    echo "<div class='timetable-event'>";
    echo "<p>No Events</p>";
    echo "</div>";
    echo "</div>";
  }else{
    echo "<div class='timetable-column'>";
    //column heading
    echo "<div class='timetable-heading'>";
    $dayOfWeek = date("l", strtotime($currentDate));
    echo "<h2>$dayOfWeek</h2>";
    $ukDate = date("d/m/Y", strtotime($currentDate));
    echo "<h3>$ukDate</h3>";
    echo "</div>";
    //display events in col
    while ($rowObj = $queryResult->fetchObject()){
        //attempt to calculate end time
        $startTime = $rowObj->eventTime;
        $duration = $rowObj->eventDuration;
        $endTime = $startTime + $duration;
        //display events
        echo "<div class='timetable-event'>";
        echo "<h3>{$rowObj->className}</h3>";
        echo "<p>{$rowObj->eventDescription}</p>";
        echo "<p><b>Start:</b> {$rowObj->eventTime}</p>";
        echo "<p><b>Duration:</b> {$rowObj->eventDuration}</p>";
        echo "<p>{$rowObj->description}</p>";
        if (isset($_SESSION['user']) && $_SESSION['user']){//Session active
        echo "<a href='booking-process.php?eventID={$rowObj->eventID}'>Book Now</a>";
        }
        echo "</div>";
    }
    echo "</div>";//end column
  }
$weekdays = $weekdays - 1;
$currentDate = date('Y-m-d', strtotime($currentDate. ' + 1 days'));
}
$prevPageStartDate = date('Y-m-d', strtotime($currentDate. ' - 14 days'));
$nextPageStartDate = $currentDate;
echo "</div>";//timetable
echo "<a href='class-timetable.php?weekStart=$prevPageStartDate' class='week-button'>Previous Week</a><br>";
echo "<a href='class-timetable.php?weekStart=$nextPageStartDate' class='week-button'>Next Week</a><br>";

echo "</div>";//main body
makeFooter();
endHTML();
?>
