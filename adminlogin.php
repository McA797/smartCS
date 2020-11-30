<?php

require "headerAdmin.php";

?>

<main>

	<div class="container">
		<img src="img/logoTest.png"/>
		
		<form action ="staffValidation.php" method="GET">
			<div class="form-input">
				<input type="text" name="username" placeholder="Staff no."/>	
			</div>
			<div class="form-input">
				<input type="password" name="password" placeholder="Password"/>
			</div>
				<input type="submit" value="Login" name= "submit" class="btn-login"/>
		</form>
	
	</div>
	
</main>


<?php

require "footer.php";

?>