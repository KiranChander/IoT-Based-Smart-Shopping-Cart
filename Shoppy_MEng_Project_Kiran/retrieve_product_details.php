<?php
    // Include database connection
    require 'database.php';

    // Check if ID is provided
    if(isset($_POST['id'])) {
        // Get the ID from the POST data
        $id = $_POST['id'];
        
        // Retrieve product details from the database based on the ID
        $pdo = Database::connect();
        $sql = "SELECT * FROM product_list WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        // Display the retrieved data
        if($product) {
            echo '<table width="452" border="0" align="center" cellpadding="5" cellspacing="0">';
            echo '<tr>';
            echo '<td width="113" align="left" class="lf">ID</td>';
            echo '<td style="font-weight:bold">:</td>';
            echo '<td align="left">' . $product['id'] . '</td>';
            echo '</tr>';
            echo '<tr bgcolor="#f2f2f2">';
            echo '<td align="left" class="lf">Product</td>';
            echo '<td style="font-weight:bold">:</td>';
            echo '<td align="left">' . $product['product'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="left" class="lf">Category</td>';
            echo '<td style="font-weight:bold">:</td>';
            echo '<td align="left">' . $product['category'] . '</td>';
            echo '</tr>';
            echo '<tr bgcolor="#f2f2f2">';
            echo '<td align="left" class="lf">Amount</td>';
            echo '<td style="font-weight:bold">:</td>';
            echo '<td align="left">' . $product['amount'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="left" class="lf">Price</td>';
            echo '<td style="font-weight:bold">:</td>';
            echo '<td align="left">' . $product['price'] . '</td>';
            echo '</tr>';
            echo '</table>';
            
            // Add the product details to the form fields for adding to cart
            echo '<input type="hidden" id="productID" value="' . $product['id'] . '">';
            echo '<input type="hidden" id="productName" value="' . $product['product'] . '">';
            echo '<input type="hidden" id="productCategory" value="' . $product['category'] . '">';
            echo '<input type="hidden" id="productAmount" value="' . $product['amount'] . '">';
            echo '<input type="hidden" id="productPrice" value="' . $product['price'] . '">';
        } else {
            echo 'Product not found.';
        }
    } else {
        echo 'ID not provided.';
    }
?>
