<?php
session_start();
$title = "Contact Us";
include ("../inc/header.php");
$urlLogin="login.html";
if(isset($_SESSION['email']))
{
    if (isset($_SESSION['link']))
    {
        echo "<li>".print_r($_SESSION['link'])."</li>";
    }
    echo"   <li>Hello " .$user[0]. "</li>
            <li><a href='user.php'>Product</a></li>
		    <li><a href='logout.php'>Logout</a></li>
		</ul>";
}
else
{
    echo "<script>alert('Please login to send a feedback!');</script>";
	echo "<script>location.href='" .$urlLogin. "'</script>";
}
if(isset($_POST['link']))
{
    $urlAdmin=$_POST['link'];
    echo "<p>Admin Panel:" .$urlAdmin. "</p>";
}
?>
<script src="../js/form_dyn.js"></script>
<script src="../js/cont_val.js"></script>
<div id="header">
    <h2>Contact Form</h2>
</div>
<form method="post" action="../logic/contproc.php" name="contact" onsubmit="return contactVal()">
    <table id="reg">
	    <tr>
		    <td>Subject:</td>
			<td><input type="text" name="subject" value="Your Subject" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)"/></td>
		</tr>
		<tr>
		    <td>Comments:</td>
            <td><textarea rows="5" cols="20" name="comments" ></textarea></td>
		</tr>
		<tr>
            <td></td>
		    <td align="right"><input type="submit" value="Contact" name="contact" /></td>			
		</tr>
	</table>
</form>
<?php 
include ("../inc/footer.php");
?>