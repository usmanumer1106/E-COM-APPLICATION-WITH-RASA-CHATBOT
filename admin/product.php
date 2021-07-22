<?php
require('navbar.php');
$db= new operationsproduct();
$db->product_status();
$result=$db->view_record();
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Products </h4>
				   <h4 class="box-link"><a href="manage_product.php">Add Product</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th width="2%">ID</th>
							   <th width="10%">Categories</th>
							   <th width="25%">Name</th>
							   <th width="10%">Image</th>
							   <th width="5%">MRP</th>
							   <th width="7%">Price</th>
							   <th width="5%">Total Qty</th>
							   <th width="5%">Remaining Qty</th>
							   <th width="35%"></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($result)){?>
							<tr>
							   <td class="serial"><?php echo $i; $i++?></td>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['categories']?></td>
							   <td><?php echo $row['name']?></td>
							   <td><img src="<?php  echo "../".$row['image']?>"/></td>
							   <td><?php echo $row['mrp']?></td>
							   <td><?php echo $row['price']?></td>
							   <td><?php echo $row['qty']?><br/>
							   <?php
							   $productSoldQtyByProductId=$db->productSoldQtyByProductId($row['id']);
							   $pneding_qty=$row['qty']-$productSoldQtyByProductId;
							   
							   ?>
							
							   
							   </td>
							   <td>
							   <?php echo $pneding_qty?>
							   </td>
							   <td>
								   <a class='badge badge-edit rounded-0' href="singleproduct.php?id=<?php echo $row['id'];?>">View</a>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete rounded-0'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending rounded-0'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit rounded-0'><a href='manage_product.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete rounded-0'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								
								?>
							   </td>
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