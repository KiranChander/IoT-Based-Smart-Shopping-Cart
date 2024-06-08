<?php
    require 'database.php';
    $serialnumber = 0;
     
    if ( !empty($_GET['serialnumber'])) {
        $serialnumber = $_REQUEST['serialnumber'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $serialnumber = $_POST['serialnumber'];
         
        // remove product
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM shopping_cart  WHERE serialnumber = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($serialnumber));

        try {
            // Begin a transaction
            $pdo->beginTransaction();

            // Reorder the serial numbers
            $sql = "SET @new_serial = 0";
            $pdo->query($sql);

            $sql = "UPDATE shopping_cart SET serialnumber = (@new_serial := @new_serial + 1) ORDER BY serialnumber";
            $pdo->query($sql);

            // Commit the transaction
            $pdo->commit();
        } catch (Exception $e) {
            // Rollback the transaction in case of error
            $pdo->rollBack();
            echo "Failed to reorder: " . $e->getMessage();
        }

        Database::disconnect();
        header("Location: shopping_cart.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	<title>Delete : Product Data</title>
</head>
 
<body>
	<h2 align="center">Shoppy: Shopping Cart</h2>

    <div class="container">
     
		<div class="span10 offset1">
			<div class="row">
				<h3 align="center">Remove Product from Shopping Cart</h3>
			</div>

			<form class="form-horizontal" action="shopping_cart_remove.php" method="post">
				<input type="hidden" name="serialnumber" value="<?php echo $serialnumber;?>"/>
				<p class="alert alert-error">Are you sure to remove this product ?</p>
				<div class="form-actions">
					<button type="submit" class="btn btn-danger">Yes</button>
					<a class="btn" href="shopping_cart.php">No</a>
				</div>
			</form>
		</div>
                 
    </div> <!-- /container -->
  </body>
</html>