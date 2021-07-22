<?php
require 'navbar.php';
$db = new operationsreviews();
$db->category_status();
$result=$db->view_record();
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Product Review </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   
							   <th >Name/Email</th>
							   <th>Product Name</th>
							   <th>Rating</th>
							   <th>Review</th>
							   <th>Added On</th>
							   <th width="20%"></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($result)){?>
							<tr>
							   <td class="serial"><?php echo $i; $i++?></td>
							
							   <td><?php echo $row['name']?>/<?php echo $row['email']?></td>
							   <td><?php echo $row['pname']?></td>
							   <td><?php echo $row['rating']?></td>
							   <td><?php echo $row['review']?></td>
							   <td><?php echo $row['added_on']?></td>
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete rounded-0' ><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending rounded-0' ><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
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