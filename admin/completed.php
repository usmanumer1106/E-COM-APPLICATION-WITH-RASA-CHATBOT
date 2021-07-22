<?php
require('navbar.php');
$db =new operationsorder();
$result=$db->view_recordcompledtd();
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Order Completed </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table">
							<thead>
								<tr>
									<th class="product-thumbnail">Sr No</th>
									<th class="product-name"><span class="nobr">Order Date</span></th>
									<th class="product-price"><span class="nobr"> Address </span></th>
									<th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
									<th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
								
									<th class="product-stock-stauts"><span class="nobr"> View Order Details </span></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sr=1;
								while($row=mysqli_fetch_assoc($result)){
								?>
								<tr>
									<td class="product-add-to-cart"><?php echo $sr; $sr++; ?></td>
									<td class="product-name"><?php echo $row['added_on']?></td>
									<td class="product-name">
									<?php echo $row['address']?><br/>
									<?php echo $row['city']?><br/>
									<?php echo $row['pincode']?>
									</td>
									<td class="product-name"><?php echo $row['payment_type']?></td>
									<td class="product-name"><?php echo $row['payment_status']?></td>
								
									<td class="product-name">
									<?php 
									echo "<span class='badge badge-pending rounded-0'><a href='order_master_detail.php?id=".$row['id']."'> View</a></span>&nbsp;";
								
								echo "<span class='badge badge-edit rounded-0'><a href='../order_pdf.php?id=".$row['id']."'>PDF Download</a></span>&nbsp;";
									
									?></td>
									
								</tr>
								<?php } ?>
							</tbody>
							
						</table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.php');
?>