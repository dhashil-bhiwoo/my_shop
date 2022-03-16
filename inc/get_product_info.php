<?php
function get_product_info($product_id)
{
require ("../config/dbconn.php");
$img_path = "../images/";

$query = sprintf("SELECT * 
                  FROM product 
                  WHERE product_id= %d", $product_id); 
                  
$result = mysql_query($query) or die ("An error occurred");

$queryDetail = sprintf("SELECT qty, price 
                        FROM product_details 
                        WHERE product_id= %d", $product_id);
                        
$resultDetail = mysql_query($queryDetail) or die ("An error occurred");
?>
    <table cellspacing="10" cellpadding="3" id="oddEven">
        <tr>
			<th> ID </th>
			<th> Name </th>
			<th> Type </th>
			<th> Color </th>
			<th width="125px"> Description </th>
            <th> Quantity </th>
			<th> Price (Rs) </th>
		</tr> 
<?php
while($my_product = mysql_fetch_assoc($result))
    {
        echo "<tr>";
        foreach($my_product as $key => $value)
        {
            $$key = $value;
            echo "<td>" .$value. "</td>";
        }
    }

while($my_product_detail = mysql_fetch_assoc($resultDetail))
    {
        foreach($my_product_detail as $key => $value)
        {
            $$key = $value;
            echo "<td>" .$value. "</td>";
        }
        echo "</tr>";
    }
echo "</table><br/>";
}
?>