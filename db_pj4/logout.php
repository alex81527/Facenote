<?php
echo "Logging out......";
session_start();
/*
if(isset($_SESSION['username']))
	unset($SESSION['username']);
if(isset($_SESSION['password']))
	unset($SESSION['password']);
*/
$_SESSION=array();
session_destroy();
echo "<meta http-equiv=REFRESH CONTENT=1;url=index.php>";

?>
