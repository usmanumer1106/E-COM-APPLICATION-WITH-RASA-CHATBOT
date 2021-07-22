<?php
require('navbar.php');
$db =new operationssubcategory();
$result=$db->view_record_active();
$result2=$db->get_record();
$categories = '';
$sub_categories = '';
if (isset($_GET['id']) && $_GET['id'] != ''){
$check = mysqli_num_rows($result2);
if ($check > 0) {
	$row = mysqli_fetch_assoc($result2);
	$sub_categories = $row['sub_categories'];
	$categories = $row['categories_id'];
} 
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Sub Categories</strong><small> Form</small></div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">Categories</label>
									<select name="categories_id" required class="form-control rounded-0">
										<option value="">Select Categories</option>
										<?php
										$res=mysqli_query($db->connection,"select * from categories where status='1'");
										while($row=mysqli_fetch_assoc($result)){
											if($row['id']==$categories){
												echo "<option value=".$row['id']." selected>".$row['categories']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['categories']."</option>";
											}
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Sub Categories</label>
									<input type="text" name="sub_categories" placeholder="Enter sub categories" class="form-control rounded-0" required value="<?php echo $sub_categories; ?>" ">
								</div>
							   <button id="payment-button" name="submit" type="submit" class="btn btn-info btn-block rounded-0">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php $db->Store_Record(); ?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
require('footer.php');
?>