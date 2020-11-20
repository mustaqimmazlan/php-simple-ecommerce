<?php

session_start();

// grab data from index.php
$email = trim (htmlentities($_POST ['email']));
$password = trim (htmlentities($_POST ['password']));



// 1. connect to DB - include connection.inc.php
require_once ("mysqli_connect.php");

// 2. query data in database
$sql = "SELECT * FROM Customer WHERE Email like '$email'
		&& Password like md5('$password') ";

// echo $sql;

$result = mysqli_query($dbc, $sql);


if(mysqli_num_rows($result) <= 0) { // if no result found
	header("Location:index.php?mode=invalid");  // redirects to another index.php
	exit();
}


// fetch data from all columns
$row = mysqli_fetch_array($result);

// data to be sent to the other page - list_order.php
$_SESSION['userid'] = $row['Customer_ID'];
$_SESSION['First_Name'] = $row['First_Name'];
$_SESSION['Last_Name']=$row['Last_Name'];
$_SESSION['Username']=$row['Username'];
$_SESSION['Password']=$row['Password'];
$_SESSION['Email']=$row['Email'];
$_SESSION['Address']=$row['Address'];
$_SESSION['Phone_Number']=$row['Phone_Number'];



mysqli_close($dbc);

// 3. kalau data in db matched with data from users, 
// redirects to another page list_contacts.php

header("Location:album_catalog.php");

exit();


?>










