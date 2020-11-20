<?php
session_start();
include('include/header.html');
include_once("mysqli_connect.php");
$shipping_cost      = 1.50; //shipping cost

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View shopping cart</title>
<link href="CSS/style.css" rel="stylesheet" type="text/css"></head>
<body>
<h1 align="center">View Cart</h1>
<div class="cart-view-table-back">
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
			echo '<td><input type="text" size="2" maxlength="2" name="quantity['.$product_id.']" value="'.$product_qty.'" /></td>';
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
	    <td colspan="5"><a href="checkout.php" class="button">Check Out</a><button type="submit">Update</button>
	    </td>
    </tr>
  </tbody>
</table>
<input type="hidden" name="return_url" value="<?php 
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
echo $current_url; ?>" />
</form>
</div>

</body>
</html>
