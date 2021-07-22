<?php
require 'navbar.php';
$db = new operationscategory();
$db->category_status();
$result = $db->view_record();
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Categories </h4>
				   <h4 class="box-link"><a href="manage_categories.php">Add Categories</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							  
							   <th>Categories</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {?>
							<tr>
							   <td class="serial"><?php echo $i; $i++; ?></td>
							
							   <td><?php echo $row['categories'] ?></td>
							   <td>
								<?php
if ($row['status'] == 1) {
    echo "<span class='badge badge-complete rounded-0'><a href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a></span>&nbsp;";
} else {
    echo "<span class='badge badge-pending rounded-0'><a href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a></span>&nbsp;";
}
    echo "<span class='badge badge-edit rounded-0'><a href='manage_categories.php?id=" . $row['id'] . "'>Edit</a></span>&nbsp;";

    echo "<span class='badge badge-delete rounded-0'><a href='?type=delete&id=" . $row['id'] . "'>Delete</a></span>";

    ?>
							   </td>
							</tr>
							<?php }?>
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
require 'footer.php';
?>