<?php
include 'functions.php';
setSessionPath();
startHTML('CMS Update','Update cms post content');
makeNav();
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT

$role = $_SESSION['userType'];
$publisher = $_SESSION['userID'];

$postDate = date("Y/m/d");
$postTime = date("h:i:sa");
$contentTitle = sanitise_input('title');
$contentBody = sanitise_input('editor1');
$contentTag = sanitise_input('tag');
$contentID = sanitise_input('contentID');
$dbConn = getConnection();

if (isset($_SESSION['user']) && $_SESSION['userType']>=3){

$errors = array();
if (empty($contentTitle)||empty($contentBody)||empty($contentTag)){
  array_push($errors,"ERROR: Ensure all fields are populated.");
}


if (empty($errors)){
  //update QUERY
  $updateQuery = "UPDATE ncl_cms_content SET
  publisher = '$publisher',
  postDate = '$postDate',
  postTime = '$postTime',
  contentTitle = '$contentTitle',
  contentBody = '$contentBody',
  contentTag = '$contentTag'
  WHERE contentID = '$contentID'";

  $queryResult = $dbConn->prepare($updateQuery);
  $queryResult->execute(array(':publisher' => $publisher,
  ':postDate' => $postDate,
  ':postTime' => $postTime,
  ':contentTitle' => $contentTitle,
  ':contentBody' => $contentBody,
  'contentTag' => $contentTag,
  ':contentID' => $contentID
  ));

        if ($queryResult === false) {
          echo "<p>Please try again! <a href='updateevent-form.php'>Try again.</a></p>\n";
          exit;
        }else{
          header("Location: manage-cms.php");
          die();
        }
}else{
  //display $errors
  echo "<div class='errors-pane'>";
  echo "<h2>Please correct the following errors</h2>";
  foreach ($errors as $error){
    echo "<p>$error</p>";
  }
  echo "</div>";
  //Autofill form
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
    <form action='cms-update-process.php' method='POST' enctype='multipart/form-data' id='cms-compose'>
      <div class='col-2-width'>
      <label for='title' class='cms-label'>Title </label>
      <input value='$contentTitle' type='text' name='title' id='title'/>
      </div>
      <div class='col-2-width'>
      <label for='tag' class='cms-label'>Tag </label>";
    echo "<select id='tag' name='tag'>";

  while ($tag = $tags->fetchObject()){
      if ($post->contentTag == $tag->tagID){
        echo "<option value='{$tag->tagID}' selected='selected'>{$tag->tagName}</option>";
      }else{
        echo "<option value='{$tag->tagID}'>{$tag->tagName}</option>";
      }
    }

  echo "</select>
      </div>
      <textarea name='editor1' id='editor1' rows='20' cols='80'>$contentBody</textarea>
      <input value='$contentID' type='hidden' name='contentID' id='contentID'/>
      <script>
      CKEDITOR.replace( 'editor1', {
        customConfig: '/Year3/IndividualProject/assets/config/ckeditor_config.js'
      });
      </script>
      <br>
      <input class='logInSubmit' type='submit' value='Update'/><br>
      </form>
  </div>";

}






}else{
  header('Location: login-form.php');
  exit;
}

makeFooter();
endHTML();
?>
