<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
makeTitle('Signup Form');
//Signup form
echo "<div class='mainBody'>
  <h1>Sign Up</h1>
  <p>Enter your information to sign up to booking system.</p>
  <form action='signup-process.php' method='POST' enctype='multipart/form-data' id='signup-form'>
    <div class='col-2-width'>
    <label for='forname' class='signup-label'>Forname</label>
    <input placeholder='Forname' type='text' name='forname'/>
    <label for='surname' class='signup-label'>Surname</label>
    <input placeholder='Surname' type='text' name='surname'/>
    <label for='email' class='signup-label'>Email</label>
    <input placeholder='Email' type='text' name='email'/>
    <label for='username' class='signup-label'>Username</label>
    <input placeholder='Username' type='text' name='username'/>
    <label for='password' class='signup-label'>Password</label>
    <input placeholder='Password' type='password' name='password'/>
    <label for='passwordchk' class='signup-label'>Confirm Password</label>
    <input placeholder='Confirm Password' type='password' name='passwordchk'/>
    </div>
    <div class='col-2-width'>
    <label for='dob' class='signup-label'>Date Of Birth</label>
    <input type='date' name='dob'/>
    <label for='gender' class='signup-label'>Gender</label>
    <select id='gender' name='gender'>
    <option value='Male'>Male</option>
    <option value='Female'>Female</option>
    <option value='Other'>Other</option>
    </select>
    <label for='addr1' class='signup-label'>Address Line 1</label>
    <input placeholder='Address Line 1' type='text' name='addr1'/>
    <label for='addr2' class='signup-label'>Address Line 2</label>
    <input placeholder='Address Line 2' type='text' name='addr2'/>
    <label for='postcode' class='signup-label'>Postcode</label>
    <input placeholder='Postcode' type='text' name='postcode'/>
    </div>
    <br>
    <input class='logInSubmit' type='submit'/><br>
    </form>
    <p>Allready signed up? <a href='login-form.php'>Login</a></p>
</div>";
makeFooter();
endHTML();
?>
