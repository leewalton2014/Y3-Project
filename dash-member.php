<?php
if (isset($_SESSION['user']) && $usertype == 2){
  //dash content
  echo "<div class='sidenav'>";
  echo "<ul>
    <li><a href='dashboard.php' class='emph'>Admin</a></li>
    <li><a href='dashboard.php' class='emph'>Welcome $username</a></li>
    <li><a href='viewuser-bookings.php'>Your Bookings</a></li>
    <li><a href='update-userinfo.php?userID=$userid'>Update Account Info</a></li>
    <li><a href='update-password-form.php'>Change Password</a></li>
  </ul>";
  echo "</div>";
  echo "<div class='dash-main'>";
  echo "<h1>Your week at a glance</h1>";
  $userID = $_SESSION['userID'];
  $today = date("Y/m/d");
  $maxDate = strtotime($today);
  $maxDate = strtotime("+7 day", $maxDate);
  $maxDate = date("Y/m/d", $maxDate);
  $getBookingsQuery = "SELECT bookingID, eventDate, className, eventTime, eventTitle, eventDescription, eventDuration
  FROM ncl_bookings INNER JOIN ncl_events ON ncl_bookings.eventID = ncl_events.eventID
  INNER JOIN ncl_classes ON ncl_events.eventTitle = ncl_classes.classID
  WHERE userID = '$userID' AND eventDate >= '$today' AND eventDate <= '$maxDate'
  ORDER BY eventDate, eventTime asc";
  $dbConn = getConnection();
  $queryResult = $dbConn->query($getBookingsQuery);


  if ($queryResult->rowCount() == 0){
    echo "<div class='dash-main-infobox'>";
    echo "<p>No bookings made for this week! View the <a href='class-timetable.php'>Class Timetable.</a></p>";
    echo "</div>";
  }else{
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
      $eventDate = $rowObj->eventDate;
      $ukDate = date("d/m/Y", strtotime($eventDate));
      echo "<td>$ukDate</td>";
      echo "<td>{$rowObj->eventTime}</td>";
      echo "<td>{$rowObj->className}</td>";
      echo "<td>{$rowObj->eventDescription}</td>";
      echo "<td>{$rowObj->eventDuration}</td>";
      echo "</tr>";
  }
  }
  echo "</table>";
  echo "</div>";
}else{
  header('Location: login-form.php');
}

?>
