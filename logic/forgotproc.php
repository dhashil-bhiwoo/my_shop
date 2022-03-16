<?php
$urlLogin = "../view/login.html";
$urlForgot = "../view/forgot.html";
if(isset($_POST['fgt']))
{
    require ("../config/dbconn.php");
    
    if(isset($_POST['email']) && 
	   isset($_POST['mobile_number']) && 
	   isset($_POST['new_password']) && 
	   isset($_POST['conf_password']) )
    {  
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/',$_POST['new_password'])) 
        {
            echo "<script>alert('Password must be more than 8 characters and must contain at least 1 numeric and 1 alphabet \n It can also contain !@#$%');</script>";
            echo "<script>location.href='" .$urlForgot. "'</script>";
            exit();
        }
        else if ($_POST['new_password'] != $_POST['conf_password'])
        {
            echo "<script>alert('Password do not match.');</script>";
            echo "<script>location.href='" .$urlForgot. "'</script>";
            exit();
        }
        
        foreach($_POST as $key => $value)
        {
            $$key=$value;
            $key=mysql_real_escape_string($value);
        }
            
        $new_password=md5($new_password);
        $query = "SELECT * FROM users WHERE email='$email' and mobile_number='$mobile_number'";
        $result = mysql_query($query) or die ("An error occurred");
        
        if (mysql_num_rows($result) != 1) 
        {
            echo "<script>alert('Email or Mobile Number is wrong');</script>";
            echo "<script>location.href='" .$urlForgot. "'</script>";
        } 
        else 
        {   
            mysql_query("UPDATE users SET password='$new_password', active=1, login_attempt=0 WHERE email='$email' ") or die("An Error Occurred");
            echo "<script>alert('Password Reset Successful.');</script>";
            echo "<script>location.href='" .$urlLogin. "'</script>";
            mysql_free_result($result);
            mysql_close();
        }
    }
}
?>