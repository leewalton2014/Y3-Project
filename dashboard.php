<?php
include 'functions.php';
setSessionPath();
startHTML('User Dashboard','Access your user account');
makeNav();
echo "<div class='mainBody'>
<h1>Dashboard</h1>";
if (isset($_SESSION['logged-in']) && $_SESSION['logged-in']){//Session active
echo "<p>Test</p>";
}else{
header('Location: login-form.php');
}

echo "</div>";

makeFooter();
endHTML();
?>
