<?php
include('include/header.html'); # Script 9.10 - login.php (4th version after Scripts 9.1, 9.3 & 9.6)
// Send NOTHING to the Web browser prior to the session_start() line!

// Check if the form has been submitted.

?>
<section>
<div class="container">
<h2>Login</h2>
<form action="process_login.php" method="post">
	<p>Email Address: <input type="text" name="email" size="20" maxlength="40" /> </p>
	<p>Password: <input type="password" name="password" size="20" maxlength="20" /></p>
	<p><input type="submit" name="submit" value="Login" /></p>
	<input type="hidden" name="submitted" value="TRUE" />

</form>
<form action="signup.php">
    <input type="submit" value="Sign Up" />
</form>
</div>
</section>
<?php
include_once ('include/footer.html');
?>
