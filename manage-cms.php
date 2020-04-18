<?php
include 'functions.php';
setSessionPath();
startHTML('Users','Update user info');
makeNav();
makeTitle('Manage CMS Content');
echo "<div class='mainBody'>";

echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a>";
echo "<a href='cms-compose.php' class='big-button'>Compose Content</a><br>";
echo "<h2>Content List</h2>";

$getUsersQuery = "SELECT contentID, username, postDate, postTime, version, contentTitle, contentBody, contentTag, tagName
FROM ncl_cms_content INNER JOIN ncl_cms_tags ON ncl_cms_content.contentTag = ncl_cms_tags.tagID
INNER JOIN ncl_users ON ncl_cms_content.publisher = ncl_users.userID
ORDER BY postDate, postTime desc";
$dbConn = getConnection();
$queryResult = $dbConn->query($getUsersQuery);

echo "<table id='table-basic'>
<tr>
<th>Title</th>
<th>Tag</th>
<th>Publisher</th>
<th>Last Updated</th>
</tr>";

while ($rowObj = $queryResult->fetchObject()){
    echo "<tr>";
    echo "<td><a href='cms-update.php?contentID={$rowObj->contentID}'>{$rowObj->contentTitle}</a></td>";
    echo "<td>{$rowObj->tagName}</td>";
    echo "<td>{$rowObj->username}</td>";
    echo "<td>{$rowObj->postDate}</td>";
    echo "</tr>";
}

echo "</table>";


echo "</div>";
makeFooter();
endHTML();
?>
