<?php
include 'functions.php';
setSessionPath();
startHTML('Newcastle Sport Home','The home of newcastles newest sport venue');
makeNav();
//Main Body
echo "<div class='mainBody'>
<img class='width100'src='assets/img/boxing.jpg'>
<h1>Newcastle Sport</h1>
<p>Welcome to Newcastle Sport the city centres new multi-million pound facility, with a range of
classes and facilities for every one of any age and ability to enjoy. There is something for you
at Newcastle Sport, so why not give us a visit.</p>
<p>More info here.</p>
<a href='signup-form.php' class='big-button'>Sign Up Today!</a><br>
</div>";
makeFooter();
endHTML();
?>
