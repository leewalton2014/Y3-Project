<?php
include 'functions.php';
setSessionPath();
startHTML('User Dashboard','Access your user account');
makeNav();
echo "<div class='mainBody'>";
if (isset($_SESSION['user']) && $_SESSION['user']){//Session active
$username = $_SESSION['userName'];
$usertype = $_SESSION['userType'];
$userid = $_SESSION['userID'];
if ($usertype >= 3){
  echo "<h1>Admin Dashboard</h1>";
}else{
  echo "<h1>User Dashboard</h1>";
}
echo "<p>YOU SUCCESSFULLY LOGGED IN</p>";
echo "<p>Welcome $username</p>
<a href='newevent-form.php' class='big-button'>New Event (testing)</a><br>";

}else{
header('Location: login-form.php');
}

echo "</div>";

makeFooter();
endHTML();
?>
