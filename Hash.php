<html>

<head>
<meta charset = "utf-8">
<title> Password hasher </title>
</head>

<body>

<H1>Password hashes</H1>

</body>


</html>



<?php

	$hash = password_hash('Test', PASSWORD_DEFAULT);
	echo "$hash = Test";
	
	$hash = password_hash('Test2', PASSWORD_DEFAULT);
	echo "$hash = Test2";
	
	$hash = password_hash('Test3', PASSWORD_DEFAULT);
	echo "$hash = Test3";
	
	$hash = password_hash('Test4', PASSWORD_DEFAULT);
	echo "$hash = Test4";
	
		$hash = password_hash('Test5', PASSWORD_DEFAULT);
	echo "$hash = Test5";

	$hash = password_hash('Test6', PASSWORD_DEFAULT);
	echo "$hash = Test6";

	$hash = password_hash('Test7', PASSWORD_DEFAULT);
	echo "$hash = Test7";

	$hash = password_hash('Test8', PASSWORD_DEFAULT);
	echo "$hash = Test8";



?>