<html>

<head>
	<meta charset="utf-8">
	<meta name="description" content ="Example description content">
	<meta name ="viewport" content "width=device-width, initial-scale=1">
	<title>Student Page</title>
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

if(isset($_SESSION['ID']) && $_SESSION['ID'] == 2)
{
	$username = $_SESSION['username'];
	echo '<p class="impact">';
	echo "Welcome $username";
	echo '</p>';
}
else
{
	echo '<p class="impact">';
	echo "Session Error: Must log in";
	echo '</p>';
	session_regenerate_id(true);
	session_destroy();
	die();
}



?>

<form action="" method="GET">

	<p class="impact">Building Access or Room booking?</p>

	<div>
    <br><button name="redirect" type="submit" value="Access" class="button" style="vertical-align:middle"><span>Building Access</span></button></br>
	</div>
	<div>
    <br><button name="redirect" type="submit" value="Booking" class="button" style="vertical-align:middle"><span>Room Booking</span></button></br>
	</div>
</form>

</body>


</html>


<?php

if(isset($_GET['redirect']))
{
	switch($_GET['redirect']) {

		case 'Access': 
		
			header("refresh:0, url=buildingAccess.php");
					break;

	case 'Booking': 
		header("refresh:0, url=roomBooking.php");
				break;
	}
}

?>

