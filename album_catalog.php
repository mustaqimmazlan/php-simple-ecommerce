<?php



$page_title = 'Home';
include('include/header.html');
?>
    <style type="text/css">
      table {
  border-spacing: 30px;
  
}
td {
  
  padding: 20px;

}
    </style>

<div class="container">
<?php


require_once ('mysqli_connect.php'); // Connect to the database.

// Display all the URLs.
$query = "SELECT * FROM Album ";
$result = mysqli_query ($dbc, $query);
$i = 0; $trEnd = 0;
echo '<table>';
while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC)) {


            if($i == 0)
            {
                echo '<tr>';
            }
              echo '<td><a href="album.php?pid='.$row['Album_ID'].'">
                      <div><img width="200px" length="300px" src="uploads/'.$row['Imagename'].'"></div>
                      </a>
                  </td>';
            if($i == 2)
            {
              $i = 0; $trEnd = 1;
            }
            else
            {
               $trEnd = 0; 
               $i++;
            }
            if($trEnd == 1) 
            {
                echo '</tr>';
            }
   
} // End of while loop.
if($trEnd == 0) echo '</tr>';
echo '</table>';


mysqli_close($dbc); // Close the database connection.
include_once ('include/footer.html');
?>
