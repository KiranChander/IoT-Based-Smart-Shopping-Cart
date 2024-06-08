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
		<script>
    		var uidInterval;
    		// Check local storage for the toggle state on page load
    		$(document).ready(function() {
        		var instantModeEnabled = localStorage.getItem('instantModeEnabled');
        		if (instantModeEnabled === 'true') {
            		$('#instantModeToggle').prop('checked', true);
            		startFetchingUID(); // Start fetching UID if instant mode was enabled
        		} else {
            		$('#instantModeToggle').prop('checked', false);
        		}
    		});

    		function toggleInstantMode() {
        		var instantMode = $("#instantModeToggle").prop("checked");
        		// Store the toggle state in local storage
        		localStorage.setItem('instantModeEnabled', instantMode);

        		if (instantMode) {
            		startFetchingUID();
        		} else {
            		stopFetchingUID();
        		}
    		}

    		function startFetchingUID() {
        		$("#getUID").load("UIDContainer.php");
        		uidInterval = setInterval(function() {
            		$("#getUID").load("UIDContainer.php", function() {
                		var uid = $("#getUID").text().trim();
                		if (uid) {
                    		addToCart(uid);
                		}
            		});
        		}, 500);
    		}

    		function stopFetchingUID() {
        		clearInterval(uidInterval);
    		}

    		function addToCart(uid) {
        		$.ajax({
            		url: 'instantmode.php',
            		type: 'POST',
            		data: { uid: uid },
            		success: function(response) {
                		var result = JSON.parse(response);
                		if (result.status === 'success') {
                    		console.log('Product added to cart');
                    		setTimeout(function() {
                        		window.location.reload();
                    		}, 100); // Reload the page after a brief delay
                		} else {
                    		console.error(result.message);
                		}
            		},
            		error: function(xhr, status, error) {
                		console.error('Error adding product to cart:', error);
            		}
        		});
    		}
		</script>
		<script>
    		$(document).ready(function () {
        		$("#clearCartBtn").click(function () {
            		// Send AJAX request to clear cart
            		$.ajax({
                			url: 'clear_cart.php',
                		type: 'POST',
                		data: {
                    		action: 'clear_cart'
                		},
                		success: function (response) {
                    		// This function will be called on successful clearance
                    		console.log('Cart cleared successfully:', response);
                    		setTimeout(function(){
                        		window.location.reload();
                    		}, 100); // Reload the page
                		},
                		error: function (xhr, status, error) {
                    		// This function will be called if there's an error
                    		console.error('Error clearing cart:', error);
                		},
            		});
        		});
    		});
		</script>
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

		/* Style for the toggle switch */
		.toggle-label {
            font-size: 1.25em;
            font-weight: bold;
            display: inline-block;
            margin-left: 10px;
        }

		.switch {
      	position: relative;
      	display: inline-block;
      	width: 60px;
      	height: 34px;
    	}

    	.switch input {
      	opacity: 0;
      	width: 0;
      	height: 0;
    	}

    	.slider {
      	position: absolute;
      	cursor: pointer;
      	top: 0;
      	left: 0;
      	right: 0;
      	bottom: 0;
      	background-color: #ccc;
      	transition: .4s;
      	border-radius: 34px;
    	}

    	.slider:before {
      	position: absolute;
      	content: "";
      	height: 26px;
      	width: 26px;
      	left: 4px;
      	bottom: 4px;
      	background-color: white;
      	transition: .4s;
      	border-radius: 50%;
    	}

    	input:checked + .slider {
      	background-color: #2196F3;
    	}

    	input:checked + .slider:before {
      	transform: translateX(26px);
    	}

    	/* Style the slider if it's a round slider */
    	.slider.round {
      	border-radius: 34px;
    	}

    	.slider.round:before {
      	border-radius: 50%;
    	}
		</style>
		
		<title>Shopping Made Easier with Shoppy</title>
	</head>	
	<body>
		<h2>Shoppy: Instant Checkout</h2>
		<ul class="topnav">
			<li><a href="home.php">Home</a></li>
			<li><a href="read_product.php">Read Product ID</a></li>
			<li><a class="active" href="shopping_cart.php">Shopping Cart</a></li>
			<li class="right"><a href="admin_access.php">Admin</a></li>
		</ul>
		<br>
		<div class="container">
            <div class="row">
                <h3>Shopping Cart</h3>
            </div>
			<br>
			<!-- Toggle Switch for Instant Mode -->
			<label class="switch">
  			<input type="checkbox" id="instantModeToggle" onchange="toggleInstantMode()">
  			<span class="slider round"></span>
			</label> 
			<span class="toggle-label">Instant Mode</span>
			<br><br>
			<!-- UID Container (hidden) -->
			<div id="getUID" style="display: none;"></div>
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr bgcolor="#FFA500" color="#FFFFFF">
					  <th>S.No</th>
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
				   $totalPrice = 0; // Initialize $totalPrice variable
                   $sql = 'SELECT * FROM shopping_cart ORDER BY serialnumber ASC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
							echo '<td>'. $row['serialnumber'] . '</td>';
                            echo '<td>'. $row['product'] . '</td>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['category'] . '</td>';
							echo '<td>'. $row['amount'] . '</td>';
							echo '<td>'. $row['price'] . '</td>';
							echo ' ';
							echo '<td><a class="btn btn-danger" href="shopping_cart_remove.php?serialnumber='.$row['serialnumber'].'">Remove</a>';
							echo '</td>';
                            echo '</tr>';
							$totalPrice += $row['price']; // Add each price to total
                   }
                   Database::disconnect();
					echo '<tr>'; // Step 3: Display total row
					echo '<td colspan="5"><strong>Total:</strong></td>';
					echo '<td><strong>'. $totalPrice . '</strong></td>';
					echo '<td></td>'; // Since this cell is for actions, leave it empty
					echo '</tr>';
					echo '<tr>';
					echo '</tr>';
                  ?>
                  </tbody>
				</table>    
			</div>
		</div> <!-- /container -->
		<br><br>
        <div class="col-md-6">
            <button id="clearCartBtn" class="btn btn-danger">Clear Cart</button>
        </div>
        <br><br>
		<td colspan="6" align="center"><a class="btn btn-primary" href="payment.php?totalPrice=<?php echo $totalPrice; ?>">Pay now</a></td>
        <!-- Images -->
        <div class="image-container" style="margin: 20px auto; max-width: 80%;">
            <!-- Left Image -->
            <img src="storehours.png" alt="" style="width: 30%; float: left; margin-right: 60px;">
            <!-- Right Image -->
            <img src="donate.png" alt="" style="width: 30%; float: right; margin-left: 60px;">
        </div>
        </div>
    </body>
</html>