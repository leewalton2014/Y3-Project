<?php
/**
*gets booking analytics data from database for use in chart.js
*
*https://phppot.com/php/creating-dynamic-data-graph-using-php-and-chart-js/
*used as reference for setup of chart.js
*/
header('Content-Type: application/json');
include 'functions.php';
$dbConn = getConnection();

$query = "SELECT COUNT(bookingID) AS count, className
FROM ncl_bookings INNER JOIN ncl_events ON  ncl_bookings.eventID = ncl_events.eventID
INNER JOIN ncl_classes ON ncl_events.eventTitle = ncl_classes.classID
GROUP BY className";
$queryResult = $dbConn->query($query);

$data = array();
foreach ($queryResult as $row){
  $data[] = $row;
}

echo json_encode($data);
?>
