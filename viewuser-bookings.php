<?php
include 'functions.php';
setSessionPath();
startHTML('Bookings','Users bookings');
makeNav();
makeTitle('Bookings');
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a><br>";
$today = date("Y-m-d");
$userID = $_SESSION['userID'];
$getBookingsQuery = "SELECT bookingID, eventDate, eventTime, eventTitle, className, eventDescription, eventDuration
FROM ncl_bookings INNER JOIN ncl_events ON ncl_bookings.eventID = ncl_events.eventID
INNER JOIN ncl_classes ON ncl_events.eventTitle = ncl_classes.classID
WHERE userID = '$userID' AND eventDate >= '$today'
ORDER BY eventDate, eventTime asc";
$dbConn = getConnection();
$queryResult = $dbConn->query($getBookingsQuery);

echo "<table id='table-basic'>
<tr>
<th>Date</th>
<th>Time</th>
<th>Event</th>
<th>Description</th>
<th>Duration</th>
<th>Cancel</th>
</tr>";

while ($rowObj = $queryResult->fetchObject()){
    echo "<tr>";
    echo "<td>{$rowObj->eventDate}</td>";
    echo "<td>{$rowObj->eventTime}</td>";
    echo "<td>{$rowObj->className}</td>";
    echo "<td>{$rowObj->eventDescription}</td>";
    echo "<td>{$rowObj->eventDuration}</td>";
    echo "<td><a href='cancel-booking.php?bookingID={$rowObj->bookingID}'>Cancel</a></td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";
makeFooter();
endHTML();
?>
