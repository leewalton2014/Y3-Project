<?php
if (isset($_SESSION['user'])){
  //dash content
  echo "<div class='sidenav'>";
  echo "<ul>
    <li><a href='dashboard.php' class='emph'>User</a></li>
    <li><a href='dashboard.php' class='emph'>Welcome $username</a></li>
    <li><a href='update-userinfo.php?userID=$userid'>Update Account Info</a></li>
    <li><a href='update-password-form.php'>Change Password</a></li>
  </ul>";
  echo "</div>";
  echo "<div class='dash-main'>";
  echo "<div class='dash-main-infobox'>";
  echo "<p><b>Check your membership</b></p>";
  echo "<p>Contact the facility by telelphone, email or enroll to the online system in person.</p>";
  echo "</div>";
  echo "</div>";
}else{
  header('Location: login-form.php');
}

?>
