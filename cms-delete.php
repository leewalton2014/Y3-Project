<?php
include 'functions.php';
setSessionPath();
startHTML('Newcastle Sport','Booking System');
makeNav();
makeTitle('Cancel Event');
echo "<div class='mainBody'>";

$contentID = isset($_REQUEST['contentID']) ? $_REQUEST['contentID'] : null;
//session vars
$userType = $_SESSION['userType'];
$membershipEXP = $_SESSION['membershipEXP'];
$userID = $_SESSION['userID'];
$dbConn = getConnection();

$errors = array();

if (!isset($_SESSION['user']) || $_SESSION['userType'] < 3){
  array_push($errors,"ERROR: You do not have access to do this.");
}

if (empty($contentID)){
  array_push($errors,"ERROR: Please try again.");
}


if (empty($errors)){
  //Delete QUERY
  $query = "DELETE FROM ncl_cms_content
  WHERE contentID = '$contentID'";
  //delete query
  $queryResult = $dbConn->query($query);
        if ($queryResult === false) {
          echo "<p>Please try again! <a href='viewuser-bookings.php'>Try again.</a></p>\n";
          exit;
        }else{
          header("Location: manage-cms.php");
          die();
        }
}else{
  echo "<div class='dash-main-infobox'>";
  echo "<div class='errors-pane'>";
  echo "<h2>Please correct the following errors</h2>";
  foreach ($errors as $error){
    echo "<p>$error</p>";
  }
  echo "<p>Go to <a href='manage-cms.php'>CMS.</a></p>\n";
  echo "</div>";
  echo "</div>";
}


echo "</div>";
makeFooter();
endHTML();
?>
