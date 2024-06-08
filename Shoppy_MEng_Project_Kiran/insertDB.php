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
		$sql = "INSERT INTO product_list (product,id,category,amount,price) values(?, ?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($product,$id,$category,$amount,$price));
		Database::disconnect();
		header("Location: product_data.php");
    }
?>