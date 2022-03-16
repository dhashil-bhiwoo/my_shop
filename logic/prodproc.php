<?php
require ("../config/dbconn.php");
define("UPLOAD_DIR", "../images/");
define("THUMB_UPLOAD_DIR", "../images/thumbs/");
$urlProdAdmin="../view/prodadmin.php";
session_start();
if(isset($_POST['name']) && isset($_POST['color']) && isset($_POST['description']) && isset($_POST['qty']) && isset($_POST['price']))
{
    foreach ($_POST as $key => $value)
    {
        $$key=$value;
        $key=mysql_real_escape_string($value);
    }
    if (!empty($_FILES["file"])) 
    {
        $myFile = $_FILES["file"];
        if ($myFile["error"] !== UPLOAD_ERR_OK) 
        {
            echo "<script>alert('An error occurred while uploading the image');</script>";
            echo "<script>location.href='" .$urlProdAdmin. "'</script>";
            exit;
        }
        $image = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
        
        $i=0;
        $parts = pathinfo($image);
        while (file_exists(UPLOAD_DIR . $image)) 
        {    
            $i++;
            $image = $parts["filename"] . "-" . $i . "." . $parts["extension"];
        }
        
        $row_number = mysql_result(mysql_query("SELECT MAX(product_id) FROM product"), 0);
        $new_name=$row_number + 1;
        $new_image = $new_name . "." . $parts["extension"];
        //undefined index $type
        $type='.'.$parts["extension"];
 
        $success = move_uploaded_file($myFile["tmp_name"], UPLOAD_DIR . $new_image);
        if (!$success) 
        { 
            echo "<script>alert('Unable to save the image');</script>";
            exit;
        }
        include ("../inc/imageFix.php"); 
        $image = new image(); 
        $image->load(UPLOAD_DIR .$new_image); 
        $image->resizeToWidth(150); 
        $image->save(THUMB_UPLOAD_DIR .'thumb_'.$new_image);
    }
    mysql_query("INSERT INTO product (name, type, color, description)
    VALUES('$name', '$type', '$color', '$description')") or die("An Error Occurred");
    mysql_query("INSERT INTO product_details (qty, price)
    VALUES('$qty', '$price')") or die("An Error Occurred");
    echo "<script>alert('Product Inserted Successful');</script>";
    echo "<script>location.href='" .$urlProdAdmin. "'</script>";
}
else
{
    echo "<script>alert('An error occurred. Please try again');</script>";
    echo "<script>location.href='" .$urlProdAdmin. "'</script>";
}
?>