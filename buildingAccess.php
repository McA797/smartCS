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

//connect to where the database resides, store connection in $link declared
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

//Set username variable of user loggedin
$username = $_SESSION['username'];


function filterTable($query){
	
	//connect to where the database resides, store connection in $link declared
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$result = mysqli_query($link, $query);	
	return $result;
}	

//Number of people currently in building
$numberQuery = "SELECT * FROM student_info WHERE inBuilding = '1'";
$numberResult = filterTable($numberQuery);
$numberOfStudents = mysqli_num_rows($numberResult);

if(isset($_GET['scan']))
{
	$query = "SELECT * FROM student_info WHERE number = '$username'";
	$search_result = filterTable($query);
	$row = mysqli_fetch_assoc($search_result);
	
	if($_GET['scan'] == "scanIn" && $row['inBuilding'] == 0)
	{
		$temperature = $row['temperature'];
		$covid = $row['covid'];
		$postCode = $row['postcode'];
			
		if($covid == 1)
		{
			$_SESSION['ID'] = 3;
			header("refresh:0, url=covidPositive.php");
		}
		else if($temperature > 37)
		{
			$_SESSION['ID'] = 3;
			header("refresh:0, url=covidTesting.php");
		}
		else if($postCode == "BT9")
		{
			echo $postCode;
			$_SESSION['ID'] = 3;
			header("refresh:0, url=covidPostCode.php");		
		}
		else 
		{
			$enterBuilding = "UPDATE student_info SET inBuilding = '1' WHERE student_info.number = '$username'";
			$entered = mysqli_query($link, $enterBuilding);
			header("refresh:0, url=buildingAccess.php");
		}
		
	}
	else if($_GET['scan'] == "scanOut" && $row['inBuilding'] == 1)
	{
		
		$exitBuilding = "UPDATE student_info SET inBuilding = '0' WHERE student_info.number = '$username'";
		$exited = mysqli_query($link, $exitBuilding);
		header("refresh:0, url=buildingAccess.php");
		
	}
}	

?>



<form action="" method="GET">


		<button class="scan scan1" name="scan" value="scanIn"><span>Scan In</span></button>
		<button class="scan scan2" name="scan" value="scanOut"><span>Scan Out </span></button>
	
	
</form>

<img class="logo" src="img/logo.jpg">	

<?php

	echo '<i class="numberStyle">';
	echo "There are currently " . $numberOfStudents . " people in the building";
	echo '</i>';

?>






</body>
</html>



