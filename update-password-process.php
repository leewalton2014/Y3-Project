<?php
include 'functions.php';
setSessionPath();
startHTML('Newcastle Sport','Booking System');
makeNav();
makeTitle('Change Password');
echo "<div class='mainBody'>";

if (isset($_SESSION['user']) && $_SESSION['user']){//Session active


//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$userID = $_SESSION['userID'];
$oldpass = sanitise_input('oldpass');
$newpass1 = sanitise_input('newpass1');
$newpass2 = sanitise_input('newpass2');
//hash new password
$password = password_hash($newpass1, PASSWORD_DEFAULT);
$dbConn = getConnection();


$errors = array();
if (empty($userID)||empty($oldpass)||empty($newpass1)||empty($newpass2)){
  array_push($errors,"ERROR: Please ensure all fields are populated.");
}
if ($newpass1 !== $newpass2){
  array_push($errors,"ERROR: Please ensure new passwords match.");
}

$oldHash = password_hash($oldpass, PASSWORD_DEFAULT);
$checkOldPass = "SELECT passwordHash
FROM ncl_users WHERE userID = :userID";
$stmt = $dbConn->prepare($checkOldPass);
$stmt->execute(array(':userID'=>$userID));
$hashcheck = $stmt->fetchObject();
$hash = $hashcheck->passwordHash;
if (!password_verify($oldpass, $hashcheck->passwordHash)){
  array_push($errors,"ERROR: Old password incorrect.");
}

if ($oldpass == $newpass1){
  array_push($errors,"ERROR: New password must be different to old password.");
}

if (empty($errors)){
  //UPDATE QUERY
  $updateQuery = "UPDATE ncl_users SET
  passwordHash = :passwordHash
  WHERE userID = :userID";

  $queryResult = $dbConn->prepare($updateQuery);
  $queryResult->execute(array(':passwordHash' => $password,
  ':userID' => $userID
  ));

  if ($queryResult === false) {
      echo "<p>Please try again! <a href='updateevent-form.php'>Try again.</a></p>\n";
      exit;
  }else{
      header("Location: dashboard.php");
      die();
  }
}else{
  echo "<div class='errors-pane'>";
  echo "<h2>Please correct the following errors</h2>";
  foreach ($errors as $error){
    echo "<p>$error</p>";
  }
  echo "</div>";
  $username = $_SESSION['userName'];
  echo "<p>Logged in as $username</p>";
  //Display form
  echo "<form action='update-password-process.php' method='POST' enctype='multipart/form-data' id='changepass-form'>
  <input placeholder='Old Password' type='password' name='oldpass'/>
  <input placeholder='New Password' type='password' name='newpass1'/>
  <input placeholder='Confirm Password' type='password' name='newpass2'/>
  <input class='logInSubmit' type='submit'/>
  </form>";
}

}else{
  header('Location: login-form.php');
  exit;
}



echo "</div>";
makeFooter();
endHTML();
?>
