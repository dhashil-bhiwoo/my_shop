<?php
session_start();
$urlIndex="../index.php";
if(isset($_SESSION['email']))
{
	unset($_SESSION);
	session_destroy();
    echo "<script>alert('You logged out successfully!');</script>";
	echo "<script>location.href='" .$urlIndex. "'</script>";
}
?>