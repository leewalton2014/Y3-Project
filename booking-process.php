<?php
include 'functions.php';
setSessionPath();
startHTML('Booking','Booking Process');
makeNav();
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$eventID = isset($_REQUEST['eventID']) ? $_REQUEST['eventID'] : null;
$userID = $_SESSION['userID'];

//INSERT QUERY
$booking_query = "INSERT INTO ncl_bookings (eventID, userID)
VALUES ('$eventID', '$userID')";

$dbConn = getConnection();
$queryResult = $dbConn->query($booking_query);
      if ($queryResult === false) {
        echo "<p>Please try again! <a href='class-timetable.php'>Try again.</a></p>\n";
        exit;
      }else{
        header("Location: dashboard.php");
        die();
      }
makeFooter();
endHTML();
?>
