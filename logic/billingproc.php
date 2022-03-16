<?php
session_start();
require ("../config/dbconn.php");
$user_id = $_SESSION['user_id'];
$urlOrder = "../view/order.php";
    
if(isset($_SESSION['cart']))
{    
    if(isset($_POST['prev_address']))
    {
        $id=$_POST['prev_address'];
        foreach($_SESSION['cart'] as $product_id => $quantity)
        {
            $query = sprintf("SELECT product_id FROM product WHERE product_id = %d", $product_id);
            $queryDetail = sprintf("SELECT price FROM product_details WHERE product_id= %d", $product_id);
            $result = mysql_query($query) or die ("An error occurred");
            $resultDetail = mysql_query($queryDetail) or die ("An error occurred");
        
            while(($my_product = mysql_fetch_assoc($result)) && ($my_prod_detail = mysql_fetch_assoc($resultDetail)))
            {
                $product_id = $my_product['product_id'];
                $price = $my_prod_detail['price'];                     
            }
            $query = "SELECT * FROM cart WHERE user_id = '$user_id'"; 
            $result = mysql_query($query) or die ("An error occurred");
            $num_rows = mysql_num_rows($result);
            if ($num_rows > 0)
            {
                mysql_query("DELETE FROM cart WHERE user_id = '$user_id'");
            }
            mysql_query("INSERT INTO cart (user_id, product_id, price, quantity, shipping_id) VALUES ('$user_id', '$product_id', '$price', '$quantity', '$id')") or die("An error occurred");
        }
    }
    else
    {
        foreach($_SESSION['cart'] as $product_id => $quantity)
        {
            $query = sprintf("SELECT product_id FROM product WHERE product_id = %d", $product_id);
            $queryDetail = sprintf("SELECT price FROM product_details WHERE product_id= %d", $product_id);
            $result = mysql_query($query) or die ("An error occurred");
            $resultDetail = mysql_query($queryDetail) or die ("An error occurred");
            
            while(($my_product = mysql_fetch_assoc($result)) && ($my_prod_detail = mysql_fetch_assoc($resultDetail)))
            {
                $product_id = $my_product['product_id'];
                $price = $my_prod_detail['price'];                     
            }  
            $query = "SELECT * FROM cart WHERE user_id = '$user_id'"; 
            $result = mysql_query($query) or die ("An error occurred");
            $num_rows = mysql_num_rows($result);
            if ($num_rows > 0)
            {
                mysql_query("DELETE FROM cart WHERE user_id = '$user_id'");
            }
            mysql_query("INSERT INTO cart (user_id, product_id, price, quantity) VALUES ('$user_id', '$product_id', '$price', '$quantity')") or die("An error occurred");
        }
    }
    echo "<script>alert('Processing the address');</script>";
    echo "<script>location.href='" .$urlOrder. "'</script>"; 
}    
?>