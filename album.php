<?php
$page_title = 'Home';
include('include/header.html');
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
        <link rel="stylesheet" type="text/css" href="CSS/album.css">
        <style type="text/css">
            
            td {padding-top: 40px; }
        
        </style>

<section>
    <div class="container">
<?php
if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
{
    echo 'The Product has been added to your cart.<br>'; 
    echo '<a href="view_cart.php">View Cart</a>';
   
   
    $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
    echo '</form>';
    echo '</div>';

}
?>
</div>
</section>
<section>
<div class="container" >



<?php 

if (is_numeric ($_GET['pid'])) { // Make sure there's a print ID.
    
    require_once ('mysqli_connect.php'); // Connect to the database.
    $query = "SELECT * FROM Album WHERE Album_ID = {$_GET['pid']} ";
    $result = mysqli_query ($dbc, $query);
    $row = mysqli_fetch_array ($result, MYSQLI_ASSOC);
    // Set the page title and include the HTML header.
    $name = $row['Name'];
    $price = $row['Price'];
    $description = $row['Description'];
    $id= $row['Album_ID'];
    
    echo '<table>
            <tr>
            <td><img width="300px" length="500px" src="uploads/'.$row['Imagename'].'"></td>
                ';
    

   
 mysqli_close($dbc); // Close the database connection.
} else { // Redirect
    header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/index.php");
    exit();
}

?>

        <td >
            <h2><?php echo "$name"; ?> </h2>
            <h1><span>RM <?php echo "$price"; ?></span></h1>
            <p><span><?php echo "$description"; ?></span></p>
            <form action="addtocart_process.php" method="post" >
                <input type="text" name="quantity" maxlength="2" size="2" value="1" >
                <input type="hidden" name="type" value="add" >
                <input type="hidden" name="id" value="<?php echo $id ?> ">
                <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
                <button type="submit" class="buttonbeli">Add</button></div>
               
            </form>
            <hr>
            <p>Category: <a href="" rel="tag"> Compact Disc</a></p>
        </td>
    </tr> 
</table>


</div>  
</section> 
</div>
<?php
include_once ('include/footer.html');
?>
