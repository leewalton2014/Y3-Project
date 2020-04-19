<?php
include 'functions.php';
setSessionPath();
startHTML('Sign Up Now','Sign up to booking system');
makeNav();
makeTitle('Update Post');
//Signup form
$dbConn = getConnection();
$contentID = isset($_REQUEST['contentID']) ? $_REQUEST['contentID'] : null;
$getPostInfo = "SELECT contentTitle, contentBody, contentTag
FROM ncl_cms_content
WHERE contentID = '$contentID'";
$getTags = "SELECT tagID, tagName
FROM ncl_cms_tags";
$tags = $dbConn->query($getTags);
$postInfo = $dbConn->query($getPostInfo);
$post = $postInfo -> fetchObject();
echo "<div class='mainBody'>
  <a href='manage-cms.php' class='big-button'>Content List</a><br>
  <form action='cms-compose-process.php' method='POST' enctype='multipart/form-data' id='cms-compose'>
    <div class='col-2-width'>
    <label for='title' class='cms'>Title </label>
    <input value='{$post->contentTitle}' type='text' name='title' id='title'/>
    </div>
    <div class='col-2-width'>
    <label for='tag' class='cms'>Tag </label>
    <select id='tag' name='tag'>";

while ($tag = $tags->fetchObject()){
    if ($post->contentTag == $tag->tagID){
      echo "<option value='{$tag->tagID}' selected='selected'>{$tag->tagName}</option>";
    }else{
      echo "<option value='{$tag->tagID}'>{$tag->tagName}</option>";
    }
  }

echo "</select>
    </div>
    <textarea name='editor1' id='editor1' rows='20' cols='80'>{$post->contentBody}</textarea>
    <script>
    CKEDITOR.replace( 'editor1', {
      customConfig: '/Year3/IndividualProject/assets/config/ckeditor_config.js'
    });
    </script>
    <br>
    <input class='logInSubmit' type='submit' value='Compose'/><br>
    </form>
</div>";
makeFooter();
endHTML();
?>
