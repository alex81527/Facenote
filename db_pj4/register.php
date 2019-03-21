<?php
	require('connect.php');
	$duplicate=false;
	if($_POST['account']=="")
		echo "Account can't be blank! Please retry. <a href=\"index.php\"> Back </a><br>";
	else if($_POST['pw']=="")
		echo "Password can't be blank! Please retry. <a href=\"index.php\"> Back </a><br>";
	else if($_POST['name']=="")
		echo "Name can't be blank! Please retry. <a href=\"index.php\"> Back </a><br>";
	else if($_POST['email']=="")
		echo "Email can't be blank! Please retry. <a href=\"index.php\"> Back </a><br>";
	else if($_POST['birthday']=="")
		echo "Birthday can't be blank! Please retry. <a href=\"index.php\"> Back </a><br>";
	else if($_POST['pw']!=$_POST['pw2'])
		echo "Wrong password! Please retry. <a href=\"index.php\"> Back </a><br>";
	else
		{
		$pass = md5($_POST['pw']);
		$str="insert into users(uid,password,name,email,birthday,sex) 
		      values('{$_POST['account']}','{$pass}','{$_POST['name']}','{$_POST['email']}','{$_POST['birthday']}','{$_POST['sex']}')";
		$sql = "SELECT * FROM users
		WHERE uid='". mysqli_real_escape_string($con, $_POST['account'])."'";
		$result = mysqli_query($con, $sql) or die(mysqli_error($con));
		while($row = mysqli_fetch_array($result)){
			$duplicate=true;
		}//end while
			
		if($duplicate){
			echo "Duplicate Account! Please try again.";
			echo "<a href=\"index.php\"> Back </a><br>";
		}
		else{
			$result = mysqli_query($con, $str) or die(mysqli_error($con)." <a href=\"index.php\"> Please retry </a>");
			echo "User registerd successfully.";
			echo "<a href=\"index.php\"> Back </a><br>";
		} 
			
	}
?>