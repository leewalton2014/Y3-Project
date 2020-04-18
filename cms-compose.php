<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
makeTitle('Compose Post');
//Signup form
echo "<div class='mainBody'>
  <form action='cms-compose-process.php' method='POST' enctype='multipart/form-data' id='cms-compose'>
    <div class='col-2-width'>
    <label for='title' class='cms'>Title </label>
    <input placeholder='Title' type='text' name='title' id='title'/>
    </div>
    <div class='col-2-width'>
    <label for='tag' class='cms'>Tag </label>
    <select id='tag' name='tag'>
    <option value='1'>index</option>
    <option value='2'>about</option>
    </select>
    </div>
    <textarea name='editor1' id='editor1' rows='20' cols='80'></textarea>
    <script>
    CKEDITOR.replace( 'editor1', {
      customConfig: '/Year3/IndividualProject/assets/config/ckeditor_config.js'
    });
    </script>
    <br>
    <input class='logInSubmit' type='submit' value='Compose'/><br>
    </form>
</div>";
makeFooter();
endHTML();
?>
