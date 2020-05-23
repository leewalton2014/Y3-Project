<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
makeTitle('Login');
echo "<div class='mainBody'>";

//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$username = sanitise_input('username');
$password = sanitise_input('password');
$dbConn = getConnection();

$errors = array();
if(empty($username)||empty($password)){
  array_push($errors,"ERROR: Please enter a username and password.");
}

//get hash to check password
$checkQuery = "SELECT userID, userType, passwordHash, membershipEXP
FROM ncl_users WHERE username = :username";

$stmt = $dbConn->prepare($checkQuery);
$stmt->execute(array(':username'=>$username));
$user = $stmt->fetchObject();
if($user){
    //if the entered password has the same hash value as the password hash then create session
    if(!password_verify($password, $user->passwordHash)){
      array_push($errors,"ERROR: Password incorrect or username does not exist.");
    }//end if
}//end if
if ($user == NULL){
  array_push($errors,"ERROR: Username Invalid.");
}

if (empty($errors)){
  //Set session variable
  $_SESSION['user'] = true;
  $_SESSION['userID'] = $user->userID;
  $_SESSION['userType'] = $user->userType;
  $_SESSION['membershipEXP'] = $user->membershipEXP;
  $_SESSION['userName'] = $username;
  //Redirect to original page
  header('Location: dashboard.php');
  exit();
}else{
  echo "<div class='errors-pane'>";
  echo "<h2>Please correct the following errors</h2>";
  foreach ($errors as $error){
    echo "<p>$error</p>";
  }
  echo "</div>";
  echo "<form action='login-process.php' method='POST' enctype='multipart/form-data' id='login-form'>
  <input placeholder='Username' type='text' name='username' class='username'/>
  <input placeholder='Password' type='password' name='password' class='password'/>
  <input class='logInSubmit' type='submit'/>
  </form>
  <a href='signup-form.php'>Sign up to online system</a>";
}




echo "</div>";
makeFooter();
endHTML();
?>
