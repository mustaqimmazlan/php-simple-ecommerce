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
		window.location.href = 'list_album?delUser=' + userid;
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

<h1 align="center">LIST OF ALBUM</h1>
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
		$q = "SELECT COUNT(Customer_ID) FROM Customer";
		
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
			<td align="left"><b>Album ID</b></td>
			<td align="left"><b>Name</b></td>
			<td align="left"><b>Description</b></td>
			<td align="left"><b>Imagename</b></td>
			<td align="left"><b>Price</b></td>
			
			<td align="left">&nbsp;</td>
			</tr>';
	


$sql = "SELECT Album_ID, Name, Description, Imagename, Price 
		    FROM Album ORDER BY Name";
	
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
			<td> ' . $row ['Album_ID'] . ' </td>
			<td> ' . $row ['Name'] . ' </td>
			<td> ' . $row ['Description'] . ' </td>
			<td> ' . $row ['Imagename'] . ' </td>
			<td> ' . $row ['Price'] . ' </td>
			

			<td>
			
			<a href="delete_album.php?userid=' . $row ['Album_ID'] . '" onclick="return deleteUser('.$row['Album_ID'].');">
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
			echo '<a href="list_album.php?s=' . ($start - $display) . '&p=' . $pages . '">Previous</a> ';
		}
		
		// Make all the numbered pages:
		for($i = 1; $i <= $pages; $i ++) {
			if ($i != $current_page) {
				echo '<a href="list_album.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '">' . $i . '</a> ';
			} else {
				echo $i . ' ';
			}
		} // End of FOR loop.
		  
		// If it's not the last page, make a Next button:
		if ($current_page != $pages) {
			echo '<a href="list_album.php?s=' . ($start + $display) . '&p=' . $pages . '">Next</a>';
		}
		echo '</p>'; // Close the paragraph.
	} // End of links section.
	exit ();
	
	?>
</body>
</html>
