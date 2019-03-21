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
			<h1>Facenote</h1>
		</div>
	</div>
	<div id="page">
		<div id="content">
			<table border="0" width="100%" height="392">
				<tr>
					<td>
						<?php
						session_start();
						require('connect.php');
						?>
						<a href="main.php"> Back to Main </a><br>
					</td> 
				</tr>
				<tr>
					<td>
						<?php
						if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && isset($_SESSION['uid'])){
							$sql =" select *  from message M,users U where to_uid='{$_SESSION['uid']}' 
									and U.uid = M.from_uid  
									order by date desc";
							$result = mysqli_query($con, $sql) or die(mysqli_error($con));
							while($row =  mysqli_fetch_array($result)){
								echo "{$row['name']} said: <br>{$row['content']}<br>{$row['date']}<br><br>";
							}
						}
						?>
					</td>
				</tr>
			</table>
		</div>
		<div id="sidebar">
			
		</div>
	</div>
	
	<div id="footer">
		<p>Copyright (c) 2013 Sitename.com. All rights reserved. Design by <a href="http://www.freecsstemplates.org">FCT</a>.</p>
	</div>
</div>

</body>

</html>