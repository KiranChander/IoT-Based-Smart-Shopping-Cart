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
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery library -->
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
		
		.table {
			margin: auto;
			width: 90%; 
		}
		
		thead {
			color: #FFFFFF;
		}
		</style>
		
		<title>Shopping Made Easier with Shoppy</title>
	</head>
	
	<body>
		<h2>Shoppy: Instant Checkout</h2>
		<ul class="topnav">
			<li><a class="active" href="product_data.php">Product Data</a></li>
			<li><a href="registration.php">Registration</a></li>
			<li class="right"><a href="home.php">Back to Shopping</a></li>
		</ul>
		<br>
		<div class="container">
            <div class="row">
                <h3>Product Data</h3>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr bgcolor="#FFA500" color="#FFFFFF">
                      <th>Product</th>
                      <th>ID</th>
					  <th>Category</th>
					  <th>Amount</th>
                      <th>Price</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
				   //$totalPrice = 0; // Initialize $totalPrice variable
                   $sql = 'SELECT * FROM product_list ORDER BY product ASC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['product'] . '</td>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['category'] . '</td>';
							echo '<td>'. $row['amount'] . '</td>';
							echo '<td>'. $row['price'] . '</td>';
							echo '<td><a class="btn btn-success" href="product_data_edit.php?id='.$row['id'].'">Edit</a>';
							echo ' ';
							echo '<a class="btn btn-danger" href="product_data_delete.php?id='.$row['id'].'">Delete</a>';
							echo '</td>';
                            echo '</tr>';
							//$totalPrice += $row['price']; // Add each price to total
                   }
                   Database::disconnect();
					//echo '<tr>'; // Step 3: Display total row
					//echo '<td colspan="4"><strong>Total:</strong></td>';
					//echo '<td><strong>'. $totalPrice . '</strong></td>';
					//echo '<td></td>'; // Since this cell is for actions, leave it empty
					//echo '</tr>';
					//echo '<tr>';
					//echo '</tr>';
                  ?>
                  </tbody>
				</table>
			</div>
		</div> <!-- /container -->
		<br><br>
	</body>
</html>