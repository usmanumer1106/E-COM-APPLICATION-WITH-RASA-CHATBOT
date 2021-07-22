<?php
require 'navbar.php';
$db = new operationsbanner();
$banner = $db->get_record();
$heading1 = '';
$heading2 = '';
$btn_txt = '';
$btn_link = '';
$image_required='required';

if (isset($_GET['id']) && $_GET['id'] != '') {
	$heading1 = $banner['heading1'];
	$heading2 = $banner['heading2'];
	$btn_txt = $banner['btn_txt'];
	$btn_link = $banner['btn_link'];
	$image_required='';
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Heading</strong><small> Form</small></div>
						<?php

$db->Store_Record();

?>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="heading1" class=" form-control-label">Heading 1</label>
									<input type="text" name="heading1" placeholder="Enter Heading 1" class="form-control rounded-0"  required value="<?php echo $heading1 ?>">
								</div>
								<div class="form-group">
									<label for="heading2" class=" form-control-label">Heading 2</label>
									<input type="text" name="heading2" placeholder="Enter Heading 1" class="form-control rounded-0"  required value="<?php echo $heading2 ?>">
								</div>
								<div class="form-group">
									<label for="btn_txt" class=" form-control-label">Button Text</label>
									<input type="text" name="btn_txt" placeholder="Enter Button Text" class="form-control rounded-0"   value="<?php echo $btn_txt ?>">
								</div>
								<div class="form-group">
									<label for="btn_link" class=" form-control-label">Button Link</label>
									<input type="text" name="btn_link" placeholder="Enter Button Link" class="form-control rounded-0"   value="<?php echo $btn_link ?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Image</label>
									<input type="file" name="image" class="form-control rounded-0" <?php echo $image_required ?>>
								</div>
							   <button id="payment-button" name="submit" type="submit" class="btn rounded-0 btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"></div>
							</div>

						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>

<?php
require 'footer.php';
?>