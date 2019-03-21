<?php
	session_start();
	require('connect.php');
	$exist=false;
	$fr=false;
	if( $_POST['id']!="" && isset($_SESSION['uid'])){
		$str1="insert into `friends`(`uid`,`friend_id`,`relationship`) 
		      values('{$_SESSION['uid']}','{$_POST['id']}','{$_POST['relationship']}')";
		$str2="insert into `friends`(`uid`,`friend_id`,`relationship`) 
		      values('{$_POST['id']}','{$_SESSION['uid']}','{$_POST['relationship']}')";
		$sql = "SELECT * FROM users
		WHERE uid='". mysqli_real_escape_string($con, $_POST['id'])."'";
		$result = mysqli_query($con, $sql) or die(mysqli_error($con));
		while($row = mysqli_fetch_array($result)){
			$exist=true;
		}//end while
		$sql = "SELECT * FROM friends
		WHERE uid='{$_SESSION['uid']}' and friend_id='{$_POST['id']}'";
		$result = mysqli_query($con, $sql) or die(mysqli_error($con));
		while($row = mysqli_fetch_array($result)){
			$fr=true;
		}//end while
			
		if($exist){
			if($fr){
				echo "You two are friends already.<a href=\"userinfo.php?uid={$_SESSION['uid']}\"> Back </a>";
			}
			else{
				$result = mysqli_query($con, $str1);
				$result = mysqli_query($con, $str2);
				echo "New friend successfully added.";
				echo "<a href=\"userinfo.php?uid={$_SESSION['uid']}\"> Back </a><br>";
			}
		}
		else{
			echo "Can't find this user! Please try again.";
			echo "<a href=\"userinfo.php?uid={$_SESSION['uid']}\"> Back </a><br>";
		} 
			
	}
	else if(isset($_SESSION['uid'])){
		echo "Make sure all fields are filled! Please try again.";
		echo "<a href=\"userinfo.php?uid={$_SESSION['uid']}\"> Back </a><br>";
	}
	else{
		echo "You haven't logged in!  <a href=\"index.php\"> login </a><br>";
	}
?>