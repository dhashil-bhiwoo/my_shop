<?php
function get_user_list($user_id)
{
    require ("../config/dbconn.php");
    
    $query = "SELECT first_name, last_name, dob, address, states, country, mobile_number, gender, email, reg_date 
            FROM users 
            WHERE user_id = '$user_id'"; 
            
    $result = mysql_query($query) or die ("An error occurred");   
?>
    <table cellspacing='3' cellpadding='4' id='oddEven'>
        <tr>
            <th> First Name </th>
            <th> Last Name </th>
            <th> DOB </th>
            <th> Address </th>
            <th> State </th>
            <th> Country </th>
            <th> Mobile Number </th>
            <th> Gender </th>
            <th> Email </th>
            <th> Date Registered </th>
        </tr>
<?php
    while($my_user = mysql_fetch_assoc($result))
    {
        echo "<tr>";
        foreach($my_user as $key => $value)
        {
            $$key = $value;
            echo "<td>" .$value. "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>