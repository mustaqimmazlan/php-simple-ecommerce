<?php 
session_start ();
?>

<html>

<head>

<link rel="stylesheet" type="text/css" href="css/gaya.css">

<script type="text/javascript">

window.onload = function() {
	document.getElementById("fullname").focus();
};

function gotoList() {	
	window.location.href = "list_user.php";	
}

</script>
</head>

<?php


require_once 'include/connection.inc.php';
include_once 'include/header.html';

$userid = $_SESSION ['userid'];
$fullname = $_SESSION ['fullname'];


?>

<body>

	<hr>
	<h1 align="center">NEW CUSTOMER REGISTRATION</h1>
	<hr />
	
	<?php
	// paparkan "Hai, fullname!"
	echo "<h5> Hi, $fullname ! </h5>";
	?>

	<form action="process_new_user.php" method="post">

		<table align="left">
			<tr>
				<td>
				<?php
				
				// masukkan menu untuk admin dan staff
				include_once 'include/menu_admin.html';
				
				
				?></td>
			</tr>
		</table>

		<table align="center">

			
			
			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">First Name</td>
				<td style="padding-bottom: 10px"><input type="text" name="First_Name"
					id="First_Name" /></td>
			</tr>

			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">Last Name</td>
				<td style="padding-bottom: 10px"><input type="text" name="Last_Name"
					id="Last_Name" /></td>
			</tr>

			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">Username</td>
				<td style="padding-bottom: 10px"><input type="text" name="Username"
					id="Username" /></td>
			</tr>

			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">Password</td>
				<td style="padding-bottom: 10px"><input type="Password" name="Password"
					id="Password" /></td>
			</tr>

			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">Email</td>
				<td style="padding-bottom: 10px"><input type="text" name="Email"
					id="Email" /></td>
			</tr>

			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">Address</td>
				<td style="padding-bottom: 10px"><input type="text" name="Address"
					id="Address" /></td>
			</tr>

			<tr>
				<td style="font-weight: bold; padding-bottom: 10px" align="right">Phone Number</td>
				<td style="padding-bottom: 10px"><input type="text" name="Phone_Number"
					id="Phone_Number" /></td>
			</tr>
			

			
			<tr>
				<td>&nbsp;</td>
				<td style="padding-bottom: 10px"><input type="submit"
					name="con_submit" value="Save" /> <input type="reset"
					name="con_reset" value="Reset" /> <input type="button"
					value="Cancel" onclick="gotoList();" /></td>
			</tr>
		</table>
		</table>
	</form>
</body>
</html>
