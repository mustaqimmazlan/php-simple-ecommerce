<?php

session_start ();

require_once 'include/connection.inc.php';


$Customer_ID = $_POST['Customer_ID'];
$First_Name = $_POST ['First_Name'] ;
$Last_Name = $_POST ['Last_Name'] ;
$Username = $_POST ['Username'] ;
$Password = $_POST ['Password'] ;
$Email = $_POST ['Email'] ;
$Address = $_POST ['Address'] ;
$Phone_Number =  $_POST ['Phone_Number'] ;




//AES_ENCRYPT('$Password','salt'),



$sql="UPDATE `Customer` SET `First_Name`='$First_Name',`Last_Name`='$Last_Name',`Username`='$Username',`Password`='$Password',`Email`='$Email',`Address`='$Address',`Phone_Number`='$Phone_Number' WHERE `Customer_ID`=$Customer_ID;";

$result = mysqli_query($dbc, $sql);

mysqli_close($dbc);

header("Location:list_user.php");

?>








