<html>

<?php

if (! empty ( $_GET ['userid'] )) {
	switch ($_GET ['userid']) {
		case "invalid" :
			echo "<h3 style='color:red;'> Invalid login. 
						Please try again.</h3>";
			break;
		
		case "logout" :
		echo "<h3 style='color:green;'> Successfully logged out</h3>";
			break;
	}
}

?>

<body>

	<img alt="Ini adalah banner" src="http://www.mojo4music.com/assets/img/logo.svg?9ab822" width="100%"
		height="130">


	<hr>
	<h1 align="center">ADMIN LOGIN</h1>
	<hr>


	<form action="process_login.php" method="post">

		<table align="center">

			<tr>
				<td>Username</td>
				<td><input type="text" name="username"></td>
			</tr>

			<tr>
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>

			<tr>
				<td align="center" colspan="2"><input type="submit" name="login"
					value="Login"> <input type="reset" name="reset" value="Reset"></td>
				<td>&nbsp;</td>
			</tr>

		</table>

	</form>





</body>

</html>

<?php
?>