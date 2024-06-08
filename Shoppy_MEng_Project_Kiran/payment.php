<?php
	$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('UIDContainer.php',$Write);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment : Shopping Cart</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        html {
            font-family: Arial;
            display: inline-block;
            margin: 0px auto;
        }

        .center {
            margin: 0 auto;
            width: 495px;
            border-style: solid;
            border-color: #f2f2f2;
        }

        textarea {
            resize: none;
        }
    </style>
</head>

<body>

    <h2 align="center">Shoppy: Instant Checkout</h2>

    <div class="container">
        <div class="center">
            <div class="row">
                <h3 align="center">Payment</h3>
                <?php
                // Retrieve the total price from the URL query parameter
                $totalPrice = isset($_GET['totalPrice']) ? $_GET['totalPrice'] : 0;
                ?>
                <p align="center">Total Cost: <?php echo $totalPrice; ?></p>
            </div>

            <form id="paymentForm" class="form-horizontal" action="#" method="post">
                <div class="control-group">
                    <label class="control-label">Card Number</label>
                    <div class="controls">
                        <input name="card_number" id="card_number" type="text" placeholder="Enter card number" required>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">PIN</label>
                    <div class="controls">
                        <input name="pin" id="pin" type="password" placeholder="Enter PIN" required>
                    </div>
                </div>

                <div class="form-actions">
                    <button id="payNowBtn" type="button" class="btn btn-primary">Pay now</button>
                    <a class="btn btn-default" href="shopping_cart.php">Back to Shopping Cart</a>
                </div>
            </form>
        </div>
    </div> <!-- /container -->

    <!-- Payment Success Modal -->
    <div class="modal fade" id="paymentSuccessModal" tabindex="-1" role="dialog" aria-labelledby="paymentSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentSuccessModalLabel">Payment Successful</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Payment Successful.
                </div>
                <div class="modal-footer">
                    <button id="backToCartBtn" type="button" class="btn btn-secondary" data-dismiss="modal">Back to Shopping Cart</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Failure Modal -->
    <div class="modal fade" id="paymentFailureModal" tabindex="-1" role="dialog" aria-labelledby="paymentFailureModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentFailureModalLabel">Payment Unsuccessful</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Payment Unsuccessful.
                </div>
                <div class="modal-footer">
                    <button id="tryAgainBtn" type="button" class="btn btn-primary">Try Again</button>
                    <button id="backToCartBtnFailure" type="button" class="btn btn-secondary" data-dismiss="modal">Back to Shopping Cart</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function () {
        // Function to fetch data from UIDContainer.php and update card_number input field
        function updateCardNumber() {
            $.ajax({
                url: 'UIDContainer.php',
                type: 'GET',
                success: function(response) {
                    // Update the value of the card_number input field with the response data
                    $("#card_number").val(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error retrieving data from UIDContainer.php:', error);
                }
            });
        }
        
        // Call the function initially when the page is loaded
        updateCardNumber();
        
        // Set interval to call the updateCardNumber function every second
        setInterval(updateCardNumber, 500);
    });
    </script>

    <script>
        $(document).ready(function () {
            $("#payNowBtn").click(function () {
                // Validate card number and pin
                var cardNumber = $("#card_number").val();
                var pin = $("#pin").val();
                if (!cardNumber || !pin) {
                    alert("Please enter both card number and PIN.");
                    return;
                }
                // Perform payment processing
                // AJAX call to the server to process the payment
                // For demonstration purposes, let's assume payment is successful
                var isSuccess = (cardNumber === "1374068370" && pin === "7890");
                if (isSuccess) {
                    $("#paymentSuccessModal").modal('show');
                } else {
                    $("#paymentFailureModal").modal('show');
                }
            });

            // Redirect to shopping cart page when "Back to Shopping Cart" button is clicked
            $("#backToCartBtn").click(function () {
                window.location.href = 'shopping_cart.php';
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

            // Redirect to payment page when "Try Again" button is clicked
            $("#tryAgainBtn").click(function () {
                window.location.reload();
            });

            // Redirect to shopping cart page when "Back to Shopping Cart" button is clicked (for failure modal)
            $("#backToCartBtnFailure").click(function () {
                window.location.href = 'shopping_cart.php';
            });
        });
    </script>
</body>
</html>
