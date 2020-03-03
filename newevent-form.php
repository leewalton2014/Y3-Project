<?php
include 'functions.php';
setSessionPath();
startHTML('New Class','Add class to timetable');
makeNav();
//Signup form
echo "<div class='mainBody'>
  <h1>New Class Info</h1>
  <p>Provide information for class.</p>
  <form action='newevent-process.php' method='POST' enctype='multipart/form-data' id='newevent-form'>
    <div class='col-2-width'>
    <label for='title' class='event-label'>Title</label>
    <input placeholder='Title' type='text' name='title'/>
    <label for='description' class='event-label'>Description</label>
    <input placeholder='Description' type='text' name='description'/>
    <label for='date' class='event-label'>Date</label>
    <input type='date' name='date'/>
    <label for='time' class='event-label'>Time</label>
    <input type='time' name='time'/>
    <label for='duration' class='event-label'>Duration</label>
    <input type='time' name='duration'/>

    <label for='facility' class='event-label'>Facility</label>
    <select id='facility' name='facility'>
    //get from db
    <option value='Male'>Male</option>
    <option value='Female'>Female</option>
    </select>

    <label for='limit' class='event-label'>Max booking capacity</label>
    <input type='number' name='limit'/>
    </div>
    <br>
    <input class='addEventSubmit' type='submit'/><br>
</div>";
makeFooter();
endHTML();
?>
