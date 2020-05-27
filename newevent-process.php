<?php
include 'functions.php';
setSessionPath();
startHTML('Newcastle Sport','Booking System');
makeNav();
makeTitle('New Event Info');
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a><br>";
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
$dbConn = getConnection();

if (isset($_SESSION['user']) && $_SESSION['userType'] >= 3){

$errors = array();

if(empty($title)||empty($description)||empty($date)||empty($time)||empty($duration)||empty($facility)||empty($limit)){
  array_push($errors,"ERROR: Please complete all fields.");
}
if(strlen($description) >= 500){
  array_push($errors,"ERROR: Description must be less than 500 characters.");
}
if (!empty($date)){
  list($y, $m, $d) = explode("-", $date);
  if(!checkdate($m, $d, $y)){
    array_push($errors,"ERROR: Please enter a valid date.");
  }
  $today = date("Y-m-d");
  if ($date < $today){
    array_push($errors,"ERROR: Date must be in the future.");
  }elseif (!empty($time)&&$date==$today){
    $currentTime = date("H:i");
    if ($time<$currentTime){
      array_push($errors,"ERROR: Select a later time.");
    }
  }
}
if ($duration >= '12:00'){
  array_push($errors,"ERROR: Check event duration.");
}

//check for clashes if input is free of errors so far
if (empty($errors)){
  //Find events on day for proposed location to check no clash
  $getSimilarEvents = "SELECT eventID, eventDate, eventTime, eventDuration
  FROM ncl_events
  WHERE eventDate = '$date' AND facilityID = '$facility'";
  //do checks for events on same date and location
  //check for time range
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
    array_push($errors,"ERROR: Event allready sceduled in this location at this time.");
  }
  //check $endTime (the proposed end time of new event)
  //is not within the start and end time of a current event
  if($endTime>=$eventStartTime&&$endTime<=$eventEndTime){
    array_push($errors,"ERROR: Event allready sceduled in this location at this time.");
  }
  //end of clash check
  }
  //check booking limit does not exceed max for location
  $getLocationCap = "SELECT capacity
  FROM ncl_facilities
  WHERE facilityID = '$facility'";
  $locationCap = $dbConn->query($getLocationCap);
  $cap = $locationCap->fetchObject();
  if ($locationCap->rowCount() == 0){
    array_push($errors,"ERROR: Select a valid facility.");
  }
  if ($limit > $cap->capacity){
    array_push($errors,"ERROR: Booking limit must be smaller or equal to the location capacity.");
  }
}

//display errors or complete query
if (empty($errors)){
  //INSERT QUERY
  $event_query = "INSERT INTO ncl_events (eventTitle, eventDescription, eventDate, eventTime, eventDuration, facilityID, eventBookingLimit)
  VALUES (:eventTitle, :eventDescription, :eventDate, :eventTime, :eventDuration, :facilityID, :eventBookingLimit)";

    $queryResult = $dbConn->prepare($event_query);
    $queryResult->execute(array(':eventTitle' => $title,
    ':eventDescription' => $description,
    ':eventDate' => $date,
    ':eventTime' => $time,
    ':eventDuration' => $duration,
    ':facilityID' => $facility,
    ':eventBookingLimit' => $limit
    ));
          if ($queryResult === false) {
            echo "<p>Please try again! <a href='newevent-form.php'>Try again.</a></p>\n";
            exit;
          }else{
            header("Location: class-timetable.php");
            die();
          }
}else{
  //display $errors
  echo "<div class='errors-pane'>";
  echo "<h2>Please correct the following errors</h2>";
  foreach ($errors as $error){
    echo "<p>$error</p>";
  }
  echo "</div>";
  //Autofill form
  $sqlFacility = "SELECT facilityID, description, capacity
  FROM ncl_facilities";
  $facilities = $dbConn->query($sqlFacility);

  //event form
  echo "<p>Provide information for class.</p>
    <form action='newevent-process.php' method='POST' enctype='multipart/form-data' id='newevent-form'>
      <div class='col-1-width'>
      <label for='title' class='event-label'>Class</label>";
  $getClasses = "SELECT classID, className
  FROM ncl_classes";
  $classes = $dbConn->query($getClasses);
  echo "<select id='title' name='title'>";

  //Options from db
  while ($class = $classes->fetchObject()) {
    if ($title == $class->classID){
      echo "<option value='{$class->classID}' selected='selected'>{$class->className}</option>\n";
    }else{
      echo "<option value='{$class->classID}'>{$class->className}</option>\n";
    }
  }
  echo "</select>";
  echo "<label for='description' class='event-label'>Description</label>
      <input placeholder='Description' type='text' name='description' value='$description'/>
      <label for='date' class='event-label'>Date</label>
      <input type='date' name='date' value='$date'/>
      <label for='time' class='event-label'>Time</label>
      <input type='time' name='time' value='$time'/>
      <label for='duration' class='event-label'>Duration</label>
      <input type='time' name='duration' value='$duration'/>";
  //Select form input
  echo "<label for='facility' class='event-label'>Facility</label>
      <select id='facility' name='facility'>";

  //Options from db
  while ($facilityInfo = $facilities->fetchObject()) {
    if ($facilityInfo->facilityID == $facility){
      echo "<option value='{$facilityInfo->facilityID}' selected='selected'>{$facilityInfo->description} ({$facilityInfo->capacity})</option>\n";
    }else{
      echo "<option value='{$facilityInfo->facilityID}'>{$facilityInfo->description} ({$facilityInfo->capacity})</option>\n";
    }
  }

  echo "</select>
      <label for='limit' class='event-label'>Max booking capacity</label>
      <input type='number' name='limit' value='$limit'/>
      <input class='addEventSubmit' type='submit'/><br>
      </div>
      </form>";
}

}else{
  header('Location: login-form.php');
  exit;
}

echo "</div>";
makeFooter();
endHTML();
?>
