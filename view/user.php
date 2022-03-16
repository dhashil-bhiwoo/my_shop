<?php
session_start();
include ("../inc/header.php");
$urlLogin="login.html";
if(isset($_SESSION['email']))
{
    if (isset($_SESSION['link']))
    {
        echo "<li>" .print_r($_SESSION['link']). "</li>";
    }
	echo"	<li><a href='contact.php'>Contact Us</a></li>
            <li><a href='my_transaction.php'>My Transactions</a></li>
            <li><a href='cart.php'>View Cart</a></li>
            <li><a href='logout.php'>Logout</a></li>
            <li><a href='profile.php'>Hello " .$user[0]. "</a></li>
		</ul>";
}
else
{
    echo "<script>alert('Please login!');</script>";
	echo "<script>location.href='".$urlLogin."'</script>";
}

if (!isset($_GET['start']) or !is_numeric($_GET['start']))
{
    $start = 0;
}
else
{
    $start = (int)$_GET['start'];
}

require ("../config/dbconn.php");
$query="SELECT product_id, type, name FROM product LIMIT $start, 6";
$queryDetail="SELECT price FROM product_details LIMIT $start, 6";
$result=mysql_query($query);
$resultDetail=mysql_query($queryDetail);
$queryNum=mysql_num_rows(mysql_query("SELECT * FROM product"));
$numpages=floor($queryNum / 6);
?>
<script src="../js/form_dyn.js"></script>
<script type="text/javascript">
<!--
function submitEnter(myfield,e)
{
    var keycode;
    if (window.event) keycode = window.event.keyCode;
    else if (e) keycode = e.which;
    else return true;

    if (keycode == 13)
    {
       myfield.form.submit();
       return false;
    }
    else
    {
       return true;
    }
}
//-->
</script>

<div id="header">
    <h2>Products</h2>
</div>
<div id="container">
<form action="search.php" method="post" name="search">
    <input type="text" name="search" value="search a product" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)" onKeyPress="return submitEnter(this,event)">
</form>
            <table cellpadding="5" cellspacing="5" id="display">
                <tr>
<?php 
        $full_img_path="../images/";
        $img_path="../images/thumbs/";
        $counter=1;
        
        while(($my_product = mysql_fetch_assoc($result)) && ($my_prod_details = mysql_fetch_assoc($resultDetail)))
        {   
            echo "<td width='150px' height='190px'> 
                    <a href='#img" .$my_product['product_id']. "'><img src='" .$img_path. "thumb_" .$my_product['product_id'].$my_product['type']. "'/></a>
                    <br/>"
                    .$my_product['name'].
                    "<br/>
                    Price: Rs".$my_prod_details['price'].
                    "<br/>
                    <a href='cart.php?action=add&id=" .$my_product['product_id']. "'>Add To Cart</a>";
            echo "<a href='#_' class='lightbox' id='img" .$my_product['product_id']. "'><img src=" .$full_img_path.$my_product['product_id'].$my_product['type']. "></a>
                </td>";
            if($counter % 3 == 0 )
            {
                echo"</tr><tr>";
            }
            $counter++;
        }
?>
            </table>
            <table id="nav">
                <tr>
<?php
        $prev = $start - 6;
        if ($prev >= 0)
        {
            echo "<td><a href='" .$_SERVER['PHP_SELF']. "?start=" .$prev. "'>Previous</a></td>";
        }
        if (($start + 6) <= $queryNum)
        {
            echo "<td><a href='" .$_SERVER['PHP_SELF']. "?start=" .($start + 6). "'>Next</a></td>";
        }
        for ($x=0;$x<=$numpages;$x++)
        {
            echo"<td><a href='" .$_SERVER['PHP_SELF']. "?start=" .($start=($x * 6)). "'>" .$x. "</a></td>";
        }
?>
                </tr>
            </table>
</div>
<?php 
include("../inc/footer.php");
?>