<?php
include 'functions.php';
setSessionPath();
startHTML('NES Login','Login to booking system');
makeNav();
makeTitle('Login');
//Login Form
echo "<div class='mainBody'>
<p>Enter your username and password</p>
<form action='login-process.php' method='POST' enctype='multipart/form-data' id='login-form'>
<input placeholder='Username' type='text' name='username' class='username'/>
<input placeholder='Password' type='password' name='password' class='password'/>
<input class='logInSubmit' type='submit'/>
</form>
<a href='signup-form.php'>Sign up to online system</a>
</div>";
makeFooter();
endHTML();
?>
