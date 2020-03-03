<?php
require_once('functions.php');
//start session
setSessionPath();
$_SESSION = array();
session_destroy();
header('Location: index.php');
exit();
?>
