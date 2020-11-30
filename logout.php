<?php
session_start();

if(isset($_SESSION['ID']))
{
	session_regenerate_id(true);
	session_destroy();
	header("refresh:0, url=index.php");
}
else
{
	header("refresh:0, url=index.php");
}




?>