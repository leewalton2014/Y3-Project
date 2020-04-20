<?php
include 'functions.php';
setSessionPath();
startHTML('Newcastle Sport','The home of newcastles newest sport venue');
makeNav();
$contentID = isset($_REQUEST['contentID']) ? $_REQUEST['contentID'] : null;

$dbConn = getConnection();
$getCMSContent = "SELECT contentID, username, postDate, postTime, version, contentTitle, contentBody, contentTag, tagName
FROM ncl_cms_content INNER JOIN ncl_cms_tags ON ncl_cms_content.contentTag = ncl_cms_tags.tagID
INNER JOIN ncl_users ON ncl_cms_content.publisher = ncl_users.userID
WHERE contentID = '$contentID'
ORDER BY postDate desc, postTime desc";
$CMSContent = $dbConn->query($getCMSContent);
$content = $CMSContent->fetchObject();
makeTitle($content->contentTitle);
echo "<div class='mainBody'>";
//post
echo "<div class='cms-post'>";
$post = $content->contentBody;
echo htmlspecialchars_decode((stripslashes($post)));
echo "</div>";
//post-info
echo "<div class='cms-post'>";
echo "<p><b>#{$content->tagName}</b></p>";
echo "<p><b>Posted By: </b>{$content->username}</p>";
echo "<p><b>Published: </b>{$content->postDate} {$content->postTime}</p>";
echo "</div>";

echo "<a href='cms.php' class='big-button'>Back</a><br>";
echo "</div>";
makeFooter();
endHTML();
?>
