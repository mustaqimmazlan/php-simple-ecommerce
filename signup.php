<?php # Script 5 - register.php 

$page_title = 'Registration';
include('include/header.html');

// Check if the form has been submitted.
if (isset($_POST['submitted'])) {

require_once('mysqli_connect.php'); //Connect to db
		
	$errors = array(); // Initialize error array.
	
	// Check for a first name.
	if (empty($_POST['fname'])) {
		$errors[] = '<font color="red">You forgot to enter your first name.</font>';
	} else {
		$fname = $_POST['fname'];
	}
	
	// Check for a last name.
	if (empty($_POST['lname'])) {
		$errors[] = '<font color="red">You forgot to enter your last name.</font>';
	} else {
		$lname = $_POST['lname'];
	}
	
	if (empty($_POST['uname'])) {
		$errors[] = '<font color="red">You forgot to enter your username.</font>';
	} else {
		$uname = $_POST['uname'];
	}
	
	// Check for a password
	if (empty($_POST['pword'])) {
		$errors[] = '<font color="red">You forgot to enter your password.</font>';
	} else {
		$pword = $_POST['pword'];
	}
	
	// Check for a email
	if (empty($_POST['email'])) {
		$errors[] = '<font color="red">You forgot to enter your email.</font>';
	} else {
		$email = $_POST['email'];
	}	
	
	// Check for phone number
	if (empty($_POST['phone'])) {
		$errors[] = '<font color="red">You forgot to enter your phone number.</font>';
	} else {
		$phone = $_POST['phone'];
	}
	
	// Check for address
	if (empty($_POST['address'])) {
		$errors[] = '<font color="red">You forgot to enter your address.</font>';
	} else {
		$addrs = $_POST['address'];
	}										
		
	if (empty($errors)) { // If everything's okay.
	
		
		$result = @mysqli_query($dbc, "SELECT * FROM Customer WHERE email = '$email'");
		if (mysqli_num_rows($result) == 0) { 

			// Make the query.
			$query = "INSERT INTO Customer (First_Name, Last_Name, Username, Password, Email, Address, Phone_Number) VALUES ('$fname', '$lname', '$uname', md5('$pword'), '$email', '$addrs', '$phone')";		
			$result = mysqli_query ($dbc, $query); // Run the query.
			if ($result) { // If it ran OK.

				// Send an email, if desired.
				
				// Print a message.
				echo '<h1 id="mainhead">Thank you!</h1>
				<p>You are now registered.</p><p><br /></p>';	
			
				// Include the footer and quit the script (to not show the form).
				exit();
				
				} else { // If it did not run OK.
				echo '<h1 id="mainhead">System Error</h1>
				<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
				include ('./includes/footer.html'); 
				exit();
				} 
				
		} else { // Already registered.
			echo '<font color="red"><h1 id="mainhead">Error!</h1>
			<p class="error">The email address has already been registered.</p></font>';
		} 
		
	} else { // Report the errors.
	
		echo '<h1 id="mainhead">Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '<p><font color="red">Please try again.</font></p><br />';
		
	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.
		
} // End of the main Submit conditional.
?>
<section>
<div class="container">
<div id="content">
<h2>Register</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<p><b>First name:</b> <input type="text" name="fname" size="15" maxlength="15" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>" /></p>
	<p><b>Last name:</b> <input type="text" name="lname" size="15" maxlength="15" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>" /></p>
	<p><b>Username:</b> <input type="text" name="uname" size="15" maxlength="15" value="<?php if (isset($_POST['uname'])) echo $_POST['uname']; ?>" /></p>
	<p><b>Password:</b> <input type="password" name="pword" size="15" maxlength="30" value="<?php if (isset($_POST['pword'])) echo $_POST['pword']; ?>" /></p>
	<p><b>Email:</b> <input type="text" name="email" size="15" maxlength="30" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
	<p><b>Phone Number:</b> <input type="text" name="phone" size="15" maxlength="30" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>" /></p>
	<p><b>Address:</b><br/> <textarea name="address" cols="40" rows="5" ><?php if(isset($_POST['address'])) { echo htmlentities($_POST['address'], ENT_QUOTES); } ?></textarea></p>
	<input type="submit" name="submitted" value="Register" />
</form>
</div>
</div>
</section>
<?php
include_once ('include/footer.html');
?>
