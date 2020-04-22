<?php
include 'functions.php';
setSessionPath();
startHTML('Newcastle Sport Home','The home of newcastles newest sport venue');
makeNav();
makeTitle('About Us');
echo "<div class='mainBody'>";
echo "<h1>Location</h1>";
echo "<iframe src='https://www.google.com/maps/embed/v1/place?key=AIzaSyD-Ikb9FiJVmyXVjSUH2Wms2ot8enQbzu0&q=Newcastle,UnitedKingdom' width='100%' height='400' frameborder='0' style='border:0;' allowfullscreen=''></iframe>";
$tagID = "2";
$dbConn = getConnection();
$getCMSContent = "SELECT contentID, username, postDate, postTime, version, contentTitle, contentBody, contentTag, tagName
FROM ncl_cms_content INNER JOIN ncl_cms_tags ON ncl_cms_content.contentTag = ncl_cms_tags.tagID
INNER JOIN ncl_users ON ncl_cms_content.publisher = ncl_users.userID
WHERE contentTag = '$tagID'
ORDER BY postDate desc, postTime desc";

$CMSContent = $dbConn->query($getCMSContent);
while($content = $CMSContent->fetchObject()){
//post
echo "<div class='cms-post'>";
$post = $content->contentBody;
echo htmlspecialchars_decode((stripslashes($post)));
echo "</div>";
//post-info
echo "<div class='cms-post'>";
echo "<p><b>Last Updated: </b>{$content->postDate} {$content->postTime}</p>";
echo "</div>";
}







echo "</div>";
makeFooter();
endHTML();
?>
