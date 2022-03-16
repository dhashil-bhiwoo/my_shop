<?php
session_start();
require ("../config/dbconn.php");
$user_id = $_SESSION['user_id'];
$urlUser = "../view/user.php";
if(isset($_SESSION['cart']))
{
    foreach($_SESSION['cart'] as $product_id => $quantity)
    {
        $query = sprintf("SELECT product_id FROM product WHERE product_id = %d", $product_id);
        $queryDetail = sprintf("SELECT price FROM product_details WHERE product_id= %d", $product_id);
        $queryShipping = "SELECT shipping_id FROM cart WHERE user_id = '$user_id'";
        $result = mysql_query($query);
        $resultDetail = mysql_query($queryDetail);
        $resultShipping = mysql_query($queryShipping);
        while(($my_product = mysql_fetch_assoc($result)) && ($my_prod_detail = mysql_fetch_assoc($resultDetail)) && ($shippingDetail = mysql_fetch_assoc($resultShipping)))
        {
            $product_id = $my_product['product_id'];
            $price = $my_prod_detail['price'];
            $id = $shippingDetail['shipping_id']; 
        }
        $total = ($quantity * $price);
        mysql_query("INSERT INTO orders (user_id, product_id, price, quantity, total, shipping_id) VALUES ('$user_id', '$product_id', '$price', '$quantity', '$total', '$id')") or die("Error!");
        $sql = sprintf("SELECT qty FROM product_details WHERE product_id = %d", $product_id);
        $qtyResult = mysql_query($sql);
        $old_qty = mysql_fetch_assoc($qtyResult);
        $new_qty = $old_qty['qty'] - $quantity;
        mysql_query("UPDATE product_details SET qty = '$new_qty' WHERE product_id = '$product_id' ");
        $sqlCredit = "SELECT credits FROM users_details WHERE user_id = '$user_id'";
        $creditResult = mysql_query($sqlCredit);
        $actualCredit = mysql_fetch_assoc($creditResult);
        $newCredit = $actualCredit['credits'] - $total;
        mysql_query("UPDATE users_details SET credits = '$newCredit' WHERE user_id = '$user_id'");
    }
    unset($_SESSION['cart']);
    mysql_query("DELETE FROM cart where user_id = '$user_id'") or die("An error occurred while emptying your cart.");
    echo "<script> alert('Order Successful'); </script>";
    echo "<script> location.href='" .$urlUser. "'</script>";
}
else
{
    echo "<script>alert('Ooops! Sorry, something went wrong.');</script>";
    echo "<script>location.href='" .$urlUser. "'</script>";
} 
?>