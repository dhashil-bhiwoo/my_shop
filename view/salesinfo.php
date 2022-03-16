<?php
session_start();
require ("../config/dbconn.php");
require ("../inc/get_sales_info.php");
include ("../inc/header.php");
if(isset($_SESSION['email']))
{
    echo"   <li><a href='contact.php'>Contact</a></li>
            <li><a href='admin.php'>Admin Panel</a></li>
		    <li>Hello " .$user[0]. "</li>
		    <li><a href='logout.php'>Logout</a></li>
		</ul>";
}
else
{
    $urlLogin = "login.html";
    echo "<script>alert('Please login to access admin panel!');</script>";
	echo "<script>location.href='" .$urlLogin. "'</script>";
}

if(!isset($_POST['user_id']))
{
    $_POST['user_id'] = "";
}
$query = "SELECT user_id, first_name, last_name FROM users"; 
$result = mysql_query($query);   
$num = mysql_num_rows($result);
?> 
    <h3>View Sales Transaction</h3>
    <form method="post" action="salesinfo.php">	
        <select name="user_id"> 
<?php
for ($i=0; $i<$num; $i++)
{ 
	$client = mysql_fetch_assoc($result);
	echo "<option value='" .$client['user_id']. "'>" .$client['first_name']. ", " .$client['last_name']. "</option>"; 
}
?>
        </select>
        <input type="Submit" value="Submit"/>
    </form>
<?php
get_sales_info($_POST['user_id']);
include ("../inc/footer.php");
?>