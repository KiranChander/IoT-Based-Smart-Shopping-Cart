<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM product_list where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
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

		ul.topnav li a:hover:not(.active) {background-color: #3e8e41;}

		ul.topnav li a.active {background-color: #333;}

		ul.topnav li.right {float: right;}

		@media screen and (max-width: 600px) {
			ul.topnav li.right, 
			ul.topnav li {float: none;}
		}
		</style>
		
		<title>Edit : Product Data</title>
		
	</head>
	
	<body>

		<h2 align="center">Shoppy: Instant Checkout</h2>
		
		<div class="container">
     
			<div class="center" style="margin: 0 auto; width:495px; border-style: solid; border-color: #f2f2f2;">
				<div class="row">
					<h3 align="center">Edit Product Data</h3>
					<p id="defaultCategory" hidden><?php echo $data['category'];?></p>
				</div>
		 
				<form class="form-horizontal" action="product_data_edit_update.php?id=<?php echo $id?>" method="post">
					<div class="control-group">
						<label class="control-label">ID</label>
						<div class="controls">
							<input name="id" type="text"  placeholder="" value="<?php echo $data['id'];?>" readonly>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Product</label>
						<div class="controls">
							<input name="product" type="text"  placeholder="" value="<?php echo $data['product'];?>" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Category</label>
						<div class="controls">
							<select name="category" id="mySelect">
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
							<input name="amount" type="text" placeholder="" value="<?php echo $data['amount'];?>" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Price</label>
						<div class="controls">
							<input name="price" type="text"  placeholder="" value="<?php echo $data['price'];?>" required>
						</div>
					</div>
					
					<div class="form-actions">
						<button type="submit" class="btn btn-success">Update</button>
						<a class="btn" href="product_data.php">Back</a>
					</div>
				</form>
			</div>               
		</div> <!-- /container -->	
		
		<script>
    var g = document.getElementById("defaultCategory").innerHTML;
    var select = document.getElementById("mySelect");

    switch(g) {
        case "Food":
            select.selectedIndex = 0;
            break;
        case "Kitchen":
            select.selectedIndex = 1;
            break;
        case "Plastics":
            select.selectedIndex = 2;
            break;
        case "HomeDecor":
            select.selectedIndex = 3;
            break;
        case "Toys":
            select.selectedIndex = 4;
            break;
        case "Pets":
            select.selectedIndex = 5;
            break;
        case "Beverage":
            select.selectedIndex = 6;
            break;
        case "Seasonal":
            select.selectedIndex = 7;
            break;
        case "Party":
            select.selectedIndex = 8;
            break;
        case "Beauty":
            select.selectedIndex = 9;
            break;
        case "Crafts":
            select.selectedIndex = 10;
            break;
        case "Stationery":
            select.selectedIndex = 11;
            break;
        case "Cleaning":
            select.selectedIndex = 12;
            break;
        case "Glass":
            select.selectedIndex = 13;
            break;
        case "Decorations":
            select.selectedIndex = 14;
            break;
        case "Garden":
            select.selectedIndex = 15;
            break;
        default:
            select.selectedIndex = 0; // Default to first option if no match found
    }
</script>

	</body>
</html>