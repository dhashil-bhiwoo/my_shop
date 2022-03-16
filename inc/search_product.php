<?php
function searchProduct($search)
{
    $urlUser = "user.php";
    
    if ($search != NULL)
    {
        require ("../config/dbconn.php");
        $search = mysql_real_escape_string($search);
        $query = "SELECT product_id, name, type FROM product WHERE name LIKE '%$search%'";
        $result = mysql_query($query);
        $num_rows = mysql_num_rows($result);
        if ($num_rows > 0)
        {
            echo "<div id='container'>
                <table cellpadding='5' cellspacing='5' id='display'>
                    <tr>";
            $full_img_path="../images/";
            $img_path="../images/thumbs/";
            $counter=1;
            while ($my_product = mysql_fetch_assoc($result))
            {   
                $queryPrice = "SELECT price FROM product_details WHERE product_id='" .$my_product['product_id']. "'";
                $resultPrice = mysql_query($queryPrice);
                $my_prod_details = mysql_fetch_assoc($resultPrice);
                
                echo "<td width='150px' height='190px'>
                        <a href='#img" .$my_product['product_id']. "'><img src='" .$img_path. "thumb_" .$my_product['product_id'].$my_product['type']. "'/></a>
                        <br/>"
                        .$my_product['name'].
                        "<br/>
                        Price: Rs" .$my_prod_details['price'].
                        "<br/>
                        <a href='cart.php?action=add&id=" .$my_product['product_id']. "'>Add To Cart</a>";
                echo "<a href='#_' class='lightbox' id='img" .$my_product['product_id']. "'><img src=" .$full_img_path.$my_product['product_id'].$my_product['type']. "></a>
                    </td>";

                if($counter % 3 == 0)
                {
                    echo"</tr><tr>";
                }
                $counter++;
            }
            echo "</tr></table>";
        }
        else
        {
            echo "<script>alert('Sorry, nothing found! Search Again');</script>";
            echo "<script>location.href='" .$urlUser. "'</script>";
        }
    }
    else
    {
        echo "<script>alert('Sorry, nothing found! Search Again');</script>";
        echo "<script>location.href='" .$urlUser. "'</script>";
    }
}
?>