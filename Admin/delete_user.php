<?php

session_start();

require_once 'include/connection.inc.php';

$userid = $_GET['userid'];

$sql = "DELETE FROM Customer WHERE `Customer_ID` = $userid";

if(!mysqli_query($dbc, $sql)) {
	die("Error. Data cannot be deleted.");
}

mysqli_close($dbc);

header("Location:list_order.php?mode=delete");

exit();
?>