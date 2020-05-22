<?php
include 'functions.php';
setSessionPath();
startHTML('User Dashboard','Access your user account');
makeNav();
makeTitle('Dashboard');
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
echo "<div class='sidenav'>";
echo "<ul>
  <li><a href='dashboard.php' class='emph'>Welcome $username</a></li>
  <li><a href='newevent-form.php'>New Event</a></li>
  <li><a href='manage-events.php'>Manage Events</a></li>
  <li><a href='view-users.php'>View Users</a></li>
  <li><a href='manage-cms.php'>Manage Content</a></li>
  <li><a href='viewuser-bookings.php'>Your Bookings</a></li>
  <li><a href='update-userinfo.php?userID=$userid'>Update Account Info</a></li>
  <li><a href='update-password-form.php'>Change Password</a></li>
</ul>";
echo "</div>";

}else{
header('Location: login-form.php');
}

echo "</div>";

makeFooter();
endHTML();
?>
