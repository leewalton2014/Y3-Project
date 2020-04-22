<?php
include 'functions.php';
setSessionPath();
startHTML('Booking','Booking Process');
makeNav();
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$eventID = isset($_REQUEST['eventID']) ? $_REQUEST['eventID'] : null;
$userID = $_SESSION['userID'];
$dbConn = getConnection();

//Insert query
$booking_query = "INSERT INTO ncl_bookings (eventID, userID)
VALUES ('$eventID', '$userID')";
//Get event and user info for email confirmation message
$getUserInfo = "SELECT forename, surname, email
FROM ncl_users
WHERE userID = '$userID'";
$getEventInfo = "SELECT eventTitle, eventDescription, eventDate, eventTime
FROM ncl_events
WHERE eventID = '$eventID'";

//Check user has not allready booked class
$checkUserBookings = "SELECT bookingID
FROM ncl_bookings
WHERE eventID = '$eventID' AND userID = '$userID'";
$checkStatus = $dbConn->query($checkUserBookings);


$userInfo = $dbConn->query($getUserInfo);
$eventInfo = $dbConn->query($getEventInfo);
$user = $userInfo->fetchObject();
$event = $eventInfo->fetchObject();
$to = $user->email;
$subject = "Booking Confirmation for {$event->eventTitle}";
$message = "You have succsessfully booked {$event->eventTitle}, on {$event->eventDate} at {$event->eventTime}.";


if ($checkStatus->rowCount() == 0){
  //if no booking allready made by user
  $queryResult = $dbConn->query($booking_query);
        if ($queryResult === false) {
          echo "<p>Please try again! <a href='class-timetable.php'>Try again.</a></p>\n";
          exit;
        }else{
          //Send Email
          mail($to,$subject,$message);
          //Take to dashboard
          header("Location: dashboard.php");
          die();
        }
}else{
  //booking allready made so alert user and dont create duplicate bookings
  echo "<p>You have allready booked this class. View your bookings <a href='viewuser-bookings.php'><b>Here</b>.</a></p>\n";
}


makeFooter();
endHTML();
?>
