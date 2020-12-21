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
<br><br><br><br><br>

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
	//echo '<div class="container">';
	echo '<p class="wave">';
	echo $username . " ------- YOU HAVE A HIGH TEMPERATURE"; 
	echo '<br><br>';
	echo "You will be able to access the building upon results of a negative COVID-19 test";
	echo '<br>';
	echo "Please book a test at queens using the feature below:"; 
	echo '</p>';
	//echo '<div>';
	
	echo "<centre><br>";
	echo '<input type="button" class = "button button1" value="Book a test "onclick="window.location=\'https://www.qub.ac.uk/home/coronavirus-faqs/asymptomatic-testing/\'">';
	
}

?>

<img class="logo" src="img/logo.jpg">

</body>
</html>

