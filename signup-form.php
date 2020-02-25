<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
//Signup form
echo "<div class='mainBody'>
  <h1>Sign Up</h1>
  <p>Enter your information to sign up to booking system.</p>
  <form action='login-process.php' method='POST' enctype='multipart/form-data' id='login-form'>
    <input placeholder='Forename' type='text' name='username' class='username'/>
    <input placeholder='Surname' type='text' name='' class=''/>
    <input placeholder='Email' type='text' name='' class=''/>
    <input placeholder='Username' type='text' name='' class=''/>
    <input placeholder='Password' type='text' name='' class=''/>
    <input placeholder='Confirm Password' type='text' name='' class=''/>
    <input placeholder='' type='date' name='dob' class='dob'/>
    <input placeholder='' type='text' name='' class=''/>
    <input placeholder='' type='text' name='' class=''/>
    <input class='logInSubmit' type='submit'/><br>
    <p>Allready signed up? <a href='login-form.php'>Login</a></p>
</div>";
makeFooter();
endHTML();
?>
