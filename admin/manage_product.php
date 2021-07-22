<?php
require 'navbar.php';
$db = new operationscategory();
$db2 = new operationsproduct();
$db2->deleteimg();
$result = $db->view_record();
$categories_id = '';
$name = '';
$mrp = '';
$price = '';
$qty = '';
$image = '';
$short_desc = '';
$description = '';

$best_seller = '';
$sub_categories_id = '';
$multipleImageArr=[];
$image_required = 'required';
$result2 = $db2->view_check();
if (isset($_GET['id']) && $_GET['id'] != '') {
	$id=$_GET['id'];
    $check = mysqli_num_rows($result2);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($result2);
        $categories_id = $row['categories_id'];
        $sub_categories_id = $row['sub_categories_id'];
        $name = $row['name'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $qty = $row['qty'];
        $short_desc = $row['short_desc'];
        $description = $row['description'];
     
        $best_seller = $row['best_seller'];
        $image_required = '';
		$images=$db2->multipleimage();
		if(mysqli_num_rows($images)>0){
			$jj = 0;
			while($rowMultipleImage=mysqli_fetch_assoc($images)){
				$multipleImageArr[$jj]['product_images']=$rowMultipleImage['product_images'];
				$multipleImageArr[$jj]['id']=$rowMultipleImage['id'];
				$jj++;
			}
		}
    }
}

?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<div class="row">
									  <div class="col-lg-6">
										<label for="categories" class=" form-control-label">Categories</label>
										<select class="form-control rounded-0" name="categories_id" id="categories_id" onchange="get_sub_cat('')" required>
											<option>Select Category</option>
											<?php
										
											while($row=mysqli_fetch_assoc($result)){
												if($row['id']==$categories_id){
													echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
												}else{
													echo "<option value=".$row['id'].">".$row['categories']."</option>";
												}
												
											}
											?>
										</select>
									  </div>
									   <div class="col-lg-6">
										<label for="categories" class=" form-control-label">Sub Categories</label>
										<select class="form-control rounded-0" name="sub_categories_id" id="sub_categories_id">
											<option>Select Sub Category</option>
										</select>
									  </div>
									</div>
								</div>	
								<div class="form-group">
									<label for="categories" class=" form-control-label">Product Name</label>
									<input type="text" name="name" placeholder="Enter product name" class="form-control rounded-0" required value="<?php echo $name?>">
								</div>
								<div class="form-group">
									<div class="row">
									  <div class="col-lg-3">
										<label for="categories" class=" form-control-label">Best Seller</label>
										<select class="form-control rounded-0" name="best_seller" required>
											<option value=''>Select</option>
											<?php
											if($best_seller==1){
												echo '<option value="1" selected>Yes</option>
													<option value="0">No</option>';
											}elseif($best_seller==0){
												echo '<option value="1">Yes</option>
													<option value="0" selected>No</option>';
											}else{
												echo '<option value="1">Yes</option>
													<option value="0">No</option>';
											}
											?>
										</select>
									  </div>
									  <div class="col-lg-3">
										<label for="categories" class=" form-control-label rounded-0">MRP</label>
										<input type="text" name="mrp" placeholder="Enter product mrp" class="form-control rounded-0" required value="<?php echo $mrp?>">
									  </div>
									  <div class="col-lg-3">
										<label for="categories" class=" form-control-label">Price</label>
										<input type="text" name="price" placeholder="Enter product price" class="form-control rounded-0" required value="<?php echo $price?>">
									  </div>
									  <div class="col-lg-3">
										<label for="categories" class=" form-control-label">Qty</label>
										<input type="text" name="qty" placeholder="Enter qty" class="form-control rounded-0" required value="<?php echo $qty?>">
									  </div>
									</div>
									
								</div>
								
								
								
								<div class="form-group">
									<div class="row"  id="image_box">
									  <div class="col-lg-10">
									   <label for="categories" class=" form-control-label">Image</label>
										<input type="file" name="image" class="form-control rounded-0" <?php echo  $image_required?>>
										<?php
										if($image!=''){
echo "<a target='_blank' href='$image'><img width='150px' src='$image'/></a>";
										}
										?>
									  </div>
									  <div class="col-lg-2">
										<label for="categories" class=" form-control-label"></label>
										<button id="" type="button" class="btn btn-info btn-block rounded-0" onclick="add_more_images()">
											<span id="payment-button-amount">Add Image</span>
										</button>
									 </div>
									 
									 <?php
									 if(isset($multipleImageArr[0])){
foreach($multipleImageArr as $list){
$path="../".$list['product_images'];

	echo '<div class="col-lg-6" style="margin-top:20px;" id="add_image_box_'.$list['id'].'"><label for="categories" class=" form-control-label">Image</label><input type="file" name="product_images[]" class="form-control rounded-0" ><a href="manage_product.php?id='.$id.'&pi='.$list['id'].'" style="color:white;"><button type="button" class="btn rounded-0 btn-danger btn-block"><span id="payment-button-amount"><a href="manage_product.php?id='.$id.'&pi='.$list['id'].'" style="color:white;">Remove</span></button></a>';
	echo "<a target='_blank' href='".$path."'><img width='150px' src='".$path."'/></a>";
	echo '<input type="hidden" name="product_images_id[]" value="'.$list['id'].'"/></div>';
	
}										 
									 }
									 ?>
									 
								  </div>
									 
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Short Description</label>
									<textarea name="short_desc" placeholder="Enter product short description" class="form-control rounded-0" required><?php echo $short_desc?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Description</label>
									<textarea name="description" placeholder="Enter product description" class="form-control rounded-0" required><?php echo $description?></textarea>
								</div>
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-info btn-block rounded-0">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php $db2->Store_Record(); ?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
		 
		 <script>
			function get_sub_cat(sub_cat_id){
				var categories_id=jQuery('#categories_id').val();
				jQuery.ajax({
					url:'get_sub_cat.php',
					type:'post',
					data:'categories_id='+categories_id+'&sub_cat_id='+sub_cat_id,
					success:function(result){
						jQuery('#sub_categories_id').html(result);
					}
				});
			}
			
			var total_image=1;
			function add_more_images(){
				total_image++;
				var html='<div class="col-lg-6" style="margin-top:20px;" id="add_image_box_'+total_image+'"><label for="categories" class=" form-control-label">Image</label><input type="file" name="product_images[]" class="form-control" required><button type="button" class="btn btn-lg btn-danger btn-block" onclick=remove_image("'+total_image+'")><span id="payment-button-amount">Remove</span></button></div>';
				jQuery('#image_box').append(html);
			}
			
			function remove_image(id){
				jQuery('#add_image_box_'+id).remove();
			}
		 </script>
         
<?php
require('footer.php');
?>
<script>
<?php
if(isset($_GET['id'])){
?>
get_sub_cat('<?php echo $sub_categories_id?>');
<?php } ?>
</script>