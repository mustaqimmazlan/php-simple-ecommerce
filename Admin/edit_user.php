<?php session_start (); ?>

<html>

<head>
<link rel="stylesheet" type="text/css" href="css/gaya.css">

<script type="text/javascript">

window.onload = function() {
	document.getElementById("invoiceno").focus();
};

function gotoList() {	
	window.location.href = "list_user.php";	
}


</script>

</head>

<?php


require_once 'include/connection.inc.php';
include_once 'include/header.html';

$fullname = $_SESSION ['fullname'];
$id = $_GET['userid'];


$sql = "SELECT Customer_ID, First_Name,Last_Name,Username,Password ,Email,Address,Phone_Number FROM Customer WHERE Customer_ID='$id'";


// echo $sql;

$result = mysqli_query($dbc,$sql);

$row = mysqli_fetch_array($result);

?>

<body>

	<hr>
	<h1 align="center">EDIT CUSTOMER </h1>
	<hr />

	<?php
	// paparkan "Hai, fullname!"
	echo "<h5> Hi, $fullname ! </h5>";
	?>
	
	<form action="process_edit_user.php" method="post">

		<table align="left">
			<tr>
				<td>
				<?php
				
					include_once 'include/menu_admin.html';
				
				?></td>
			</tr>
		</table>

		<table align="center">

			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">First Name</td>
				<td style="padding-bottom: 10px"><input type="text" name="First_Name"
					id="First_Name" value="<?php echo $row['First_Name']; ?>" /></td>
			</tr>

			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">Last Name</td>
				<td style="padding-bottom: 10px"><input type="text" name="Last_Name"
					id="Last_Name" value="<?php echo $row['Last_Name']; ?>"/></td>
			</tr>

			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">Username</td>
				<td style="padding-bottom: 10px"><input type="text" name="Username"
					id="Username" value="<?php echo $row['Username']; ?>"/></td>
			</tr>

			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">Password</td>
				<td style="padding-bottom: 10px"><input type="Password" name="Password"
					id="Password" value="<?php echo $row['Password']; ?>"/></td>
			</tr>

			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">Email</td>
				<td style="padding-bottom: 10px"><input type="text" name="Email"
					id="Email" value="<?php echo $row['Email']; ?>"/></td>
			</tr>

			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">Address</td>
				<td style="padding-bottom: 10px"><input type="text" name="Address"
					id="Address" value="<?php echo $row['Address']; ?>"/></td>
			</tr>

			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">Phone Number</td>
				<td style="padding-bottom: 10px"><input type="text" name="Phone_Number"
					id="Phone_Number" value="<?php echo $row['Phone_Number']; ?>"/></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td style="padding-bottom: 10px">
					<input type="submit" name="con_submit" value="Save" /> 
					<input type="reset" name="con_reset" value="Reset" /> 
					<input type="button" value="Cancel" onclick="gotoList();" >
					<input type="hidden" name="Customer_ID" value="<?php echo $row['Customer_ID']; ?>">
				</td>
			</tr>
		</table>
		</table>
	</form>
</body>
</html>
