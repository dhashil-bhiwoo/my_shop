<?php
session_start();
require ("../config/dbconn.php");
$user_id = $_SESSION['user_id'];
$urlOrder = "../view/order.php";
if(isset($_POST['newAddress']))
{
    foreach($_POST as $key => $value)
    {
        $$key=$value;
        $key=mysql_real_escape_string($value);
    }     
    $sql = "INSERT INTO shipping (user_id, ship_address, ship_states, ship_country) VALUES ('$user_id', '$ship_address1, $ship_address2', '$ship_states', '$ship_country')";
    mysql_query($sql) or die("An error occurred");
    $id = mysql_insert_id();
 
    if(isset($_SESSION['cart']))
    {
        foreach($_SESSION['cart'] as $product_id => $quantity)
        {
            $query = sprintf("SELECT product_id FROM product WHERE product_id = %d", $product_id);
            $queryDetail = sprintf("SELECT price FROM product_details WHERE product_id= %d", $product_id);
            $result = mysql_query($query);
            $resultDetail = mysql_query($queryDetail);
            while(($my_product = mysql_fetch_assoc($result)) && ($my_prod_detail = mysql_fetch_assoc($resultDetail)))
            {
                $product_id = $my_product['product_id'];
                $price = $my_prod_detail['price'];               
            }
            $query = "SELECT * FROM cart WHERE user_id= '$user_id'"; 
            $result = mysql_query($query) or die ("An error occurred");
            $num_rows = mysql_num_rows($result);
            if ($num_rows > 0)
            {
                mysql_query("DELETE FROM cart WHERE user_id= '$user_id'");
            }
            mysql_query("INSERT INTO cart (user_id, product_id, price, quantity, shipping_id) VALUES ('$user_id', '$product_id', '$price', '$quantity','$id')") or die("An error occurred");
        }
        echo"<script>alert('Processing your address');</script>";
        echo "<script>location.href='" .$urlOrder. "'</script>";
    }
}
?>