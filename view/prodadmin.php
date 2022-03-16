<?php
session_start();
include_once ("../inc/header.php"); 
require ("../config/dbconn.php");
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
    $urlLogin="../view/login.html";
    echo "<script>alert('Please login to access admin panel!');</script>";
	echo "<script>location.href='".$urlLogin."'</script>";
}
?>
<div id="header">
    <h2>Add New Product</h2>
</div>
<script src="../js/prod_ad.js"></script>
<script src="../js/form_dyn.js"></script>
<script src="../js/jscolor.js"></script>
<form name="addprod" method="post" action ="../logic/prodproc.php" onsubmit="return addProductValidation()" id="addprod" enctype="multipart/form-data">
<table id="reg">
    <tr>
        <td>Product Name:</td>
        <td><input name="name" type="text" value="Product Name" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)"></td>
    </tr>
    <tr>
        <td>Color:</td>
        <td><input class="color" name="color" value="66ff00" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)"></td>        
    </tr>
    <tr>
        <td>Description:</td>
        <td><textarea rows="5" cols="20" name="description" value="Product Description" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)"></textarea></td>
    </tr>
    <tr>
        <td>Quantity:</td>
        <td>
            <select name="qty">
            <?php
            for ($qty = 100; $qty >= 1; $qty--)
            {
                echo "<option value='" .$qty. "'>" .$qty. "</option>\n";
            }       
            ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Price:</td>
        <td><input name="price" type="text" value="Product Price" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)"></td>
    </tr>
    <tr>
        <td>Upload Picture:</td>
        <td><input type="file" id="file" name="file" onChange="Checkfiles()"/></td>
    </tr>
    <tr>
        <td></td>
        <td><input name="submit" type="submit" value="Add Product" /></td>
    </tr>
</table>
</form>
</br>
<?php 
include_once ("../inc/footer.php");
?>