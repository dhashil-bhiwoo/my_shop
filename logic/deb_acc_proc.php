<?php
session_start();
$urlAdmin = "../view/admin.php";
if (isset($_POST['user_id']) && isset($_POST['amount']))
{
    require ("../config/dbconn.php");
    
    $user_id = $_POST['user_id'];
    $amount = mysql_real_escape_string($_POST['amount']);
    mysql_query("INSERT INTO Transaction(user_id, amount) VALUES ('$user_id', '$amount')") or die("An Error Occurred");
    $sqlCredit = "SELECT credits FROM users_details WHERE user_id = '$user_id'";
    $creditResult = mysql_query($sqlCredit);
    $actualCredit = mysql_fetch_assoc($creditResult);
    $newCredit = $actualCredit['credits'] + $amount;
    mysql_query("UPDATE users_details SET credits = '$newCredit' WHERE user_id = '$user_id'");
    echo "<script>alert('Transaction Successful');</script>";
    echo "<script>location.href='" .$urlAdmin. "'</script>";
}
else
{
    echo "<script>alert('Ooops! Sorry, something went wrong.');</script>";
    echo "<script>location.href='" .$urlAdmin. "'</script>";
}
?>