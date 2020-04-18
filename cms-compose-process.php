<?php
include 'functions.php';
setSessionPath();
startHTML('Process','Insert into cms table');
makeNav();
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$role = $_SESSION['role'];

$publisher = $_SESSION['userID'];
$postDate = date("Y/m/d");
$postTime = date("h:i:sa");
$version = "1";
$contentTitle = sanitise_input('title');
$contentBody = sanitise_input('editor1');
$contentTag = sanitise_input('tag');

//HASH PASSWORD
$password = password_hash($password, PASSWORD_DEFAULT);
//INSERT QUERY
$insertQry = "INSERT INTO ncl_cms_content (publisher, postDate, postTime, version, contentTitle, contentBody, contentTag)
VALUES ('$publisher','$postDate','$postTime','$version','$contentTitle', '$contentBody', '$contentTag')";

$dbConn = getConnection();
$queryResult = $dbConn->query($insertQry);
      if ($queryResult === false) {
        echo "<p>Please try again! <a href='cms-compose.php'>Try again.</a></p>\n";
        exit;
      }else{
        header("Location: manage-cms.php");
        die();
      }
makeFooter();
endHTML();
?>
