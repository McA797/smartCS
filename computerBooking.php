<html>

<head>
	<meta charset="utf-8">
	<meta name="description" content ="Example description content">
	<meta name ="viewport" content "width=device-width, initial-scale=1">
	<title>Computer Booking</title>
	<link rel="stylesheet" type="text/css" href="css\studentStyle.css">
	<style>
		table {
		font-family: Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 70%;
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
			<li><a class="active white" href = "studentPage.php">Home</a></li>
			<li><a href = "logout.php">Logout</a></li>		
			<li><a href = "#">About</a></li>	
			<li><a href = "#">Help</a></li>						
		</ul>
	</nav>

</header>
<br><br><br><br>

<body>

<script>
function myFunction() {
  alert("Computer booked!");
}
</script>

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

//List of computers to chose from
$computerQuery = "SELECT * FROM computers";
$computer_result = filterTable($computerQuery);
$computerData   = $computer_result->fetch_all(MYSQLI_ASSOC);

if(!$link){
		
		die('Could not connect' . mysql_error());
	}

if(isset($_GET['searchComputers']))
{
	$day = $_GET['day'];
	$time = $_GET['time'];
	$computerName = $_GET['computer'];
	
	$query = "SELECT * FROM computer_bookings WHERE computer_name LIKE '%$computerName%' AND day LIKE'%$day' AND time LIKE '%$time' AND booked = '0'";
	$search_result = filterTable($query);
	$data   = $search_result->fetch_all(MYSQLI_ASSOC);
}
else
{
	$query = "SELECT * FROM computer_bookings WHERE booked = '0'";
	$search_result = filterTable($query);
	$data   = $search_result->fetch_all(MYSQLI_ASSOC);
	
}

if(isset($_GET['booking']))
{
	$bookingNumber = $_GET['booking'];
	$bookingDayVar = $_GET['bookingDay'];
	$bookingTimeVar = $_GET['bookingTime'];
	
    $username = $_SESSION['username'];
	
	$bookingQuery = "UPDATE computer_bookings SET booked= '$username' WHERE computer_bookings.computer_name = '$bookingNumber' 
	AND computer_bookings.day = '$bookingDayVar' AND computer_bookings.time = '$bookingTimeVar'";
	$setBooking = mysqli_query($link, $bookingQuery);
	
	//echo "<script>alert('Computer Booked!');</script>";
	
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
			<option value = ""> -- </option>
			<option value = "Today"> Today </option>
			<option value = "Tomorrow"> Tomorrow </option>
		</select>
		<select id="Time" name="time" class = "inputBox">
			<option value = ""> All slots </option>
			<option value = "9-10am"> 9-10am </option>
			<option value = "10-11am"> 10-11am </option>
			<option value = "11-12pm"> 11-12am </option>
			<option value = "12-1pm"> 12-1pm </option>
			<option value = "1-2pm"> 1-2pm </option>
			<option value = "2-3pm"> 2-3pm </option>
			<option value = "3-4pm"> 3-4pm </option>
			<option value = "4-5pm"> 4-5pm </option>
		</select>
		<select id="Computer" name="computer" class="inputBox">
			<option value = ""> All computers</option>
			<?php foreach($computerData as $row) { $computername = $row['computer_name'] ?>
			<option value = <?php echo $computername; ?> > <?php echo $row['computer_name']; ?> </option>
			<?php } ?>			
		</select>
	</div>
	<br>	
	<input type="submit" value="Search" name="searchComputers" class="btn-search">
</form>

</br>

	<table>
		<tr>
			<th>ID</th>
			<th>Computer</th>
			<th>Model</th>
			<th>Day</th>
			<th>Timeslot</th>
			<th>Book</th>
		</tr>
			<?php
			foreach($data as $row)
			{
				$booking = $row['computer_name']; $bookingDay = $row['day']; $bookingTime = $row['time'];
			?>
			<tr>
				<td><?php echo $row['ID'] ?></td>
				<td><?php echo $row['computer_name'] ?></td>
				<td><?php echo $row['model'] ?></td>
				<td><?php echo $row['day'] ?></td>
				<td><?php echo $row['time'] ?></td>
				<form action="" method="GET">	
					<input type="hidden" name="bookingDay"   value=<?php echo $bookingDay  ?>>
					<input type="hidden" name="bookingTime"  value=<?php echo $bookingTime ?>>
					<td><button onclick="myFunction()" name="booking" type="submit" value=<?php echo $booking;    ?>><span>Book</span></button></td>
				</form>
			</tr>
			<?php
			}
			?>
	</table>
	</br>
	
	<img class="logo" src="img/logo.jpg">	

</body>


</html>