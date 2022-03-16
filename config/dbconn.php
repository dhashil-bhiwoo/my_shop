<?php
$host="localhost";
$name="root";
$pass="";
$dbname="proj";
$dbcon=mysql_connect($host,$name,$pass);
if (!$dbcon)
{
    die("Database Connection Failed");
}
mysql_select_db($dbname,$dbcon);
?>