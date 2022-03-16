<?php
session_start();
require ("../config/dbconn.php");
require ("../inc/get_product_info.php");
include ("../inc/header.php");
if(isset($_SESSION['email']))
{
    echo"   <li><a href='contact.php'>Contact</a></li>
            <li><a href='admin.php'>Admin Panel</a></li>
		    <li>" .$user[0]. "</li>
		    <li><a href='logout.php'>Logout</a></li>
		</ul>";
}
else
{
    $urlLogin = "login.html";
    echo "<script>alert('Please login to access admin panel!');</script>";
	echo "<script>location.href='" .$urlLogin. "'</script>";
}

if(!isset($_POST['product']))
{
    $_POST['product'] = "";
}
$query = "SELECT product_id, name FROM product"; 
$result = mysql_query($query);   
$num = mysql_num_rows($result);
?> 
    <h3>Select a Product</h3>
    <form method="post" action="prodinfo.php">	
        <select name="product"> 
<?php
for ($i=0; $i<$num; $i++)
{ 
	$product_id=mysql_result($result, $i, "product_id");
    $name=mysql_result($result, $i, "name");    
	echo "<option value='" .$product_id. "'>" .$name. "</option>"; 
}
?>
        </select>
        <input type="Submit" value="Submit"/>
    </form>
<?php
get_product_info($_POST['product']);
include ("../inc/footer.php");
?>