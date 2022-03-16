<?php
session_start();
include ("../inc/header.php");
require ("../inc/search_product.php");
$urlLogin="login.html";
$urlUser = "user.php";
if(isset($_SESSION['email']))
{
    if (isset($_SESSION['link']))
    {
        echo "<li>" .print_r($_SESSION['link']). "</li>";
    }
	echo"	<li>Hello " .$user[0]. "</li>
            <li><a href='contact.php'>Contact Us</a></li>
            <li><a href='my_transaction.php'>My Transactions</a></li>
            <li><a href='cart.php'>View Cart</a></li>
            <li><a href='logout.php'>Logout</a></li>
		</ul>";
}
else
{
    echo "<script>alert('Please login!');</script>";
	echo "<script>location.href='" .$urlLogin. "'</script>";
}

if (isset($_POST['search']))
{
    searchProduct($_POST['search']);
}
else
{
    echo "<script>location.href='" .$urlUser. "'</script>";
}
include("../inc/footer.php");
?>