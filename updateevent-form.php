<?php
include 'functions.php';
setSessionPath();
startHTML('Users','Update event info');
makeNav();
makeTitle('Update Event Info');
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a>";
echo "<a href='manage-events.php' class='big-button'>Back to Events</a><br>";

if (isset($_SESSION['user']) && $_SESSION['userType'] >= 3){
  
$eventID = isset($_REQUEST['eventID']) ? $_REQUEST['eventID'] : null;
$getEventQuery = "SELECT eventID, eventTitle, eventDescription, eventDate, eventTime, eventDuration, description, eventBookingLimit, ncl_facilities.facilityID
FROM ncl_events INNER JOIN ncl_facilities ON ncl_events.facilityID = ncl_facilities.facilityID
WHERE eventID = '$eventID'";
$dbConn = getConnection();
$queryResult = $dbConn->query($getEventQuery);
$event = $queryResult->fetchObject();
echo "<form action='updateevent-process.php' method='POST' enctype='multipart/form-data' id='newevent-form'>
    <div class='col-1-width'>
    <input type='hidden' value='$eventID' name='eventid'/>
    <label for='title' class='event-label'>Class</label>";
$getClasses = "SELECT classID, className
FROM ncl_classes";
$classes = $dbConn->query($getClasses);
echo "<select id='title' name='title'>";

//Options from db
while ($class = $classes->fetchObject()) {
  if ($event->eventTitle == $class->classID){
    echo "<option value='{$class->classID}' selected='selected'>{$class->className}</option>\n";
  }else{
    echo "<option value='{$class->classID}'>{$class->className}</option>\n";
  }
}
echo "</select>";
echo"<label for='description' class='event-label'>Description</label>
    <input value='{$event->eventDescription}' type='text' name='description'/>
    <label for='date' class='event-label'>Date</label>
    <input type='date' value='{$event->eventDate}' name='date'/>
    <label for='time' class='event-label'>Time</label>
    <input type='time' value='{$event->eventTime}' name='time'/>
    <label for='duration' class='event-label'>Duration</label>
    <input type='time' value='{$event->eventDuration}' name='duration'/>";
//Select form input
echo "<label for='facility' class='event-label'>Facility</label>
    <select id='facility' name='facility'>";

//Options from db
//query for facility type selection
$sqlFacility = "SELECT facilityID, description, capacity
FROM ncl_facilities";
$facilities = $dbConn->query($sqlFacility);
$eventFacility = $event->facilityID;
while ($facility = $facilities->fetchObject()) {
  if ($eventFacility == $facility->facilityID){
    echo "<option value='{$facility->facilityID}' selected='selected'>{$facility->description} ({$facility->capacity})</option>\n";
  }else{
    echo "<option value='{$facility->facilityID}'>{$facility->description} ({$facility->capacity})</option>\n";
  }
}

echo "</select>
    <label for='limit' class='event-label'>Max booking capacity</label>
    <input type='number' value='{$event->eventBookingLimit}' name='limit'/>
    <input class='addEventSubmit' value='Update Info' type='submit'/><br>
</div>
</form>";

}else{
  header('Location: login-form.php');
  exit;
}

echo "</div>";
makeFooter();
endHTML();
?>
