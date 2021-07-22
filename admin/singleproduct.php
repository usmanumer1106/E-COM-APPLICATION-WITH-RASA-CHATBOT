<?php
require 'navbar.php';
$db = new operationsproduct();
$result = $db->view_check();
$db->add_stock();
$product = mysqli_fetch_assoc($result);
$remainingqty=$db->productSoldQtyByProductId($product['id']);
$remainingqty=$product['qty']-$remainingqty;
?>
<div class="content pb-0">
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">Produtct Detail </h4>
					</div>
					<div class="card-body--">
						<div>
							<table class="table">

								<tr>
									<td rowspan="6" width="35%">
										<img height="500px" src="<?php echo "../" . $product['image']; ?>">
									</td>

									<td>
										<b>Name:</b><?php echo $product['name']; ?>
									</td>
								</tr>
								<tr>
									<td>
										<b>Maximum Retail Price: </b><?php echo $product['mrp']; ?>
									</td>
								</tr>
								<tr>
									<td>
										<b>
											Retail Price:
										</b>
										<?php echo $product['price']; ?>
									</td>
								</tr>
								<tr>
									<td>
										<b>
											Short Discription:
										</b>
										<?php echo $product['short_desc']; ?>
									</td>
								</tr>
								<tr>
									<td>
										<b>
											Discription:
										</b>
										<?php echo $product['description']; ?>
									</td>
								</tr>
								<tr>
									<td>
									<b>	Quantity:</b><?php echo $product['qty']; ?>
									<br>
									<b>Remaining Quantity:</b> <?php  echo $remainingqty;  ?>
									</td>
								</tr>
							</table>
							<div class="container">
								
								<form method="post" style="margin-bottom: 30px;">

									<div class="row">
										<div class="col-lg-4">
											<input type="text" placeholder="Enter Quantity" name="qty" class="form-control rounded-0" />
										</div>
										<div class="col-lg-4">
											<button class="btn form-control rounded-0" name="addstock" type="submit" style="background-color:#01AEFC;">Add Stock</button>
										</div>
										<div class="col-lg-4">
											<a style="background-color:#01AEFC;" class="btn form-control" href="manage_product.php?id=<?php echo $product['id']; ?>">Edit This Product</a>
										</div>
									</div>
								</form>
							</div>
						</div>



					</div>

				</div>
			</div>
		</div>
	</div>
</div>



<?php
require 'footer.php';
?>