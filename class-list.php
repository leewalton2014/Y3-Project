<?php
include 'functions.php';
setSessionPath();
startHTML('Newcastle Sport','The home of newcastles newest sport venue');
makeNav();
makeTitle('Classes');
echo "<div class='mainBody'>";



$dbConn = getConnection();
$getClassInfo = "SELECT className, classDescription
FROM ncl_classes
ORDER BY className asc";
$classInfo = $dbConn->query($getClassInfo);


echo "<div class='class-list'>";
while ($info = $classInfo->fetchObject()){
    echo "<div class='content-card'>";
    echo "<p class='big-button'>{$info->className}</p><br>";
    echo "<div class='card-info'>";
    echo "<p>{$info->classDescription}</p>";
    echo "</div>";
    echo "</div>";
}
echo "</div>";


echo "</div>";
makeFooter();
endHTML();
?>
