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
$membershipEXP = $_SESSION['membershipEXP'];
$userid = $_SESSION['userID'];
$today = date("Y/m/d");

if ($usertype == 4){
  include 'dash-admin.php';
}else if ($usertype == 3){
  include 'dash-staff.php';
}else if ($usertype == 2 && $today<=$membershipEXP){
  include 'dash-member.php';
}else {
  include 'dash-user.php';
}

}else{
header('Location: login-form.php');
}

echo "</div>";

makeFooter();
endHTML();
?>
