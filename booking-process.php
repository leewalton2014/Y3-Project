<?php
include 'functions.php';
setSessionPath();
startHTML('Booking','Booking Process');
makeNav();
makeTitle('Booking');
echo "<div class='mainBody'>";
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$eventID = isset($_REQUEST['eventID']) ? $_REQUEST['eventID'] : null;
$userID = $_SESSION['userID'];
$dbConn = getConnection();

//session vars
$userType = $_SESSION['userType'];
$membershipEXP = $_SESSION['membershipEXP'];

//Insert query
$booking_query = "INSERT INTO ncl_bookings (eventID, userID)
VALUES ('$eventID', '$userID')";
//Get event and user info for email confirmation message
$getUserInfo = "SELECT forename, surname, email
FROM ncl_users
WHERE userID = '$userID'";
$getEventInfo = "SELECT eventTitle, className, eventDescription, eventDate, eventTime, eventBookingLimit
FROM ncl_events INNER JOIN ncl_classes ON ncl_events.eventTitle = ncl_classes.classID
WHERE eventID = '$eventID'";

//Check user has not allready booked class
$checkUserBookings = "SELECT bookingID
FROM ncl_bookings
WHERE eventID = '$eventID' AND userID = '$userID'";

$errors = array();


$checkStatus = $dbConn->query($checkUserBookings);
$userInfo = $dbConn->query($getUserInfo);
$eventInfo = $dbConn->query($getEventInfo);
$user = $userInfo->fetchObject();
$event = $eventInfo->fetchObject();
$to = $user->email;
$subject = "Booking Confirmation for {$event->className}";
$message = "You have succsessfully booked {$event->className}, on {$event->eventDate} at {$event->eventTime}.";


if ($checkStatus->rowCount() !== 0){
  array_push($errors,"ERROR: You allready booked this class.");
}
$today = date("Y-m-d");
$currentTime = date("H:i:s");
if ($event->eventDate < $today){
  array_push($errors,"ERROR: Cannot book event in the past.");
}else if ($event->eventDate == $today){
  if ($event->eventTime <= $currentTime){
    array_push($errors,"ERROR: Cannot book event in the past.");
  }
}

if (isset($_SESSION['user']) && $_SESSION['user']){
  if ($userType > 1){
    if ($userType == 2 && $membershipEXP <= $today){
      array_push($errors,"ERROR: Check your membership.");
    }
  }
  if ($userType == 1){
    array_push($errors,"ERROR: Only members can make bookings contact staff.");
  }
}else{
  array_push($errors,"ERROR: Please login.");
}
//check spaces available
$checkLimit = "SELECT bookingID
FROM ncl_bookings
WHERE eventID = '$eventID'";
$countBookings = $dbConn->query($checkLimit);
$totalBookings = $countBookings->rowCount();
if ($event->eventBookingLimit <= $totalBookings){
  array_push($errors,"Notice: Class Full");
}

if (empty($errors)){
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
  echo "<div class='dash-main-infobox'>";
  echo "<div class='errors-pane'>";
  echo "<h2>Please correct the following errors</h2>";
  foreach ($errors as $error){
    echo "<p>$error</p>";
  }
  echo "<p>Go to <a href='class-timetable.php'>Class Timetable.</a></p>\n";
  echo "</div>";
  echo "</div>";
}



echo "</div>";
makeFooter();
endHTML();
?>
