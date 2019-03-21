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
				<?php session_start(); 
				$_SESSION['logged_in'] = false;
				$_SESSION['first']=true;
				?>
				<table border="0" width="100%" height="318">
				<tr>
					<td>
						<font size=15>Login</font><br><br>
						<form action="main.php" method="post">
						Account: <input type="text" name="user"> <br>
						Password: <input type="password" name="pw"><br>
						<input type="submit" value="log in">
						</form>
					</td>
					<td>
						<font size=15>Register a new account</font><br><br>
						<form action="register.php" method="post">
						Account: <input type="text" name="account"> <br>
						Password: <input type="password" name="pw"><br>
						Password Again: <input type="password" name="pw2"><br>
						Name: <input type="text" name="name"> <br>
						Email: <input type="text" name="email"> <br>
						Birthday: <input type="text" value="yyyy-mm-dd" name="birthday"> <br>
						Sex: 
						<input type="radio" value='M' checked name="sex">Male
						<input type="radio" value='F' name="sex"> Female<p> 
						<input type="submit" value="sign up">
						</p>
						</form>
								
					</td>
				</tr>
				</table>
		</div>
		
	</div>
	
	<div id="footer">
		<p>Copyright (c) 2013 Sitename.com. All rights reserved. Design by <a href="http://www.freecsstemplates.org">FCT</a>.</p>
	</div>
</div>

</body>

</html>