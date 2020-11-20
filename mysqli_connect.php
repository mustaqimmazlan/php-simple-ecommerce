<?php #  mysql_connect.php

// This file contains the database access information for the database.
//This file also establishes a connection to MySQL and selects the database.

// Set the database access information as constants.
define ('DB_USER', 'root');
define ('DB_PASSWORD', 'root');
define ('DB_HOST', 'localhost');
define ('DB_NAME', 'mojomusic');

// Make the connnection and then select the database.
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD) OR die ('Could not connect to MySQL: ' . mysqli_error() );
mysqli_select_db ($dbc, DB_NAME) OR die ('Could not select the database: ' . mysqli_error() );

// Function for escaping and trimming form data.
function escape_data ($data) { 
	global $dbc;
	if (ini_get('magic_quotes_gpc')) {
		$data = stripslashes($data);
	}
	return mysqli_real_escape_string ($dbc, trim ($data));
} // End of escape_data() function.
?>
