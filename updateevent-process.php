<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$eventID = sanitise_input('eventid');
$title = sanitise_input('title');
$description = sanitise_input('description');
$date = sanitise_input('date');
$time = sanitise_input('time');
$duration = sanitise_input('duration');
$facility = sanitise_input('facility');
$limit = sanitise_input('limit');

//INSERT QUERY
$event_query = "UPDATE ncl_events SET
eventTitle = '$title',
eventDescription = '$description',
eventDate = '$date',
eventTime = '$time',
eventDuration = '$duration',
facilityID = '$facility',
eventBookingLimit = '$limit'
WHERE eventID = '$eventID'";

$dbConn = getConnection();
$queryResult = $dbConn->query($event_query);
      if ($queryResult === false) {
        echo "<p>Please try again! <a href='updateevent-form.php'>Try again.</a></p>\n";
        exit;
      }else{
        header("Location: class-timetable.php");
        die();
      }
makeFooter();
endHTML();
?>
