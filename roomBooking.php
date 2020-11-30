<html>

<head>
	<meta charset="utf-8">
	<meta name="description" content ="Example description content">
	<meta name ="viewport" content "width=device-width, initial-scale=1">
	<title>Room Booking</title>
	<link rel="stylesheet" type="text/css" href="css\studentStyle.css">
	<style>
		table {
		font-family: Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 40%;
		position: absoulte;
		}

		td, th {
		  border: 1px solid #ddd;
		  padding: 8px;
		}

		tr {background-color: #d4d5d6;}

		tr:hover {background-color: #ddd;}

		th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: left;
		  background-color: #0b398c;
		  color: white;
		}
	</style>	
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

//connect to where the database resides, store connection in $link declared
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!$link){
		
		die('Could not connect' . mysql_error());
	}

if(isset($_GET['Submit']))
{
	$day = $_GET['day'];
	$time = $_GET['time'];
	$occupants = $_GET['occupancy'];
	
	$query = "SELECT * FROM rooms WHERE mOccupants LIKE '%$occupants%'";
	$search_result = filterTable($query);
}
else
{
	$query = "SELECT * FROM rooms";
	$search_result = filterTable($query);
	
}


function filterTable($query){
	
	//connect to where the database resides, store connection in $link declared
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$result = mysqli_query($link, $query);	
	return $result;
}	

?>


<form action="" method="GET">
	<div>
		<select id="Day" name="day" class = "inputBox">
			<option value = "Today"> Today </option>
			<option value = "Tomorrow"> Tomorrow </option>
		</select>
		<select id="Time" name="time" class = "inputBox">
			<option value = 9> 9-10am </option>
			<option value = 10> 10-11am </option>
			<option value = 11> 11-12am </option>
			<option value = 12> 12-1pm </option>
			<option value = 13> 1-2pm </option>
			<option value = 14> 2-3pm </option>
			<option value = 15> 3-4pm </option>
			<option value = 16> 4-5pm </option>
		</select>
		<select id="MaxOccupancy" name="occupancy" class="inputBox">
			<option value = ""> All occupancies </option>
			<option value = 2> 2 </option>
			<option value = 4> 4 </option>
			<option value = 6> 6 </option>
			<option value = 8> 8 </option>
		</select>
	</div>
	<br>	
	<input type="submit" value="Search" name="Submit" class="btn-login">
	</br>
	<br>
	<table>
		<tr>
			<th>ID</th>
			<th>Floor/Room</th>
			<th>Max Occupancy</th>
		</tr>
		<?php while($row = mysqli_fetch_array($search_result)) { ?>
		<tr>
			<td><?php echo $row['ID'] ?></td>
			<td><?php echo $row['Floor_Room'] ?></td>
			<td><?php echo $row['mOccupants'] ?></td>
		</tr>
		<?php } ?>
	</table>
	</br>
	
</form>





</body>


</html>