<?php
require 'database.php';

$response = array('status' => 'error', 'message' => 'Unknown error');

if (!empty($_POST['uid'])) {
    $uid = $_POST['uid'];
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM product_list WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($uid));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $product = $data['product'];
        $category = $data['category'];
        $amount = $data['amount'];
        $price = $data['price'];

        $sql = "INSERT INTO shopping_cart (product, id, category, amount, price) VALUES (?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($product, $uid, $category, $amount, $price));
        
        try {
            $pdo->beginTransaction();
            $sql = "SET @new_serial = 0";
            $pdo->query($sql);
            $sql = "UPDATE shopping_cart SET serialnumber = (@new_serial := @new_serial + 1) ORDER BY serialnumber";
            $pdo->query($sql);
            $pdo->commit();
            
            $response['status'] = 'success';
            $response['message'] = 'Product added to cart';
        } catch (Exception $e) {
            $pdo->rollBack();
            $response['message'] = 'Failed to reorder: ' . $e->getMessage();
        }
    } else {
        $response['message'] = 'Product not found';
    }

    Database::disconnect();
} else {
    $response['message'] = 'No UID provided';
}

echo json_encode($response);
?>
