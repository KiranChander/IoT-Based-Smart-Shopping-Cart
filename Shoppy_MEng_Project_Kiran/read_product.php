<?php
	$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('UIDContainer.php',$Write);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
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
		
		td.lf {
			padding-left: 15px;
			padding-top: 12px;
			padding-bottom: 12px;
		}
		</style>
		
		<title>Read Product : Shoppy</title>
	</head>
	
	<body>
		<img src="flyer1.png" alt="" style="width: 10%; float: left; margin-right: 20px;">
		<img src="flyer2.png" alt="" style="width: 10%; float: right; margin-left: 20px;">
		<h2 align="center">Shoppy: Instant Checkout</h2>
		<ul class="topnav">
			<li><a href="home.php">Home</a></li>
			<li><a class="active" href="read_product.php">Read Product ID</a></li>
			<li><a href="shopping_cart.php">Shopping Cart</a></li>
			<li class="right"><a href="admin_access.php">Admin</a></li>
		</ul>
		
		<br>
		
		<h3 align="center" id="blink">Please Scan Tag to Display ID or Product Details</h3>
		
		<p id="getUID" hidden></p>
		
		<br>
		
		<div id="show_product_data">
			<form>
				<table  width="452" border="1" bordercolor="#10a0c5" align="center"  cellpadding="0" cellspacing="1"  bgcolor="#000" style="padding: 2px">
					<tr>
						<td  height="40" align="center"  bgcolor="#FFA500"><font  color="#FFFFFF">
							<b>Product Details</b>
							</font>
						</td>
					</tr>
					<tr>
						<td  bgcolor="#f9f9f9">
							<table width="452"  border="0" align="center" cellpadding="5"  cellspacing="0">
								<tr>
									<td width="113" align="left" class="lf">ID</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><input type="text" id="idInput" name="id" placeholder="Type or Scan ID"></td>
									<td button id="searchID" class="btn btn-primary btn-sm">LookUp</button>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">Product</td>
									<td style="font-weight:bold">:</td>
									<td align="left">--------</td>
								</tr>
								<tr>
									<td align="left" class="lf">Category</td>
									<td style="font-weight:bold">:</td>
									<td align="left">--------</td>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">Amount</td>
									<td style="font-weight:bold">:</td>
									<td align="left">--------</td>
								</tr>
								<tr>
									<td align="left" class="lf">Price</td>
									<td style="font-weight:bold">:</td>
									<td align="left">--------</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div class="form-actions">
    		<button id="addToCartBtn" class="btn btn-success">Add to Cart</button>
			<div style="text-align: center; margin-top: 20px;">
        		<button id="scanNextItemBtn" class="btn btn-info">Scan Next Item</button>
    		</div>
		</div>

		<!-- Modal for success or failure message -->
		<div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-labelledby="addToCartModalLabel" aria-hidden="true">
    		<div class="modal-dialog" role="document">
        		<div class="modal-content">
            		<div class="modal-header justify-content-end">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    		<span aria-hidden="true">&times;</span>
                		</button>
                		<h5 class="modal-title" id="addToCartModalLabel">Add to Cart</h5>
            		</div>
            		<div class="modal-body" id="addToCartModalBody">
                	<!-- Message will be displayed here -->
            		</div>
        		</div>
    		</div>
		</div>

		<script>
			var myVar = setInterval(myTimer, 1000);
			var myVar1 = setInterval(myTimer1, 1000);
			var oldID="";
			clearInterval(myVar1);

			function myTimer() {
				var getID=document.getElementById("getUID").innerHTML;
				oldID=getID;
				if(getID!="") {
					myVar1 = setInterval(myTimer1, 500);
					showProduct(getID);
					clearInterval(myVar);
				}
			}
			
			function myTimer1() {
				var getID=document.getElementById("getUID").innerHTML;
				if(oldID!=getID) {
					myVar = setInterval(myTimer, 500);
					clearInterval(myVar1);
				}
			}
			
			function showProduct(str) {
				if (str == "") {
					document.getElementById("show_product_data").innerHTML = "";
					return;
				} else {
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("show_product_data").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET","read_product_data.php?id="+str,true);
					xmlhttp.send();
				}
			}
			var blink = document.getElementById('blink');
			setInterval(function() {
				blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
			}, 750); 
		</script>

		<script>
    		$("#searchID").click(function(){
        		var id = $("#idInput").val();
        		if(id.trim() !== "") {
            		$.ajax({
                		url: 'retrieve_product_details.php',
                		type: 'POST',
                		data: { id: id },
                		success: function(response) {
                    		$("#show_product_data").html(response);
                		},
                		error: function(xhr, status, error) {
                    		console.error('Error retrieving product details:', error);
                		}
            		});
        		}
    		});
		</script>

		<script>
    		document.getElementById("scanNextItemBtn").addEventListener("click", function() {
        		location.reload();
    		});
		</script>

		<script>
    		$(document).ready(function(){
        		$("#addToCartBtn").click(function(){
					// Check if the input fields are present
					if ($("#productID").length && $("#productName").length && $("#productCategory").length && $("#productAmount").length && $("#productPrice").length) {
            			// Get the product details
						var productID = $("#productID").val();
            			var productName = $("#productName").val();
            			var productCategory = $("#productCategory").val();
            			var productAmount = $("#productAmount").val();
            			var productPrice = $("#productPrice").val();
        
            			// Send the product details to addtocartDB.php using AJAX
            			$.ajax({
                			url: 'addtocartDB.php',
                			type: 'POST',
                			data: {
								id: productID, 
                    			product: productName,
                    			category: productCategory,
                    			amount: productAmount,
                    			price: productPrice
                			},
                			success: function(response) {
                    			// Handle success
                    			$('#addToCartModalBody').text('Product added to cart successfully.');
                    			$('#addToCartModal').modal('show');
                			},
                			error: function(xhr, status, error) {
                    			// Handle errors
                    			$('#addToCartModalBody').text('Unable to add the product.');
                    			$('#addToCartModal').modal('show');
                			}
            			});
					} else {
            			// Input fields are not present, display the modal with "Item Not Found" message
            			$('#addToCartModalBody').text('Item Not Found.');
            			$('#addToCartModal').modal('show');
        			}
        		});
    		});
		</script>

	</body>
</html>