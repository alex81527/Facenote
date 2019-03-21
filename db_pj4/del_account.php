<?php
	session_start();
	require('connect.php');
	
	if( isset($_SESSION['uid'])){
		$sql = "delete from users WHERE uid='{$_SESSION['uid']}'";
		$result = mysqli_query($con, $sql) or die(mysqli_error($con));
		
		echo "Success...";
		$_SESSION=array();
		session_destroy();
		echo "<meta http-equiv=REFRESH CONTENT=1;url=index.php>";
	}
	else{
		echo "You haven't logged in!  <a href=\"index.php\"> login </a><br>";
	}
?>