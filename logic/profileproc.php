<?php
session_start(); 
$urlProfile = "../view/profile.php";
$urlLogin = "../view/login.html";
$user_id = $_SESSION['user_id'];
if(isset($_POST['update'])) 
{
    require ("../config/dbconn.php");
   
    if(isset($_POST['first_name']) && 
	   isset($_POST['last_name']) && 
	   isset($_POST['dob']) && 
	   isset($_POST['address1']) && 
	   isset($_POST['country']) && 
	   isset($_POST['mobile_number']) && 
	   isset($_POST['gender']) && 
	   isset($_POST['preferred_language']) && 
	   isset($_POST['email']))
	{
        foreach($_POST as $key => $value)
        {
            $$key=$value;
            $key=mysql_real_escape_string($value);
        }
        
        $query = "SELECT email 
                    FROM users 
                    WHERE email='$email'
                    AND user_id != '$user_id'";
        $result = mysql_query($query);
        if (mysql_num_rows($result) >= 1) 
        {
            echo "<script>alert('Email already exist!');</script>";
            echo "<script>location.href='" .$urlProfile. "'</script>";
            exit();
        }
        
        $old_email = mysql_fetch_assoc(mysql_query("SELECT email FROM users WHERE user_id='$user_id'"));
        if($email != $old_email['email'])
        {
            mysql_query("UPDATE users SET first_name='$first_name', last_name='$last_name', dob='$dob', address='$address1,$address2', states='$states', 
            phone_number='$phone_number', mobile_number='$mobile_number', gender='$gender', preferred_language='$preferred_language', email='$email' WHERE user_id='$user_id'") 
            or die ("An Error Occurred");
            echo "<script>alert('You changed your email! Update successful, Please Login again');</script>";
            unset($_SESSION);
            session_destroy();
            echo "<script>location.href='" .$urlLogin. "'</script>";
        }
        else
        {
            mysql_query("UPDATE users SET first_name='$first_name', last_name='$last_name', dob='$dob', address='$address1,$address2', states='$states', 
            phone_number='$phone_number', mobile_number='$mobile_number', gender='$gender', preferred_language='$preferred_language', email='$email' WHERE user_id='$user_id'") 
            or die ("An Error Occurred");
            echo "<script>alert('Update successful!');</script>";
            echo "<script>location.href='" .$urlProfile. "'</script>";
        }
    }
}
else 
{
    echo "<script>alert('Profile Update Failed');</script>";
	echo "<script>location.href='" .$urlProfile. "'</script>";
    exit();
}
?>