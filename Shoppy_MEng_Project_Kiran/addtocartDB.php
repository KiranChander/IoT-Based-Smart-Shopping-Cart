<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track post values
        $product = $_POST['product'];
		$id = $_POST['id'];
		$category = $_POST['category'];
        $amount = $_POST['amount'];
        $price = $_POST['price'];
        
		// insert data
        $pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO shopping_cart (product,id,category,amount,price) values(?, ?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($product,$id,$category,$amount,$price));
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