<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
makeTitle('Update User Membership');
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$userID = sanitise_input('userID');
$acctype = sanitise_input('acctype');
$expdate = sanitise_input('expdate');


//INSERT QUERY
$updateQuery = "UPDATE ncl_users SET
userType = '$acctype',
membershipEXP = '$expdate'
WHERE userID = '$userID'";

$dbConn = getConnection();
$queryResult = $dbConn->query($updateQuery);
      if ($queryResult === false) {
        echo "<p>Please try again! <a href='update-usertype.php'>Try again.</a></p>\n";
        exit;
      }else{
        header("Location: dashboard.php");
        die();
      }
makeFooter();
endHTML();
?>
