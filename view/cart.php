<?php
error_reporting(0);
session_start();
include ("../inc/header.php");
require ("../config/dbconn.php");
$urlLogin="login.html";
$user_id = $_SESSION['user_id'];
if(isset($_SESSION['email']))
{
    if (isset($_SESSION['link']))
    {
        echo "<li>".print_r($_SESSION['link'])."</li>";
    }
    echo"   <li>Hello " .$user[0]. "</li>
            <li><a href='contact.php'>Contact Us</a></li>
            <li><a href='cart.php'>No of Item = " .$cartItemCount. "</a></li>
            <li><a href='logout.php'>Logout</a></li>
		</ul>";
}
else
{
    echo "<script>alert('Please login!');</script>";
	echo "<script>location.href='" .$urlLogin. "'</script>";
}

if(isset($_POST['link']))
{
    $urlAdmin=$_POST['link'];
    echo "<p>Admin Panel:" .$urlAdmin. "</p>";
}

    $action = isset($_GET['action']) ? $_GET['action'] : "";
    $product_id = isset($_GET['id']) ? $_GET['id'] : "";

	if($product_id && !productExists($product_id)) {
		die("Error. Product Doesn't Exist");
	}

	switch($action) 
    {
	
		case "add":
			$_SESSION['cart'][$product_id]++;  
		break;
		
		case "remove":
			$_SESSION['cart'][$product_id]--; 
			if($_SESSION['cart'][$product_id] == 0) unset($_SESSION['cart'][$product_id]);  
		break;
		
		case "empty":
			unset($_SESSION['cart']); 
		break;
	
	}

     
if(isset($_SESSION['cart']))
{
?>
    <div id="header">
        <h2>My Cart</h2>
    </div>
    <div id="container">
    <table cellspacing="10" cellpadding="3" id="oddEven">
        <tr>
            <th>Product Name</th>
            <th>Thumbnail</th>
            <th>Price (Rs)</th>
            <th>Quantity</th>
            <th>Cost</th>
        </tr>
<?php
    $total = 0;
    $img_path="../images/thumbs/";
    foreach($_SESSION['cart'] as $product_id => $quantity)
    {
        $sql = sprintf("SELECT qty FROM product_details WHERE product_id = %d", $product_id);
        $qtyResult = mysql_query($sql);
        $qty = mysql_fetch_assoc($qtyResult);
        if ($quantity <= $qty['qty'])
        {
            $query=sprintf("SELECT * FROM product WHERE product_id = %d", $product_id);
            $queryDetail=sprintf("SELECT price from product_details WHERE product_id = %d", $product_id);
            $result=mysql_query($query) or die ('An error occurred');
            $resultDetail=mysql_query($queryDetail) or die ('An error occurred');
            while(($my_product = mysql_fetch_assoc($result)) && ($my_prod_details = mysql_fetch_assoc($resultDetail)))
            {
                $line_cost = ($my_prod_details['price'] * $quantity);
                $total += $line_cost;
                echo "<tr>";
                    echo "<td align='center'>" .$my_product['name']. "</td>";
                    echo "<td align='center'><img src='" .$img_path. "thumb_" .$my_product['product_id'].$my_product['type']. "' width='70px'/></td>";
                    echo "<td align='center'>" .$my_prod_details['price']. "</td>";
                    echo "<td align='center'>" .$quantity. "&nbsp;&nbsp;&nbsp;<a href='$_SERVER[PHP_SELF]?action=remove&id=$product_id'>X</a></td>";
                    echo "<td align='center'>" .$line_cost. "</td>";
                echo "</tr>";
            }
        }
    }
?>
        <tr>
            <th>Total Price</th>
<?php
    echo "<th>".$total."</th></tr>";
    echo "<tr>";
		echo "<td colspan='3' align='right'><a href='$_SERVER[PHP_SELF]?action=empty' onClick='return confirm('Are you sure?');'>Empty Cart</a></td>";
	echo "</tr>";
    
?>    
    </table>
    <br/><br/>
    <table id="nav" cellspacing="10">
        <tr>
            <td><a href="user.php">Continue Shopping</a></td>
            <td><a href="billing.php">Check Out</a></td>
        </tr>
    </table>
<?php 
}
else
{
    $urlUser="user.php";
    echo "<script>alert('No products found in cart yet')</script>";
    echo "<script>location.href='" .$urlUser. "'</script>";        
}

function productExists($product_id) 
{
	$sql = sprintf("SELECT * FROM product WHERE product_id = %d;", $product_id); 
    return mysql_num_rows(mysql_query($sql)) > 0;
}

include("../inc/footer.php");
?>