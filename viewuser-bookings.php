<?php
include 'functions.php';
setSessionPath();
startHTML('Bookings','Users bookings');
makeNav();
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a><br>";
echo "<h1>Your Bookings</h1>";
$userID = $_SESSION['userID'];
$getUsersQuery = "SELECT eventDate, eventTime, eventTitle, eventDescription, eventDuration
FROM ncl_bookings INNER JOIN ncl_events ON ncl_bookings.eventID = ncl_events.eventID
WHERE userID = '$userID'
ORDER BY eventDate, eventTime asc";
$dbConn = getConnection();
$queryResult = $dbConn->query($getUsersQuery);

echo "<table id='table-basic'>
<tr>
<th>Date</th>
<th>Time</th>
<th>Event</th>
<th>Description</th>
<th>Duration</th>
</tr>";

while ($rowObj = $queryResult->fetchObject()){
    echo "<tr>";
    echo "<td>{$rowObj->eventDate}</td>";
    echo "<td>{$rowObj->eventTime}</td>";
    echo "<td>{$rowObj->eventTitle}</td>";
    echo "<td>{$rowObj->eventDescription}</td>";
    echo "<td>{$rowObj->eventDuration}</td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";
makeFooter();
endHTML();
?>
