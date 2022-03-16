<?php
session_start();
$urlAdmin = "../view/admin.php";
if (isset($_POST['user_id']))
{
    require ("../config/dbconn.php");
    
    $user_id = $_POST['user_id'];
    mysql_query("UPDATE users SET active = 3 WHERE user_id = '$user_id'");
    echo "<script>alert('Account Unlocked Successful');</script>";
    echo "<script>location.href='" .$urlAdmin. "'</script>";
}
else
{
    echo "<script>alert('Ooops! Sorry, something went wrong.');</script>";
    echo "<script>location.href='" .$urlAdmin. "'</script>";
}
?>