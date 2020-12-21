<html>

<head>
	<meta charset="utf-8">
	<meta name="description" content ="Example description content">
	<meta name ="viewport" content "width=device-width, initial-scale=1">
	<title>Building Access</title>
	<link rel="stylesheet" a href="css/studentStyle.css">
</head>	

<header>
	<nav>
		<ul>
			<li><a class="active white" href = "studentPage.php">Home</a></li>
			<li><a href = "logout.php">Logout</a></li>		
			<li><a href = "#">About</a></li>	
			<li><a href = "#">Help</a></li>						
		</ul>
	</nav>
	
</header>
<br><br><br><br>

<body>

<?php 
session_start();

define('DB_NAME', 'userinfo');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

//Set username variable of user loggedin
$username = $_SESSION['username'];

if(!isset($_SESSION['ID']) && $_SESSION['ID'] != 3)
{
	echo '<p class="impact">';
	echo "Session Error: Must log in";
	echo '</p>';
	session_regenerate_id(true);
	session_destroy();
	die();
}
else 
{
	echo '<p class="wave">';
	echo $username . " ------- YOU ARE COVID-19 POSITIVE"; 
	echo '<br><br>';
	echo "You have been identified as COVID-19 positive on the QUB system";
	echo '<br>';
	echo "PLEASE GO HOME AND SELF ISOLATE";  
	echo '</p>';
	
}

?>

<img class="covid" src="img/COVID19.jpg">
<img class="logo" src="img/logo.jpg">	


</body>
</html>

