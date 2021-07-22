<?php
require 'navbar.php';
$db = new operationsorder();
$result = $db->view_record();
$totalorders=mysqli_num_rows($result);
$result = $db->view_recordnotprocess();
$notprocess=mysqli_num_rows($result);
$result = $db->view_recordinprocess();
$inprocess=mysqli_num_rows($result);
$result = $db->view_recordshiped();
$shipped=mysqli_num_rows($result);
$result = $db->view_recordcanceled();
$cancled=mysqli_num_rows($result);
$result = $db->view_recordcompledtd();
$completed=mysqli_num_rows($result);


?>
<div class="content pb-0">
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">Dashboard </h4>
					</div>
					<div class="card-body--">

						<div class="container">
							<div class="row">

								<div class="col-lg-4">
									<div class="card" style="width: 18rem;">
										<div class="card-body rounded" style="background-color: cyan;">
										<a href="order_master.php">			<p class="card-text text-center" style="color: black;">Total Orders</p>
											<p class="card-text text-center" style="color: black;"><?php echo $totalorders ?></p>
											</a>
										</div>
									</div>
								</div>
								
									
								<div class="col-lg-4">
									<div class="card" style="width: 18rem;">
										<div class="card-body rounded" style="background-color:darkmagenta;">
										<a href="completed.php">
										<p class="card-text text-center" style="color: black;">Completed Orders</p>
											<p class="card-text text-center" style="color: black;"><?php echo $completed ?></p>
											<a/>
										</div>
									</div>
								</div>
							
							
								<div class="col-lg-4">
									<div class="card" style="width: 18rem;">
										<div class="card-body rounded" style="background-color:chartreuse;">
										<a href="pending.php">
										<p class="card-text text-center" style="color: black;">Pending Orders</p>
											<p class="card-text text-center" style="color: black;"><?php echo $notprocess ?></p>
											</a>
										</div>
									</div>
								</div>
							
								
								<div class="col-lg-4">
									<div class="card" style="width: 18rem;">
									
									<div class="card-body rounded" style="background-color:darksalmon;">
									<a href="inprocess.php">
									<p class="card-text text-center" style="color: black;">In Process Orders</p>
											<p class="card-text text-center" style="color: black;"><?php echo $inprocess ?></p>
											</a>
										</div>
									</div>
								</div>
							
								
								<div class="col-lg-4">
									<div class="card" style="width: 18rem;">
										<div class="card-body rounded" style="background-color:crimson;">
										<a href="shipped.php">
										<p class="card-text text-center" style="color: black;">Shipped Orders</p>
											<p class="card-text text-center" style="color: black;"><?php echo $shipped ?></p>
									
											</a>	</div>
									</div>
								</div>
							
								

							
								<div class="col-lg-4">
									<div class="card" style="width: 18rem;">
										<div class="card-body rounded" style="background-color:darkgrey;">
										<a href="canceled.php">		<p class="card-text text-center" style="color: black;">Cancel Orders</p>
											<p class="card-text text-center" style="color: black;"><?php echo $cancled ?></p>
										
											</a></div>
									</div>
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