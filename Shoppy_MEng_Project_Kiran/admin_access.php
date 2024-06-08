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
            $(document).ready(function () {
                // Function to fetch data from UIDContainer.php and update Employee Authentication field
                function updateEmployeeAuth() {
                    $.ajax({
                        url: 'UIDContainer.php',
                        type: 'GET',
                        success: function(response) {
                            // Update the value of the Employee Authentication input field with the response data
                            $("#password").val(response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error retrieving data from UIDContainer.php:', error);
                        }
                    });
                }
        
                // Call the function initially when the page is loaded
                updateEmployeeAuth();
        
                // Set interval to call the updateCardNumber function every second
                setInterval(updateEmployeeAuth, 500);
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
		
		img {
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
		</style>
		
		<title>Shopping Made Easier with Shoppy</title>
	</head>
	
	<body>
		<h2>Shoppy: Instant Checkout</h2>
		<ul class="topnav">
			<li><a href="home.php">Home</a></li>
			<li><a href="read_product.php">Read Product ID</a></li>
			<li><a href="shopping_cart.php">Shopping Cart</a></li>
			<li class="right"><a class="active" href="admin_access.php">Admin</a></li>
		</ul>
		<br>
		<h3>Enter your employee ID </h3>

        <div class="login-box">
            <input type="text" id="employeeID" placeholder="Employee ID">
            <input type="password" id="password" placeholder="Employee Authentication">
            <button id="loginButton" class="btn btn-warning" onclick="validateLogin()">Login</button>
        </div>

        <div class="button-container">
        <button id="registrationButton" class="btn btn-primary btn-lg" onclick="window.location.href='registration.php';" disabled>Product Registration</button>
        <button id="productDataButton" class="btn btn-primary btn-lg" onclick="window.location.href='product_data.php';" disabled>Product Data List</button>
        </div>

        <script>
        function validateLogin() {
            var employeeID = document.getElementById("employeeID").value;
            var password = document.getElementById("password").value;
            
            // Check if employee ID and password are valid
            if (employeeID === "00987644" && password === "1374068370") {
                // Enable buttons
                document.getElementById("registrationButton").disabled = false;
                document.getElementById("productDataButton").disabled = false;
            } else {
                // Display error message or take appropriate action
                alert("Invalid employee ID or Authentication!");
            }
        }
        </script>
	</body>
</html>