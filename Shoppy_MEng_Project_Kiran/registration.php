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
		<script src="jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				 $("#getUID").load("UIDContainer.php");
				setInterval(function() {
					$("#getUID").load("UIDContainer.php");
				}, 500);
			});
		</script>
		
		<style>
		html {
			font-family: Arial;
			display: inline-block;
			margin: 0px auto;
		}
		
		textarea {
			resize: none;
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
		</style>
		
		<title>Registration : Shoppy - Shopping Cart</title>
	</head>
	
	<body>

		<h2 align="center">Shoppy: Instant Checkout</h2>
		<ul class="topnav">
			<li><a href="product_data.php">Product Data</a></li>
			<li><a class="active" id="registrationLink" href="registration.php">Registration</a></li>
			<li class="right"><a href="home.php">Back to Shopping</a></li>
		</ul>

		<div class="container">
			<br>
			<div class="center" style="margin: 0 auto; width:495px; border-style: solid; border-color: #f2f2f2;">
				<div class="row">
					<h3 align="center">Register New Product</h3>
				</div>
				<br>
				<form class="form-horizontal" action="insertDB.php" method="post" >
					<div class="control-group">
						<label class="control-label">ID</label>
						<div class="controls">
							<textarea name="id" id="getUID" placeholder="Please Scan your Card / Key Chain to display ID" rows="1" cols="1" required></textarea>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Product</label>
						<div class="controls">
							<input id="div_refresh" name="product" type="text"  placeholder="" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Category</label>
						<div class="controls">
							<select name="category">
								<option value="Food">Food</option>
								<option value="Kitchen">Kitchen</option>
								<option value="Plastics">Plastics</option>
								<option value="HomeDecor">HomeDecor</option>
								<option value="Toys">Toys</option>
								<option value="Pets">Pets</option>
								<option value="Beverage">Beverage</option>
								<option value="Seasonal">Seasonal</option>
								<option value="Party">Party</option>
								<option value="Beauty">Beauty</option>
								<option value="Crafts">Crafts</option>
								<option value="Stationery">Stationery</option>
								<option value="Cleaning">Cleaning</option>
								<option value="Glass">Glass</option>
								<option value="Decorations">Decorations</option>
								<option value="Garden">Garden</option>

							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Amount</label>
						<div class="controls">
							<input name="amount" type="text" placeholder="" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Price</label>
						<div class="controls">
							<input name="price" type="text"  placeholder="" required>
						</div>
					</div>
					
					<div class="form-actions">
						<button type="submit" class="btn btn-success">Save</button>
                    </div>
				</form>
				
			</div>               
		</div> <!-- /container -->	
	</body>
</html>