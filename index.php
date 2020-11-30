<?php
//Begin session 
ini_set('session.cookie_httponly', 'On');
ini_set('session.cookie_secure', 'On');
ini_set('session.use_cookies', 'On');

session_start();

define('DB_NAME', 'userinfo');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

function _escape($string)
{
	$estring = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	return $estring;
}

if (isset($_SESSION["locked"]))
{
	$difference = time() - $_SESSION["locked"];
	if($difference>10)
	{
		unset($_SESSION["locked"]);
		unset($_SESSION["login_attempts"]);
	}
}

if (!isset($_SESSION["login_attempts"]))
{
	$_SESSION["login_attempts"] = 0;
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
	$sqlq = "SELECT * FROM student_info WHERE number = '$username'";	
	$result = mysqli_query($link, $sqlq);
	
	//If username exists 
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_object($result);
		
		if(password_verify($password, $row->password))
		{
			echo "Login success" . $row->number . "<br>";
			$_SESSION["login_attempts"] = 0;
			$_SESSION['ID'] = 2;
			$_SESSION['username'] = $row->number;
			header("refresh:0, url=studentPage.php");
		}
		else 
		{	
			$_SESSION["login_attempts"] += 1;
			$_SESSION["error"] = "Incorrect password";
		}
	} 
	else 
	{
		$_SESSION["login_attempts"] += 1;
		$_SESSION["error"] = "User Not found!";	
	}

}

?>

<?php

require "header.php";

?>
	<div class="container">
		<img src="img/logoTest.png"/>
		
		<?php if(isset($_SESSION["error"])){?>
		<p style="color:red;"><?=$_SESSION["error"]; ?></p>
		<?php unset($_SESSION["error"]); } ?>
		
		<form action ="" method="POST">
			<div class="form-input">
				<input type="text" name="username" placeholder="Student no."/>	
			</div>
			<div class="form-input">
				<input type="password" name="password" placeholder="Password"/>
			</div>
			
				<?php	
					if($_SESSION["login_attempts"]>4)
					{
						$_SESSION["locked"] = time();
						echo '<p style="color:red;font-size:20px;font-family: Arial, Helvetica, sans-serif;">
						Locked out for 10 seconds! </p> ';
					}
					else{
					?> 	<input type="submit" value="Login" name= "Submit" class="btn-login"/>
					<?php } ?>
			
		</form>
	
	</div>


</body>
</html>