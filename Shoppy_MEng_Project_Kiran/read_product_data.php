<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM product_list where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
	
	$msg = null;
	if (null==$data['product']) {
		$msg = "The ID of your product is not registered !!!";
		$data['id']=$id;
		$data['product']="--------";
		$data['category']="--------";
		$data['amount']="--------";
		$data['price']="--------";
	} else {
		$msg = null;
	}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	<style>
		td.lf {
			padding-left: 15px;
			padding-top: 12px;
			padding-bottom: 12px;
		}
	</style>
</head>
 
	<body>	
		<div>
			<form>
				<table  width="452" border="1" bordercolor="#10a0c5" align="center"  cellpadding="0" cellspacing="1"  bgcolor="#000" style="padding: 2px">
					<tr>
						<td  height="40" align="center"  bgcolor="#FFA500"><font  color="#FFFFFF">
						<b>Product Details</b></font></td>
					</tr>
					<tr>
						<td bgcolor="#f9f9f9">
							<table width="452"  border="0" align="center" cellpadding="5"  cellspacing="0">
								<tr>
									<td width="113" align="left" class="lf">ID</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['id'];?></td>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">Product</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['product'];?></td>
								</tr>
								<tr>
									<td align="left" class="lf">Category</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['category'];?></td>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">Amount</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['amount'];?></td>
								</tr>
								<tr>
									<td align="left" class="lf">Price</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['price'];?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<?php
				// Add the product details to the form fields for adding to cart
            	echo '<input type="hidden" id="productID" value="' . $data['id'] . '">';
            	echo '<input type="hidden" id="productName" value="' . $data['product'] . '">';
            	echo '<input type="hidden" id="productCategory" value="' . $data['category'] . '">';
            	echo '<input type="hidden" id="productAmount" value="' . $data['amount'] . '">';
            	echo '<input type="hidden" id="productPrice" value="' . $data['price'] . '">';
				?>
			</form>
		</div>
		<p style="color:red;"><?php echo $msg;?></p>
	</body>
</html>