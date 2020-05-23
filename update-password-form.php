<?php
include 'functions.php';
setSessionPath();
startHTML('User Dashboard','Access your user account');
makeNav();
makeTitle('Change Password');
echo "<div class='mainBody'>";
if (isset($_SESSION['user']) && $_SESSION['user']){//Session active
$username = $_SESSION['userName'];
$usertype = $_SESSION['userType'];
$userid = $_SESSION['userID'];

echo "<p>Logged in as $username</p>";
//Display form
echo "<form action='update-password-process.php' method='POST' enctype='multipart/form-data' id='changepass-form'>
<input placeholder='Old Password' type='password' name='oldpass'/>
<input placeholder='New Password' type='password' name='newpass1'/>
<input placeholder='Confirm Password' type='password' name='newpass2'/>
<input class='logInSubmit' type='submit'/>
</form>";





}else{
header('Location: login-form.php');
}

echo "</div>";

makeFooter();
endHTML();
?>
