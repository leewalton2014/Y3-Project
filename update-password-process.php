<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
echo "<div class='mainBody'>";
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$userID = sanitise_input('userID');
$oldpass = sanitise_input('oldpass');
$newpass1 = sanitise_input('newpass1');
$newpass2 = sanitise_input('newpass2');
//hash new password
$password = password_hash($newpass1, PASSWORD_DEFAULT);


//UPDATE QUERY
$updateQuery = "UPDATE ncl_users SET
passwordHash = '$password'
WHERE userID = '$userID'";

$dbConn = getConnection();



if ($newpass1==$newpass2){
//password confirmation matches so update password
$queryResult = $dbConn->query($updateQuery);
      if ($queryResult === false) {
        echo "<p>Please try again! <a href='updateevent-form.php'>Try again.</a></p>\n";
        exit;
      }else{
        header("Location: dashboard.php");
        die();
      }
}else{
  //error passwords dont match
  echo "<p>Passwords dont match try again.</p>\n";
}

echo "</div>";
makeFooter();
endHTML();
?>
