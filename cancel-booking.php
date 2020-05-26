<?php
include 'functions.php';
setSessionPath();
startHTML('Process','Cancel booking');
makeNav();
makeTitle('Booking');
echo "<div class='mainBody'>";

$bookingID = isset($_REQUEST['bookingID']) ? $_REQUEST['bookingID'] : null;
//session vars
$userType = $_SESSION['userType'];
$membershipEXP = $_SESSION['membershipEXP'];
$userID = $_SESSION['userID'];
$dbConn = getConnection();

$errors = array();
if (!isset($_SESSION['user'])){
  array_push($errors,"ERROR: Please login.");
}
if (empty($bookingID)){
  array_push($errors,"ERROR: Please try again.");
}

//check date of event related to booking
$getEventInfo = "SELECT eventDate
FROM ncl_bookings INNER JOIN ncl_events ON ncl_bookings.eventID = ncl_events.eventID
WHERE bookingID = '$bookingID'";
$eventInfo = $dbConn->query($getEventInfo);
$eventData = $eventInfo->fetchObject();

$eventDate = $eventData->eventDate;

$today = date("Y-m-d");
if ($today >= $eventDate){
  array_push($errors,"ERROR: You cannot cancel bookings on the day of the class.");
}


if (empty($errors)){
  //Delete QUERY
  $event_query = "DELETE FROM ncl_bookings
  WHERE bookingID = '$bookingID'";
  //delete query
  $queryResult = $dbConn->query($event_query);
        if ($queryResult === false) {
          echo "<p>Please try again! <a href='viewuser-bookings.php'>Try again.</a></p>\n";
          exit;
        }else{
          header("Location: viewuser-bookings.php");
          die();
        }
}else{
  echo "<div class='dash-main-infobox'>";
  echo "<div class='errors-pane'>";
  echo "<h2>Please correct the following errors</h2>";
  foreach ($errors as $error){
    echo "<p>$error</p>";
  }
  echo "<p>Go to <a href='viewuser-bookings.php'>Bookings.</a></p>\n";
  echo "</div>";
  echo "</div>";
}


echo "</div>";
makeFooter();
endHTML();
?>
