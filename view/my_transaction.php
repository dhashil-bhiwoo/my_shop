<?php
session_start();
require ("../config/dbconn.php");
require ("../inc/get_sales_info.php");
require ("../inc/get_my_transaction.php");
include ("../inc/header.php");
$user_id=$_SESSION['user_id'];
if(isset($_SESSION['email']))
{
    echo"   <li><a href='contact.php'>Contact</a></li>
		    <li>Hello " .$user[0]. "</li>
            <li><a href='cart.php'>View Cart</a></li>
		    <li><a href='logout.php'>Logout</a></li>
		</ul>";
}
else
{
    $urlLogin = "login.html";
    echo "<script>alert('Please login to access admin panel!');</script>";
	echo "<script>location.href='" .$urlLogin. "'</script>";
}
get_sales_info($user_id);
get_my_transaction($user_id);
include ("../inc/footer.php");
?>