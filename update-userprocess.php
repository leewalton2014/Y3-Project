<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$userID = sanitise_input('userID');
$forename = sanitise_input('forename');
$surname = sanitise_input('surname');
$email = sanitise_input('email');
$username = sanitise_input('username');
$dob = sanitise_input('dob');
$gender = sanitise_input('gender');
$addr1 = sanitise_input('addr1');
$addr2 = sanitise_input('addr2');
$postcode = sanitise_input('postcode');

//INSERT QUERY
$updateQuery = "UPDATE ncl_users SET
username = '$username',
forename = '$forename',
surname = '$surname',
dob = '$dob',
email = '$email',
gender = '$gender',
addrL1 = '$addr1',
addrL2 = '$addr2',
postcode = '$postcode'
WHERE userID = '$userID'";

$dbConn = getConnection();
$queryResult = $dbConn->query($updateQuery);
      if ($queryResult === false) {
        echo "<p>Please try again! <a href='updateevent-form.php'>Try again.</a></p>\n";
        exit;
      }else{
        header("Location: dashboard.php");
        die();
      }
makeFooter();
endHTML();
?>
