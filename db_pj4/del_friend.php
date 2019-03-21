<?php
	session_start();
	require('connect.php');
	$exist=false;
	if( $_POST['id']!="" && isset($_SESSION['uid'])){
		$sql = "select * from friends
		WHERE friend_id='". mysqli_real_escape_string($con, $_POST['id'])."'
		AND uid='{$_SESSION['uid']}'
		";
		$result = mysqli_query($con, $sql) or die(mysqli_error($con));
		while($row = mysqli_fetch_array($result)){
			$exist=true;
		}//end while
		
		if($exist){
			$sql = "delete from friends
			WHERE (friend_id='". mysqli_real_escape_string($con, $_POST['id'])."'
			AND uid='{$_SESSION['uid']}') or (friend_id='{$_SESSION['uid']}' and uid='". mysqli_real_escape_string($con, $_POST['id'])."')
			";
			$result = mysqli_query($con, $sql) or die(mysqli_error($con));
			echo "A friend successfully deleted.";
			echo "<a href=\"userinfo.php?uid={$_SESSION['uid']}\"> Back </a><br>";
		}
		else{
			echo "User not found. Please try again.";
			echo "<a href=\"userinfo.php?uid={$_SESSION['uid']}\"> Back </a><br>";
		}
	}
	else{
		echo "You haven't logged in!  <a href=\"index.php\"> login </a><br>";
	}
?>