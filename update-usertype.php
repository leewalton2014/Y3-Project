<?php
include 'functions.php';
setSessionPath();
startHTML('Users','Update user info');
makeNav();
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a><br>";
echo "<h1>Users</h1>";

$userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : null;

echo "<p>$userID</p>";




echo "</div>";
makeFooter();
endHTML();
?>
