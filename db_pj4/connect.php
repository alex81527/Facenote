<?php
$host = "localhost";
$username = "dbuser";
$password = "dbuser";
$database = "db_9910029"; 
$con = mysqli_connect($host, $username, $password, $database);
if(mysqli_connect_errno($con)){
	echo "Fail to connect to MySQL: ".mysqli_connect_error();
}
?>