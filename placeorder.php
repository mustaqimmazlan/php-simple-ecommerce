<?php
session_start();

require_once ('mysqli_connect.php');

$First_Name = $_POST['First_Name'];
$Last_Name = $_POST['Last_Name'];
$Email = $_POST['Email'];
$Phone_Number = $_POST['Phone_Number'];
$Address= $_POST['Address'];
$Total_Price= $_SESSION['total'];

$query = "INSERT INTO neworder (First_Name,Last_Name,Email,Phone_Number,Address,Total_Price,Order_date,Order_Status) VAlUES 
			('$First_Name','$Last_Name','$Email','$Phone_Number','$Address','$Total_Price',now(),'pending')";

$result = @mysqli_query($dbc,$query);

mysqli_close($dbc);
session_destroy();
header("Location:index.php");

?>
