<?php
error_reporting(0);
session_start();
include ("../inc/header.php");
$user_id = $_SESSION['user_id'];
require ("../config/dbconn.php");
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
    
$query = "SELECT first_name, last_name, dob, address, states, country, phone_number, mobile_number, gender, preferred_language, email 
          FROM users 
          WHERE user_id = '$user_id'"; 
            
$result = mysql_query($query) or die ("An error occurred");
$my_user = mysql_fetch_assoc($result);
foreach ($my_user as $key => $value)
{
    $$key=$value;
}
$add = explode(",", $address);
?>
<script src="../js/profile_val.js"></script>
<script src="../js/form_dyn.js"></script>
<div id="header">
    <h2>My Profile</h2>
</div>
<form action="../logic/profileproc.php" method="post" onsubmit="return validate()" name="profile" id="profile">
    <table id="reg">
        <tr>
            <td>First Name:</td>
            <td><input name="first_name" type="text" value="<?php echo $first_name; ?>" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)">*</td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td><input name="last_name" type="text" value="<?php echo $last_name; ?>" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)">*</td>
        </tr>
        <tr>
            <td>Date of Birth:</td>
            <td><input name="dob" type="date" value="<?php echo $dob; ?>" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)">*</td>
        </tr>
        <tr>
            <td>Address Line 1:</td>
            <td><input name="address1" type="text" value="<?php echo $add[0]; ?>" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)">*</td>
        </tr>
        <tr>
            <td>Address Line 2:</td>
            <td><input name="address2" type="text" value="<?php echo $add[1]; ?>" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)"></td>
        </tr>
        <tr>
            <td>State:</td>
            <td><input name="states" type="text" value="<?php echo $states; ?>" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)"></td>
        </tr>
        <tr>
            <td>Country:</td>
            <td>
                <select name="country">
                    <option value="Mauritius" <?php if ($country == 'Mauritius') {echo 'selected=\"selected\"';} ?> >
                        Mauritius
                    </option>
                    <option value="France" <?php if ($country == 'France') {echo 'selected=\"selected\"';} ?> >
                        France
                    </option>
                    <option value="Germany" <?php if ($country == 'Germany') {echo 'selected=\"selected\"';} ?> >
                        Germany
                    </option>
                    <option value="South Africa" <?php if ($country == 'South Africa') {echo 'selected=\"selected\"';} ?> >
                        South Africa
                    </option>
                    <option value="Australia" <?php if ($country == 'Australia') {echo 'selected=\"selected\"';} ?> >
                        Australia
                    </option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Phone Number:</td>
            <td><input name="phone_number" type="text" value="<?php echo $phone_number; ?>" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)"></td>
        </tr>
        <tr>
            <td>Mobile Number:</td>
            <td><input name="mobile_number" type="text" value="<?php echo $mobile_number; ?>" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)">*</td>
        </tr>
        <tr>
            <td>Gender:</td>
            <td>
                <input type="radio" name="gender" value="M" <?php if ($gender == 'M') {echo 'checked=\"checked\"';} ?> /> Male 
                <input type="radio" name="gender" value="F" <?php if ($gender == 'F') {echo 'checked=\"checked\"';} ?> /> Female
            </td>
        </tr>
        <tr>
            <td>Preferred Language:</td>
            <td>
                <select name="preferred_language">
                    <option value="Spanish" <?php if ($preferred_language == 'Spanish') {echo 'selected=\"selected\"';} ?> >
                        Spanish
                    </option>
                    <option value="English" <?php if ($preferred_language == 'English') {echo 'selected=\"selected\"';} ?> >
                        English
                    </option>
                    <option value="French" <?php if ($preferred_language == 'French') {echo 'selected=\"selected\"';} ?> >
                        French
                    </option>
                </select>
            </td>
        </tr>
        <!--<tr>
            <td>Password:</td>
            <td><input name="password" type="password" value="<?php echo $password; ?>">*</td>
        </tr>
        <tr>
            <td>Re-Type Password:</td>
            <td><input name="repassword" type="password" value="<?php echo $password; ?>">*</td>
        </tr>-->
        <tr>
            <td>Email: </td>
            <td><input name="email" type="email" value="<?php echo $email; ?>" onfocus="ClearPlaceHolder(this)" onblur="SetPlaceHolder(this)">*</td>
        </tr>
        <tr>
            <td></td>
            <td align="right"><input name="update" type="submit" value="Update Profile" /></td>
        </tr>
    </table>
</form>

<?php
include ("../inc/footer.php");