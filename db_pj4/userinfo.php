<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Facenote</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700" rel="stylesheet" type="text/css" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>

<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="#">Facenote</a></h1>
		</div>
	</div>
	<div id="page">
		<div id="content">
			<?php
			session_start();
			if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
			require('connect.php');
			$sql =" select uid,name,birthday,email
					from users 
					where uid='{$_GET['uid']}'
				";
			$result = mysqli_query($con, $sql) or die(mysqli_error($con));
			while($row = mysqli_fetch_array($result)){
				echo "<font size=\"5\" color=\"0000FF\">{$row['name']}</font><br>";
				echo "ID: {$row['uid']}<br>";
				echo "Email: {$row['email']}<br>";
				echo "Birthday: {$row['birthday']}";
			}	
			
			echo "<br><br>";
			if( isset($_GET['club_id']) )
				echo "<a href=\"club.php?club_id={$_GET['club_id']}\"> Back to club</a><br>";
			else 
				echo "<a href=\"main.php\"> Back to main page</a><br>";
				
			echo "<a href=\"logout.php\"> Log out </a><br>";
			echo "<hr>";
			
			echo "<font size=\"5\" color=\"0000FF\"> Friends </font><br>";
			$sql =" select * from users U
					where U.uid in (select F.friend_id from friends F
					where F.uid = (select U.uid from users U where U.uid='{$_GET['uid']}'))
				  ";
			$result = mysqli_query($con, $sql) or die(mysqli_error($con));
			while($row = mysqli_fetch_array($result)){
				echo "<a href=\"userinfo.php?uid={$row['uid']}\"> {$row['name']} </a><br>";
			}
			}
			else {
				echo "You haven't logged in yet!<br>";
				echo "<a href=\"index.php\"> Login </a><br>";
			}
			?>
			<hr>
			<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {?>
			Add a new friend: <br>
			<form action="add_friend.php" method="post">
			friend ID: <input type="text" name="id"> <br>
			relationship: <input type="text" name="relationship"> <br>
			<input type="submit" value="submit">
			</form>
			Delete a friend: <br>
			<form action="del_friend.php" method="post">
			friend ID: <input type="text" name="id"> <br>
			<input type="submit" value="submit">
			</form>
			<form action="main.php" method="POST">
			friend ID: <input type="text" name="to_uid" size="15"> <br>
			Leave a message: <input type="text" name="to_content"> <br>
			<input type="submit" value="submit">
			</form>
			<?php }?>
		</div>
		
	</div>
	
	<div id="footer">
		<p>Copyright (c) 2013 Sitename.com. All rights reserved. Design by <a href="http://www.freecsstemplates.org">FCT</a>.</p>
	</div>
</div>

</body>

</html>