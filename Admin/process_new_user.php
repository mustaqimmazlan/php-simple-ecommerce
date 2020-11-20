<?php

session_start ();

require_once 'include/connection.inc.php';

$userid = $_SESSION ['userid'];

$First_Name = trim ( $_POST ['First_Name'] );
$Last_Name = trim ( $_POST ['Last_Name'] );
$Username = trim ( $_POST ['Username'] );
$Password = trim ( $_POST ['Password'] );
$Email = trim ( $_POST ['Email'] );
$Address = trim ( $_POST ['Address'] );
$Phone_Number = trim ( $_POST ['Phone_Number'] );


$sql = "INSERT INTO Customer (First_Name,Last_Name,Username,Password,Email,Address,Phone_Number) 
		VALUES ('$First_Name', '$Last_Name', '$Username', AES_ENCRYPT('$Password','salt'), 
		'$Email', '$Address','$Phone_Number')";

// echo $sql;

$result = @mysqli_query($dbc, $sql);

mysqli_close($dbc);

header("Location:list_user.php");

?>








