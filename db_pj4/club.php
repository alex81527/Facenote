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
			<h1>
			<?php  
				require('connect.php');
				$sql =" select * from club where club_id='{$_GET['club_id']}'";
				$result = mysqli_query($con, $sql) or die(mysqli_error($con));
				while($row =  mysqli_fetch_array($result)){echo $row['name'];}
			?></h1>
		</div>
	</div>
	<div id="page">
		<div id="content">
			<table border="0" width="100%" height="392">
				<tr>
					<td>
						<?php
						session_start();
						require('process.php');
						
						$sql =" select * from club where club_id='{$_GET['club_id']}'";
						$result = mysqli_query($con, $sql) or die(mysqli_error($con));
						while($row =  mysqli_fetch_array($result)){
							if($row['owner']==$_SESSION['uid'])
								echo "<a href=\"main.php?del_club=1&club_id={$_GET['club_id']}\"> Delete this club </a><br>";
						}
							
						echo "<a href=\"main.php\"> Back to Main </a>&nbsp<br><br>";
						?>
					</td> 
				</tr>
				<tr>
					<td>
						<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){?>
						<form action="club.php" method="get">
						Say something: <input type="text" name="club_msg" size="80" > <br>
						<input type="hidden" name="club_id" value=<?php echo $_GET['club_id']; ?>>
						<input type="submit" value="submit">
						</form>
						<?php }?>
					</td>
				</tr>
				<tr>
					<td>
						<?php
						if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && isset($_GET['club_id'])){ 		
						$sql ="(SELECT U.uid,U.name,A.content,A.time,A.postid,count(*) as \"like\"
								FROM users U,articles A,likes L,club_articles C
								WHERE  C.club_id = '{$_GET['club_id']}'
								and C.article_id = A.postid
								and A.uid = U.uid
								and A.postid = L.postid
								group by L.postid 
								)

								union 

								(SELECT U.uid,U.name,A.content,A.time,A.postid,count(*)-1 as \"like\"
								FROM users U,articles A,club_articles C
								WHERE  C.club_id = '{$_GET['club_id']}'
								and C.article_id = A.postid
								and A.uid = U.uid
								and A.postid not in  (select postid from likes)
								group by A.postid             
								)

								order by time desc
								";
						$result = mysqli_query($con, $sql) or die(mysqli_error($con));
						
						while($row =  mysqli_fetch_array($result)){//list all articles related to user and his friends
								echo "{$row['name']} said: <br>{$row['content']}<br>{$row['time']}
									  <br>{$row['like']} likes       ";	
								
								if($row['uid']==$_SESSION['uid']){//if he's the owner of this article, he has the right to delete it
									echo "<a href=\"club.php?club_id={$_GET['club_id']}&postid={$row['postid']}\"> like </a> ";
									if($row['like']>0){//check if user likes this post, if he does, then he has the right to dislike
										$sql4 =" select count(*) as \"count\" from likes where postid='{$row['postid']}' 
												and uid='{$_SESSION['uid']}'
										";
										$result4 = mysqli_query($con, $sql4) or die(mysqli_error($con));
										while($row4 =  mysqli_fetch_array($result4)){
											if($row4['count']>0){
												echo "<a href=\"club.php?club_id={$_GET['club_id']}&dislike_postid={$row['postid']}\"> dislike </a> ";
												break;
											}
										}
									}
									echo "<a href=\"club.php?club_id={$_GET['club_id']}&del_postid={$row['postid']}\"> delete </a> ";										
								}
								else {
									echo "<a href=\"club.php?club_id={$_GET['club_id']}&postid={$row['postid']}\"> like </a> \t";
									if($row['like']>0){//check if user likes this post, if he does, then he has the right to dislike
										$sql4 =" select count(*) as \"count\" from likes where postid='{$row['postid']}' 
												and uid='{$_SESSION['uid']}'
										";
										$result4 = mysqli_query($con, $sql4) or die(mysqli_error($con));
										while($row4 =  mysqli_fetch_array($result4)){
											if($row4['count']>0){
												echo "<a href=\"club.php?club_id={$_GET['club_id']}&dislike_postid={$row['postid']}\"> dislike </a> ";
												break;
											}
										}
									}			
								}
								//responses related to the article
								$sql2 =" select * from responses R,users U where R.article_id={$row['postid']} 
										and R.uid=U.uid
								      ";
								$result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
								while($row2 =  mysqli_fetch_array($result2)){
									echo "<br><font size=\"3\" color=\"0000FF\">{$row2['name']}&nbsp:&nbsp{$row2['response']} &nbsp&nbsp&nbsp{$row2['time']}</font>";
									
									//response_likes for the responses related to this article
									$sql3 =" select response_id,count(*) as \"like\" from responses_likes where response_id={$row2['response_id']} 
										  ";
									$result3 = mysqli_query($con, $sql3) or die(mysqli_error($con));
									while($row3 =  mysqli_fetch_array($result3)){
										echo "&nbsp<font size=\"3\" color=\"FF0000\">{$row3['like']} likes</font> &nbsp";
										echo "<a href=\"club.php?club_id={$_GET['club_id']}&response_id={$row2['response_id']}\"> like </a> ";
										
										if($row3['like']>0){//check if user likes this post, if he does, then he has the right to dislike
											$sql5 =" select count(*) as \"count\" from responses_likes where response_id='{$row2['response_id']}' 
													and uid='{$_SESSION['uid']}'
											";
											$result5 = mysqli_query($con, $sql5) or die(mysqli_error($con));
											while($row5 =  mysqli_fetch_array($result5)){
												if($row5['count']>0){
													echo "<a href=\"club.php?club_id={$_GET['club_id']}&dislike_response_id={$row2['response_id']}\"> dislike </a> ";
													break;
												}
											}
										}
										
									}//end while
									
									if($row2['uid']==$_SESSION['uid']){//if he's the owner of this response, then he has the right to delete the response
										echo "<a href=\"club.php?club_id={$_GET['club_id']}&del_response_id={$row2['response_id']}\"> delete </a> ";
									}
								} 
								//respond here
								echo "<br>";
								?> 
								<form action="club.php" method="get">
								Respond: <input type="text" name="respond" size="80" > <br>
								<input type="hidden" name="article_id" value= <?php echo $row['postid']; ?> >
								<input type="hidden" name="club_id" value=<?php echo $_GET['club_id'];?> >
								<input type="submit" value="submit">
								</form>
								
								<?php
								echo "<br><br>";
						}//end while 
						}//end if
						else{
							echo "<a href=\"userinfo.php\"}\"> User Info </a>&nbsp";  
							echo "<a href=\"logout.php\"> Log out </a><br><br><br><hr>";
							echo "Wrong password or you haven't logged in.<br>";
							echo "<a href=\"index.php\"> Try again </a>";
						}
						?>
					</td>
				</tr>
			</table>
		</div>
		<div id="sidebar">
			<div id="tbox1">
				<h2><font size=\"3\" color=\"0000FF\">Members</font></h2>
				<ul class="style2">
					<li class="first">
						<?php
							if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
							$sql =" select *
									from users U
									where U.uid in (select uid from club_member where club_id = '{$_GET['club_id']}')
							";
							$result = mysqli_query($con, $sql) ;
							while($row = mysqli_fetch_array($result)){
								echo "<li><h3><a href=\"userinfo.php?club_id={$_GET['club_id']}&uid={$row['uid']}\"> {$row['name']} </a></h3><br></li>";
							}	
							}						
						?>
				</ul>
				<h2><font size=\"3\" color=\"0000FF\">Clubs</font></h2>
				<ul class="style2">
					<li class="first">
						<?php
							if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
							$sql =" select *
									from club_member M, club C
									where M.uid ='{$_SESSION['uid']}' and M.club_id = C.club_id 
							";
							$result = mysqli_query($con, $sql) ;
							while($row = mysqli_fetch_array($result)){
								echo "<li><h3><a href=\"club.php?club_id={$row['club_id']}\"> {$row['name']} </a></h3><br></li>";
							}	
							}						
						?>
						<form action="club.php" method="get">
						Invite a Friend: <input type="text" name="invite_id" size="15" > <br>
						<input type="hidden" name="club_id" value=<?php echo $_GET['club_id'];?> >
						<input type="submit" value="submit">
						</form>
				</ul>
			</div>
		</div>
	</div>
	
	<div id="footer">
		<p>Copyright (c) 2013 Sitename.com. All rights reserved. Design by <a href="http://www.freecsstemplates.org">FCT</a>.</p>
	</div>
</div>

</body>

</html>