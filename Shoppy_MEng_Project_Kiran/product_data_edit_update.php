<?php
    require 'database.php';
 
    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if (!empty($_POST)) {
        // Keep track of post values
        $product = $_POST['product'];
        $category = $_POST['category'];
        $amount = $_POST['amount'];
        $price = $_POST['price'];
        $id = $_POST['id'];
         
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE product_list SET product = ?, category = ?, amount = ?, price = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($product, $category, $amount, $price, $id));
        Database::disconnect();
        header("Location: product_data.php");
    }
?>
