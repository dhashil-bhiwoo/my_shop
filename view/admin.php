<?php
session_start();
include ("../inc/header.php");
$title = "Admin Page";
if(isset($_SESSION['email']))
{
    if (isset($_SESSION['link']))
    {
        echo "<li>".print_r($_SESSION['link'])."</li>";
    }
	echo"   <li>Hello " .$user[0]. "</li>
            <li><a href='user.php'>User Page</a></li>
		    <li><a href='logout.php'>Logout</a></li>
		</ul>";
}
else
{
    $urlLogin="../view/login.html";
    echo "<script>alert('Please login to access admin panel!');</script>";
	echo "<script>location.href='" .$urlLogin. "'</script>";
}
?>
<table id="reg">
    <tr>
        <th>Admin Links</th>
    </tr>
    <tr>
        <td>User Info</td>
        <td><a href="useradmin.php" >View User</a></td>
    </tr>
    <tr>
        <td>Add Products</td>
        <td><a href="prodadmin.php" >Add Product</a></td>
    </tr>
    <tr>
        <td>Product Info</td>
        <td><a href="prodinfo.php" >View Product</a></td>
    </tr>
    <tr>
        <td>Sales Info</td>
        <td><a href="salesinfo.php" >View Sales to Client</a></td>
    </tr>
    <tr>
        <td>Credit Mgmt</td>
        <td><a href="deb_acc.php" >Debit User Account</a></td>
    </tr>
    <tr>
        <td>Unlock Account</td>
        <td><a href="unlock_acc.php" >Unlock User Account</a></td>
    </tr>
</table>
<?php
include ("../inc/footer.php");
?>