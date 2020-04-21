<?php
include 'functions.php';
setSessionPath();
startHTML('CMS Update','Update cms post content');
makeNav();
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT

$role = $_SESSION['role'];
$publisher = $_SESSION['userID'];

$postDate = date("Y/m/d");
$postTime = date("h:i:sa");
$contentTitle = sanitise_input('title');
$contentBody = sanitise_input('editor1');
$contentTag = sanitise_input('tag');
$contentID = sanitise_input('contentID');

//INSERT QUERY
$updateQuery = "UPDATE ncl_cms_content SET
publisher = '$publisher',
postDate = '$postDate',
postTime = '$postTime',
contentTitle = '$contentTitle',
contentBody = '$contentBody',
contentTag = '$contentTag'
WHERE contentID = '$contentID'";

$dbConn = getConnection();
$queryResult = $dbConn->query($updateQuery);
      if ($queryResult === false) {
        echo "<p>Please try again! <a href='updateevent-form.php'>Try again.</a></p>\n";
        exit;
      }else{
        header("Location: dashboard.php");
        die();
      }
makeFooter();
endHTML();
?>
