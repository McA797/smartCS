<?php
//Begin session 
ini_set('session.cookie_httponly', 'On');
ini_set('session.cookie_secure', 'On');
ini_set('session.use_cookies', 'On');
session_start();
//echo session_id();

define('DB_NAME', 'userinfo');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

function _escape($string)
{
	$estring = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	return $estring;
}

//If Login has been pressed name=submit
if (isset($_POST['Submit']))
{
	
	//Set session ID
	$_SESSION['ID'] = 1;
	
	//connect to where the database resides, store connection in $link declared
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	if(!$link){
		
		die('Could not connect' . mysql_error());
	}
	
	//Variables hold form inputs 
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	//sql query
	$sqlq = "SELECT * FROM student_info WHERE number = '$username' && password = '$password'";	
	//Database querey studentinfo 
	$resultsSet = mysqli_query($link, $sqlq);
	$row = mysqli_fetch_array($resultsSet);

	
	if($row['number'] == $username && $row['password'] == $password)
	{
		$ename = _escape($row['number']);
		echo "Login success" . $ename . "<br>";
		$_SESSION['ID'] = 2;
		header("refresh:2, url=studentPage.php");
		
	}
	 
	$link->close();
}

?>

<?php

require "header.php";

?>
	<div class="container">
		<img src="img/logoTest.png"/>
		
		<form action ="" method="POST">
			<div class="form-input">
				<input type="text" name="username" placeholder="Student no."/>	
			</div>
			<div class="form-input">
				<input type="password" name="password" placeholder="Password"/>
			</div>
				<input type="submit" value="Login" name= "Submit" class="btn-login"/>
		</form>
	
	</div>
