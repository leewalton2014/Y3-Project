<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$username = sanitise_input('username');
$password = sanitise_input('password');

if(empty($username)||empty($password)){
  echo "<p>Please enter a username and password!</p>";
}else{
//get hash to check password
$checkQuery = "SELECT userID, userType, passwordHash
FROM ncl_users WHERE username = :username";

$dbConn = getConnection();
$stmt = $dbConn->prepare($checkQuery);
$stmt->execute(array(':username'=>$username));
$user = $stmt->fetchObject();
if($user){
    //if the entered password has the same hash value as the password hash then create session
    if(password_verify($password, $user->passwordHash)){
        //Set session variable
        $_SESSION['user'] = true;
        $_SESSION['userID'] = $user->userID;
        $_SESSION['userType'] = $user->userType;
        $_SESSION['userName'] = $username;
        //Redirect to original page
        header('Location: dashboard.php');
        exit();
    }//end if
    else{
        echo "<p>Incorrect Password <a href='login-form.php'>try again</a></p>";
    }//end else
}//end if
}//end else
makeFooter();
endHTML();
?>
