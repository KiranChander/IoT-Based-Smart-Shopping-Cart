<?php
	$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('UIDContainer.php',$Write);
?>

<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		<style>
		html {
			font-family: Arial;
			display: inline-block;
			margin: 0px auto;
			text-align: center;
		}

		ul.topnav {
			border-radius: 40px;
			list-style-type: none;
			margin: auto;
			padding: 0;
			overflow: hidden;
			background-color: #00008B;
			width: 70%;
		}

		ul.topnav li {float: left;}

		ul.topnav li a {
			display: block;
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}

		ul.topnav li a:hover:not(.active) {background-color: #FFA500;}

		ul.topnav li a.active {background-color: #333;}

		ul.topnav li.right {float: right;}

		@media screen and (max-width: 600px) {
			ul.topnav li.right, 
			ul.topnav li {float: none;}
		}
		
		img {
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
		</style>
		
		<title>Shopping Made Easier with Shoppy</title>
	</head>
	
	<body>
		<img src="flyer1.png" alt="" style="width: 10%; float: left; margin-right: 20px;">
		<img src="flyer2.png" alt="" style="width: 10%; float: right; margin-left: 20px;">
		<h2>Shoppy: Instant Checkout</h2>
		<ul class="topnav">
			<li><a class="active" href="home.php">Home</a></li>
			<li><a href="read_product.php">Read Product ID</a></li>
			<li><a href="shopping_cart.php">Shopping Cart</a></li>
			<li class="right"><a href="admin_access.php">Admin</a></li>
		</ul>
		<br>
		<h3>Welcome to Shoppy, an IOT based shopping experience. </h3>
		
		<img src="shoppyhome.png" alt="" style="width:55%;">
	</body>
</html>