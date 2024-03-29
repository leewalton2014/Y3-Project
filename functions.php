<?php
//Database connection
function getConnection() {
    try {
        $connection = new PDO('mysql:host=localhost;dbname=unn_w17007224',
            'unn_w17007224', 'db2020lww');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (Exception $e) {
        throw new Exception('Connection error '. $e->getMessage(), 0, $e);
    }
}
//Sessions
//Function to start sessions and set path
function setSessionPath(){
    $currentPath = getcwd();
    ini_set('session.save_path', $currentPath.'/sessionData');
    session_start();
}
//sanitise input
function sanitise_input($var){
    $output = filter_has_var(INPUT_POST, $var) ? $_POST[$var] : null;
    $output = trim($output);
    $output = stripslashes($output);
    $output = htmlspecialchars($output);
    return $output;
}
//Start Webpage
function startHTML($title, $description){
  $content = <<< startHTML
  <!doctype html>
  <html lang='en'>
    <head>
        <meta charset='UTF-8'/>
        <meta name='description' content='$description'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$title</title>
        <link rel='stylesheet' type='text/css' href='stylesheet.css'>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
        <script src='//cdn.ckeditor.com/4.14.0/full/ckeditor.js'></script>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/chart.js@2.8.0'></script>
    </head>
    <body>
startHTML;
  $content .= "\n";
  echo $content;
}
//Navigation
function makeNav(){
  $content = <<< makeNAV
  <nav class='nav'>
    <div class='logo'><img src='assets/img/NS-White-Small.png' alt='logo'>
    <div class='nav-toggle'><i class='fa fa-bars' aria-hidden='true'></i></div>
    </div>

    <ul id='nav-buttons'>
      <li><a href='index.php'>Home</a></li>
      <li><a href='class-timetable.php'>Timetable</a></li>
      <li><a href='class-list.php'>Classes</a></li>
      <li><a href='about-us.php'>About Us</a></li>
      <li><a href='cms.php'>Content</a></li>
makeNAV;
  $content .= "\n";
  //Logout button float right
  if (isset($_SESSION['user']) && $_SESSION['user']){
    $content .= "<li><a href='dashboard.php'>Dashboard</a></li>";
    $content .= "<li><a href='logout-process.php'>Logout</a></li>";
  }else{
    $content .= "<li><a href='dashboard.php'>Login</a></li>";
  }
  $content .= "</ul>
    </nav>";
  $content .= "<script type='text/javascript'>
	$(document).ready(function(){
		$('.nav-toggle').click(function(){
			$('#nav-buttons').toggleClass('activated')
		})
	})
</script>";
  $content .= "\n";
  echo $content;
}
//Title Bar
function makeTitle($title){
  $content = <<< makeTITLE
  <div class='title'>
  <h1>$title</h1>
  </div>
makeTITLE;
  $content .= "\n";
  echo $content;
}
//Footer
function makeFooter(){
  $content = <<< makeFOOTER
  <footer class='footer'>
    <div class='footer_pane'>
      <h2>Address</h2>
      <p>Newcastle Sport</p>
      <p>11 Big Street</p>
      <p>Newcastle</p>
      <p>NE13FT</p>
    </div>
    <div class='footer_pane'>
      <h2>Contact</h2>
      <p>TEL: 000 0000 000 000</p>
      <p>Email: Bookings@nsport.co.uk</p>
      <p>Twitter: @NESport</p>
    </div>
    <div class='footer_pane'>
      <img src='assets/img/NS-White-Large.png' alt='logo'>
    </div>
  </footer>
makeFOOTER;
  $content .= "\n";
  echo $content;
}
//endHTML
function endHTML(){
  $content = <<< endHTML
  </body>
</html>
endHTML;
  $content .= "\n";
  echo $content;
}
?>
