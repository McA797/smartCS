<html>

<head>
	<meta charset="utf-8">
	<meta name="description" content ="Example description content">
	<meta name ="viewport" content "width=device-width, initial-scale=1">
	<title>Building Access</title>
	<link rel="stylesheet" a href="css\studentStyle.css">
</head>	

<header>
	<nav>
		<ul>
			<li><a href = "index.php">Home</a></li>
			<li><a href = "logout.php">Logout</a></li>		
			<li><a href = "#">About</a></li>	
			<li><a href = "#">Help</a></li>						
		</ul>
	</nav>
</header>

<body>


<?php 
session_start();

if(!isset($_SESSION['ID']) && $_SESSION['ID'] != 2)
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
	echo '<p class="impact">';
	echo "BUILDING ACCESS SYSTEM";
	echo '</p>';
	
}

?>