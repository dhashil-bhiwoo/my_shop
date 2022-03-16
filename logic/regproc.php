<?php
session_start(); 
$urlReg = "../view/reg.html";
$urlLogin = "../view/login.html";
if(isset($_POST['reg'])) 
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
	   isset($_POST['password']) && 
	   isset($_POST['repassword']) && 
	   isset($_POST['email']))
	{
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/',$_POST['password'])) 
		{
            echo "<script>alert('Password must be more than 8 characters and must contain at least 1 numeric and 1 alphabet \n It can also contain !@#$%');</script>";
		    echo "<script>location.href='" .$urlReg. "'</script>";
            exit();
        }
		else if (($_POST['password']) != ($_POST['repassword']))
		{
            echo "<script>alert('Password do not match!');</script>";
		    echo "<script>location.href='" .$urlReg. "'</script>";
			echo "<p>Password do not match!</p>";
            exit();
		}

        foreach($_POST as $key => $value)
        {
            $$key=$value;
            $key=mysql_real_escape_string($value);
        }
        
        $password=md5($password);

        $query = "SELECT * 
		          FROM users 
				  WHERE email='$email'";
        $result = mysql_query($query);
        if (mysql_num_rows($result) >= 1) 
		{
            echo "<script>alert('Email already exist!');</script>";
			echo "<script>location.href='" .$urlReg. "'</script>";
            exit();
        }
        mysql_query("INSERT INTO users(first_name, last_name, dob, address, states, country, phone_number, mobile_number, gender, preferred_language, password, email) 
		             VALUES ('$first_name', '$last_name', '$dob', '$address1,$address2', '$states', '$country', '$phone_number', '$mobile_number', '$gender', '$preferred_language','$password','$email')") 
					 or  die("An Error Occurred");
        mysql_query("INSERT INTO users_details (credits) VALUES (50)") or die("An Error Occurred");
        echo "<script>alert('Registration Successful');</script>";
        echo "<script>location.href='" .$urlLogin. "'</script>";        
    }
}
else 
{
    echo "<script>alert('Registration Failed');</script>";
	echo "<script>location.href='" .$urlReg. "'</script>";
    exit();
}
?>