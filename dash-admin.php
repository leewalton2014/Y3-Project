<?php
if (isset($_SESSION['user']) && $usertype == 4){
  //dash content
  echo "<div class='sidenav'>";
  echo "<ul>
    <li><a href='dashboard.php' class='emph'>Admin</a></li>
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
  echo "<div class='dash-main'>";

  echo "<div class='dash-main-infobox'>
  <p>Please logout of the system when not in use for data protection.</p>
  </div>";

  echo "</div>";
}else{
  header('Location: login-form.php');
}

?>
