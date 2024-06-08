<?php
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM product_list  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: product_data.php");
         
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
				<h3 align="center">Delete Product</h3>
			</div>

			<form class="form-horizontal" action="product_data_delete.php" method="post">
				<input type="hidden" name="id" value="<?php echo $id;?>"/>
				<p class="alert alert-error">Are you sure to delete ?</p>
				<div class="form-actions">
					<button type="submit" class="btn btn-danger">Yes</button>
					<a class="btn" href="product_data.php">No</a>
				</div>
			</form>
		</div>
                 
    </div> <!-- /container -->
  </body>
</html>