<?php
session_start();
require ("config/dbconn.php");
if (!isset($_GET['start']) or !is_numeric($_GET['start']))
{
    $start = 0;
}
else
{
    $start = (int)$_GET['start'];
}

$queryNum=mysql_num_rows(mysql_query("SELECT * FROM product"));
$query="SELECT * FROM product LIMIT $start, 6";
$result=mysql_query($query);
$numpages=floor($queryNum / 6);
?>
<html>
    <head>
        <title>Index</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css" />
        <link rel="stylesheet" type="text/css" href="css/lightbox.css" />
    </head>
    <body>
        <ul id="menu">
		    <li><a href="index.php">Home</a></li>
            <li><a href="view/login.html">login</a></li>
            <li><a href="view/reg.html">Register</a></li>       
        </ul>
        <div id="header">
			<h2>Welcome</h2>
		</div>
        <div id="container">
            <table cellpadding="5" cellspacing="5" id="display">
                <tr>
<?php 
        $img_path="images/thumbs/";
        $full_img_path="images/";
        $counter=1;
        while($my_product = mysql_fetch_assoc($result))
        {   
            echo "<td width='150px' height='180px' id='hover'><a href='#img" .$my_product['product_id']. "'><img src='" .$img_path. "thumb_" .$my_product['product_id'].$my_product['type']. "'/></a><br/>" .$my_product['name'];
            echo "<a href='#_' class='lightbox' id='img" .$my_product['product_id']. "'>
            <img src=" .$full_img_path.$my_product['product_id'].$my_product['type']. "></a></td>";
            if($counter % 3 == 0) 
            {
                echo"</tr><tr>";
            }
            $counter++;
        }
?>
                <tr>
            </table>
            <table id="nav">
                <tr>
<?php
        $prev = $start - 6;
        if ($prev >= 0)
        {
            echo "<td><a href='" .$_SERVER['PHP_SELF']. "?start=" .$prev. "'>Previous</a></td>";
        }
        if (($start + 6) <= $queryNum)
        {
            echo "<td><a href='" .$_SERVER['PHP_SELF']. "?start=" .($start + 6). "'>Next</a></td>";
        }
        for ($x=0;$x<=$numpages;$x++)
        {
            echo"<td><a href='" .$_SERVER['PHP_SELF']. "?start=" .($start=($x * 6)). "'>" .$x. "</a></td>";
        }
?>
                </tr>
            </table>
        </div>
        </br>
<?php 
include_once ("inc/footer.php");
?>