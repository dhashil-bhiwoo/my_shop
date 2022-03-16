<?php
session_start();
require ("../config/dbconn.php");
$user_id = $_SESSION['user_id'];
include ("../inc/header.php");
$urlLogin="login.html";
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
    echo "<script>alert('Please login to send a feedback!');</script>";
	echo "<script>location.href='" .$urlLogin. "'</script>";
}

if(isset($_POST['link']))
{
    $urlAdmin=$_POST['link'];
    echo "<p>Admin Panel:" .$urlAdmin. "</p>";
}
?>
    <div id="header">
        <h2>My Invoice</h2>
    </div>
    <div id="container">
    <table cellspacing="10" cellpadding="3" id="oddEven">
        <tr>
            <th>Product Name</th>
            <th>Price (Rs)</th>
            <th>Quantity</th>
            <th>Cost (Rs)</th>
        </tr>
<?php
    $total = 0;
    foreach($_SESSION['cart'] as $product_id => $quantity)
    {
        $query=sprintf("SELECT product_id, name FROM product WHERE product_id = %d", $product_id);
        $queryDetail=sprintf("SELECT price from product_details WHERE product_id = %d", $product_id);
        $result=mysql_query($query) or die ('An error occurred');
        $resultDetail=mysql_query($queryDetail) or die ('An error occurred');
        while(($my_product = mysql_fetch_assoc($result)) && ($my_prod_details = mysql_fetch_assoc($resultDetail)))
        {
            $line_cost = ($my_prod_details['price'] * $quantity);		
            $total += $line_cost;
            echo "<tr>";
                echo "<td align='center'>" .$my_product['name']. "</td>";
                echo "<td align='center'>" .$my_prod_details['price']. "</td>";
                echo "<td align='center'>" .$quantity. "</td>";
                echo "<td align='center'>Rs. " .$line_cost. "</td>";
            echo "</tr>";
        }
        $sqlCredit = sprintf("SELECT credits FROM users_details WHERE user_id = %d", $user_id);
        $creditResult = mysql_query($sqlCredit);
        $credit = mysql_fetch_assoc($creditResult);
        if($total > $credit['credits'])
        {
            $_SESSION['cart'][$product_id]--; 
			if($_SESSION['cart'][$product_id] == 0)
            {
                unset($_SESSION['cart'][$product_id]);
            }
            echo "<script>alert('You do not have enough credit! Please do needful!');</script>";
            echo "<script>location.href='cart.php'</script>"; 
        }
    }
        echo "<tr>
                <th>Total Price</th>
                <th>Rs. " .$total. "</th>";
?>
        </tr>
        </table>
        <br/>
        <p>Product is going to be shipped to the following address</p>
        <table id="oddEven">
            <tr>
                <th>Address</th>
                <th>State</th>
                <th>Country</th>
            </tr>
<?php
        $shipping=mysql_query("SELECT shipping_id FROM cart WHERE user_id = '$user_id'") or die("Cannot query your address");
        $ship_add = mysql_fetch_assoc($shipping);
        if ($ship_add['shipping_id'] == 0)
        {
            $billing = mysql_query("SELECT address, states, country FROM users WHERE user_id ='$user_id'");
            while($bil_add = mysql_fetch_assoc($billing))
            {
                echo "<tr>
                        <td>" .$bil_add['address']. "</td>
                        <td>" .$bil_add['states']. "</td>
                        <td>" .$bil_add['country']. "</td>
                     </tr>";
            }
        }
        else
        {
            $shipping = mysql_query("SELECT ship_address, ship_states, ship_country FROM shipping WHERE id = ".$ship_add['shipping_id']."");
            while($shipping_add = mysql_fetch_assoc($shipping))
            {
                echo "<tr>
                        <td>" .$shipping_add['ship_address']. "</td>
                        <td>" .$shipping_add['ship_states']. "</td>
                        <td>" .$shipping_add['ship_country']. "</td>
                     </tr>";
            }
        }
?>
        </table>
        <table>
            <tr>
                <td><a href="billing.php"><input type="button" value="Review Address"/></td>
                <td><a href="../logic/orderproc.php"><input type="button" value="Confirm Order"/></a></td>
            </tr>
        </table>
<?php    
include ("../inc/footer.php");
?>