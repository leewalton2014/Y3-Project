<?php
include 'functions.php';
setSessionPath();
startHTML('Process','Insert into cms table');
makeNav();
//GET VARIABLES FROM FORM AND SANITISE USING FUNCTION IN CUSTOM SCRIPT
$role = $_SESSION['userType'];

$publisher = $_SESSION['userID'];
$postDate = date("Y/m/d");
$postTime = date("h:i:sa");
$version = "1";
$contentTitle = sanitise_input('title');
$contentBody = sanitise_input('editor1');
$contentTag = sanitise_input('tag');


if (isset($_SESSION['user']) && $_SESSION['userType']>=3){

$errors = array();
if (empty($contentTitle)||empty($contentBody)||empty($contentTag)){
  array_push($errors,"ERROR: Ensure all fields are populated.");
}
if ($contentTag == 1||$contentTag == 2){
  array_push($errors,"ERROR: Cannot create new home or about pages edit existing.");
}

if (empty($errors)){
  //INSERT QUERY
  $insertQry = "INSERT INTO ncl_cms_content (publisher, postDate, postTime, version, contentTitle, contentBody, contentTag)
  VALUES (:publisher, :postDate, :postTime, :version, :contentTitle, :contentBody, :contentTag)";

  $dbConn = getConnection();

  $queryResult = $dbConn->prepare($insertQry);
  $queryResult->execute(array(':publisher' => $publisher,
  ':postDate' => $postDate,
  ':postTime' => $postTime,
  ':version' => $version,
  ':contentTitle' => $contentTitle,
  ':contentBody' => $contentBody,
  'contentTag' => $contentTag
  ));

        if ($queryResult === false) {
          echo "<p>Please try again! <a href='cms-compose.php'>Try again.</a></p>\n";
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
  $getTags = "SELECT tagID, tagName
  FROM ncl_cms_tags";
  $tags = $dbConn->query($getTags);

  echo "<div class='mainBody'>
    <a href='manage-cms.php' class='big-button'>Content List</a><br>
    <form action='cms-compose-process.php' method='POST' enctype='multipart/form-data' id='cms-compose'>
      <div class='col-2-width'>
      <label for='title' class='cms-label'>Title </label>
      <input placeholder='Title' type='text' name='title' id='title'/>
      </div>
      <div class='col-2-width'>
      <label for='tag' class='cms-label'>Tag </label>
      <select id='tag' name='tag'>";

  while ($tag = $tags->fetchObject()){
    if ($tag->tagID == 1 || $tag->tagID == 2){
      echo "<option value='{$tag->tagID}' disabled>{$tag->tagName}</option>";
    }else{
      echo "<option value='{$tag->tagID}'>{$tag->tagName}</option>";
    }

    }

  echo "</select>
      </div>
      <textarea name='editor1' id='editor1' rows='20' cols='80'>$contentBody</textarea>
      <script>
      CKEDITOR.replace( 'editor1', {
        customConfig: '/Year3/IndividualProject/assets/config/ckeditor_config.js'
      });
      </script>
      <br>
      <input class='logInSubmit' type='submit' value='Compose'/><br>
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
