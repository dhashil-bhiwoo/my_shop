<?php
function get_sales_info($user_id)
{
    require ("../config/dbconn.php");

    $queryOrder = "SELECT date, product_id, quantity, price, total FROM orders WHERE user_id= '$user_id'"; 
    $resultOrder = mysql_query($queryOrder) or die ("An error occurred");
    $num_rows = mysql_num_rows($resultOrder);
    if ($num_rows > 0)
    {
?>
        <table cellspacing="10" cellpadding="3" id="oddEven">
            <tr>
                <th> Date </th>
                <th> Product ID </th>
                <th> Quantity </th>
                <th> Price (Rs) </th>
                <th> Total (Rs) </th>
                <th> Product Name </th>
            </tr> 
<?php
    while($my_order = mysql_fetch_assoc($resultOrder))
    {
        echo "<tr>";
        foreach($my_order as $key => $value)
        {
            $$key = $value;
            echo "<td>" .$value. "</td>";
            
        }
        $product_id = $my_order['product_id'];
        $queryName = sprintf("SELECT name FROM product WHERE product_id= %d", $product_id);
        $resultName = mysql_query($queryName) or die ("An error occurred");
        while($my_product_detail = mysql_fetch_assoc($resultName))
        {
            foreach($my_product_detail as $key => $value)
            {
                $$key = $value;
                echo "<td>" .$value. "</td>";
            }
            echo "</tr>";
        }
    }
    echo "</table><br/>";
    }
    else
    {
        echo "<p>No order placed till now</p>";
    }
}
?>