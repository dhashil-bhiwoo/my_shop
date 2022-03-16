<html>
    <head>
        <title>My_Shop</title>
        <meta charset="UTF-8">
        <meta name="description" content="My Shop is an e-commerce website present globally, delivering at high speed delivery.">
        <meta name="keywords" content="e-commerce, shopping, cart, shopping cart, buying online, online shopping">
        <meta name="author" content="my_shop">
		<link rel="stylesheet" type="text/css" href="../css/styles.css" />
        <link rel="stylesheet" type="text/css" href="../css/lightbox.css" />
    </head>
    <body>
    <?php
    $cartItemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    $user = $_SESSION['email'];
	$user = explode('@',$user);
    ?>  
        <ul id="menu">
		    <li><a href="../view/user.php">Home</a></li>
