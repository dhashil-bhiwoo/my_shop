<?php
session_start();
include_once ("../inc/header.php"); 
require ("../config/dbconn.php");
require ("../inc/get_user_list.php");
if(isset($_SESSION['email']))
{
    echo"   <li><a href='contact.php'>Contact</a></li>
            <li><a href='admin.php'>Admin Panel</a></li>
		    <li>Hello " .$user[0]. "</li>
		    <li><a href='logout.php'>Logout</a></li>
		</ul>";
}
else
{
    $urlLogin = "../view/login.html";
    echo "<script>alert('Please login to access admin panel!');</script>";
	echo "<script>location.href='" .$urlLogin. "'</script>";
}
$query = "SELECT first_name, last_name, user_id FROM users"; 
$result = mysql_query($query); 
if(mysql_num_rows($result) == 0)
{
    echo "<p>No rows found!</p>";
	exit();
}
$num = mysql_num_rows($result); 
echo "<h3>View User Information</h3>
<form method='post' action='useradmin.php'>"; 	
echo "<select name='users'>"; 

while($my_user = mysql_fetch_assoc($result))
{
    foreach($my_user as $key => $value)
    {
        $$key=$value;
    }
echo "<option value='" .$user_id. "'>" .$first_name. ", " .$last_name. "</option>"; 
}
?> 
    </select>
    <input type="Submit" value="Submit"/>
</form>
<br />
<?php 
if(!isset($_POST['users']))
{
    $_POST['users'] = "";
}
get_user_list($_POST['users']);
include_once ("../inc/footer.php");
?> 