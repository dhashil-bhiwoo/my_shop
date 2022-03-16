<?php
session_start();
$urlUser = "../view/user.php";
$urlLogin = "../view/login.html";
$urlForgot = "../view/forgot.html";
if ((!isset($_SESSION['email'])) && (!isset($_SESSION['user_id'])))
{
	if (isset($_POST['login'])) 
	{
        require ("../config/dbconn.php");
		$email = mysql_real_escape_string($_POST['email']);
        //undefined index $password
		$password = md5(mysql_real_escape_string($_POST['password']));
		$query = "SELECT *
		          FROM users 
				  WHERE email='$email' AND password='$password' AND active = 1";
		$result = mysql_query($query);
        $qry_attempt=mysql_query("SELECT login_attempt, active FROM users WHERE email='$email'");
        $rslt_attempt=mysql_fetch_assoc($qry_attempt);

		if(mysql_num_rows($result) != 1) 
        {
            if($rslt_attempt['active'] = 0)
            {
                echo "<script>alert('Your account is not active. Contact admin!');</script>";
                echo "<script>location.href='" .$urlLogin. "'</script>";
            }
            elseif($rslt_attempt['active'] = 3)
            {
                echo "<script>alert('Please recover your account!');</script>";
                echo "<script>location.href='" .$urlForgot. "'</script>";
            }
            elseif($rslt_attempt['login_attempt'] >= 3)
            {
                mysql_query("UPDATE users SET active = 0, login_attempt = (login_attempt + 1) WHERE email='$email'");
                echo "<script>alert('Sorry! Your account is locked. Contact admin!');</script>";
                echo "<script>location.href='" .$urlLogin. "'</script>";
            }
            else
            {
                mysql_query("UPDATE users SET login_attempt = (login_attempt + 1) WHERE email = '$email'");
                echo "<script>alert('Email or password is wrong.');</script>";
                echo "<script>location.href='" .$urlLogin. "'</script>";
            }
		} 
        else
		{			
			$row = mysql_fetch_assoc($result);
			$_SESSION['email'] = $email;
            $_SESSION['user_id'] = $row['user_id'];
            $user_priv=$row['privilege'];
            $first_name=$row['first_name'];
			if ($user_priv >= 1)
			{
                $link="<a href='admin.php'>Admin Panel</a>";
                $_SESSION['link'] = $link;
                echo "<script>alert('Hello Admin, " .$first_name. "');</script>";
			}
            mysql_query("UPDATE users SET last_login = NOW(), login_attempt = 0 WHERE email = '$email' ");
            echo "<script>alert('Hello " .$first_name. ".\n Login Successful');</script>";
            echo "<script>location.href='" .$urlUser. "'</script>";
            mysql_free_result($result);
		}
	} 
    else 
	{
        echo "<script>alert('An error occurred. Please login again.');</script>";
	    echo "<script>location.href='" .$urlLogin. "'</script>";
	}
} 
else 
{
    echo "<script>alert('Already Logged In!');</script>";
    echo "<script>location.href='" .$urlUser. "'</script>";
}
?>