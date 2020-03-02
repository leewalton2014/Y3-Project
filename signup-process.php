<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$forename = sanitise_input('forname');
$surname = sanitise_input('surname');
$username = sanitise_input('username');
$email = sanitise_input('email');
$password = sanitise_input('password');
$dob = sanitise_input('dob');
$gender = sanitise_input('gender');
$userType = sanitise_input('userType');
$addr1 = sanitise_input('addr1');
$addr2 = sanitise_input('addr2');
$postcode = sanitise_input('postcode');
//HASH PASSWORD
$password = password_hash($password, PASSWORD_DEFAULT);
//INSERT QUERY
$signup_query = "INSERT INTO ncl_users (forename, surname, username, email, passwordHash, dob, gender, userType, addrL1, addrL2, postcode)
VALUES ('$forename','$surname','$username','$email','$password', '$dob', '$gender', '$userType', '$addr1', '$addr2', '$postcode')";

$dbConn = getConnection();
$queryResult = $dbConn->query($signup_query);
      if ($queryResult === false) {
        echo "<p>Please try again! <a href='signup-form.php'>Try again.</a></p>\n";
        exit;
      }else{
        header("Location: login-form.php");
        die();
      }
makeFooter();
endHTML();
?>
