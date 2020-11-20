<?php
session_start();
include('include/header.html');

if (isset($_SESSION['First_Name'])) {
	$First_Name = $_SESSION['First_Name'];
}

if (isset($_SESSION['Last_Name'])) {
	$Last_Name = $_SESSION['Last_Name'];
}
if (isset($_SESSION['Email'])) {
	$Email = $_SESSION['Email'];
}
if (isset($_SESSION['Address'])) {
	$Address = $_SESSION['Address'];
}
if (isset($_SESSION['Phone_Number'])) {
	$Phone_Number = $_SESSION['Phone_Number'];
}
$shipping_cost      = 1.50;

?>
 <link rel="stylesheet" type="text/css" href="CSS/album.css">
<div class="container">

<section>
	<div class="container">
		<fieldset><legend>Billing Info</legend>
			<form action="placeorder.php" method="post">
				<p>First Name: <input type="text" name="First_Name" value="<?php
				if (isset($_SESSION['First_Name'])) { echo "$First_Name" ;} ?>"></p>
				<p>Last Name: <input type="text" name="Last_Name" value="<?php
				if (isset($_SESSION['Last_Name'])) { echo "$Last_Name" ;} ?>"></p>
				<p>Email: <input type="text" name="Email" value="<?php
				if (isset($_SESSION['Email'])) { echo "$Email" ;} ?>"></p>
				<p>Phone Number: <input type="text" name="Phone_Number" value="<?php
				if  (isset($_SESSION['Phone_Number'])) { echo "$Phone_Number" ;}?>"></p>
				<p>Address: <br>
				<textarea name="Address" cols="40" rows="5" ><?php
				if (isset($_SESSION['Address'])) { echo "$Address" ;} ?> </textarea></p>
				
				<input  type="submit" value="Place Order" class="buttonbeli">

			</form>
		</fieldset>
	</div>
</section>
<section>
	<div class="container">
		<fieldset><legend>Your Order</legend>
			<form method="post" action="addtocart_process.php">
<table width="100%"  cellpadding="6" cellspacing="0"><thead><tr><th>Quantity</th><th>Name</th><th>Price</th><th>Total</th><th>Remove</th></tr></thead>
  <tbody>
 	<?php
	if(isset($_SESSION["cart_products"])) //check session var
    {
		$total = 0; //set initial total value
		$b = 0; //var for zebra stripe table 
		foreach ($_SESSION["cart_products"] as $cart_itm)
        {
			//set variables to use in content below
			$product_id = $cart_itm["id"];
			$product_name = $cart_itm["product_name"];
			$product_qty = $cart_itm["quantity"];
			$product_price = $cart_itm["product_price"];
	
			$subtotal = ($product_price * $product_qty); //calculate Price x Qty
			
		   	$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 
		    echo '<tr class="'.$bg_color.'">';
			echo '<td>'.$product_qty.'</td>';
			echo '<td>'.$product_name.'</td>';
			echo '<td>'.$product_price.'</td>';
			echo '<td>'.$subtotal.'</td>';
			echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_id.'" /></td>';
            echo '</tr>';
			$total = ($total + $subtotal); //add subtotal to total var
        }
		
		$grand_total = $total + $shipping_cost; //grand total including shipping cost


		
		$_SESSION["total"] = $grand_total;
	}
    ?>
    <tr>
	    <td colspan="5"><span style="float:right;text-align: right;">Amount Payable : 
	    <?php
	    if (isset($grand_total)) {
	     	 echo $grand_total; 
	     } 
	   
	    ?></span>
	    </td>
    </tr>
    <tr>
	    <td colspan="5"><button type="submit">Remove</button>
	    </td>
    </tr>
  </tbody>
</table>
<input type="hidden" name="return_url" value="<?php 
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
echo $current_url; ?>" />
</form>
		</fieldset>
	</div>
</section>
<hr>



</form>
</div>

