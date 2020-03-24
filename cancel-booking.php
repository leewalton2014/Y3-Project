<?php
include 'functions.php';
setSessionPath();
startHTML('Process','Cancel booking');
makeNav();

$bookingID = isset($_REQUEST['bookingID']) ? $_REQUEST['bookingID'] : null;
//Delete QUERY
$event_query = "DELETE FROM ncl_bookings
WHERE bookingID = '$bookingID'";
//check event isnt within 1 day



//delete query
$dbConn = getConnection();
$queryResult = $dbConn->query($event_query);
      if ($queryResult === false) {
        echo "<p>Please try again! <a href='viewuser-bookings.php'>Try again.</a></p>\n";
        exit;
      }else{
        header("Location: viewuser-bookings.php");
        die();
      }

makeFooter();
endHTML();
?>
