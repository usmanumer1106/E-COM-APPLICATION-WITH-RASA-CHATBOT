<?php
require 'navbar.php';
$db = new operationsorder();
$db->change_order_status();
$result = $db->view_order();
$result2 = $db->user_detail();
$result3 = $db->coupon();
$coupon_details = mysqli_fetch_assoc($result3);
$coupon_value = $coupon_details['coupon_value'];
$coupon_code = $coupon_details['coupon_code'];
$userInfo = mysqli_fetch_assoc($result2);
$address = $userInfo['address'];
$city = $userInfo['city'];
$pincode = $userInfo['pincode'];
$result4 = $db->order_status();
$order_status = mysqli_fetch_assoc($result4);
$status = $order_status['name'];
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Order Detail </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table">
								<thead>
									<tr>
										<th class="product-thumbnail">Product Name</th>
										<th class="product-thumbnail">Product Image</th>
										<th class="product-name">Qty</th>
										<th class="product-price">Price</th>
										<th class="product-price">Total Price</th>
									</tr>
								</thead>
								<tbody>
									<?php
$total_price = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $total_price = $total_price + ($row['qty'] * $row['price']);
    ?>
									<tr>
										<td class="product-name"><?php echo $row['name'] ?></td>
										<td class="product-name"> <img src="<?php echo "../" . $row['image'] ?>"></td>
										<td class="product-name"><?php echo $row['qty'] ?></td>
										<td class="product-name"><?php echo $row['price'] ?></td>
										<td class="product-name"><?php echo $row['qty'] * $row['price'] ?></td>

									</tr>
									<?php }if ($coupon_value == '') {
    $coupon_value = 0;
}
if ($coupon_value != 0) {
    ?>
									<tr>
										<td colspan="3"></td>
										<td class="product-name">Coupon Value</td>
										<td class="product-name">
										<?php
echo $coupon_value . "($coupon_code)";
    ?></td>

									</tr>
									<?php }?>
									<tr>
										<td colspan="3"></td>
										<td class="product-name">Total Price</td>
										<td class="product-name"><?php
echo $total_price - $coupon_value;
?></td>

									</tr>
								</tbody>

						</table>
						<div id="address_details">
							<strong>Address</strong>
							<?php echo $address ?>, <?php echo $city ?>, <?php echo $pincode ?><br/><br/>
							<strong>Order Status</strong>
							<?php
echo $status;
?>

					
								<form method="post" style="margin-top: 10px;">

								<div class="row">
									<div class="col-lg-6">
									<select class="form-control rounded-0" name="update_order_status" id="update_order_status" required ">
										<option value="">Select Status</option>
										<?php
								$result5 = $db->status();
								while ($row = mysqli_fetch_assoc($result5)) {
									echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
								}
								?>
									</select>
									</div>
							<div class="col-lg-6">

							<button class="btn form-control rounded-0" type="submit"  style="background-color:#01AEFC;">Submit</button>
							
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
</div>

<?php
require 'footer.php';
?>