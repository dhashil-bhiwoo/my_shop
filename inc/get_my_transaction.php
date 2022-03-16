<?php
function get_my_transaction($user_id)
{
    require ("../config/dbconn.php");

    $queryTrans = "SELECT trans_id, date, amount FROM transaction WHERE user_id= '$user_id'"; 
    $resultTrans = mysql_query($queryTrans) or die ("An error occurred");
    $num_rows = mysql_num_rows($resultTrans);
    if ($num_rows > 0)
    {
?>
        <table cellspacing="10" cellpadding="3" id="oddEven">
            <tr>
                <th> Transaction ID </th>
                <th> Date </th>
                <th> Amount (Rs) </th>
            </tr> 
<?php
        while($my_transaction = mysql_fetch_assoc($resultTrans))
        {
            echo "<tr>";
            foreach($my_transaction as $key => $value)
            {
                $$key = $value;
                echo "<td>" .$value. "</td>";
            }
            echo "</tr>";
        }
        echo "</table><br/>";
    }
    else
    {
        echo "<p>No transaction recorded yet</p>";
    }
    $queryBalance = mysql_fetch_assoc(mysql_query("SELECT credits FROM users_details WHERE user_id='$user_id'"));
    echo "<b>Your current balance is: Rs." .$queryBalance['credits'] ."</b>";
}
?>