<?php
include 'functions.php';
setSessionPath();
startHTML('Newcastle Sport','The home of newcastles newest sport venue');
makeNav();
makeTitle('Content');
echo "<div class='mainBody'>";

$dbConn = getConnection();
if (isset($_REQUEST['tagID'])){
  //query filtered by tag
  $tagID = isset($_REQUEST['tagID']) ? $_REQUEST['tagID'] : null;
  $getCMSContent = "SELECT contentID, username, postDate, postTime, version, contentTitle, contentBody, contentTag, tagName
  FROM ncl_cms_content INNER JOIN ncl_cms_tags ON ncl_cms_content.contentTag = ncl_cms_tags.tagID
  INNER JOIN ncl_users ON ncl_cms_content.publisher = ncl_users.userID
  WHERE contentTag = '$tagID'
  ORDER BY postDate desc, postTime desc";
}else{
  //get all content
  $getCMSContent = "SELECT contentID, username, postDate, postTime, version, contentTitle, contentBody, contentTag, tagName
  FROM ncl_cms_content INNER JOIN ncl_cms_tags ON ncl_cms_content.contentTag = ncl_cms_tags.tagID
  INNER JOIN ncl_users ON ncl_cms_content.publisher = ncl_users.userID
  ORDER BY postDate desc, postTime desc";
}

$getCMSTags = "SELECT tagID, tagName
FROM ncl_cms_tags";


$CMSContent = $dbConn->query($getCMSContent);
$CMSTags = $dbConn->query($getCMSTags);




echo "<div class='content-list'>";
while ($content = $CMSContent->fetchObject()){
    echo "<div class='content-card'>";
    echo "<a href='view-cms-content.php?contentID={$content->contentID}' class='big-button'>{$content->contentTitle}</a><br>";
    echo "<div class='card-info'>";
    echo "<p><b>#{$content->tagName}</b></p>";
    echo "<p><b>Posted By: </b>{$content->username}</p>";
    echo "<p><b>Published: </b>{$content->postDate} {$content->postTime}</p>";
    echo "</div>";
    echo "</div>";
}
echo "</div>";
echo "<div class='tag-list'>";
echo "<h2>Tags</h2>";
while ($tag = $CMSTags->fetchObject()){
    echo "<a href='cms.php?tagID={$tag->tagID}' class='big-button'><b>#</b>{$tag->tagName}</a><br>";
}
echo "<a href='cms.php' class='big-button'>Clear Tag Filter</a><br>";
echo "</div>";

echo "</div>";
makeFooter();
endHTML();
?>
