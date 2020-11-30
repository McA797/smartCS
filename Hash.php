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
	echo "$hash = Test"


?>