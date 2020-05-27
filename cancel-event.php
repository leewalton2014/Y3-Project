<?php
include 'functions.php';
setSessionPath();
startHTML('Process','Cancel booking');
makeNav();
makeTitle('Cancel Event');
echo "<div class='mainBody'>";

$eventID = isset($_REQUEST['eventID']) ? $_REQUEST['eventID'] : null;
//session vars
$userType = $_SESSION['userType'];
$membershipEXP = $_SESSION['membershipEXP'];
$userID = $_SESSION['userID'];
$dbConn = getConnection();

$errors = array();
if (!isset($_SESSION['user']) || $userType < 3){
  array_push($errors,"ERROR: You do not have access to do this.");
}
if (empty($eventID)){
  array_push($errors,"ERROR: Please try again.");
}

//check if bookings
$getBookings = "SELECT eventID
FROM ncl_bookings
WHERE eventID = '$eventID'";
$bookings = $dbConn->query($getBookings);

if ($bookings->rowCount() > 0){
  array_push($errors,"ERROR: You cannot cancel events that have bookings.");
}


if (empty($errors)){
  //Delete QUERY
  $event_query = "DELETE FROM ncl_events
  WHERE eventID = '$eventID'";
  //delete query
  $queryResult = $dbConn->query($event_query);
        if ($queryResult === false) {
          echo "<p>Please try again! <a href='viewuser-bookings.php'>Try again.</a></p>\n";
          exit;
        }else{
          header("Location: manage-events.php");
          die();
        }
}else{
  echo "<div class='dash-main-infobox'>";
  echo "<div class='errors-pane'>";
  echo "<h2>Please correct the following errors</h2>";
  foreach ($errors as $error){
    echo "<p>$error</p>";
  }
  echo "<p>Go to <a href='manage-events.php'>Events.</a></p>\n";
  echo "</div>";
  echo "</div>";
}


echo "</div>";
makeFooter();
endHTML();
?>
