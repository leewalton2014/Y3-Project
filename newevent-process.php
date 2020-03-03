<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$title = sanitise_input('title');
$description = sanitise_input('description');
$date = sanitise_input('date');
$time = sanitise_input('time');
$duration = sanitise_input('duration');
$facility = sanitise_input('facility');
$limit = sanitise_input('limit');

//INSERT QUERY
$event_query = "INSERT INTO ncl_events (eventTitle, eventDescription, eventDate, eventTime, eventDuration, facilityID, eventBookingLimit)
VALUES ('$title','$description','$date','$time','$duration', '$facility', '$limit')";

$dbConn = getConnection();
$queryResult = $dbConn->query($event_query);
      if ($queryResult === false) {
        echo "<p>Please try again! <a href='newevent-form.php'>Try again.</a></p>\n";
        exit;
      }else{
        header("Location: class-timetable.php");
        die();
      }
makeFooter();
endHTML();
?>
