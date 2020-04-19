<?php
include 'functions.php';
setSessionPath();
startHTML('Newcastle Sport','The home of newcastles newest sport venue');
makeNav();
makeTitle('News and Info Articles');
echo "<div class='mainBody'>";

$dbConn = getConnection();

$getCMSContent = "SELECT contentID, username, postDate, postTime, version, contentTitle, contentBody, contentTag, tagName
FROM ncl_cms_content INNER JOIN ncl_cms_tags ON ncl_cms_content.contentTag = ncl_cms_tags.tagID
INNER JOIN ncl_users ON ncl_cms_content.publisher = ncl_users.userID
ORDER BY postDate desc, postTime desc";
$CMSContent = $dbConn->query($getCMSContent);

while ($content = $CMSContent->fetchObject()){
    echo "<div class='content-card'>";
    echo "<a href='view-cms-content.php?contentID={$content->contentID}' class='big-button'>{$content->contentTitle}</a><br>";
    echo "<p><b>#{$content->tagName}</b></p>";
    echo "<p><b>Posted By: </b>{$content->username}</p>";
    echo "<p><b>Published: </b>{$content->postDate} {$content->postTime}</p>";
    echo "</div>";
}


echo "</div>";
makeFooter();
endHTML();
?>
