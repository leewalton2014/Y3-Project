<?php
/**
*gets facility analytics data from database for use in chart.js
*
*https://phppot.com/php/creating-dynamic-data-graph-using-php-and-chart-js/
*used as reference for setup of chart.js
*/
header('Content-Type: application/json');
include 'functions.php';
$dbConn = getConnection();

$query = "SELECT COUNT(eventID) AS count, description
FROM ncl_events INNER JOIN ncl_classes ON ncl_events.eventTitle = ncl_classes.classID
INNER JOIN ncl_facilities ON ncl_events.facilityID = ncl_facilities.facilityID
GROUP BY ncl_facilities.facilityID";
$queryResult = $dbConn->query($query);

$data = array();
foreach ($queryResult as $row){
  $data[] = $row;
}

echo json_encode($data);
?>
