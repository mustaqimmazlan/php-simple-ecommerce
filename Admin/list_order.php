<?php 
session_start ();
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/gaya.css">

<script type="text/javascript">

function delUser(userid)
{
	if (confirm("Are you sure you want to delete?"))
	{
		window.location.href = 'list_order?delUser=' + userid;
		return true;
	} else {
		return false;
	}
}
</script>

</head>

<?php


require_once ("include/header.html");
require_once ("include/connection.inc.php");

echo "<table align='left'>";
echo "<tr>";
echo "<td>";
include ("include/menu_admin.html");
echo "</td>";
echo "</tr>";

?>

<h1 align="center">LIST OF ORDER</h1>
<hr />

<?php
$fullname = $_SESSION ['fullname'];

echo "<h5>";
echo "Hi, " . $fullname . " !";
echo "</h5>";
?>

<body>
	<?php
	
	// ************************************* PAGINATION ******************************************************
	
	// Number of records to show per page:
	$display = 10;
	
	// Determine how many pages there are...
	if (isset ( $_GET ['p'] ) && is_numeric ( $_GET ['p'] )) { // Already been determined.
		
		$pages = $_GET ['p'];
	} else { // Need to determine.
	         
		// Count the number of records:
		$q = "SELECT COUNT(Order_ID) FROM neworder";
		
		$r = mysqli_query ( $dbc, $q );
		$row = mysqli_fetch_array ( $r, MYSQLI_NUM );
		$records = $row [0];
		
		// Calculate the number of pages...
		if ($records > $display) { // More than 1 page.
			$pages = ceil ( $records / $display );
		} else {
			$pages = 1;
		}
	} // End of p IF.
	  
	// Determine where in the database to start returning results...
	if (isset ( $_GET ['s'] ) && is_numeric ( $_GET ['s'] )) {
		$start = $_GET ['s'];
	} else {
		$start = 0;
	}
	
	// ***********************************************************************************************
	
	echo '<table style="border: solid 2px black;" cellspacing="0" cellpadding="10" align="center">
			<tr id="header">';
	
	echo '
			<td align="left"><b>Order ID</b></td>
			<td align="left"><b>First Name</b></td>
			<td align="left"><b>Last Name</b></td>
			<td align="left"><b>Email</b></td>
			<td align="left"><b>Phone Number</b></td>
			<td align="left"><b>Address</b></td>
			<td align="left"><b>Total Price</b></td>
			<td align="left"><b>Date</b></td>
			<td align="left"><b>Status</b></td>
			
			<td align="left">&nbsp;</td>
			</tr>';
	


$sql = "SELECT Order_ID,First_Name,Last_Name,Email,Phone_Number,Address,Total_Price,Order_date,Order_Status
		    FROM neworder ORDER BY Order_ID";
	
	$res = mysqli_query ( $dbc, $sql );
	
	if (mysqli_num_rows ( $res ) <= 0) {
		echo '<tr>
				<td> No data found </td>
				</tr>';
	}
	
	$bg = '#eeeeee'; // Set the initial background color.
	
	while ( $row = mysqli_fetch_array ( $res ) ) {
		$bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee'); // Switch the background color.
		
		echo '<tr bgcolor="' . $bg . '">
			<td> ' . $row ['Order_ID'] . ' </td>
			<td> ' . $row ['First_Name'] . ' </td>
			
			<td> ' . $row ['Last_Name'] . ' </td>
			<td> ' . $row ['Email'] . ' </td>
			<td> ' . $row ['Phone_Number'] . ' </td>
			<td> ' . $row ['Address'] . ' </td>
			<td> ' . $row ['Total_Price'] . ' </td>
			<td> ' . $row ['Order_date'] . ' </td>
			<td> ' . $row ['Order_Status'] . ' </td>
			

			<td>
			<a href="edit_order.php?userid=' . $row ['Order_ID'] . '">
				<img src="images/edit.jpg" width="15px" height="15px" title ="Edit user" /></a>
			
			<a href="delete_order.php?userid=' . $row ['Order_ID'] . '" onclick="return deleteUser('.$row['Order_ID'].');">
				<img src="images/delete.jpg" width="15px" height="15px" title ="Delete user"/></a>
			</td>
			</tr>';
	}
	echo '</table>';
	
	mysqli_free_result ( $res );
	mysqli_close ( $dbc );
	
	// Make the links to other pages, if necessary.
	if ($pages > 1) {
		
		echo '<br /><p>';
		
		$current_page = ($start / $display) + 1;
		
		// If it's not the first page, make a Previous button:
		if ($current_page != 1) {
			echo '<a href="list_order.php?s=' . ($start - $display) . '&p=' . $pages . '">Previous</a> ';
		}
		
		// Make all the numbered pages:
		for($i = 1; $i <= $pages; $i ++) {
			if ($i != $current_page) {
				echo '<a href="list_order.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '">' . $i . '</a> ';
			} else {
				echo $i . ' ';
			}
		} // End of FOR loop.
		  
		// If it's not the last page, make a Next button:
		if ($current_page != $pages) {
			echo '<a href="list_order.php?s=' . ($start + $display) . '&p=' . $pages . '">Next</a>';
		}
		echo '</p>'; // Close the paragraph.
	} // End of links section.
	exit ();
	
	?>
</body>
</html>
