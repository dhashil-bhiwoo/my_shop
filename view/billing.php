<?php
session_start();
require ("../config/dbconn.php");
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];
$urlUser="user.php";
$urlOrder="order.php";
include ("../inc/header.php");
$urlLogin="login.html";
if(isset($_SESSION['email']))
{
    if (isset($_SESSION['link']))
    {
        echo "<li>".print_r($_SESSION['link'])."</li>";
    }
    echo"   <li>Hello " .$user[0]. "</li>
            <li><a href='contact.php'>Contact Us</a></li>
            <li><a href='cart.php'>No of Item = " .$cartItemCount. "</a></li>
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
<script type="text/javascript" src="../js/jquery.js"></script>
<script src="../js/form_dyn.js"></script>
<script src="../js/shipping_val.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('input[type="checkbox"]').click(function()
        {
            if($(this).attr("value")=="address")
            {
                $(".box").toggle();
            }
        });
    });
</script>
<div id='header'>
    <h2>Your Billing Info</h2>
</div>
<br/>
<?php
if(isset($_SESSION['cart']))
{
    $query=sprintf("SELECT first_name, last_name, address, states, country FROM users WHERE user_id= %d", $user_id);
    $result=mysql_query($query);
    while($user_info = mysql_fetch_assoc($result))
    {
        echo "<label><input type='checkbox' name='updateAdd' value='address'>Select check box if you are shipping to a different address.</label><br/>";
        echo"<table id='oddEven'>
            <tr>
                <td>First Name</td>
                <td>".$user_info['first_name']."</td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td>".$user_info['last_name']."</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>".$user_info['address']."</td>
            </tr>
            <tr>
                <td>State</td>
                <td>".$user_info['states']."</td>
            </tr>
            <tr>
                <td>Country</td>
                <td>".$user_info['country']."</td>";
?>           
            </tr>
            <tr>
                <td><a href="cart.php">Back to Cart</a></td>
                <td><a href="../logic/billingproc.php">Confirm Address</a></td>
            </tr>
        </table>
        <br/><br/>
        <div class="box">
            <h3>Shipping and Billing Address</h3>
            <form name="updateAddress" action="../logic/shippingproc.php" method="post" onSubmit="return shippingVal()">
                <table id="reg">
                    <tr>
                        <td>Shipping Address</td>
                    </tr>
                    <tr>
                        <td>Address Line 1:</td>
                        <td><input name="ship_address1" type="text" value="Your Address Line 1" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)">*</td>
                    </tr>
                    <tr>
                        <td>Address Line 2:</td>
                        <td><input name="ship_address2" type="text" value="Your Address Line 2" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)"></td>
                    </tr>
                    <tr>
                        <td>State:</td>
                        <td><input name="ship_states" type="text" value="Your state" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)">*</td>
                    </tr>
                    <tr>
                        <td>Country:</td>
                        <td>
                            <select name="ship_country">
                                <option value="Mauritius" selected>
                                    Mauritius
                                </option>
                                <option value="France">
                                    France
                                </option>
                                <option value="Germany">
                                    Germany
                                </option>
                                <option value="South Africa">
                                    South Africa
                                </option>
                                <option value="Australia">
                                    Australia
                                </option>
                            </select>*
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Submit New Address" name="newAddress"></td>
                    </tr>
                </table>               
            </form>
<?php 
        $prev_address = mysql_query("SELECT id, ship_address, ship_states, ship_country FROM shipping WHERE user_id = '$user_id'");
        $num_rows = mysql_num_rows($prev_address);
        if($num_rows > 0)
        {
            echo "<form method='post' action='../logic/billingproc.php'>";
            for($i=0;$i<=$num_rows;$i++)
            {
                while($shipping_add = mysql_fetch_assoc($prev_address))
                {
                    echo"<input type='radio' name='prev_address' value='" .$shipping_add['id']. "'/>ADDRESS: " .$shipping_add['ship_address']. "</br>STATE: " .$shipping_add['ship_states']. "</br>COUNTRY: " .$shipping_add['ship_country']. "</br></br>";
                }
            }
            echo "<input type='submit' value='Submit Address'/></form>";
        }
        else
        {
            echo "<p>You don't have any previous shipping address.</p>";
        }
        echo "</div>";
    }
}
else
{
    echo "<script>alert('Your cart seems to be empty')</script>";
    echo "<script>location.href='" .$urlUser. "'</script>";
}
include ("../inc/footer.php");
?>