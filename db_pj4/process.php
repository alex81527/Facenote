<?php
if( isset($_SESSION['first']) && $_SESSION['first']){
	$_SESSION['username']="";
	if(isset($_POST['user']) && isset($_POST['pw'])){
		$sql = "SELECT * FROM users
		WHERE uid='". mysqli_real_escape_string($con, $_POST['user'])."'
		AND password='". mysqli_real_escape_string($con, md5($_POST['pw']))."'  ";
		$result = mysqli_query($con, $sql) or die(mysqli_error($con));
		while($row = mysqli_fetch_array($result)){
		$_SESSION['logged_in']= true;
		$_SESSION['first']= false;
		$_SESSION['uid']=$_POST['user'];
		$_SESSION['username']=$row['name'];
		}//end while
	}
}
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){//check if user logs in
	echo "<font size=\"5\" color=\"0000FF\"> Welcome {$_SESSION['username']} !!</font><br>";
	echo "<a href=\"userinfo.php?uid={$_SESSION['uid']}\"> User Info </a>&nbsp";
	echo "<a href=\"logout.php\"> Log out </a>&nbsp";
	echo "<a href=\"del_account.php\"> Delete my account </a><br><br><br><hr>";
}
if(isset($_GET['msg']) && $_GET['msg']!=""){//add new articles
	date_default_timezone_set("Asia/Taipei");
	$date = date("Y-m-d H:i:s",time());
	$time = time();

	$sql =" insert into articles(uid,postid,content,time)
			values('{$_SESSION['uid']}','{$time}','".mysqli_real_escape_string($con,$_GET['msg'])."','{$date}')
		";
	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
	$sql =" insert into main_articles(uid,article_id)
			values('{$_SESSION['uid']}','{$time}')
		";
	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
}
if(isset($_GET['club_msg']) && $_GET['club_msg']!="" && isset($_GET['club_id']) ){//add new club articles
	date_default_timezone_set("Asia/Taipei");
	$date = date("Y-m-d H:i:s",time());
	$time = time();

	$sql =" insert into articles(uid,postid,content,time)
			values('{$_SESSION['uid']}','{$time}','".mysqli_real_escape_string($con,$_GET['club_msg'])."','{$date}')
		";
	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
	$sql =" insert into club_articles(club_id,article_id)
			values('{$_GET['club_id']}','{$time}')
		";
	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
}
if(isset($_GET['postid'])){//likes for articles
	$sql = "insert into likes(postid,uid)
			values('{$_GET['postid']}','{$_SESSION['uid']}')
			";
	$result = mysqli_query($con, $sql) or die("you already liked it. <a href=\"main.php\"> Back </a>");
}
if(isset($_GET['del_postid'])){//delete articles
	$sql = "delete from articles
			where postid='{$_GET['del_postid']}'
	";
	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
}
if(isset($_GET['respond']) && $_GET['respond']!="" && isset($_GET['article_id']) && isset($_SESSION['uid'])){
	date_default_timezone_set("Asia/Taipei");//add responses
	$date = date("Y-m-d H:i:s",time());
	$time = time();
	$sql =" insert into responses(response_id,article_id,uid,response,time)
			values('{$time}','{$_GET['article_id']}','{$_SESSION['uid']}','".mysqli_real_escape_string($con,$_GET['respond'])."','{$date}')
	";
	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
}
if(isset($_GET['response_id']) && isset($_SESSION['uid']) ){//likes for responses
	$sql =" insert into responses_likes(response_id,uid)
			values('{$_GET['response_id']}','{$_SESSION['uid']}')
		";
	$result = mysqli_query($con, $sql)or die("you already liked it. <a href=\"main.php\"> Back </a>") ;
}
if(isset($_GET['del_response_id']) && isset($_SESSION['uid']) ){//delete reponses
	$sql =" delete from responses
			where response_id='{$_GET['del_response_id']}'
	";
	$result = mysqli_query($con, $sql) ;
}
if(isset($_GET['dislike_postid']) && isset($_SESSION['uid'])){//dislike articles
	$sql =" delete from likes
			where postid='{$_GET['dislike_postid']}' and uid='{$_SESSION['uid']}'
	";
	$result = mysqli_query($con, $sql) ;
}
if(isset($_GET['dislike_response_id']) && isset($_SESSION['uid'])){//dislike responses
	$sql =" delete from responses_likes
			where response_id='{$_GET['dislike_response_id']}' and uid='{$_SESSION['uid']}'
	";
	$result = mysqli_query($con, $sql) ;
}
if(isset($_GET['club_name']) && isset($_SESSION['uid'])){//create a club
	date_default_timezone_set("Asia/Taipei");
	$time = time();
	$sql =" insert into club(club_id,name,owner)
			values('{$time}','".mysqli_real_escape_string($con,$_GET['club_name'])."','{$_SESSION['uid']}')
	";
	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
	$sql =" insert into club_member(club_id,uid)
			values('{$time}','{$_SESSION['uid']}')
	";
	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
}
if(isset($_GET['invite_id']) && isset($_GET['club_id']) && isset($_SESSION['uid']) ){//invite a friend to a club
	$sql =" select count(*) as \"count\" from users where uid ='".mysqli_real_escape_string($con,$_GET['invite_id'])."'";
	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
	while($row = mysqli_fetch_array($result)){
		if( mysqli_real_escape_string($con,$_GET['invite_id'])==$_SESSION['uid'] ){
			echo "Can't add yourself!";
		}
		else if($row['count']>0){
			$sql2 =" insert into club_member(club_id,uid)
					values('{$_GET['club_id']}','".mysqli_real_escape_string($con,$_GET['invite_id'])."')
			";
			$result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
		}
		else{
			echo " User not Found ! ";
		}
	}
}
if(isset($_POST['to_uid']) && isset($_POST['to_content']) && isset($_SESSION['uid'])){//leave messages for friends
	date_default_timezone_set("Asia/Taipei");//add responses
	$date = date("Y-m-d H:i:s",time());
	
	$sql =" select count(*) as \"count\" from users where uid ='".mysqli_real_escape_string($con,$_POST['to_uid'])."'";
	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
	while($row = mysqli_fetch_array($result)){
		if($row['count']>0){
			$sql2 =" insert into message(from_uid,to_uid,content,date)
					values('{$_SESSION['uid']}','".mysqli_real_escape_string($con,$_POST['to_uid'])."','{$_POST['to_content']}','{$date}')
			";
			$result2 = mysqli_query($con, $sql2) ;
			echo "Message successfully sent!<br>";
		}
		else
			echo " User not Found ! ";
	}
}
if(isset($_GET['del_club']) && isset($_GET['club_id']) && isset($_SESSION['uid']) ){//delete a club
	$sql =" delete from club where club_id ='{$_GET['club_id']}'";
	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
	
	echo "Club successfully deleted!<br>";
}

?>