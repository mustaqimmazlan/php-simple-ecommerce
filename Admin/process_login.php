<?php

session_start();

// grab data from index.php
$email = trim (htmlentities($_POST ['username']));
$password = trim (htmlentities($_POST ['password']));



// 1. connect to DB - include connection.inc.php
require_once ("include/connection.inc.php");

// 2. query data in database
$sql = "SELECT * FROM admin WHERE Adm_email like '$email'
		&& Adm_password like '$password' ";

// echo $sql;

$result = mysqli_query($dbc, $sql);


if(mysqli_num_rows($result) <= 0) { // if no result found
	header("Location:index.php?mode=invalid");  // redirects to another index.php
	exit();
}


// fetch data from all columns
$row = mysqli_fetch_array($result);

// data to be sent to the other page - list_order.php
$_SESSION['userid'] = $row['Adm_ID'];
$_SESSION['fullname'] = $row['Adm_name'];


mysqli_close($dbc);

// 3. kalau data in db matched with data from users, 
// redirects to another page list_contacts.php

header("Location:list_user.php");

exit();


?>










