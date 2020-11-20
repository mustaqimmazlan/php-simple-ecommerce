
<head>
	<title>Add Products</title>
</head>
<body>
<?php #  - add_product.php
// This page allows the administrator to add a product.

require_once ('../mysqli_connect.php'); // Connect to the database.

if (isset($_POST['submit'])) { // Handle the form.
	
	// Validate the product_name, image, price, and description.

	// Check for a product name.
	if (!empty($_POST['Album_name'])) {
		$an = escape_data($_POST['Album_name']);
	} else {
		$an = FALSE;
		echo '<p><font color="red">Please enter the product\'s name!</font></p>';
	}
	
	// Check for an image (not required).
	if (is_uploaded_file ($_FILES['image']['tmp_name'])) {
		if (move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/{$_FILES['image']['name']}")) { // Move the file over.

			echo '<p>The file has been uploaded!</p>';

		} else { // Couldn't move the file over.
			echo '<p><font color="red">The file could not be moved.</font></p>';
			$i = FALSE;
		}
		$i = $_FILES['image']['name'];
	} else {
		$i = FALSE;
		echo '<p><font color="red">Please choose the product\'s image!</font></p>';
	}
	
	// Check for a price.
	if (is_numeric($_POST['price'])) {
		$p = $_POST['price'];
	} else {
		$p = FALSE;
		echo '<p><font color="red">Please enter the product\'s price!</font></p>';
	}
	
	// Check for a description (not required).
	if (!empty($_POST['description'])) {
		$d = escape_data($_POST['description']);
	} else {
		$d = '<i>No description available.</i>';
	}
				
	
	if ($an && $p && $i) {
	
		// Add the print to the database.
		$query = "INSERT INTO Album (Name,Description,Imagename,Price) VALUES ('$an', '$d', '$i','$p')";
		if ($result = @mysqli_query ($dbc, $query)) { // Worked.
			echo '<p>The product has been added.</p>';
		} else { // If the query did not run OK.
			echo '<p><font color="red">Your submission could not be processed due to a system error.</font></p>'; 
		}
		
	} else { // Failed a test.
			echo '<br><p><font color="red">Please click "back" and try again.</font></p>';
			echo '<button onclick="history.go(-1);">Back </button>';
	}
	
} else { // Display the form.
?>
	
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="524288">

<fieldset><legend>Fill out the form to add a product to the catalog:</legend>
<p><b>Album Name:</b> <input type="text" name="Album_name" size="30" maxlength="60" /></p>
<p><b>Image:</b> <input type="file" name="image" /></p>
<p><b>Price: RM</b> <input type="text" name="price" size="10" maxlength="10" /><br /><small>Do not include the dollar sign or commas.</small></p>
<p><b>Description:</b><br/> <textarea name="description" cols="40" rows="5"></textarea></p>
</fieldset>
<div align="center"><input type="submit" name="submit" value="Submit" /></div>

</form><!-- End of Form -->
<?php
} // End of main conditional.
?>
</body>
</html>
