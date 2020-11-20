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

$sql = "SELECT * FROM neworder WHERE Order_ID='$id'";



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
	
	<form action="process_edit_order.php" method="post">

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
				<td style="font-weight: bold; padding-bottom: 10px" align="right">Status</td>
				<td style="padding-bottom: 10px"><input type="text" name="Order_Status"
					id="Order_Status" value="<?php echo $row['Order_Status']; ?>" /></td>
			</tr>

			
			<tr>
				<td>&nbsp;</td>
				<td style="padding-bottom: 10px">
					<input type="hidden" name="Order_ID" value="<?php echo $row['Order_ID']; ?>">
					<input type="submit" name="con_submit" value="Save" /> 
					<input type="reset" name="con_reset" value="Reset" /> 
					<input type="button" value="Cancel" onclick="gotoList();" >
					
				</td>
			</tr>
		</table>
		</table>
	</form>
</body>
</html>
