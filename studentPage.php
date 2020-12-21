<html>

<head>
	<meta charset="utf-8">
	<meta name="description" content ="Example description content">
	<meta name ="viewport" content "width=device-width, initial-scale=1">
	<title>Student Page</title>
	<link rel="stylesheet" href="css/studentStyle.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
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

	<div>
		<button class="button button1" style="vertical-align:middle" name="redirect" value="Access"><span>Building Access </span></button>
	</div>
		<button class="button button2"  style="vertical-align:middle" name="redirect" value="Booking"><span>Room Booking </span></button>
	<div>
		<button class="button button3" style="vertical-align:middle" name="redirect" value="Computers" ><span>Computer Booking </span></button>
	</div>
	
</form>


</body>

<img class="logo" src="img/logo.jpg">	

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
				
	case 'Computers': 
		header("refresh:0, url=computerBooking.php");
				break;			
	}
}

?>

