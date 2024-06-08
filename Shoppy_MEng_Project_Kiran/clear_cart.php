<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
  
        try {
            // Execute SQL query to clear cart
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'DELETE FROM shopping_cart'; // Use DELETE FROM to clear all entries
            $q = $pdo->prepare($sql);
            $q->execute();
            Database::disconnect(); // Disconnect from database
            header("Location: shopping_cart.php");
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
        }
    }
?>