<?php
session_start();
$user_id = $_SESSION['user_id'];
$urlContact = "../view/contact.php";
if(isset($_POST['contact'])) 
{
    require ("../config/dbconn.php");
    if(isset($_POST['subject']) && isset($_POST['comments']))
	{
		$subject = mysql_real_escape_string($_POST['subject']);
		$comments = mysql_real_escape_string($_POST['comments']);	
		mysql_query("INSERT INTO contact(subject, comments, user_id) VALUES ('$subject', '$comments', '$user_id')") or  die("Cannot Query Database");
        echo "<script>alert('Thank you for your comments.');</script>"; 
        echo "<script>location.href='" .$urlContact. "'</script>";        
	}
	else
	{
        echo "<script>alert('Please fill out the form again.');</script>";
        echo "<script>location.href='" .$urlContact. "'</script>";
        mysql_close();
	}
}
else 
{
	$urlLogin = "../view/login.html";
	echo "<script>location.href='" .$urlLogin. "'</script>";
    exit();
}
?>