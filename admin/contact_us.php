<?php
require 'navbar.php';
$db = new operationsadmin();
$db->contact_us_delete();
$result = $db->contact_us_show();

?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Contact Us </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>Name</th>
							   <th>Email</th>
							   <th>Mobile</th>
							   <th>Query</th>
							   <th>Date</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {?>
							<tr>
							   <td class="serial"><?php echo $i;
    $i++; ?></td>

							   <td><?php echo $row['name'] ?></td>
							   <td><?php echo $row['email'] ?></td>
							   <td><?php echo $row['mobile'] ?></td>
							   <td><?php echo $row['comment'] ?></td>
							   <td><?php echo $row['added_on'] ?></td>
							   <td>
								<?php
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