<?php

session_start ();

require_once 'include/connection.inc.php';

$Order_ID = $_POST['Order_ID'];

$Order_Status = $_POST ['Order_Status'] ;




$sql = "UPDATE `neworder` SET `Order_Status`='$Order_Status' WHERE`Order_ID` =$Order_ID;";

$result = mysqli_query($dbc, $sql);



mysqli_close($dbc);

header("Location:list_order.php");

?>








