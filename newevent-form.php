<?php
include 'functions.php';
setSessionPath();
startHTML('New Class','Add class to timetable');
makeNav();
//query for facility type selection
$dbConn = getConnection();
$sqlFacility = "SELECT facilityID, description, capacity
FROM ncl_facilities";
$queryResult = $dbConn->query($sqlFacility);



//Signup form
echo "<div class='mainBody'>
  <h1>New Class Info</h1>
  <p>Provide information for class.</p>
  <form action='newevent-process.php' method='POST' enctype='multipart/form-data' id='newevent-form'>
    <div class='col-1-width'>
    <label for='title' class='event-label'>Title</label>
    <input placeholder='Title' type='text' name='title'/>
    <label for='description' class='event-label'>Description</label>
    <input placeholder='Description' type='text' name='description'/>
    <label for='date' class='event-label'>Date</label>
    <input type='date' name='date'/>
    <label for='time' class='event-label'>Time</label>
    <input type='time' name='time'/>
    <label for='duration' class='event-label'>Duration</label>
    <input type='time' name='duration'/>";
//Select form input
echo "<label for='facility' class='event-label'>Facility</label>
    <select id='facility' name='facility'>";

//Options from db
while ($facility = $queryResult->fetchObject()) {
                 echo "<option value='{$facility->facilityID}'>{$facility->description} ({$facility->capacity})</option>\n";
             }

echo "</select>
    <label for='limit' class='event-label'>Max booking capacity</label>
    <input type='number' name='limit'/>
    <input class='addEventSubmit' type='submit'/><br>
    </div>
</div>";
makeFooter();
endHTML();
?>
