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
    <div class='col-2-width'>
    <label for='forename'>Forename</label>
    <input placeholder='Forename' type='text' name='forename' class='username'/>
    <label for='surname'>Surname</label>
    <input placeholder='Surname' type='text' name='surname'/>
    <label for='email'>Email</label>
    <input placeholder='Email' type='text' name='email'/>
    <label for='username'>Username</label>
    <input placeholder='Username' type='text' name='username'/>
    <label for='password'>Password</label>
    <input placeholder='Password' type='text' name='password'/>
    <label for='passwordchk'>Confirm Password</label>
    <input placeholder='Confirm Password' type='text' name='passwordchk'/>
    </div>
    <div class='col-2-width'>
    <label for='dob'>Date Of Birth</label>
    <input type='date' name='dob'/>
    <label for='gender'>Gender</label>
    <select id='gender' name='gender'>
    <option value='Male'>Male</option>
    <option value='Female'>Female</option>
    </select>
    <input type='hidden' name='userType' value='2'/>
    <label for='addr1'>Address Line 1</label>
    <input placeholder='Address Line 1' type='text' name='addr1'/>
    <label for='addr2'>Address Line 2</label>
    <input placeholder='Address Line 2' type='text' name='addr2'/>
    <label for='postcode'>Postcode</label>
    <input placeholder='Postcode' type='text' name='postcode'/>
    </div>
    <input class='logInSubmit' type='submit'/><br>
    <p>Allready signed up? <a href='login-form.php'>Login</a></p>
</div>";
makeFooter();
endHTML();
?>
