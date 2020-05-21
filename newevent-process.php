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
//proposed end time
$diff = strtotime($duration)-strtotime("00:01:00");
$endTime = date("H:i:s",strtotime($time)+$diff);

//database
$dbConn = getConnection();
//INSERT QUERY
$event_query = "INSERT INTO ncl_events (eventTitle, eventDescription, eventDate, eventTime, eventDuration, facilityID, eventBookingLimit)
VALUES ('$title','$description','$date','$time','$duration', '$facility', '$limit')";


//Find events on day for proposed location to check no clash
$getSimilarEvents = "SELECT eventID, eventDate, eventTime, eventDuration
FROM ncl_events
WHERE eventDate = '$date' AND facilityID = '$facility'";
//do checks for events on same date and location
//check for time range
$clash = false;
$similarEvents = $dbConn->query($getSimilarEvents);
//for each similar event
while ($event = $similarEvents->fetchObject()){
//get time and duration
$eventStartTime = $event->eventTime;
$eventDuration = $event->eventDuration;
//calculate end time
$secs = strtotime($eventDuration)-strtotime("00:01:00");
$eventEndTime = date("H:i:s",strtotime($eventStartTime)+$secs);
//check $time (the proposed time of new event)
//is not within the start and end time of a current event
if($time>=$eventStartTime&&$time<=$eventEndTime){
  $clash = true;
}
//check $endTime (the proposed end time of new event)
//is not within the start and end time of a current event
if($endTime>=$eventStartTime&&$endTime<=$eventEndTime){
  $clash = true;
}
//end of checks
}


if ($clash == false){
  $queryResult = $dbConn->query($event_query);
        if ($queryResult === false) {
          echo "<p>Please try again! <a href='newevent-form.php'>Try again.</a></p>\n";
          exit;
        }else{
          header("Location: class-timetable.php");
          die();
        }
}else{
  echo "<p>Plase try again event allready sceduled in this time frame in the chosen location on this date.</p>";
}

makeFooter();
endHTML();
?>
